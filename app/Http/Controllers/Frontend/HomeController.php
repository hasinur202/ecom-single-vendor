<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Settings;
use App\Models\WishList;
use App\Models\AdManager;
use App\Models\Banar;
use App\Models\Attribute;
use App\Models\Cart;
use App\Models\ChildCategory;
use App\Models\SubChildCategory;
use App\Models\Brand;
class HomeController extends Controller
{

    public function queryForCat(){
        return Category::where('status',1)->with('get_child_category','get_child_category.get_sub_child_category')->get();
    }

    public function index()
    {
        $banars = Banar::all();
        $ads = AdManager::all();
        $categories = $this->queryForCat();
        $setting = Settings::first();
        $cart = Cart::latest()->where('user_id',auth()->user()->id ?? '')->get();
        $count = WishList::select('id')->where('user_id',auth()->user()->id ?? '')->count();
        $count1 = Cart::select('id')->where('user_id',auth()->user()->id ?? '')->count();
        $products = Product::with('get_product_avatars','get_attribute')->get();
        $all_product = Product::with('get_product_avatars','get_attribute')
        ->where('position','just for you')
        ->limit(12)
        ->get();
        $brands = Brand::all();
        
        return view('layouts.frontend.home',[
            'categories'=>$categories,
            'setting'=>$setting,
            'cart'=>$cart,
            'count'=>$count,
            'count1'=>$count1,
            'banars'=>$banars,
            'products'=>$products,
            'all_product'=>$all_product,
            'ads'=>$ads,
            'brands'=>$brands
        ]);
    }

    public function productByCategory($slug)
    {
        $pro_name = Product::where('product_name',$slug)->first();
        if ($pro_name) {
            return $this->searchByProduct($pro_name,$slug);
        }else{

            $categories = $this->queryForCat();
            $ads = AdManager::all();
            $category = ChildCategory::where('slug',$slug)->with('get_category:id,cover')->first();
            $sub_category = SubChildCategory::where('slug',$slug)->with('get_category:id,cover')->first();
            $count = WishList::select('id')->where('user_id',auth()->user()->id ?? '')->count();
            $count1 = Cart::select('id')->where('user_id',auth()->user()->id ?? '')->count();

            if ($category != null) {
                $products = Product::where('child_category_id',$category->id)->with(['get_product_avatars','get_attribute' => function ($query) {
                    $query->whereNotNull('product_id')->get();
                }])->get();
                $product = $category->get_product()->with('get_brand')->selectRaw('distinct(brand_id)')->get();
                $productSize = Product::where('child_category_id',$category->id)->with(['get_product_avatars','get_attribute' => function ($query) {
                    $query->whereNotNull('size')->get();
                }])->get();
            }elseif($sub_category !=null){
                $products = Product::where('sub_child_category_id',$sub_category->id)->with(['get_product_avatars','get_attribute' => function ($query) {
                    $query->whereNotNull('product_id')->get();
                }])->get();
                $product = $sub_category->get_product()->with('get_brand')->selectRaw('distinct(brand_id)')->get();
                $productSize = Product::where('sub_child_category_id',$sub_category->id)->with(['get_product_avatars','get_attribute' => function ($query) {
                    $query->whereNotNull('size')->get();
                }])->get();
            }


            $setting = Settings::first();
            $cart = Cart::latest()->where('user_id',auth()->user()->id ?? '')->get();
            return view('layouts.frontend.product.category_wise_products',[
                'setting'=>$setting,
                'cart'=>$cart,
                'count'=>$count,
                'count1'=>$count1,
                'categories'=>$categories,
                'category'=>$category,
                'sub_category'=>$sub_category,
                'products'=>$products,
                'product'=>$product,
                'productSize'=>$productSize,
                'ads'=>$ads
            ]);
        }
    }

