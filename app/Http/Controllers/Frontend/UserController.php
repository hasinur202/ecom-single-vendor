<?php

namespace App\Http\Controllers\Frontend;

use Image;
use session;
use App\User;
use App\Models\Cart;
use App\Models\Nominee;
use App\Models\Category;
use App\Models\Settings;
use App\Models\WishList;
use App\Models\ShareHolder;
use App\Models\OrderDetails;
use App\Models\Attribute;
use App\Models\Orders;
use Illuminate\Http\Request;
use App\Models\ShareHolderLevel;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

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

        return view('layouts.frontend.user.login',[
            'categories'=>$categories,
            'setting'=>$setting,
            'count'=>$count,
            'count1'=>$count1,
            'cart'=>$cart
        ]);
    }

    public function registerIndex(){
        $categories = $this->queryForCat();
        $setting = Settings::first();
        $count = WishList::select('id')->where('user_id',Auth::user()->id ?? '')->count();
        $count1 = Cart::select('id')->where('user_id',Auth::user()->id ?? '')->count();
        $cart = Cart::latest()->where('user_id',auth()->user()->id ?? '')->get();

        return view('layouts.frontend.user.register',[
            'categories'=>$categories,
            'setting'=>$setting,
            'count'=>$count,
            'count1'=>$count1,
            'cart'=>$cart
        ]);
    }

    public function shareholderRegister(){
        $categories = $this->queryForCat();
        $setting = Settings::first();
        $count = WishList::select('id')->where('user_id',Auth::user()->id ?? '')->count();
        $count1 = Cart::select('id')->where('user_id',Auth::user()->id ?? '')->count();
        $cart = Cart::latest()->where('user_id',auth()->user()->id ?? '')->get();

        return view('layouts.frontend.user.shareholder',[
            'categories'=>$categories,
            'setting'=>$setting,
            'count'=>$count,
            'count1'=>$count1,
            'cart'=>$cart
        ]);
    }


    public function shareholderFormStore(Request $request){

        $checkUser = ShareHolder::where('user_id', auth()->user()->id)->first();

        if($checkUser){

            return response()->json([
                'message'=>'error'
            ],502);

        }else{
            if($request->nom_nid != '' && $request->nid == ''){
                $validator = Validator::make($request->all(), [
                    'account_no' => 'required|unique:share_holders',
                    'acc_type' =>'required',
                    'nominee_name' =>'required',
                    'nom_mobile' =>'required|unique:nominees',
                    'nom_nid' =>'required|unique:nominees',
                    'nom_image1'=>'required',
                    'nom_image2'=>'required'
                ]);
                if ($validator->fails()) {
                    return response()->json([
                        'errors'=> $validator->messages()->all()
                    ],404);
                }
                elseif($request->file('nom_image1') != null && $request->file('nom_image2') != null){
                    $nid_front = $request->file('nom_image1');
                    $nid_back = $request->file('nom_image2');

                    $new_name1 = rand() . '.' . $nid_front->getClientOriginalExtension();
                    $new_name2 = rand() . '.' . $nid_back->getClientOriginalExtension();
                    $img1 = Image::make($request->file('nom_image1'))->fit(1349,375);
                    $img2 = Image::make($request->file('nom_image2'))->fit(1349,375);
                    $upload_path = public_path()."/images/";

                    $data = ShareHolder::create([
                        'user_id'=>auth()->user()->id,
                        'account_no'=>$request->account_no,
                        'acc_type'=>$request->acc_type,
                    ]);

                    $data2 = Nominee::create([
                        'share_holder_id'=>$data->id,
                        'nominee_name'=>$request->nominee_name,
                        'nom_mobile'=>$request->nom_mobile,
                        'nom_nid'=>$request->nom_nid,
                        'nom_image1'=>$new_name1,
                        'nom_image2'=>$new_name2,
                    ]);

                    if($data2){
                        $img1->save($upload_path.$new_name1);
                        $img2->save($upload_path.$new_name2);

                        return response()->json([
                            'message'=>'success'
                        ],200);
                    }
                }
                else{
                    return response()->json([
                        'message'=>'error'
                    ],500);
                }
            }elseif($request->nid != '' && $request->nom_nid == ''){
                $validator = Validator::make($request->all(), [
                    'account_no' => 'required|unique:share_holders',
                    'acc_type' =>'required',
                    'nid' =>'required|unique:share_holders',
                    'image_front'=>'required',
                    'image_back'=>'required',
                ]);
                if ($validator->fails()) {

                    return response()->json([
                        'errors'=> $validator->messages()->all()
                    ],404);
                }
                elseif($request->file('image_front') != null && $request->file('image_back') != null){
                    $nid_front = $request->file('image_front');
                    $nid_back = $request->file('image_back');

                    $new_name1 = rand() . '.' . $nid_front->getClientOriginalExtension();
                    $new_name2 = rand() . '.' . $nid_back->getClientOriginalExtension();
                    $img1 = Image::make($request->file('image_front'))->fit(1349,375);
                    $img2 = Image::make($request->file('image_back'))->fit(1349,375);
                    $upload_path = public_path()."/images/";

                    $data = ShareHolder::create([
                        'user_id'=>auth()->user()->id,
                        'nid'=>$request->nid,
                        'account_no'=>$request->account_no,
                        'acc_type'=>$request->acc_type,
                        'image_front'=>$new_name1,
                        'image_back'=>$new_name2,
                    ]);
                    if($data){
                        $img1->save($upload_path.$new_name1);
                        $img2->save($upload_path.$new_name2);

                        return response()->json([
                            'message'=>'success'
                        ],200);
                    }
                }
                else{
                    return response()->json([
                        'message'=>'error'
                    ],500);
                }
            }else{
                return response()->json([
                    'message'=>'error'
                ],422);
            }
        }
    }


    public function user_profile(){
        $categories = $this->queryForCat();
        $setting = Settings::first();
        $count = WishList::select('id')->where('user_id',Auth::user()->id ?? '')->count();
        $count1 = Cart::select('id')->where('user_id',Auth::user()->id ?? '')->count();

        $shareholder = ShareHolder::with('get_users','get_users.get_share_holder_level')->where('token','!=',null)->where('user_id',Auth::user()->id ?? '')->first();
        $countClient = User::where('share_holder_id',$shareholder->id ?? '')->count();
        $holder_users = User::where('share_holder_id',$shareholder->id ?? '')->get();

        //count all user product those users are under the shareholder
        $shareHolderUser = Orders::where('token',$shareholder->token ?? '')->get();
        $countSharedUserPro = 0;
        foreach($shareHolderUser as $userSharedHolder){
            $countSharedUserPro = $countSharedUserPro + OrderDetails::where('order_id',$userSharedHolder->id)->count();
        }

        $shareholderlevels = ShareHolderLevel::all();
        $userOrderDetails = OrderDetails::with('get_product');
        $orders = Orders::where('user_id',auth()->user()->id ?? '')->get();
        $cart = Cart::latest()->where('user_id',auth()->user()->id ?? '')->get();

        return view('layouts.frontend.user.profile',[
            'categories'=>$categories,
            'setting'=>$setting,
            'count'=>$count,
            'count1'=>$count1,
            'cart'=>$cart,
            'shareholder'=>$shareholder,
            'countClient'=>$countClient,
            'countSharedUserPro'=>$countSharedUserPro,
            'shareholderlevels'=>$shareholderlevels,
            'holder_users'=>$holder_users,
            'userOrderDetails'=>$userOrderDetails,
            'orders'=>$orders
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
