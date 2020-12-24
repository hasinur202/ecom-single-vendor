<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Brand;
use App\Models\SubChildCategory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Image;

class BrandController extends Controller
{

    public function index()
    {
        $data = auth()->user();
        $brands = Brand::latest()->get();
        return view('layouts.backend.brand.brand_list',[
            'data'=>$data,
            'brands'=>$brands
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCatSubCat(Request $request)
    {
        $datas = SubChildCategory::where('id',$request->id)->with('get_child_category.get_category','get_child_category')->first();
        return response()->json([
            'datas'=>$datas
        ]);
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
            'brand_name' => 'required|unique:"brands"',
            'logo' => 'required'

        ]);

        if ($validator->fails()) {
            return response()->json([
                'msg'=>'error'
            ],500);
        }else{
            $image = $request->file('logo');
            $new_name = rand() . '.' . $image->getClientOriginalExtension();
            $img = Image::make($request->file('logo'));
            $upload_path = public_path()."/images/";

            Brand::create([
                'brand_name'=>$request->brand_name,
                'slug'=> Str::slug($request->brand_name),
                'logo'=>$new_name,
                'br_description'=>$request->br_description
            ]);
            $img->save($upload_path.$new_name);
        }
        return response()->json([
            'msg'=>'success'
        ],200);
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
        $brand = Brand::where('id',$request->brand_id)->first();
        $validator = Validator::make($request->all(), [
            'brand_name' => 'required',

        ]);

        if ($validator->fails()) {
            return response()->json([
                'msg'=>'error'
            ],500);
        }else{
            if ($request->file('logo') != null) {
                
                $image = $request->file('logo');
                $new_name = rand() . '.' . $image->getClientOriginalExtension();
                $img = Image::make($request->file('logo'));
                $upload_path = public_path()."/images/";
                
                Brand::where('id',$request->brand_id)->update([
                    'brand_name'=>$request->brand_name,
                    'logo'=>$new_name,
                    'slug'=> Str::slug($request->brand_name),
                    'br_description'=>$request->description
                ]);
                \File::delete(public_path('images/' . $brand->logo));
                $img->save($upload_path.$new_name);
            }else{
                Brand::where('id',$request->brand_id)->update([
                    'brand_name'=>$request->brand_name,
                    'slug'=> Str::slug($request->brand_name),
                    'br_description'=>$request->description
                ]);
            }
            

            return response()->json([
                'msg'=>'success'
            ],200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
