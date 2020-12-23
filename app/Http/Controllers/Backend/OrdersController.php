<?php

namespace App\Http\Controllers\Backend;

use PDF;
use Alert;
use App\User;
use Carbon\Carbon;
use App\Models\Orders;
use App\Models\Product;
use App\Models\Attribute;
use App\Models\ShareHolder;
use App\Models\OrderDetails;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrdersController extends Controller
{
    public function __construct()
    {
        ini_set('max_execution_time', 300);
    }


    public function order_by_product(Request $request)
    {
        $details = OrderDetails::where('order_id',$request->id)->with('get_product','get_product.get_attribute')->get();
        return view('layouts.backend.sales.order_by_product',[
            'details'=>$details
        ]);
    }


    public function delete_single_order($id)
    {
        OrderDetails::find($id)->delete();
        toast('Order deleted successfull.','success')->padding('10px')->width('270px')->timerProgressBar()->hideCloseButton();

        return redirect()->back();
    }


    public function refundView(Request $request)
    {
        $data = auth()->user();
        $orders = Orders::latest()
        ->where('status','Refund')
        ->with('get_order_details','get_order_details.get_product')->get();
        $count = Orders::where('status','Processing')->count();
        $refund = Orders::where('status','Refund')->count();
        $details = OrderDetails::with('get_product','get_product.get_attribute')->get();
        return view('layouts.backend.sales.sales_refund',[
            'data'=>$data,
            'orders'=>$orders,
            'details'=>$details,
            'count'=>$count,
            'refund'=>$refund

        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function refund(Request $request)
    {
        //update shareholder emoney -- decreases
        $odrs = Orders::where('id',$request->id)->first();
        if($odrs->token != null){
            $shreHolder = ShareHolder::where('token',$odrs->token)->first();
            $getHolderCurrentMoney = User::where('id',$shreHolder->user_id)->first();
            $newEmoney = $getHolderCurrentMoney->e_money - $odrs->total_emoney;
            User::where('id',$shreHolder->user_id)->update([
                'e_money'=>$newEmoney,
            ]);
        }

        //refund start from here
        $odrsdetails = OrderDetails::where('order_id',$request->id)->get();
        foreach ($odrsdetails as $key => $value) {
            $attr = Attribute::where('product_id',$value->product_id)->where('size',$value->size)->first();
            Attribute::where('product_id',$value->product_id)
            ->where('size',$value->size)->update([
                'qty'=>$value->qty+$attr->qty
            ]);
            $value->delete();
        }
        Orders::where('id',$request->id)->delete();

        return response()->json([
            'mag'=>'success'
        ],200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function invoice(Request $request)
    {
        $data = auth()->user();
        $datas = Orders::where('id',$request->id)->with(
            'get_order_details',
            'get_order_details.get_product',
            'get_order_details.get_product.get_attribute'
        )->first();

        // return view('layouts.backend.invoice.order_invoice',[
        //     'data'=>$data,
        //     'datas'=>$datas
        // ]);

        $pdf = PDF::loadView('layouts.backend.invoice.order_invoice',['datas'=>$datas]);
        return $pdf->stream('invoice.pdf');
    }
    public function sales_history()
    {
        $data = auth()->user();
        $orders = Orders::latest()->with('get_order_details','get_order_details.get_product')->get();
        $count = Orders::where('status','Processing')->count();
        $refund = Orders::where('status','Refund')->count();
        $details = OrderDetails::with('get_product','get_product.get_attribute')->get();
        return view('layouts.backend.sales.sales_history',[
            'data'=>$data,
            'orders'=>$orders,
            'details'=>$details,
            'count'=>$count,
            'refund'=>$refund

        ]);
    }


    public function delivery(Request $request)
    {
        $order = Orders::where('id',$request->id)->update([
            'status'=>'delivered'
        ]);
        return response()->json([
            'msg'=>'success'
        ],200);
    }

    public function table_search(Request $request)
    {
        if ($request->search == 'daily') {
            $orders = Orders::latest()->where('created_at','>=',Carbon::today())->with('get_order_details','get_order_details.get_product')->get();
        }elseif($request->search == 'weekly'){
            $orders = Orders::latest()->whereBetween('created_at', [Carbon::now()->subWeek()->format("Y-m-d H:i:s"), Carbon::now()])->with('get_order_details','get_order_details.get_product')->get();

        }elseif($request->search == 'monthly'){
            $orders = Orders::latest()->whereBetween('created_at', [Carbon::now()->subMonth()->format("Y-m-d H:i:s"), Carbon::now()])->with('get_order_details','get_order_details.get_product')->get();

        }elseif($request->search == 'yearly'){
            $orders = Orders::latest()->whereBetween('created_at', [Carbon::now()->subYear()->format("Y-m-d H:i:s"), Carbon::now()])->with('get_order_details','get_order_details.get_product')->get();
        }

        $data = auth()->user();
        $orders = Orders::latest()->with('get_order_details','get_order_details.get_product')->get();
        $count = Orders::where('status','Processing')->count();
        $refund = Orders::where('status','Refund')->count();
        $details = OrderDetails::with('get_product','get_product.get_attribute')->get();
        return view('layouts.backend.sales.sales_history',[
            'data'=>$data,
            'orders'=>$orders,
            'details'=>$details,
            'count'=>$count,
            'refund'=>$refund
        ]);
    }


    public function sales_history_pdf(Request $request)
    {
        $order = Orders::latest();

        if ($request->val == 'daily') {
            $orders = $order->where('created_at','>=',Carbon::today())->with('get_order_details','get_order_details.get_product')->get();
        }elseif($request->val == 'weekly'){
            $orders = $order->whereBetween('created_at', [Carbon::now()->subWeek()->format("Y-m-d H:i:s"), Carbon::now()])->with('get_order_details','get_order_details.get_product')->get();

        }elseif($request->val == 'monthly'){
            $orders = $order->whereBetween('created_at', [Carbon::now()->subMonth()->format("Y-m-d H:i:s"), Carbon::now()])->with('get_order_details','get_order_details.get_product')->get();

        }elseif($request->val == 'yearly'){
            $orders =$order->whereBetween('created_at', [Carbon::now()->subYear()->format("Y-m-d H:i:s"), Carbon::now()])->with('get_order_details','get_order_details.get_product')->get();
        }else{
            return redirect()->back();
        }

        $pdf = PDF::loadView('layouts.backend.sales.pdf_sales_history',[
            'orders'=>$orders
        ]);
        
        return $pdf->setPaper('a4', 'landscape')->stream('sales_history.pdf');


        // return view('layouts.backend.sales.pdf_sales_history',[
        //     'orders'=>$orders,
        // ]);

    }

}
