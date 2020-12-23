@extends('layouts.frontend.app')


@section('content')
@section('css')
    <link href="{{ asset('assets/css/checkout.css') }}" rel="stylesheet">
@endsection


<main class="bg_gray">
	<div class="container margin_30">
		<div class="page_header">
			<div class="breadcrumbs">
				<ul>
					<li><a href="#">Home</a></li>
					<li><a href="#">Category</a></li>
					<li>Page active</li>
				</ul>
		    </div>
		    <h1>Online Payment</h1>
	    </div>
	<!-- /page_header -->
    <form action="{{ url('/pay') }}" method="POST">
        @csrf
        <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="step middle payments">
                        <h3>1. Payment and Shipping</h3>
                        <h6 class="pb-2">Shipping Method</h6>
                        <ul>
                            <li>
                                <label class="container_radio">Inside Dhaka
                                    <input onclick="chargeAdd(this.value)" id="shippIn" type="radio" name="shipping" value="indoor_charge">
                                    <span class="checkmark"></span>
                                </label>
                            </li>
                            <li>
                                <label class="container_radio">Outside Dhaka
                                    <input onclick="chargeAdd(this.value)" type="radio" id="shippOut" value="outdoor_charge" name="shipping">
                                    <span class="checkmark"></span>
                                </label>
                            </li>
                        </ul>
                        <h6 class="pb-2">Payment Method</h6>
                        <ul>
                            <li>
                                <label class="container_radio">Credit Card
                                    <input type="radio" name="payment" checked>
                                    <span class="checkmark"></span>
                                </label>
                            </li>
                            <li>
                                <label class="container_radio">Cash on delivery
                                    <input type="radio" value="cash on delivery" name="payment">
                                    <span class="checkmark"></span>
                                </label>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="step first">
                        <h3>1. Billing address</h3>
                        <div class="checkout">
                            <div class="form-group">
                                <input type="text" name="name" class="form-control" placeholder="Full Name">
                            </div>
                            <div class="form-group">
                                <input type="text" name="phone" class="form-control" placeholder="Mobile">
                            </div>
                            <div class="form-group">
                                <input type="email" name="email" class="form-control" placeholder="Email">
                            </div>

                            <div class="form-group">
                                <input type="text" name="address" class="form-control" placeholder="Address">
                            </div>


                            <div class="form-group">
								<label class="container_check" id="other_addr">If you have token id please enter.
								  <input type="checkbox">
								  <span class="checkmark"></span>
								</label>
                            </div>

                            <div id="other_addr_c" class="pt-2">
                                <div class="row no-gutters">
                                    <div class="col-3 form-group">
                                        <label>Apply Token</label>
                                    </div>
                                    <div class="col-9 form-group">
                                        <input type="text" name="token" class="form-control" placeholder="token code">
                                    </div>
                                </div>
                            </div>

                            <hr>
                        </div>

                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="step last">
                        <h3>3. Order Summary</h3>
                        <div class="box_general summary">
                            <ul>
                                @php
                                    $total = 0;
                                    $shipp = 0;
                                    $final = 0;
                                    $qty = 0;
                                    $emoney =0;
                                @endphp
                                @foreach ($cart as $crt)
                                    @php
                                        $total +=$crt->total;
                                        $shipp +=$crt->delivery_charge;
                                        $qty +=$crt->qty;
                                        $emoney +=$crt->get_product->e_money;
                                    @endphp
                                    <li class="clearfix"><em>{{$crt->qty}} x {{$crt->get_product->product_name}}</em>
                                          <span>{{ $crt->total }} TK</span>
                                          <span>shipp.co.  {{$crt->delivery_charge}} TK</span>
                                    </li>
                                @endforeach
                            </ul>
                            <input type="hidden" value="{{$emoney}}" name="total_emoney">
                            <input type="hidden" value="{{$total + $shipp}}" name="amount">
                            <input type="hidden" value="{{$qty}}" name="qty">
                            <ul>
                                <li class="clearfix"><em><strong>Subtotal</strong></em>  <span>{{$total}} TK</span></li>
                            <li class="clearfix"><em><strong>Total Shipping Charge</strong></em> <span>{{ $shipp }} TK</span></li>
                            </ul>
                        <div class="total clearfix" id="final">TOTAL <span>{{$total + $shipp}} TK</span></div>

                            <button type="submit" class="btn_1 full-width">Confirm and Pay</button>
                        </div>
                    </div>
                </div>

            </div>
        </form>

	</div>
	<!-- /container -->
</main>
<!--/main-->



@section('js')

<script>
    window.onload = (function(){
        $.ajax({
            url: "{{ route('get.shipp.des') }}",
            type: "get",
            success:function(response)
            {
                if(response.data.shipp_des == "outdoor_charge"){
                    $("#shippOut").attr('checked',true);
                }else if(response.data.shipp_des == "indoor_charge"){
                    $("#shippIn").attr('checked',true);
                }
            }
        })
    })


    function itemDelete(id){
        $.ajax({
            url: "{{ route('cart.item.delete') }}",
            type: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                'id': id
            },
            success:function(response)
            {
                $("#count1").text(response.count1);
                window.location.reload();
            }
        })
    }

    function chargeAdd(val){
        $.ajax({
            url: "{{ route('cart.update.by.shipp') }}",
            type: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                'shipp_des': val
            },
            success:function(response)
            {
                window.location.reload();
            }
        })
    }

    function searchProduct(){
        
        $.ajax({
            url: "{{ route('search') }}",
            method: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                'name':$("#data").val()
            },
            dataType: 'html',
            success: function(response) {
                if ($("#data").val() != null) {
                    if (window.screen.availWidth < 600) {
                        $("#searchData1").html(response);
                        $("#searchData1").show();
                    }else{
                        $("#searchData").html(response);
                        $("#searchData").show();
                    }
                    
                }else{
                    $("#searchData").fadeOut();
                    $("#searchData1").hide();
                }
            },
        })
        $(document).on('click', 'li', function(){
            $("#data").val($(this).text());
            $("#searchData").fadeOut();
            $("#searchData1").fadeOut();
            window.location.href="/"+$("#data").val();
        });
    }

    // Other address Panel
    $('#other_addr input').on("change", function (){
        if(this.checked)
            $('#other_addr_c').fadeIn('fast');
        else
            $('#other_addr_c').fadeOut('fast');
    });
</script>

@endsection
@endsection
