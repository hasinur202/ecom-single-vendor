<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WishList;
use App\Models\Cart;
use App\Models\Category;
use App\Models\AdManager;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;
use App\Models\Settings;

class WishListController extends Controller
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
        $count = WishList::select('id')->where('user_id',auth()->user()->id ?? '')->count();
        $count1 = Cart::select('id')->where('user_id',auth()->user()->id ?? '')->count();
        $wish_lists = WishList::latest()->where('user_id',auth()->user()->id ?? '')->get();
        $cart = Cart::latest()->where('user_id',auth()->user()->id ?? '')->get();

        $setting = Settings::first();

        return view('layouts.frontend.wishlist.wishlist',[
            'ads'=>$ads,
            'categories'=>$categories,
            'count'=>$count,
            'count1'=>$count1,
            'wish_lists'=>$wish_lists,
            'cart'=>$cart,
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
            $product = Product::where('slug',$request->slug)->with('get_product_avatars')->first();
            $wish = WishList::where('product_id',$product->id)->first();
            if ($wish) {
                return response()->json([
                    'errors'=> 'match'
                ]);
            }else{
                $data = WishList::create([
                    'product_id'=> $product->id,
                    'user_id'=> auth()->user()->id
                ]);

                if ($data) {
                    $count = WishList::select('id')->count();
                    return response()->json([
                        'count'=>$count
                    ]);
                }
            }
        }else{
            return response()->json([
                'guest'=>'guest'
            ]);
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        WishList::where('product_id',$id)->delete();
        toast('Product remove successfully','success')->padding('10px')->width('270px')->timerProgressBar()->hideCloseButton();

        return redirect()->back();
    }
}
