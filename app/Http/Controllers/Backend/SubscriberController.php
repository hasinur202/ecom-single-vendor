<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Newsletter_subscriber;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;


use Rap2hpoutre\FastExcel\FastExcel;

class SubscriberController extends Controller
{
    public function index(){
        $subscribers = Newsletter_subscriber::all();
        $data = auth()->user();
        return view('layouts.backend.subscribe.subscriber_list',[
            'data'=>$data,
            'subscribers'=>$subscribers
        ]);
    }

    public function updateSubscriberStatus($id, $status){
        Newsletter_subscriber::where('id',$id)->update(['status'=>$status]);

        return redirect()->back()->with('success','Subscriber status has been updated');
    }

    public function deleteSubscriber($id){
        Newsletter_subscriber::where('id',$id)->delete();

        return redirect()->back()->with('success','Subscriber has been deleted');
    }

    public function exportSubscriber(){
        $subscribersData = Newsletter_subscriber::select('id','email','created_at')->where('status',1)->orderBy('id','Desc')->get();
        $subscribersData = json_decode(json_encode($subscribersData),true);

        return (new FastExcel($subscribersData))->download('file.xlsx');


        // return Excel::store('subscribers'.rand(),function($excel) use($subscribersData){
        //     $excel->sheet('mySheet',function($sheet) use($subscribersData){
        //         $sheet->fromArray($subscribersData);
        //     });
        // })->download('xlsx');
    }


}
