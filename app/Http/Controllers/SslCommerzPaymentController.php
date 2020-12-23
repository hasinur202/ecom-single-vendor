<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Library\SslCommerz\SslCommerzNotification;
use App\Models\Cart;
use App\Models\Orders;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\ShareHolder;
use App\Models\OrderDetails;
use App\Models\ShareHolderLevel;
use App\Models\Attribute;
use App\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
class SslCommerzPaymentController extends Controller
{

    public function exampleEasyCheckout()
    {
        return view('exampleEasycheckout');
    }

    public function exampleHostedCheckout()
    {
        return view('exampleHosted');
    }

    public function index(Request $request)
    {
        $post_data = array();
        $post_data['total_amount'] = $request->amount; # You cant not pay less than 10
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = uniqid(); // tran_id must be unique

        # CUSTOMER INFORMATION
        $post_data['user_id'] = auth()->user()->id;
        $post_data['cus_name'] = $request->name;
        $post_data['cus_email'] = $request->email;
        $post_data['cus_add1'] = $request->address;
        $post_data['total_emoney'] = $request->total_emoney;
        $post_data['qty'] = $request->qty;
        $post_data['delivery_status'] = 'pending';
        $post_data['token'] = $request->token;
        $post_data['cus_add2'] = "";
        $post_data['cus_city'] = "";
        $post_data['cus_state'] = "";
        $post_data['cus_postcode'] = "";
        $post_data['cus_country'] = "Bangladesh";
        $post_data['cus_phone'] = $request->phone;
        $post_data['cus_fax'] = "";

        # SHIPMENT INFORMATION
        $post_data['ship_name'] = "Store Test";
        $post_data['ship_add1'] = "Dhaka";
        $post_data['ship_add2'] = "Dhaka";
        $post_data['ship_city'] = "Dhaka";
        $post_data['ship_state'] = "Dhaka";
        $post_data['ship_postcode'] = "1000";
        $post_data['ship_phone'] = "";
        $post_data['ship_country'] = "Bangladesh";

        $post_data['shipping_method'] = "NO";
        $post_data['product_name'] = "Computer";
        $post_data['product_category'] = "Goods";
        $post_data['product_profile'] = "physical-goods";

        # OPTIONAL PARAMETERS
        $post_data['value_a'] = "ref001";
        $post_data['value_b'] = "ref002";
        $post_data['value_c'] = "ref003";
        $post_data['value_d'] = "ref004";

        if($request->payment == 'cash on delivery'){
            if($request->token != null){
                $data = ShareHolder::where('token',$request->token)->first();
                if($data == null){
                    alert()->error('Invalid Token','Try to input correct token! Thank You.');
                    return redirect()->back();
                }else{
                    $post_data['payment'] = $request->payment;
                    $update_product = DB::table('orders')
                    ->where('transaction_id', $post_data['tran_id'])
                    ->updateOrInsert([
                        'user_id'=>$post_data['user_id'],
                        'name' => $post_data['cus_name'],
                        'email' => $post_data['cus_email'],
                        'phone' => $post_data['cus_phone'],
                        'amount' => $post_data['total_amount'],
                        'status' => 'Processing',
                        'token' => $post_data['token'],
                        'address' => $post_data['cus_add1'],
                        'qty' => $post_data['qty'],
                        'total_emoney' => $post_data['total_emoney'],
                        'transaction_id' => $post_data['tran_id'],
                        'payment' => $post_data['payment'],
                        'currency' => $post_data['currency'],
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()
                    ]);

                    //insert shareholder id to users table
                    DB::table('users')
                    ->where('id', $post_data['user_id'])
                    ->update([
                        'share_holder_id'=>$data->id,
                    ]);

                    //check Current Emoney in shareholder account
                    $currentEmoney = User::where('id',$data->user_id)->first();
                    //Count User those are under the shareholder
                    $userCount = User::where('share_holder_id',$data->id)->count();
                    $countUser = strval($userCount);


                    $getShareHolderLevel = ShareHolderLevel::where('cycle_value','<=',$countUser)->orderBy('cycle_value', 'DESC')->first();

                    if($getShareHolderLevel != null){
                        $newTotalEmoney = $currentEmoney->e_money + $request->total_emoney + $getShareHolderLevel->e_money;
                        $level_Id = $getShareHolderLevel->id;
                        DB::table('users')->where('id', $data->user_id)->update([
                            'e_money' =>$newTotalEmoney,
                            'share_holder_level_id'=>$level_Id,
                        ]);

                        ShareHolder::where('id',$data->id)->update([
                            'share_holder_level_id'=>$level_Id,
                        ]);

                    }else{
                        $newTotalEmoney = $currentEmoney->e_money + $request->total_emoney;
                        DB::table('users')->where('id', $data->user_id)->update([
                            'e_money' =>$newTotalEmoney,
                        ]);
                    }

                }

            }else{
                $post_data['payment'] = $request->payment;
                DB::table('orders')
                ->where('transaction_id', $post_data['tran_id'])
                ->updateOrInsert([
                    'user_id'=>$post_data['user_id'],
                    'name' => $post_data['cus_name'],
                    'email' => $post_data['cus_email'],
                    'phone' => $post_data['cus_phone'],
                    'amount' => $post_data['total_amount'],
                    'status' => 'Processing',
                    'address' => $post_data['cus_add1'],
                    'qty' => $post_data['qty'],
                    'transaction_id' => $post_data['tran_id'],
                    'payment' => $post_data['payment'],
                    'currency' => $post_data['currency'],
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);
            }
            $total = 0;
            $order = Orders::orderBy('id', 'desc')->where('user_id',auth()->user()->id)->where('status','Processing')->first();
            $carts = Cart::where('user_id',auth()->user()->id)->get();
                foreach($carts as $cart){
                    OrderDetails::create([
                        'user_id'=>$cart->user_id,
                        'order_id'=>$order->id,
                        'product_id'=>$cart->product_id,
                        'size'=>$cart->size,
                        'qty'=>$cart->qty,
                        'total'=>$cart->total,
                        'profit'=>$cart->profit,
                        'shipp_charge'=>$cart->delivery_charge,
                    ]);
                    $qty = Attribute::where('product_id',$cart->product_id)->where('size',$cart->size)->first();
                    Attribute::where('product_id',$cart->product_id)->where('size',$cart->size)->update([
                        'qty'=>$qty->qty - $cart->qty
                    ]);
                    $total +=$cart->profit+$cart->delivery_charge;
                    Orders::where('id',$order->id)->update([
                        'profit'=>$total
                    ]);
                    $cart->delete();
                }

            toast('Order Successful','success')->padding('10px')->width('270px')->timerProgressBar()->hideCloseButton();
            return redirect()->route('confirm.pay');
        }else{
            if($request->token != null){
                $data = ShareHolder::where('token',$request->token)->first();
                if($data == null){
                    alert()->error('Invalid Token','Try to input correct token! Thank You.');
                    return redirect()->back();
                }else{
                    $post_data['payment'] = $request->payment;
                    $update_product = DB::table('orders')
                    ->where('transaction_id', $post_data['tran_id'])
                    ->updateOrInsert([
                        'user_id'=>$post_data['user_id'],
                        'name' => $post_data['cus_name'],
                        'email' => $post_data['cus_email'],
                        'phone' => $post_data['cus_phone'],
                        'amount' => $post_data['total_amount'],
                        'status' => 'Pending',
                        'token' => $post_data['token'],
                        'address' => $post_data['cus_add1'],
                        'qty' => $post_data['qty'],
                        'total_emoney' => $post_data['total_emoney'],
                        'transaction_id' => $post_data['tran_id'],
                        'currency' => $post_data['currency'],
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()
                    ]);

                    //insert shareholder id to users table
                    DB::table('users')
                    ->where('id', $post_data['user_id'])
                    ->update([
                        'share_holder_id'=>$data->id,
                    ]);

                    //check Current Emoney in shareholder account
                    $currentEmoney = User::where('id',$data->user_id)->first();
                    //Count User those are under the shareholder
                    $userCount = User::where('share_holder_id',$data->id)->count();
                    $countUser = strval($userCount);


                    $getShareHolderLevel = ShareHolderLevel::where('cycle_value','<=',$countUser)->orderBy('cycle_value', 'DESC')->first();

                    if($getShareHolderLevel != null){
                        $newTotalEmoney = $currentEmoney->e_money + $request->total_emoney + $getShareHolderLevel->e_money;
                        $level_Id = $getShareHolderLevel->id;
                        DB::table('users')->where('id', $data->user_id)->update([
                            'e_money' =>$newTotalEmoney,
                            'share_holder_level_id'=>$level_Id,
                        ]);

                        ShareHolder::where('id',$data->id)->update([
                            'share_holder_level_id'=>$level_Id,
                        ]);

                    }else{
                        $newTotalEmoney = $currentEmoney->e_money + $request->total_emoney;
                        DB::table('users')->where('id', $data->user_id)->update([
                            'e_money' =>$newTotalEmoney,
                        ]);
                    }

                }

            }else{
                $post_data['payment'] = $request->payment;
                DB::table('orders')
                ->where('transaction_id', $post_data['tran_id'])
                ->updateOrInsert([
                    'user_id'=>$post_data['user_id'],
                    'name' => $post_data['cus_name'],
                    'email' => $post_data['cus_email'],
                    'phone' => $post_data['cus_phone'],
                    'amount' => $post_data['total_amount'],
                    'status' => 'Pending',
                    'address' => $post_data['cus_add1'],
                    'qty' => $post_data['qty'],
                    'transaction_id' => $post_data['tran_id'],
                    'currency' => $post_data['currency'],
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);
            }
        }


        $sslc = new SslCommerzNotification();
        # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
        $payment_options = $sslc->makePayment($post_data, 'hosted');

        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = array();
        }

    }

    public function success(Request $request)
    {

        $tran_id = $request->input('tran_id');
        $amount = $request->input('amount');
        $currency = $request->input('currency');

        $sslc = new SslCommerzNotification();

        #Check order status in order tabel against the transaction id or order id.
        $order_detials = DB::table('orders')
            ->where('transaction_id', $tran_id)
            ->select('id','user_id','transaction_id', 'status', 'currency', 'amount')->first();

        if ($order_detials->status == 'Pending') {
            $validation = $sslc->orderValidate($tran_id, $amount, $currency, $request->all());

            if ($validation == TRUE) {
                /*
                That means IPN did not work or IPN URL was not set in your merchant panel. Here you need to update order status
                in order table as Processing or Complete.
                Here you can also sent sms or email for successfull transaction to customer
                */
                $update_product = DB::table('orders')
                    ->where('transaction_id', $tran_id)
                    ->update([
                        'status' => 'Processing',
                        'payment' => $request->card_type
                    ]);
                $total = 0;
                $carts = Cart::where('user_id',$order_detials->user_id)->get();
                foreach($carts as $cart){
                    OrderDetails::create([
                        'user_id'=>$cart->user_id,
                        'order_id'=>$order_detials->id,
                        'product_id'=>$cart->product_id,
                        'size'=>$cart->size,
                        'qty'=>$cart->qty,
                        'total'=>$cart->total,
                        'profit'=>$cart->profit,
                        'shipp_charge'=>$cart->delivery_charge,
                    ]);
                    $qty = Attribute::where('product_id',$cart->product_id)->where('size',$cart->size)->first();
                    Attribute::where('product_id',$cart->product_id)->where('size',$cart->size)->update([
                        'qty'=>$qty->qty - $cart->qty
                    ]);
                    $total +=$cart->profit+$cart->delivery_charge;
                    Orders::where('id',$order_detials->id)->update([
                        'profit'=>$total
                    ]);
                    $cart->delete();
                }

                toast('Transaction Successful','success')->padding('10px')->width('270px')->timerProgressBar()->hideCloseButton();
                return redirect()->route('confirm.pay');
            } else {
                /*
                That means IPN did not work or IPN URL was not set in your merchant panel and Transation validation failed.
                Here you need to update order status as Failed in order table.
                */
                $update_product = DB::table('orders')
                    ->where('transaction_id', $tran_id)
                    ->update(['status' => 'Failed']);

                    alert()->error('Transaction Failed','Please try again.');
                    return redirect()->back();
            }
        } else if ($order_detials->status == 'Processing' || $order_detials->status == 'Complete') {
            /*
             That means through IPN Order status already updated. Now you can just show the customer that transaction is completed. No need to udate database.
             */
            return redirect()->route('confirm.pay');
        } else {
            #That means something wrong happened. You can redirect customer to your product page.
            return redirect()->back();
        }


    }

    public function fail(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $order_detials = DB::table('orders')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount')->first();

        if ($order_detials->status == 'Pending') {
            $update_product = DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->update(['status' => 'Failed']);
            echo "Transaction is Falied";
        } else if ($order_detials->status == 'Processing' || $order_detials->status == 'Complete') {
            echo "Transaction is already Successful";
        } else {
            return redirect()->back();
        }

    }

    public function cancel(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $order_detials = DB::table('orders')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount')->first();

        if ($order_detials->status == 'Pending') {
            $update_product = DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->update(['status' => 'Canceled']);
                return redirect()->back();
        } else if ($order_detials->status == 'Processing' || $order_detials->status == 'Complete') {
            echo "Transaction is already Successful";
        } else {
            return redirect()->back();
        }


    }

    public function ipn(Request $request)
    {
        #Received all the payement information from the gateway
        if ($request->input('tran_id')) #Check transation id is posted or not.
        {

            $tran_id = $request->input('tran_id');

            #Check order status in order tabel against the transaction id or order id.
            $order_details = DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->select('transaction_id', 'status', 'currency', 'amount')->first();

            if ($order_details->status == 'Pending') {
                $sslc = new SslCommerzNotification();
                $validation = $sslc->orderValidate($tran_id, $order_details->amount, $order_details->currency, $request->all());
                if ($validation == TRUE) {
                    /*
                    That means IPN worked. Here you need to update order status
                    in order table as Processing or Complete.
                    Here you can also sent sms or email for successful transaction to customer
                    */
                    $update_product = DB::table('orders')
                        ->where('transaction_id', $tran_id)
                        ->update(['status' => 'Processing']);

                    echo "Transaction is successfully Completed";
                } else {
                    /*
                    That means IPN worked, but Transation validation failed.
                    Here you need to update order status as Failed in order table.
                    */
                    $update_product = DB::table('orders')
                        ->where('transaction_id', $tran_id)
                        ->update(['status' => 'Failed']);

                    echo "validation Fail";
                }

            } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {

                #That means Order status already updated. No need to udate database.

                echo "Transaction is already successfully Completed";
            } else {
                #That means something wrong happened. You can redirect customer to your product page.

                echo "Invalid Transaction";
            }
        } else {
            echo "Invalid Data";
        }
    }

}
