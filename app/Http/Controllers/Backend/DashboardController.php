<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ShareHolder;
use Illuminate\Http\Request;
use App\User;
use App\Models\ShareHolderLevel;
use RealRashid\SweetAlert\Facades\Alert;

class DashboardController extends Controller
{
    public function index()
    {
        $data = auth()->user();
        $levels = ShareHolderLevel::orderBy('cycle_no', 'ASC')->get();

        $level_wise_holder = ShareHolderLevel::with('get_share_holders')->get();
        $zeroLevelsCount = ShareHolder::where('token','!=',null)->where('share_holder_level_id',null)->count();


        return view('layouts.backend.dashboard',[
            'data'=>$data,
            'levels'=>$levels,
            'level_wise_holder'=>$level_wise_holder,
            'zeroLevelsCount'=>$zeroLevelsCount
        ]);
    }

    public function user_list()
    {
       $users = User::all();
       $data = auth()->user();
       return view('layouts.backend.user.user_list',[
           'users'=>$users,
           'data'=>$data,
       ]);
    }
    public function vendor_list()
    {
       $users = User::all();
       $data = auth()->user();
       return view('layouts.backend.user.vendor_list',[
           'users'=>$users,
           'data'=>$data,
       ]);
    }
}
