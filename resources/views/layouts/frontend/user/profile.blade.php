@extends('layouts.frontend.app')

@section('content')
@section('css')
    {{--  <link href="{{ asset('assets/css/account.css') }}" rel="stylesheet">  --}}
    <link href="{{ asset('/assets/css/product_page.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/cart.css') }}" rel="stylesheet">
    <style>
        .table td, .table th {
            vertical-align: middle;
        }
        .badge-success{
            padding: 0px 5px 0px 5px;
            background: #91a462;;
            border-radius: 5px;
            font-size: 12px;
            color: #fff;

        }
        .badge-info{
            padding: 0px 5px 0px 5px;
            background: #8693df;
            border-radius: 5px;
            color: #fff;
            font-size: 12px;
        }

        .shareholder_acc ul{
            margin-right: 3rem;
            padding: 10px;
            list-style: none;
            border-radius: 8px;
            box-shadow: 2px 5px #7c8d1d;
        }

        .shareholder_acc ul li{
            margin-bottom: 2px;
            padding: 5px 10px 5px 10px;
        }
        .shareholder_acc ul li span{
            float: right;
            font-size: 15px;
            color: #4273dd;
        }

        .shareholder_acc_inf ul{
            margin-right: 3rem;
            line-height: 1.5rem;
            list-style: circle;
        }
        .shareholder_acc_inf ul li{
            padding: 5px;
        }
        .shareholder_acc_inf ul li span{
            float: right;
        }

        @media (max-width: 600px){
            .shareholder_acc_inf ul{
                margin-right: 0rem;
            }
            .shareholder_acc ul{
                margin-right: 0rem;
            }
        }


    </style>

@endsection

