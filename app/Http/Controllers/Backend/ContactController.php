<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use App\Models\Contact;


use Rap2hpoutre\FastExcel\FastExcel;

class ContactController extends Controller
{
    public function index(){
        $contacts = Contact::get();
        $data = auth()->user();
        return view('layouts.backend.settings.contact_list',[
            'data'=>$data,
            'contacts'=>$contacts

        ]);
    }


    public function destroy($id){
        Contact::where('id',$id)->delete();

        return redirect()->back()->with('success','Contact Deleted Successfully.');
    }


    public function exportContact(){
        $contactsData = Contact::select('id','name', 'email','phone','subject','message','created_at')->orderBy('id','Desc')->get();
        $contactsData = json_decode(json_encode($contactsData),true);

        return (new FastExcel($contactsData))->download('contactlist.xlsx');

    }


}

