<?php

namespace App\Http\Controllers\Frontend;

use Image;
use session;
use App\User;
use App\Models\Cart;
use App\Models\Orders;
use App\Models\Category;
use App\Models\Settings;
use App\Models\WishList;
use App\Models\AdManager;
use App\Models\Attribute;
use App\Models\OrderDetails;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function queryForCat(){
        return Category::where('status',1)->with('get_child_category','get_child_category.get_sub_child_category')->get();
    }

    public function index(){
        $categories = $this->queryForCat();
        $setting = Settings::first();
        $count = WishList::select('id')->where('user_id',Auth::user()->id ?? '')->count();
        $count1 = Cart::select('id')->where('user_id',Auth::user()->id ?? '')->count();
        $cart = Cart::latest()->where('user_id',auth()->user()->id ?? '')->get();
        $ads = AdManager::all();

        return view('layouts.frontend.user.login',[
            'categories'=>$categories,
            'setting'=>$setting,
            'count'=>$count,
            'count1'=>$count1,
            'cart'=>$cart,
            'ads'=>$ads
        ]);
    }

    public function registerIndex(){
        $categories = $this->queryForCat();
        $setting = Settings::first();
        $count = WishList::select('id')->where('user_id',Auth::user()->id ?? '')->count();
        $count1 = Cart::select('id')->where('user_id',Auth::user()->id ?? '')->count();
        $cart = Cart::latest()->where('user_id',auth()->user()->id ?? '')->get();
        $ads = AdManager::all();

        return view('layouts.frontend.user.register',[
            'categories'=>$categories,
            'setting'=>$setting,
            'count'=>$count,
            'count1'=>$count1,
            'cart'=>$cart,
            'ads'=>$ads
        ]);
    }


    public function user_profile(){
        $categories = $this->queryForCat();
        $setting = Settings::first();
        $count = WishList::select('id')->where('user_id',Auth::user()->id ?? '')->count();
        $count1 = Cart::select('id')->where('user_id',Auth::user()->id ?? '')->count();
        $userOrderDetails = OrderDetails::with('get_product');
        $orders = Orders::where('user_id',auth()->user()->id ?? '')->get();
        $cart = Cart::latest()->where('user_id',auth()->user()->id ?? '')->get();
        $ads = AdManager::all();

        return view('layouts.frontend.user.profile',[
            'categories'=>$categories,
            'setting'=>$setting,
            'count'=>$count,
            'count1'=>$count1,
            'cart'=>$cart,
            'userOrderDetails'=>$userOrderDetails,
            'orders'=>$orders,
            'ads'=>$ads
        ]);
    }


    public function getUserProduct(Request $request){
        $userOrderDetails = OrderDetails::with('get_product')->where('user_id',$request->id)->get();
        return view('layouts.frontend.user.user_order_details',[
            'userOrderDetails'=>$userOrderDetails
        ]);

    }


    public function orderedProductInfo(Request $request){
        $userOrderDetails = OrderDetails::with('get_product')->where('order_id',$request->id)->get();
        return view('layouts.frontend.user.order_by_product',[
            'userOrderDetails'=>$userOrderDetails
        ]);
    }


    public function refundOrder(Request $request, $id){
        Orders::where('id',$id)->update([
            'status'=>'Refund'
        ]);
        return redirect()->back()->with('success','Order has been refunded');
    }




    public function logout(Request $request)
    {
        if(Auth::check()){
            Auth::logout();
            $request->session()->flush();

            return redirect()->route('home');
        }

    }


    public function update(Request $request)
    {
        if($request->old_password == null && $request->new_password == null){
            User::where('id',auth()->user()->id ?? '')->update([
                'name'=>$request->name,
                'email'=>$request->email,
                'phn'=>$request->phn,
                'address'=>$request->address
            ]);
            toast('Update Successfull.','success')->padding('10px')->width('270px')->timerProgressBar()->hideCloseButton();
        }else{

            if (Auth::attempt([
                'email'=>$request->email,
                'password'=>$request->old_password
            ])) {
                User::where('id',auth()->user()->id ?? '')->update([
                    'name'=>$request->name,
                    'email'=>$request->email,
                    'phn'=>$request->phn,
                    'password'=>Hash::make($request->new_password),
                    'address'=>$request->address
                ]);
                toast('Update Successfull.','success')->padding('10px')->width('270px')->timerProgressBar()->hideCloseButton();

            }else{
                Alert::warning('Opps!','Wrong Password.');
            }
        }
        return redirect()->back();

    }


    public function get_shipp_des(){
        $data = Cart::where('user_id',auth()->user()->id ?? '')->select('shipp_des')->first();

        return response()->json([
            'data'=>$data
        ]);
    }

}
