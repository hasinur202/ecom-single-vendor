<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Settings;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use Image;


class SettingsController extends Controller
{
    public function index()
    {
        $data = auth()->user();
        $setting = Settings::first();
        return view('layouts.backend.settings.setup',[
            'data'=>$data,
            'setting'=>$setting,
        ]);
    }

    public function store(Request $request){

        $SettingId = Settings::select('id')->first();


        if($SettingId == null){
            $validator = Validator::make($request->all(), [
                'logo' => 'required',
                'title' =>'required',
                'contact' =>'required'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'errors'=> $validator->messages()->all()
                ]);
            }elseif($request->file('logo') != null){
                $logo = $request->file('logo');
                $new_name = rand() . '.' . $logo->getClientOriginalExtension();
                $img = Image::make($request->file('logo'))->fit(1349,375);
                $upload_path = public_path()."/images/";

                if($new_name){
                    $data = Settings::create([
                        'title'=>$request->title,
                        'logo'=>$new_name,
                        'description'=>$request->description,
                        'email'=>$request->email,
                        'address'=>$request->address,
                        'contact'=>$request->contact,
                        'fb_link'=>$request->fb_link,
                        'twitt_link'=>$request->twitt_link,
                        'tube_link'=>$request->tube_link,
                        'insta_link'=>$request->insta_link
                    ]);
                    if($data){
                        $img->save($upload_path.$new_name);

                       toast('Changes saved successfully','success')
                       ->padding('10px')->width('270px')->timerProgressBar()->hideCloseButton();
                        return redirect()->back();
                    }
                }
            }
            else{
                Alert::error('Opps...','Data entry wrong.');
                return response()->json([
                    'message'=>'success'
                ],200);
            }

        }else{
            $setting = Settings::where('id',$request->id)->first();
            if($request->file('logo') != null){

                $logo = $request->file('logo');
                $new_name = rand() . '.' . $logo->getClientOriginalExtension();
                $img = Image::make($request->file('logo'))->fit(1349,375);
                $upload_path = public_path()."/images/";


                \File::delete(public_path('images/' . $setting->logo));

                if($new_name)
                {
                    $data = Settings::where('id',$request->id)->update([
                        'logo'=>$new_name,
                        'title'=>$request->title,
                        'contact'=>$request->contact,
                        'email'=>$request->email,
                        'address'=>$request->address,
                        'description'=>$request->description,
                        'fb_link'=>$request->fb_link,
                        'insta_link'=>$request->insta_link,
                        'twitt_link'=>$request->twitt_link,
                        'tube_link'=>$request->tube_link,
                    ]);

                    if($data){
                        $img->save($upload_path.$new_name);

                        toast('Changes saved successfully','success')
                       ->padding('10px')->width('270px')->timerProgressBar()->hideCloseButton();
                        return redirect()->back();

                        // toast('Settings changes successfully','success')
                        // ->padding('10px')->width('270px')->timerProgressBar()->hideCloseButton();
                        // return response()->json([
                        //     'message'=>'success'
                        // ],200);
                    }
                }

            }elseif($request->logo == ''){
                $data = Settings::where('id',$request->id)->update([
                    'title'=>$request->title,
                    'contact'=>$request->contact,
                    'email'=>$request->email,
                    'address'=>$request->address,
                    'description'=>$request->description,
                    'fb_link'=>$request->fb_link,
                    'insta_link'=>$request->insta_link,
                    'twitt_link'=>$request->twitt_link,
                    'tube_link'=>$request->tube_link,
                ]);


                toast('Changes saved successfully','success')
                ->padding('10px')->width('270px')->timerProgressBar()->hideCloseButton();
                 return redirect()->back();




                        // toast('Settings changes successfully','success')
                        // ->padding('10px')->width('270px')->timerProgressBar()->hideCloseButton();
                        // return response()->json([
                        //     'message'=>'success'
                        // ],200);
            }else{
                Alert::error('Opps...', 'Please fillup all field');
                return response()->json([
                    'message'=>'success'
                ],200);
            }

        }
    }

}