<main class="bg_gray">
	<div class="container margin_30">
		<div class="page_header">
            <h1>Profile of {{ optional(auth()->user())->name }}</h1>
            @if(auth()->user()->type == 'user')
            <p class="to-be-share-holder">If you want to be a <strong>Share Holder</strong> please <a href="{{ route('shareholder.register') }}" class="badge badge-info">Click Here</a></p>
            @endif
        </div>


        <div class="tabs_product">
	        <div class="container">
	            <ul class="nav nav-tabs" role="tablist">
	                <li class="nav-item">
	                    <a id="tab-A" href="#pane-A" class="nav-link active" data-toggle="tab" role="tab">Orders</a>
	                </li>
	                <li class="nav-item">
	                    <a id="tab-B" href="#pane-B" class="nav-link" data-toggle="tab" role="tab">Account Details</a>
                    </li>
                    @if(auth()->user()->type == "share_holder")
                    <li class="nav-item">
	                    <a id="tab-C" href="#pane-C" class="nav-link" data-toggle="tab" role="tab">Shareholder Info</a>
                    </li>
                    <li class="nav-item">
	                    <a id="tab-D" href="#pane-D" class="nav-link" data-toggle="tab" role="tab">Your Client</a>
	                </li>
	                @endif
	            </ul>
	        </div>
	    </div>
	    <!-- /tabs_product -->
	    <div class="tab_content_wrapper" style="padding-top:25px !important;">
	        <div class="container" style="background: #fff; padding-top: 11px; box-shadow: 0px 0px 5px 0px #ddd;">
	            <div class="tab-content" role="tablist">
	                <div id="pane-A" class="card tab-pane fade active show" role="tabpanel" aria-labelledby="tab-A">
	                    <div class="card-header" role="tab" id="heading-A">
	                        <h5 class="mb-0">
	                            <a class="collapsed" data-toggle="collapse" href="#collapse-A" aria-expanded="false" aria-controls="collapse-A">
	                                Orders
	                            </a>
	                        </h5>
	                    </div>
	                    <div id="collapse-A" class="collapse" role="tabpanel" aria-labelledby="heading-A">
	                            <div class="row justify-content-between">
	                                <div class="col-lg-12">
	                                    <h5>Recent Order</h5>
	                                    <div class="table-responsive">
	                                        <table class="table table-sm table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>Transaction No.</th>
                                                        <th>Quantity</th>
                                                        <th>Total Price</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
	                                            <tbody>
                                                    @foreach ($orders as $order)
                                                    @if ($order->status == 'Processing')

                                                        <tr>
                                                            <td>{{optional($order)->transaction_id}}</td>
                                                            <td>{{optional($order)->qty}}</td>
                                                            <td>{{optional($order)->amount}} TK</td>
                                                            <td>{{optional($order)->status}}</td>
                                                            <td>
                                                                <button type="button" onclick="viewProduct({{ $order->id }})" data-toggle="modal" data-target="#orderByProductModal" class="btn_info"><i class="ti-eye"></i></button>
                                                                <a href="{{ url('order-refund/'.$order->id) }}" style="padding:3px 5px 3px 5px;" title="Refund" class="btn_danger"><i class="fa fa-undo"></i></a>
                                                            </td>
                                                        </tr>
                                                    @endif
                                                    @endforeach
	                                            </tbody>
	                                        </table>
	                                    </div>
	                                    <!-- /table-responsive -->
                                        <hr>
                                    </div>
                                    <div class="col-lg-12">
	                                    <h5>Order History</h5>
	                                    <div class="table-responsive">
	                                        <table class="table table-sm table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>Transaction No.</th>
                                                        <th>Quantity</th>
                                                        <th>Total Price</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
	                                            <tbody>
	                                                <tr>
                                                        @foreach ($orders as $order)
                                                        @if ($order->status == 'delivered')
                                                            <tr>
                                                                <td>{{ optional($order)->transaction_id}}</td>
                                                                <td>{{ optional($order)->qty}}</td>
                                                                <td>{{ optional($order)->amount}} TK</td>
                                                                <td>{{ optional($order)->status}}</td>
                                                                <td>
                                                                    <button type="submit" class="btn_danger"><i class="ti-trash"></i></button>
                                                                    {{-- <button type="submit" title="Refund" class="btn_info"><i class="fa fa-undo"></i></button> --}}
                                                                </td>
                                                            </tr>
                                                        @endif
                                                        @endforeach
                                                    </tr>
	                                            </tbody>
	                                        </table>
	                                    </div>
	                                    <!-- /table-responsive -->
	                                </div>
	                            </div>

	                    </div>
	                </div>
	                <!-- /TAB A -->
	                <div id="pane-B" class="card tab-pane fade" role="tabpanel" aria-labelledby="tab-B">
	                    <div class="card-header" role="tab" id="heading-B">
	                        <h5 class="mb-0">
	                            <a class="collapsed" data-toggle="collapse" href="#collapse-B" aria-expanded="false" aria-controls="collapse-B">
	                                Account Details
	                            </a>
	                        </h5>
	                    </div>
	                    <div id="collapse-B" class="collapse" role="tabpanel" aria-labelledby="heading-B">
	                        <div class="card-body">
                                <form action="{{route('update.user.info')}}" method="POST">
                                    @csrf
	                            <div class="row justify-content-between">
                                    <div class="col-xl-6 col-lg-6 col-md-8">
                                        <h3 class="new_client">Basic Info</h3> <small class="float-right pt-2">* Required Fields</small>
                                        <div class="form_container">
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="email" value="{{optional(auth()->user())->email}}" class="form-control" name="email" id="email_2" placeholder="Email*">
                                            </div>
                                            <div class="form-group">
                                                <label>Name</label>
                                                <input type="text" value="{{optional(auth()->user())->name}}" name="name" class="form-control" placeholder="Name">
                                            </div>
                                            <div class="form-group">
                                                <label>Mobile Number</label>
                                                <input type="text" value="{{optional(auth()->user())->phn}}" class="form-control" name="phn" placeholder="Number">
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-xl-6 col-lg-6 col-md-8">
                                        <h3 class="new_client">Change Password</h3> <small class="float-right pt-2">* Required Fields</small>
                                        <div class="form_container">
                                            <div class="form-group">
                                                <label>Old Password</label>
                                                <input type="password" class="form-control" name="old_password" placeholder="Type old password">
                                            </div>
                                            <div class="form-group">
                                                <label>New Password</label>
                                                <input type="password" name="new_password" class="form-control" placeholder="Type new password">
                                            </div>
                                            <div class="form-group">
                                                <label>Confirm New Password</label>
                                                <input type="password" class="form-control" name="conf_password" placeholder="Retype new password">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-12 col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <label>Address</label>
                                            <textarea class="form-control" name="address" placeholder="Full Address">{{optional(auth()->user())->address}}</textarea>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn_1 full-width">Submit</button>
                                </div>
                            </form>
                                    {{--  <p class="text-right"><a href="leave-review.html" class="btn_1">Leave a review</a></p>  --}}
	                        </div>
	                        <!-- /card-body -->
	                    </div>
	                </div>
                    <!-- /tab B -->

                    {{-- <div id="pane-C" class="card tab-pane fade" role="tabpanel" aria-labelledby="tab-C">
	                    <div class="card-header" role="tab" id="heading-C">
	                        <h5 class="mb-0">
	                            <a class="collapsed" data-toggle="collapse" href="#collapse-C" aria-expanded="false" aria-controls="collapse-C">
	                                Shareholder Info
	                            </a>
	                        </h5>
	                    </div>
	                    <div id="collapse-C" class="collapse" role="tabpanel" aria-labelledby="heading-C">
	                        <div class="card-body">
	                            <div class="row justify-content-between">
                                    <div class="col-xl-6 col-lg-6 col-md-8" style="border-right: 3px solid #DDD; margin-bottom: 8px;">
                                        <h5>Dashboard</h5>
                                        <div class="shareholder_acc">
                                            <ul>
                                                <li style="background:#d1d1a8;">
                                                    <strong>Shareholder Token</strong>
                                                    <span>{{ optional($shareholder)->token }}</span>
                                                </li>
                                                <li style="background:#e6e6da;">
                                                    <strong>Your Level</strong>

                                                    @if($shareholder ? $shareholder->get_users->get_share_holder_level->cycle_no != null : '')
                                                        <span>Level - {{ $shareholder ? $shareholder->get_users->get_share_holder_level->cycle_no : '' }}</span>
                                                    @else
                                                        <span>Level - 0</span>
                                                    @endif

                                                </li>
                                                <li style="background:#88b7bd;">
                                                    <strong>Total Client</strong> <span>{{ $countClient }}</span>
                                                </li>
                                                <li style="background:#e6e6da;">
                                                    <strong>Total Product</strong> <span>{{ $countSharedUserPro }}</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="col-xl-6 col-lg-6 col-md-8">
                                        <h5>Account Info</h5>
                                        <div class="shareholder_acc_inf">
                                            <ul>
                                                <li>
                                                    <strong>E-Money</strong>

                                                    @if($shareholder ? $shareholder->get_users->e_money != null : '')
                                                    <span class="badge-success">{{ $shareholder ? $shareholder->get_users->e_money : '' }} Tk.</span>
                                                    @else
                                                    <span class="badge-success">0.00 Tk.</span>
                                                    @endif

                                                </li>
                                                <li>
                                                    <strong>Account No.</strong> <span>{{ optional($shareholder)->account_no }}</span>
                                                </li>
                                                <li>
                                                    <strong>Account Type</strong> <span>{{ optional($shareholder)->acc_type }}</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
	                            </div>
	                        </div>
	                        <!-- /card-body -->
	                    </div>
	                </div>

                    <div id="pane-D" class="card tab-pane fade" role="tabpanel" aria-labelledby="tab-D">
	                    <div class="card-header" role="tab" id="heading-D">
	                        <h5 class="mb-0">
	                            <a class="collapsed" data-toggle="collapse" href="#collapse-D" aria-expanded="false" aria-controls="collapse-D">
	                                Your Client
	                            </a>
	                        </h5>
	                    </div>
	                    <div id="collapse-D" class="collapse" role="tabpanel" aria-labelledby="heading-D">
	                        <div class="card-body">
	                            <div class="row justify-content-between">
                                    <div class="col-xl-8 col-lg-8 col-md-10" style="border-right: 2px solid #DDD; margin-bottom: 8px;">
                                        <h5>Client List</h5>
                                        <div class="table-responsive">
                                            <table class="table table-sm table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>SI #</th>
                                                        <th>Name</th>
                                                        <th>Phone</th>
                                                        <th>Email</th>
                                                        <th>Address</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php $i=0; @endphp
                                                    @foreach ($holder_users as $shared_user)
                                                    @php $i++; @endphp
                                                    <tr>
                                                        <td>{{ $i }}</td>
                                                        <td>{{ $shared_user->name }}</td>
                                                        <td>{{ $shared_user->phn }}</td>
                                                        <td>{{ $shared_user->email }}</td>
                                                        <td>{{ $shared_user->address }}</td>
                                                        <td>
                                                            <button onclick="userProductDetails({{ $shared_user->id }})" data-toggle="modal" data-target="#exampleModalCenter" class="btn_info"><i class="fa fa-eye"></i></button>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- /table-responsive -->
                                    </div>

                                    <div class="col-xl-4 col-lg-4 col-md-6">
                                        <h5>Level Info</h5>
                                        <div style="background: red;
                                                padding: 8px 0px 8px 22px;
                                                color: #fff;
                                                font-weight:200;">
                                            @if($shareholder ? $shareholder->get_users->get_share_holder_level->cycle_no != null : '')
                                                <span>** Your Level Now - {{ $shareholder ? $shareholder->get_users->get_share_holder_level->cycle_no : '' }}</span>
                                            @else
                                                <span>** Your Level Now - 0</span>
                                            @endif

                                        </div>

                                        <div class="shareholder_acc_inf">
                                            <ul>
                                                <li style="list-style: none; border-bottom:1px solid #ddd;">
                                                    <strong style="margin-right: 4rem;">Level</strong>
                                                    <strong>E-Money</strong>
                                                    <span style="font-weight: 700">Target User</span>
                                                </li>
                                                @foreach ($shareholderlevels as $levelsAll)
                                                <li>
                                                    <a style="margin-right: 4rem;" href="#">Level - {{ $levelsAll->cycle_no }}</a>
                                                    <a style="color:#8f850c;" href="#">{{ $levelsAll->e_money }}</a>
                                                    <span class="badge-success">{{ $levelsAll->cycle_value }}</span>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
	                            </div>
	                        </div>
	                        <!-- /card-body -->
	                    </div>
	                </div> --}}
	            </div>
	            <!-- /tab-content -->
	        </div>
	        <!-- /container -->
	    </div>
	    <!-- /tab_content_wrapper -->
    </div>

    </main>

    {{-- <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">Client Product List</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-striped">
                            <thead>
                                <tr>
                                    <th>SI #</th>
                                    <th>Product Name</th>
                                    <th>E-money</th>
                                    <th>Quantity</th>
                                    <th>Qty * E-money</th>
                                    <th>Total Price</th>
                                </tr>
                            </thead>
                            <tbody id="detailsProduct">
                               @include('layouts.frontend.user.user_order_details')
                            </tbody>
                        </table>
                    </div>
            </div>
          </div>
        </div>
    </div> --}}

        <div class="modal fade" id="orderByProductModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
              <div class="modal-content" style="padding:0px !important;">
                <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLongTitle">Ordered Product Info</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body" id="orderByProduct">
                       @include('layouts.frontend.user.order_by_product')

                  </div>
              </div>
          </div>
      </div>
@section('js')
<script>

    function userProductDetails(id){
        $.ajax({
        url: "{{ route('sharedUser.product') }}",
            method: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                'id':id
            },
            dataType: 'html',
            success: function(response) {
                $("#detailsProduct").html(response);
            },
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


    function viewProduct(id){
        $.ajax({
            url: "{{ route('order.product_info') }}",
            method: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                'id':id
            },
            dataType: 'html',
            success: function(response) {
                $("#orderByProduct").html(response);
            },
        })
    }
</script>

<script src="{{ asset('assets/js/carousel_with_thumbs.js') }}"></script>
@endsection
@endsection
