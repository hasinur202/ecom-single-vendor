<?php

namespace App\Http\Controllers\Backend;

use App\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\Commision;
use Illuminate\Http\Request;
use App\Models\CommisionDetails;
use App\Models\ShareHolderLevel;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class ShareHolderLevelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = auth()->user();
        $products = Product::all();
        $categories = Category::all();

        $commisionData = Commision::with('get_commisionDetails')->get();

        return view('layouts.backend.shareholder.commision',[
            'data'=>$data,
            'products'=>$products,
            'categories' =>$categories,
            'commisionData' =>$commisionData,
        ]);
    }


    public function storeCommision(Request $request){

        //ShareHolderLevel::whereNotNull('id')->update(['money_by_commision'=>0]);

        Commision::create([
            'commision_value'=>$request->commision,
            'comment'=>$request->comment
        ]);

        $levels = ShareHolderLevel::get();
        $missingLevel = 0;
        foreach($levels as $level){
            $levelMoney = ($level->commision * $request->commision)/100;

            $countShareHolder = User::where('share_holder_level_id',$level->id)->count();
            if(!$countShareHolder){
                $missingLevel = $missingLevel+1;
            }else{
                $singleNewMoney = $levelMoney/$countShareHolder;
                $allShareHolder = User::where('share_holder_level_id',$level->id)->get();

                foreach($allShareHolder as $singleMoney){
                    $updatedMoney = $singleMoney->e_money + $singleNewMoney;

                    User::where('id', $singleMoney->id)->update([
                        'e_money' =>$updatedMoney,
                    ]);
                }

                $commisionId = Commision::latest()->first();
                CommisionDetails::create([
                    'commision_id'=>$commisionId->id,
                    'level_no'=>$level->cycle_no,
                    'level_money'=>$levelMoney,
                ]);
            }


        }
        if($missingLevel){
            return redirect()->back()->with('warning',"$missingLevel ShareHolder Levels Money Not Updated.");
        }else{
            return redirect()->back()->with('success',"ShareHolder Level Money Updated.");
        }
    }


    public function deleteCommisionHistory(Request $request, $id){

        CommisionDetails::where('commision_id',$id)->delete();
        Commision::where('id',$id)->delete();
        return redirect()->back()->with('success','Commision History Deleted Successfully.');
    }


    public function store(Request $request)
    {
        $checkLevel = ShareHolderLevel::where('cycle_no',$request->cycle_no)->first();

        if($checkLevel != null){
            return response()->json([
                'status'=>'error'
            ],500);
        }else{
            ShareHolderLevel::Create([
                'cycle_no'=>$request->cycle_no,
                'cycle_value'=>$request->cycle_value,
                'e_money'=>$request->e_money,
                'commision'=>$request->commision,
            ]);

            $levels = ShareHolderLevel::all();
            return view('layouts.backend.dashboardTbl',[
                'levels'=>$levels
            ]);
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        ShareHolderLevel::where('id',$request->id)->update([
            'cycle_value'=>$request->edit_cycle_value,
            'e_money'=>$request->edit_e_money,
            'commision'=>$request->edit_commision
        ]);


        $levels = ShareHolderLevel::all();
        return view('layouts.backend.dashboardTbl',[
            'levels'=>$levels,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        ShareHolderLevel::where('id',$request->id)->delete();

        $levels = ShareHolderLevel::all();
        return view('layouts.backend.dashboardTbl',[
            'levels'=>$levels
        ]);

    }
}
