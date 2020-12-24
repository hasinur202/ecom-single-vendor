<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Image;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = auth()->user();
        $categories = Category::all();
        return view('layouts.backend.category.categories',[
            'data'=>$data,
            'categories'=>$categories
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

        $validator = Validator::make($request->all(), [
            'cat_name' => 'required|unique:"categories"',
            'cover' => 'required'

        ]);

        
        if ($validator->fails()) {
            return response()->json([
                'errors'=> $validator->messages()->all()
            ],500);
        }else{
            $image = $request->file('cover');
            $new_name = rand() . '.' . $image->getClientOriginalExtension();
            $img = Image::make($request->file('cover'));
            $upload_path = public_path()."/images/";

            if($new_name){
                $data = Category::create([
                    'cat_name'=>$request->cat_name,
                    'slug'=>Str::slug($request->cat_name),
                    'cover'=>$new_name
                ]);
                if($data){
                    $img->save($upload_path.$new_name);
                    return response()->json([
                        'message'=>'success'
                    ],200);
                }
            }
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

   
    public function update(Request $request)
    {
        $cat = Category::where('id',$request->id)->first();

        if($request->file('cover') != null && $request->cat_name != null){

            $image = $request->file('cover');
            $new_name = rand() . '.' . $image->getClientOriginalExtension();
            $img = Image::make($request->file('cover'));
            $upload_path = public_path()."/images/";
            \File::delete(public_path('images/' . $cat->cover));
            
            if($new_name){
                $data = $cat->update([
                    'cat_name'=>$request->cat_name,
                    'slug'=>Str::slug($request->cat_name),
                    'cover'=>$new_name
                ]);
                if($data){
                    $img->save($upload_path.$new_name);
                    return response()->json([
                        'message'=>'success'
                    ],200);
                }
            }
        }elseif($request->file('cover') != null && $request->cat_name == $cat->cat_name){

            $image = $request->file('cover');
            $new_name = rand() . '.' . $image->getClientOriginalExtension();
            $img = Image::make($request->file('cover'));
            $upload_path = public_path()."/images/";
            \File::delete(public_path('images/' . $cat->cover));
            
            if($new_name){
                $data = $cat->update([
                    'cover'=>$new_name
                ]);
                if($data){
                    $img->save($upload_path.$new_name);
                    return response()->json([
                        'message'=>'success'
                    ],200);
                }
            }
        }elseif($request->file('cover') == null && $request->cat_name != null){
            
            
            $data = $cat->update([
                'cat_name'=>$request->cat_name,
                'slug'=>Str::slug($request->cat_name)
            ]);
            
            return response()->json([
                'message'=>'success'
            ],200);
                
         
        }
    }

    public function destroy(Request $request)
    {
        $category = Category::find($request->id);
        $category->status = 0;
        $category->save();
        toast('Category delete successfully','success')
        ->padding('10px')->width('270px')->timerProgressBar()->hideCloseButton();
        return response()->json([
            'message'=>'success'
        ]);
    }
}
