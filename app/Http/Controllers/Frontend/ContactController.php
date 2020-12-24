<?php
namespace App\Http\Controllers\Frontend;

use App\Models\Cart;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Category;
use App\Models\Settings;
use App\Models\WishList;
use App\Models\AdManager;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function queryForCat(){
        return Category::where('status',1)->with('get_child_category','get_child_category.get_sub_child_category')->get();
    }

    public function index()
    {
        $categories = $this->queryForCat();
        $setting = Settings::first();
        $cart = Cart::latest()->where('user_id',auth()->user()->id ?? '')->get();
        $count = WishList::select('id')->where('user_id',auth()->user()->id ?? '')->count();
        $count1 = Cart::select('id')->where('user_id',auth()->user()->id ?? '')->count();
        $products = Product::select('product_name')->get();
        $ads = AdManager::all();

        return view('layouts.frontend.settings.contact_us',[
            'categories'=>$categories,
            'setting'=>$setting,
            'cart'=>$cart,
            'count'=>$count,
            'count1'=>$count1,
            'products'=>$products,
            'ads'=>$ads
        ]);
    }


    public function storeContact(Request $request){
        $data = Contact::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'message'=>$request->message
        ]);

       toast('Submitted successfully','success')
       ->padding('10px')->width('270px')->timerProgressBar()->hideCloseButton();
        return redirect()->back();

    }

}