    public function searchByProduct($pro_name,$slug)
    {

        $categories = $this->queryForCat();
        $category = ChildCategory::where('id',$pro_name->child_category_id)->with('get_category:id,cover')->first();
        $sub_category = SubChildCategory::where('id',$pro_name->sub_child_category_id)->with('get_category:id,cover')->first();
        $count = WishList::select('id')->where('user_id',auth()->user()->id ?? '')->count();
        $count1 = Cart::select('id')->where('user_id',auth()->user()->id ?? '')->count();
        $ads = AdManager::all();

        if ($category != null) {
            $products = Product::where('child_category_id',$category->id)->with(['get_product_avatars','get_attribute' => function ($query) {
                $query->whereNotNull('product_id')->get();
            }])->get();
            $product = $category->get_product()->with('get_brand')->selectRaw('distinct(brand_id)')->get();
            $productSize = Product::where('child_category_id',$category->id)->with(['get_product_avatars','get_attribute' => function ($query) {
                $query->whereNotNull('size')->get();
            }])->get();
        }elseif($sub_category !=null){
            $products = Product::where('sub_child_category_id',$sub_category->id)->with(['get_product_avatars','get_attribute' => function ($query) {
                $query->whereNotNull('product_id')->get();
            }])->get();
            $product = $sub_category->get_product()->with('get_brand')->selectRaw('distinct(brand_id)')->get();
            $productSize = Product::where('sub_child_category_id',$sub_category->id)->with(['get_product_avatars','get_attribute' => function ($query) {
                $query->whereNotNull('size')->get();
            }])->get();
        }

        $setting = Settings::first();
        $cart = Cart::latest()->where('user_id',auth()->user()->id ?? '')->get();
        return view('layouts.frontend.product.category_wise_products',[
            'setting'=>$setting,
            'cart'=>$cart,
            'count'=>$count,
            'count1'=>$count1,
            'categories'=>$categories,
            'category'=>$category,
            'sub_category'=>$sub_category,
            'products'=>$products,
            'product'=>$product,
            'productSize'=>$productSize,
            'ads'=>$ads
        ]);
    }

    public function productSearch(Request $request)
    {
        if ($request->data1 != null) {
            if ($request->col_name3 == null) {
                if($request->col_name == "id"){
                    $products = Product::whereHas('get_attribute', function($q) use($request){
                        $q->where($request->col_name,$request->data);
                    })->where($request->col_name1,$request->data1)
                    ->with('get_product_avatars')->get();
                }else{
                    $products = Product::where($request->col_name,$request->data)
                    ->where($request->col_name1,$request->data1)
                    ->with('get_product_avatars')->get();
                }

            }else{
                $products = Product::where($request->col_name1,$request->data1)
                ->whereHas('get_attribute', function($q) use($request){
                    $q->whereBetween('sale_price',[$request->min,$request->max,]);
                })->with('get_product_avatars')->get();
            }

            return view('layouts.frontend.product.all_products',[
                'products'=>$products
            ]);
        }elseif($request->data2 != null){
            if ($request->col_name3 == null) {
                if($request->col_name == "id"){
                    $products = Product::where($request->col_name2,$request->data2)
                    ->whereHas('get_attribute', function($q) use($request){
                        $q->where($request->col_name,$request->data);
                    })->with('get_product_avatars')->get();

                }else{
                    $products = Product::where($request->col_name,$request->data)
                    ->where($request->col_name2,$request->data2)
                    ->with('get_product_avatars')->get();
                }
            }else{
                $products = Product::where($request->col_name2,$request->data2)
                ->whereHas('get_attribute', function($q) use($request){
                    $q->whereBetween('sale_price',[$request->min,$request->max,]);
                })->with('get_product_avatars')->get();
            }

            return view('layouts.frontend.product.all_products',[
                'products'=>$products
            ]);
        }
    }


    public function priceBySize(Request $request)
    {
        $price = Attribute::select('sale_price','promo_price')
        ->where('product_id',$request->id)
        ->where('size',$request->val)->first();
        return response()->json([
            'price'=>$price
        ]);
    }



    public function search(Request $request)
    {
        $product_data = Product::where('product_name','LIKE','%'.$request->name.'%')->get();
        $output = '<ul style="margin-left: -27px;">';
        foreach($product_data as $row)
        {
        $output .= '
        <li style="list-style: none;border-bottom: 1px solid #ddd;"><a href="#">'.$row->product_name.'</a></li>';
        }
        $output .= '</ul>';
        return $output;
    }

