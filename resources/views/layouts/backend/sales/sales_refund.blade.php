@extends('layouts.backend.app')
@section('content')
<div class="content-wrapper" style="min-height: 1589.56px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-2">
                    <div id="disableDiv" style="width: 100%;
                        padding: 10px;
                        background-color: white;
                        border: 1px solid #ddd;
                        box-shadow: 1px 1px #ddd;
                        border-radius: 5px;display: inline-flex;">
                        <a href="{{route('sales.history')}}" class="btn btn-primary" style="padding: 10px;">
                            <i class="fas fa-undo-alt" style="margin-right: 5px;font-size: 25px;margin-left: 5px;"></i>
                        </a>
                        <p style="margin-left: 5px;
                        font-weight: 700;
                        margin-bottom: 0px;">Sales List
                            <span style="float: left;
                        margin-left: 15px;" class="badge badge-warning">

                            @if ($count)
                                {{ $count }}
                            @else
                                0/0
                            @endif
                        </span>
                        </p>
                    </div>

                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <hr>
    <section class="content">
        <div class="row">

            <div class="card col-12" id="refundHistory" style="border: 1px solid #ddd;display: block">
                <div class="card-header">
                    <h3 class="card-title"><strong>Refund History is here</strong></h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr role="row">
                                <th style="width: 166px;">
                                    Transection Id
                                </th>

                                <th style="width: 166px;">
                                    Payment Type
                                </th>
                                <th style="width: 166px;">
                                    Quantity
                                </th>
                                <th style="width: 166px;">
                                    Customer Name
                                </th>
                                <th style="width: 166px;">
                                    Phone
                                </th>
                                <th style="width: 204px;">
                                    Address
                                </th>
                                <th style="width: 204px;">
                                    Total Amount
                                </th>
                                <th style="width: 204px;">
                                    Status
                                </th>
                                <th style="width: 99px;">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr role="row" class="odd">
                                    <td class="sorting_1">
                                        <span><strong>{{ $order->transaction_id }}</strong></span><br>
                                    </td>
                                    <td class="sorting_1">{{ $order->payment }}</td>
                                    <td class="sorting_1">{{ $order->qty }}</td>
                                    <td class="sorting_1">{{ $order->name }}</td>
                                    <td class="sorting_1">
                                        {{$order->phone}}
                                    </td>
                                    <td class="sorting_1">
                                        {{$order->address}}
                                    </td>
                                    <td class="sorting_1">
                                        {{$order->amount}} TK
                                        <p>Profit : <spna class="badge badge-warning">{{$order->profit}}</span> TK</p>
                                    </td>
                                    <td class="sorting_1">
                                        <p style="cursor: pointer;margin: 0px;"
                                            onclick="refund({{ $order->id }})"
                                            class="badge badge-danger">Refund</p>
                                    </td>
                                    <td class="sorting_1" style="display: inline-flex;">
                                        <button onclick="showProduct({{$order->id}})" style="margin-right: 5px;" class="btn btn-primary btn-sm">
                                            <i class="fa fa-eye"></i>
                                        </button>
                                        {{-- <form action="{{route('order.invoice')}}" method="POST" target="_blank">
                                            @csrf
                                            <input type="hidden" id="id" name="id" value="{{$order->id}}">
                                            <button type="submit" class="badge badge-info btn-sm">Invoice</button>
                                        </form> --}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="modal fade bd-example-modal-lg" tabindex="-1" id="orderByProduct" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Ordered Product Info</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                         @include('layouts.backend.sales.order_by_product')

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@section('js')
    <script>
        $(function() {
       $("#example1").DataTable();
       $('#example2').DataTable({
           "paging": true,
           "lengthChange": false,
           "searching": false,
           "ordering": true,
           "info": true,
           "autoWidth": false,
       });
   });

        function refund(id){

            $.ajax({
                url: "{{ route('order.refunded') }}",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": id,
                },
                success: function(response) {
                    window.location.reload();
                    Toast.fire({
                        icon: 'success',
                        title: 'Refund successfull'
                    })
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Something wrong.'
                    })
                }
            });
        }

        function showProduct(id){
            $.ajax({
                url: "{{ route('orderBy.product') }}",
                type: "POST",
                dataType:"html",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": id
                },
                success: function(response) {
                    $("#getProduct").html(response);
                    $("#orderByProduct").modal('show');
                }
            });
        }
    </script>
@endsection
@endsection
