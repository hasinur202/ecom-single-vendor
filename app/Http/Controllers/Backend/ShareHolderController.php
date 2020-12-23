<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Nominee;
use App\User;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Image;
use App\Models\Product;
use App\Models\ShareHolder;
use App\Models\ShareHolderPaymentHistory;

class ShareHolderController extends Controller
{
    public function index(){
        $data = auth()->user();
        $products = Product::all();
        $categories = Category::all();
        $shareholders = ShareHolder::with('get_users','get_nominees','get_users.get_share_holder_level')->where('token','!=',null)->get();

        return view('layouts.backend.shareholder.shareholder_list',[
            'data'=>$data,
            'products'=>$products,
            'categories' =>$categories,
            'shareholders'=>$shareholders
        ]);
    }

    public function new_shareholderList(){


        $shareholders = ShareHolder::with('get_users','get_nominees')->where('token',null)->get();
        $data = auth()->user();
        $products = Product::all();
        $categories = Category::all();

        return view('layouts.backend.shareholder.new_shareholder',[
            'data'=>$data,
            'products'=>$products,
            'categories' =>$categories,
            'shareholders'=>$shareholders,
        ]);
    }

    public function tokenGenerate(Request $request, $id, $name){

        $namee = strtok($name, " ");
        $value = Str::lower($namee).''.strval($id);

        ShareHolder::where('user_id',$id)->update(['token'=>$value]);
        User::where('id',$id)->update(['type'=>'share_holder']);

        toast('Shareholder Approved & Token Generated','success')->padding('10px')->width('270px')->timerProgressBar()->hideCloseButton();

        return redirect()->back();
    }

    public function tokenDeactive(Request $request, $id){


        ShareHolder::where('id',$id)->update(['token'=>null]);

        toast('Token Deactivated','success')->padding('10px')->width('270px')->timerProgressBar()->hideCloseButton();

        return redirect()->back();
    }

    public function delete($id){
        Nominee::where('share_holder_id',$id)->delete();
        ShareHolder::where('id',$id)->delete();

        return redirect()->back()->with('success','ShareHolder Deleted Successfully.');
    }


    public function pay(Request $request)
    {
        $data = ShareHolder::where('id',$request->id)->with('get_users')->first();
        User::where('id',$data->user_id)->update([
            'e_money'=>$data->get_users->e_money - $request->pay_money
        ]);

        ShareHolderPaymentHistory::create([
            'share_holder_id'=>$request->id,
            'amount'=>$request->pay_money,
            'transaction_no'=>$request->transaction_no,
            'payment'=>$request->payment
        ]);
    }

    public function payment_list()
    {
        $data = auth()->user();
        $histories = ShareHolderPaymentHistory::with('get_share_holder','get_share_holder.get_users')->get();
        return view('layouts.backend.shareholder.payment_history',[
            'data'=>$data,
            'histories'=>$histories
        ]);
    }

    public function payment_delete($id)
    {
        ShareHolderPaymentHistory::find($id)->delete();

        toast('History Deleted Successfull.','success')->padding('10px')->width('270px')->timerProgressBar()->hideCloseButton();
        return redirect()->back();
    }



}