    public function quick_view($slug)
    {
        $categories = Category::with('get_child_category')->get();
        $count = WishList::select('id')->where('user_id',auth()->user()->id ?? '')->count();
        $count1 = Cart::select('id')->where('user_id',auth()->user()->id ?? '')->count();
        $product = Product::where('slug',$slug)->with('get_product_avatars','get_brand','get_attribute')->first();
        $cart = Cart::where('user_id',auth()->user()->id ?? '')->get();
        $products = Product::with('get_brand','get_product_avatars')->get();
        $ads = AdManager::all();

        $setting = Settings::first();
        return view('layouts.frontend.product.product_details',[
            'categories'=>$categories,
            'count'=>$count,
            'count1'=>$count1,
            'cart'=>$cart,
            'product'=>$product,
            'products'=>$products,
            'setting'=>$setting,
            'ads'=>$ads
        ]);

    }


     public function confirmPayment(){
        $categories = $this->queryForCat();
        $count = WishList::select('id')->where('user_id',auth()->user()->id ?? '')->count();
        $count1 = Cart::select('id')->where('user_id',auth()->user()->id ?? '')->count();
        $setting = Settings::first();
        $cart = Cart::latest()->where('user_id',auth()->user()->id ?? '')->get();
        $ads = AdManager::all();

        return view('layouts.frontend.cart.confirm',[
            'categories'=>$categories,
            'setting'=>$setting,
            'cart'=>$cart,
            'count'=>$count,
            'count1'=>$count1,
            'ads'=>$ads
        ]);
    }

    public function billing_index(){
        $categories = $this->queryForCat();
        $count = WishList::select('id')->where('user_id',auth()->user()->id ?? '')->count();
        $count1 = Cart::select('id')->where('user_id',auth()->user()->id ?? '')->count();
        $setting = Settings::first();
        $cart = Cart::where('user_id',auth()->user()->id ?? '')->with('get_product')->get();
        $ads = AdManager::all();

        return view('layouts.frontend.cart.billing_address',[
            'categories'=>$categories,
            'setting'=>$setting,
            'cart'=>$cart,
            'count'=>$count,
            'count1'=>$count1,
            'ads'=>$ads
        ]);
    }

    public function shop_more($data)
    {
        $ads = AdManager::all();
        $categories = $this->queryForCat();
        $setting = Settings::first();
        $cart = Cart::latest()->where('user_id',auth()->user()->id ?? '')->get();
        $count = WishList::select('id')->where('user_id',auth()->user()->id ?? '')->count();
        $count1 = Cart::select('id')->where('user_id',auth()->user()->id ?? '')->count();
        $products = Product::with('get_product_avatars','get_attribute')
        ->where('position',$data)
        ->get();
        
        return view('layouts.frontend.show_more_product',[
            'categories'=>$categories,
            'setting'=>$setting,
            'cart'=>$cart,
            'count'=>$count,
            'count1'=>$count1,
            'products'=>$products,
            'ads'=>$ads,
        ]);
    }

    public function product_by_brand($data)
    {
        $ads = AdManager::all();
        $categories = $this->queryForCat();
        $setting = Settings::first();
        $cart = Cart::latest()->where('user_id',auth()->user()->id ?? '')->get();
        $count = WishList::select('id')->where('user_id',auth()->user()->id ?? '')->count();
        $count1 = Cart::select('id')->where('user_id',auth()->user()->id ?? '')->count();
        $products = Product::with('get_product_avatars','get_attribute','get_brand')
        ->whereHas('get_brand',function($q) use($data){
            $q->where('slug',$data);
        })
        ->get();
        return view('layouts.frontend.product_by_brand',[
            'categories'=>$categories,
            'setting'=>$setting,
            'cart'=>$cart,
            'count'=>$count,
            'count1'=>$count1,
            'products'=>$products,
            'ads'=>$ads,
        ]);
    }


    public function load_more(Request $request)
    {
        $all_product = Product::with('get_product_avatars','get_attribute')
        ->where('position','just for you')
        ->limit($request->len+$request->val)
        ->get();

        return view('layouts.frontend.load_more',[
            'all_product'=>$all_product
        ]);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
