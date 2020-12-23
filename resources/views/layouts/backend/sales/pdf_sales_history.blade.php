<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'E-commerce') }}</title>

        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

        <link rel="stylesheet" href="{{asset('backend/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">

        <link rel="stylesheet" href="{{asset('backend/dist/css/adminlte.min.css')}}">

        <link rel="stylesheet" href="{{asset('backend/plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">


    </head>
    <body>
        <section class="content">
            <h3 style="text-align:center; maring-bottom:4rem;">Sales History</h3>
            <div class="row">
                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr role="row">
                                    <th>
                                        Transection Id
                                    </th>

                                    <th>
                                        Payment Type
                                    </th>
                                    <th>
                                        Quantity
                                    </th>
                                    <th>
                                        Customer Name
                                    </th>
                                    <th>
                                        Phone
                                    </th>
                                    <th>
                                        Address
                                    </th>
                                    <th>
                                        Total Amount
                                    </th>
                                    <th>
                                        Status
                                    </th>
                                </tr>
                                </tr>
                            </thead>
                            <tbody id="countRow">
                                @php
                                    $total = 0;
                                    $total_profit = 0;
                                @endphp
                                @foreach ($orders as $order)
                                    @if($order->status == 'delivered')
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
                                            @php
                                                $total += $order->amount;
                                                $total_profit+= $order->profit;
                                            @endphp
                                            <td class="sorting_1">
                                                <p id="amount">{{$order->amount}} TK</p>
                                                <p>Profit : <span id="profit" class="badge badge-warning">{{$order->profit}}</span> TK</p>
                                            </td>
                                            <td class="sorting_1">
                                                <p class="badge badge-success">Delivered</p>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th rowspan="1" colspan="1"></th>
                                    <th rowspan="1" colspan="1"></th>
                                    <th rowspan="1" colspan="1"></th>
                                    <th rowspan="1" colspan="1"></th>
                                    <th rowspan="1" colspan="1"></th>
                                    <th rowspan="1" colspan="1"></th>
                                    <th rowspan="1" colspan="1">Total Sales Amount = <span style="color:blue;">{{ $total }}</span> Tk.</th>
                                    <th rowspan="1" colspan="1">Total Profit = <span style="color:blue;">{{ $total_profit }}</span> Tk.</th>

                                </tr>
                            </tfoot>
                        </table>
                    </div>

            </div>
        </section>
    <script src="{{ asset('backend/plugins/jquery/jquery.min.js')}}"></script>
    <script src="{{ asset('backend/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
    <script>
    $.widget.bridge('uibutton', $.ui.button)
    </script>
    <script src="{{ asset('backend/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <script src="{{ asset('backend/plugins/datatables/jquery.dataTables.js')}}"></script>
    <script src="{{ asset('backend/plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>


    <script>
        window.onload = (function() {
                var sum = 0;
                var sum1 = 0;
                $('#countRow tr').each(function() {
                    sum += parseFloat($(this).find('#profit').text());
                    sum1 += parseFloat($(this).find('#amount').text());
                    $("#total_profit").text(sum);
                    $("#total_amount").text(sum1);
                });
            })

            // function totalAmount(){
            //     var sum = 0;
            //     var sum1 = 0;
            //     $('#countRow tr').each(function() {
            //         sum += parseFloat($(this).find('#profit').text());
            //         sum1 += parseFloat($(this).find('#sales_total').text());
            //         $("#total").text(sum);
            //         $("#sales_total1").text(sum1);
            //     });
            // };

    </script>

    </body>
</html>
