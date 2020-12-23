<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Brand;
use App\Models\SubChildCategory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

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
            'brand_name' => 'required|unique:"brands"'

        ]);

        if ($validator->fails()) {
            if ($validator->messages()->all()[0] == "The brand name has already been taken.") {
                Alert::warning('Opps!','Brand name already taken.');
                return redirect()->back();
            }else{
                Alert::warning('Opps!','Please fillup all field.');
                return redirect()->back();
            }
        }else{
            Brand::create([

                'brand_name'=>$request->brand_name,
                'slug'=> Str::slug($request->brand_name),
                'br_description'=>$request->br_description
            ]);
        }



        // if ($request->category_id && $request->child_category_id && $request->sub_child_category_id) {

        // }elseif($request->category_id && !$request->child_category_id && !$request->sub_child_category_id){
        //     Brand::create([
        //         'category_id'=>$request->category_id,
        //         'brand_name'=>$request->brand_name,
        //         'slug'=> $request->brand_name,
        //         'br_description'=>$request->br_description
        //     ]);
        // }elseif($request->category_id && $request->child_category_id && !$request->sub_child_category_id){
        //     Brand::create([
        //         'category_id'=>$request->category_id,
        //         'child_category_id'=>$request->child_category_id,
        //         'brand_name'=>$request->brand_name,
        //         'slug'=> $request->brand_name,
        //         'br_description'=>$request->br_description
        //     ]);
        // }


        toast('Brand Upload successfully','success')->padding('10px')->width('270px')->timerProgressBar()->hideCloseButton();

        return redirect()->back();
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
        $validator = Validator::make($request->all(), [
            'brand_name' => 'required',
            'description' => 'required'

        ]);

        if ($validator->fails()) {
            return response()->json([
                'msg'=>'error'
            ],500);
        }else{
            Brand::where('id',$request->id)->update([
                'brand_name'=>$request->brand_name,
                'slug'=> Str::slug($request->brand_name),
                'br_description'=>$request->description
            ]);

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
