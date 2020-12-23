<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductAvatar;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Image;

class ProductAvatarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = ProductAvatar::select('product_id')->get();
        return response()->json([
            'data'=>$data
        ],200);
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
            'prod_name' => 'required',
            'front' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors'=> $validator->messages()->all()
            ],500);
        }elseif($request->file('front') != null && $request->file('back') == null &&
        $request->file('left') == null && $request->file('right') == null)
        {
            $image = $request->file('front');
            $new_name = rand() . '.' . $image->getClientOriginalExtension();
            $img = Image::make($request->file('front'));
            $upload_path = public_path()."/images/";

            if($new_name){
                $data = ProductAvatar::create([
                    'product_id'=>$request->prod_name,
                    'front'=>$new_name,
                    'back'=>'',
                    'left'=>'',
                    'right'=>'',
                    'slug'=>$new_name
                ]);
                if($data){
                    $img->save($upload_path.$new_name);

                    return response()->json([
                        'message'=>'success'
                    ],200);
                }
            }else{


            }
        }elseif($request->file('front') != null && $request->file('back') != null &&
        $request->file('left') != null && $request->file('right') != null)
        {
            $image = $request->file('front');
            $new_name = rand() . '.' . $image->getClientOriginalExtension();
            $img = Image::make($request->file('front'));
            $upload_path = public_path()."/images/";

            $image2 = $request->file('back');
            $new_name2 = rand() . '.' . $image2->getClientOriginalExtension();
            $img2 = Image::make($request->file('back'));
            $upload_path2 = public_path()."/images/";

            $image3 = $request->file('left');
            $new_name3 = rand() . '.' . $image3->getClientOriginalExtension();
            $img3 = Image::make($request->file('left'));
            $upload_path3 = public_path()."/images/";

            $image4 = $request->file('right');
            $new_name4 = rand() . '.' . $image4->getClientOriginalExtension();
            $img4 = Image::make($request->file('right'));
            $upload_path4 = public_path()."/images/";

            if($new_name && $new_name2 && $new_name3 && $new_name4){
                $data = ProductAvatar::create([
                    'product_id'=>$request->prod_name,
                    'front'=>$new_name,
                    'back'=>$new_name2,
                    'left'=>$new_name3,
                    'right'=>$new_name4,
                    'slug'=>$new_name
                ]);
                if($data){
                    $img->save($upload_path.$new_name);
                    $img2->save($upload_path2.$new_name2);
                    $img3->save($upload_path3.$new_name3);
                    $img4->save($upload_path4.$new_name4);

                    return response()->json([
                        'message'=>'success'
                    ],200);
                }
            }
        }elseif($request->file('front') != null && $request->file('back') != null &&
        $request->file('left') != null && $request->file('right') == null)
        {
            $image = $request->file('front');
            $new_name = rand() . '.' . $image->getClientOriginalExtension();
            $img = Image::make($request->file('front'));
            $upload_path = public_path()."/images/";

            $image2 = $request->file('back');
            $new_name2 = rand() . '.' . $image2->getClientOriginalExtension();
            $img2 = Image::make($request->file('back'));
            $upload_path2 = public_path()."/images/";

            $image3 = $request->file('left');
            $new_name3 = rand() . '.' . $image3->getClientOriginalExtension();
            $img3 = Image::make($request->file('left'));
            $upload_path3 = public_path()."/images/";

            if($new_name && $new_name2){
                $data = ProductAvatar::create([
                    'product_id'=>$request->prod_name,
                    'front'=>$new_name,
                    'back'=>$new_name2,
                    'left'=>$new_name3,
                    'right'=>'',
                    'slug'=>$new_name
                ]);
                if($data){
                    $img->save($upload_path.$new_name);
                    $img2->save($upload_path2.$new_name2);
                    $img3->save($upload_path3.$new_name3);

                    return response()->json([
                        'message'=>'success'
                    ],200);
                }
            }
        }elseif($request->file('front') != null && $request->file('back') != null &&
        $request->file('left') == null && $request->file('right') == null)
        {
            $image = $request->file('front');
            $new_name = rand() . '.' . $image->getClientOriginalExtension();
            $img = Image::make($request->file('front'));
            $upload_path = public_path()."/images/";

            $image2 = $request->file('back');
            $new_name2 = rand() . '.' . $image2->getClientOriginalExtension();
            $img2 = Image::make($request->file('back'));
            $upload_path2 = public_path()."/images/";

            if($new_name && $new_name2){
                $data = ProductAvatar::create([
                    'product_id'=>$request->prod_name,
                    'front'=>$new_name,
                    'back'=>$new_name2,
                    'left'=>'',
                    'right'=>'',
                    'slug'=>$new_name
                ]);
                if($data){
                    $img->save($upload_path.$new_name);
                    $img2->save($upload_path2.$new_name2);

                    return response()->json([
                        'message'=>'success'
                    ],200);
                }
            }
        }
        else{
            return response()->json([
                'message'=>'error'
            ],404);
        }
    }


    public function show($slug)
    {
        $data = auth()->user();
        $data1 = Product::where('slug',$slug)->first();
        $avatars = ProductAvatar::where('product_id',$data1->id)->with('get_product')->get();
        return view('layouts.backend.product.avatars',[
            'avatars'=>$avatars,
            'data'=>$data
        ]);
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request)
    {

        $data = ProductAvatar::where('slug',$request->slug)->first();

        if($request->file('front') != null && $request->file('back') != null &&
        $request->file('left') != null && $request->file('right') != null
        ){

            $image = $request->file('front');
            $new_name = rand() . '.' . $image->getClientOriginalExtension();
            $img = Image::make($request->file('front'));
            $upload_path = public_path()."/images/";

            $image2 = $request->file('back');
            $new_name2 = rand() . '.' . $image2->getClientOriginalExtension();
            $img2 = Image::make($request->file('back'));
            $upload_path2 = public_path()."/images/";

            $image3 = $request->file('left');
            $new_name3 = rand() . '.' . $image3->getClientOriginalExtension();
            $img3 = Image::make($request->file('left'));
            $upload_path3 = public_path()."/images/";

            $image4 = $request->file('right');
            $new_name4 = rand() . '.' . $image4->getClientOriginalExtension();
            $img4 = Image::make($request->file('right'));
            $upload_path4 = public_path()."/images/";

            \File::delete(public_path('images/' . $data->front));
            \File::delete(public_path('images/' . $data->back));
            \File::delete(public_path('images/' . $data->left));
            \File::delete(public_path('images/' . $data->right));

            if($new_name && $new_name2 && $new_name3 && $new_name4)
            {
                $data = ProductAvatar::where('slug',$request->slug)->update([
                    'front'=>$new_name,
                    'back'=>$new_name2,
                    'left'=>$new_name3,
                    'right'=>$new_name4,
                    'slug'=>$new_name
                ]);
                if($data){
                    $img->save($upload_path.$new_name);
                    $img2->save($upload_path2.$new_name2);
                    $img3->save($upload_path3.$new_name3);
                    $img4->save($upload_path4.$new_name4);

                    return response()->json([
                        'message'=>'success'
                    ],200);
                }
            }

        }elseif($request->file('front') != null && $request->file('back') == null &&
        $request->file('left') == null && $request->file('right') == null){
            $image = $request->file('front');
            $new_name = rand() . '.' . $image->getClientOriginalExtension();
            $img = Image::make($request->file('front'));
            $upload_path = public_path()."/images/";

            \File::delete(public_path('images/' . $data->front));

            if($new_name)
            {
                $data = ProductAvatar::where('slug',$request->slug)->update([
                    'front'=>$new_name,
                    'slug'=>$new_name
                ]);
                if($data){
                    $img->save($upload_path.$new_name);

                    return response()->json([
                        'message'=>'success'
                    ],200);
                }
            }
        } else{
            return response()->json([
                'message'=>'error'
            ],404);
        }
    }


    public function destroy($id)
    {
        
    }
}
