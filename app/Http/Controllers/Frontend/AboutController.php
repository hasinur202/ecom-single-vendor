<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Cart;
use App\Models\About;
use App\Models\Category;
use App\Models\Settings;
use App\Models\WishList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AboutController extends Controller
{

    public function index()
    {
        $categories = Category::with('get_child_category')->get();
        $cart = Cart::latest()->where('user_id',auth()->user()->id ?? '')->get();
        $count = WishList::select('id')->where('user_id',auth()->user()->id ?? '')->count();
        $count1 = Cart::select('id')->where('user_id',auth()->user()->id ?? '')->count();
        $about = About::first();

        $setting = Settings::first();
        return view('layouts.frontend.settings.about_us',[
            'categories'=>$categories,
            'count'=>$count,
            'cart'=>$cart,
            'count1'=>$count1,
            'setting'=>$setting,
            'about'=>$about
        ]);
    }

}

