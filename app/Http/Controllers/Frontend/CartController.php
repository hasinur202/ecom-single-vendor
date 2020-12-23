<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WishList;
use App\Models\Cart;
use App\Models\Category;
use App\Models\AdManager;
use App\Models\Product;
use App\Models\Attribute;
use App\Models\Orders;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;

use App\Models\Settings;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::with('get_child_category')->get();
        $ads = AdManager::all();
        $cart = Cart::latest()->where('user_id',auth()->user()->id ?? '')->get();
        $count = WishList::select('id')->where('user_id',auth()->user()->id ?? '')->count();
        $count1 = Cart::select('id')->where('user_id',auth()->user()->id ?? '')->count();

        $orders = Orders::where('user_id',auth()->user()->id ?? '')->get();

        $setting = Settings::first();
        return view('layouts.frontend.cart.cart',[
            'ads'=>$ads,
            'categories'=>$categories,
            'count'=>$count,
            'cart'=>$cart,
            'count1'=>$count1,
            'orders'=>$orders,
            'setting'=>$setting,
        ]);
    }

    public function billing_index()
    {
        $categories = Category::with('get_child_category')->get();
        $ads = AdManager::all();
        $cart = Cart::latest()->where('user_id',auth()->user()->id ?? '')->get();
        $count = WishList::select('id')->where('user_id',auth()->user()->id ?? '')->count();
        $count1 = Cart::select('id')->where('user_id',auth()->user()->id ?? '')->count();
        $orders = Orders::where('user_id',auth()->user()->id ?? '')->get();
        $setting = Settings::first();
        return view('layouts.frontend.cart.billing_address',[
            'ads'=>$ads,
            'categories'=>$categories,
            'count'=>$count,
            'count1'=>$count1,
            'cart'=>$cart,
            'orders'=>$orders,
            'setting'=>$setting
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Auth::check()){
            $product = Product::where('id',$request->id)->with('get_product_avatars')->first();
            $attr = Attribute::where('product_id',$request->id)->first();
            if($product){
                $wish = Cart::where([
                    'product_id'=>$attr->product_id,
                    'user_id'=>auth()->user()->id

                ])->first();
            }

            if ($wish) {
                return response()->json([
                    'errors'=> 422
                ],422);
            }else if(!$wish){
                if ($attr->qty >0) {
                    $data = Cart::create([
                        'product_id'=> $attr->product_id,
                        'user_id'=> auth()->user()->id,
                        'size'=> $request->size ?? $attr->size,
                        'total'=>$attr->sale_price*($request->qty ?? 1),
                        'profit'=>($attr->sale_price*($request->qty ?? 1))-($attr->pur_price*($request->qty ?? 1)),
                        'qty'=>$request->qty ?? 1
                    ]);

                    if ($data) {
                        WishList::where('product_id',$request->id)->delete();
                        $count = WishList::select('id')->where('user_id',Auth::user()->id ?? '')->count();
                        $count1 = Cart::select('id')->where('user_id',Auth::user()->id ?? '')->count();
                        $cart = Cart::latest()
                        ->where('user_id',auth()->user()->id ?? '')
                        ->with('get_product','get_product.get_product_avatars')
                        ->get();

                        return view('layouts.frontend.cart.headerCartPortion',[
                            'cart'=>$cart,
                            'count'=>$count,
                            'count1'=>$count1
                        ]);
                    }
                }else{
                    return response()->json([
                        'stockOut'=>'stock out'
                    ],404);
                }
            }
        }else{
            return response()->json([
                'guest'=>'guest'
            ],500);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        if ($request->qty >10) {
            return response()->json([
                'msg'=>'up to 10'
            ]);
        }else{
            $cart = Cart::where('id',$request->id)->first();
            if ($cart->product_id != null) {
                $attr = Attribute::where('product_id',$cart->product_id)->first();
                if ($request->qty <= $attr->qty) {
                    Cart::where('id',$request->id)->update([
                        'qty'=>$request->qty,
                        'total'=>$request->qty*$attr->sale_price
                    ]);

                    $cart = Cart::latest()->where('user_id',auth()->user()->id ?? '')->get();
                    if ($request->qty == 4 || $request->qty == 5 || $request->qty == 6) {
                        return response()->json([
                            'msg'=>'double'
                        ]);
                    }elseif($request->qty >7 || $request->qty == 8 || $request->qty == 9){
                        return response()->json([
                            'msg'=>'treeple'
                        ]);
                    }elseif($request->qty == 10){
                        return response()->json([
                            'msg'=>'fourth'
                        ]);
                    }
                    return response()->json([
                        'msg'=>'success'
                    ]);
                }else{
                    return response()->json([
                        'stock'=>'stock out'
                    ],404);

                }
            }
        }
    }

    function update_by_shipping(Request $request){
        $carts = Cart::where('user_id',auth()->user()->id ?? '')->with('get_product')->get();
        foreach ($carts as $key => $cart) {
            if ($request->shipp_des == "outdoor_charge") {
                if ($cart->qty <= 3) {
                    $cart->update([
                        'shipp_des'=>$request->shipp_des,
                        'delivery_charge'=>1*$cart->get_product->outdoor_charge
                    ]);
                }elseif($cart->qty > 3 && $cart->qty <=6){
                    $cart->update([
                        'shipp_des'=>$request->shipp_des,
                        'delivery_charge'=>2*$cart->get_product->outdoor_charge
                    ]);
                }elseif($cart->qty >6 && $cart->qty <=9){
                    $cart->update([
                        'shipp_des'=>$request->shipp_des,
                        'delivery_charge'=>3*$cart->get_product->outdoor_charge
                    ]);
                }elseif($cart->qty >9 && $cart->qty <=10){
                    $cart->update([
                        'shipp_des'=>$request->shipp_des,
                        'delivery_charge'=>4*$cart->get_product->outdoor_charge
                    ]);
                }
            }elseif($request->shipp_des == "indoor_charge"){
                if ($cart->qty <= 3) {
                    $cart->update([
                        'shipp_des'=>$request->shipp_des,
                        'delivery_charge'=>1*$cart->get_product->indoor_charge
                    ]);
                }elseif($cart->qty > 3 && $cart->qty <=6){
                    $cart->update([
                        'shipp_des'=>$request->shipp_des,
                        'delivery_charge'=>2*$cart->get_product->indoor_charge
                    ]);
                }elseif($cart->qty >6 && $cart->qty <=9){
                    $cart->update([
                        'shipp_des'=>$request->shipp_des,
                        'delivery_charge'=>3*$cart->get_product->indoor_charge
                    ]);
                }elseif($cart->qty >9 && $cart->qty <=10){
                    $cart->update([
                        'shipp_des'=>$request->shipp_des,
                        'delivery_charge'=>4*$cart->get_product->indoor_charge
                    ]);
                }
            }
            
        }

    }

    public function destroy(Request $request)
    {
        Cart::find($request->id)->delete();
        $cart = Cart::where('user_id',auth()->user()->id ?? '')->get();
        $count1 = Cart::select('id')->where('user_id',auth()->user()->id ?? '')->count();
        toast('Product remove successfully','success')->padding('10px')->width('270px')->timerProgressBar()->hideCloseButton();

        return response()->json([
            'cart'=>$cart,
            'count1'=>$count1
        ]);
    }
}
