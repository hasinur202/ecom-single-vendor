<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Newsletter_subscriber;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function checkSubscriber(Request $request){
        if($request->ajax()){
            $data = $request->all();
            $subscriberCount = Newsletter_subscriber::where('email', $data['subscriber_email'])->count();
            if($subscriberCount > 0){
                echo "exists";
            }
        }
    }

    public function addSubscriber(Request $request){
        if($request->ajax()){
            $data = $request->all();
            $subscriberCount = Newsletter_subscriber::where('email', $data['subscriber_email'])->count();
            if($subscriberCount > 0){
                echo "exists";
            }else{
                //add subscriber email
                $newsletter = new Newsletter_subscriber;
                $newsletter->email = $data['subscriber_email'];
                $newsletter->status = 1;
                $newsletter->save();
                echo "saved";
            }
        }
    }
}
