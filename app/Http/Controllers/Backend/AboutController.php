<?php

namespace App\Http\Controllers\Backend;

use App\Models\About;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;


class AboutController extends Controller
{
    public function index(){
        $about = About::first();
        $data = auth()->user();
        return view('layouts.backend.settings.about_us',[
            'data'=>$data,
            'about'=>$about
        ]);
    }


    public function store(Request $request){
        $aboutId = About::select('id')->first();

        if($aboutId == null){
            About::create([
                'description'=>$request->description
            ]);

        }else{

            About::where('id',$request->id)->update([
                'description'=>$request->description
            ]);

        }

        toast('Changes saved successfully','success')
                ->padding('10px')->width('270px')->timerProgressBar()->hideCloseButton();
        return redirect()->back();

    }


}
