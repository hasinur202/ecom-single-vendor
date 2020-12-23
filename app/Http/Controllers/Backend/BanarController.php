<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banar;
use App\Models\Category;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Image;
use App\Models\Product;

class BanarController extends Controller
{

    public function index()
    {
        $data = auth()->user();
        $banars = Banar::all();
        $products = Product::all();
        $categories = Category::all();
        return view('layouts.backend.slide.slide_list',[
            'data'=>$data,
            'banars'=>$banars,
            'products'=>$products,
            'categories' =>$categories,
        ]);

    }

    public function index_banar()
    {
        $id = Banar::select('id')->get();
        return response()->json([
            'id'=>$id
        ],200);
    }

    function upload(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required'

        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors'=> 'errors'
            ],500);
        }elseif($request->file('image') != null){
            $image = $request->file('image');
            $new_name = rand() . '.' . $image->getClientOriginalExtension();
            $img = Image::make($request->file('image'))->fit(1349,375);
            $upload_path = public_path()."/images/";

            if($new_name){
                $data = Banar::create([
                    'image'=>$new_name,
                    'product_name'=>$request->product_name,
                    'slug'=>Str::slug($request->product_name)
                ]);
                if($data){
                    $img->save($upload_path.$new_name);
                    
                    return response()->json([
                        'message'=>'success'
                    ],200);
                }
            }
        }
        else{
            
            return response()->json([
                'message'=>'wrong data'
            ],404);
        }

    }



    function update(Request $request)
    {
        $banar = Banar::where('image',$request->slug)->first();

        if($request->file('image') != $banar->image){

            $image = $request->file('image');
            $new_name = rand() . '.' . $image->getClientOriginalExtension();
            $img = Image::make($request->file('image'))->fit(1349,375);
            $upload_path = public_path()."/images/";


            \File::delete(public_path('images/' . $banar->image));

            if($new_name)
            {
                $data = Banar::where('image',$request->slug)->update([
                    'image'=>$new_name,
                    'product_name'=>$request->product_name,
                    'slug'=>Str::slug($request->product_name)
                ]);
                if($data){
                    $img->save($upload_path.$new_name);

                    return response()->json([
                        'message'=>'success'
                    ],200);
                }
            }

        }elseif($request->image == ''){
            $data = Banar::where('slug',$request->slug)->update([
                'product_name'=>$request->product_name,
            ]);

                return response()->json([
                    'message'=>'success'
                ],200);

        }else{
            
            return response()->json([
                'message'=>'Please fillup all field'
            ],404);
        }
    }

    function delete(Request $request)
    {
        $data = Banar::find($request->id);
        $data->delete();

        \File::delete(public_path('images/' . $request->image));

        toast('Banar deleted successfully','success')->padding('10px')->width('270px')->timerProgressBar()->hideCloseButton();

        return redirect()->back();
    }


}
