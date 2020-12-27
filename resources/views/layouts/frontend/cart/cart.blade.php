@extends('layouts.frontend.app')


@section('content')
@section('css')
    <link href="{{ asset('assets/css/cart.css') }}" rel="stylesheet">
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
        <h1>Cart page</h1>
    </div>
    <!-- /page_header -->
    <table class="table table-striped cart-list">
                        <thead>
                            <tr>
                                <th>
                                    Product
                                </th>
                                <th>
                                    Price
                                </th>
                                <th>
                                    Quantity
                                </th>
                                <th>
                                    Subtotal
                                </th>
                                <th>

                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                @foreach ($cart as $crt)
                                    @if ($crt->get_product)
                                <td>
                                    <div class="thumb_cart">
                                        @foreach ($crt->get_product->get_product_avatars as $avtr)
                                        <img src="assets/img/products/product_placeholder_square_small.jpg" data-src="{{ asset('/images/' . $avtr->front) }}" class="lazy" alt="Image">
                                        @endforeach
                                    </div>
                                    <span class="item_cart">{{ $crt->get_product->product_name }}</span>
                                </td>
                                <td>
                                    <strong>{{ $crt->get_product->sale_price }}</strong>
                                </td>
                                <td>
                                    <div class="numbers-row">
                                        <input onchange="calculate({{$crt->id}},this.value)" id="qty" name="qty"
                                            type="number" value="{{ $crt->qty }}" class="qty2" required>
                                    </div>
                                </td>
                                <td>
                                    <strong id="total">{{$crt ? $crt->total : $crt->get_product->sale_price }}</strong>
                                </td>

                                <td class="options">
                                    <a onclick="itemDelete({{$crt->id}})" href="#"><i class="ti-trash"></i></a>
                                </td>
                            </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                <div class="row add_top_30 flex-sm-row-reverse cart_actions">
                    <div class="col-sm-4 text-right">
                        {{--  <button type="button" class="btn_1 gray">Update Cart</button>  --}}
                        <a href="{{ route('cart.bill') }}" class="btn_1 full-width cart">Proceed to Checkout</a>

                    </div>
                </div>
                <!-- /cart_actions -->

    </div>
    <!-- /container -->

</main>
<!--/main-->





@section('js')

<script>
    function calculate(id,val){
        $.ajax({
            url: "{{ route('cart.update') }}",
            type: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                'id': id,
                'qty': val
            },
            success:function(res)
            {
                if(res.msg == "up to 10"){
                    Swal.fire({
                        icon: 'warning',
                        title: 'Oops...',
                        text: 'you cant buy as a same product up to quantity 10!',
                    })
                    setTimeout(() => {
                        window.location.reload();
                    },5000);
                }else if(res.msg == "double"){
                    Swal.fire({
                        icon: 'warning',
                        title: 'Oops...',
                        text: 'If your cart product quantity up to 3 as a same product.You have to pay two times delivery charge.',
                    })
                    setTimeout(() => {
                        window.location.reload();
                    },5000);
                }else if(res.msg == "treeple"){
                    Swal.fire({
                        icon: 'warning',
                        title: 'Oops...',
                        text: 'If your cart product quantity up to 6 as a same product.You have to pay three times delivery charge.',
                    })
                    setTimeout(() => {
                        window.location.reload();
                    },5000);
                }else if(res.msg == "fourth"){
                    Swal.fire({
                        icon: 'warning',
                        title: 'Oops...',
                        text: 'If your cart product quantity up to 9 as a same product.You have to pay four times delivery charge.',
                    })
                    setTimeout(() => {
                        window.location.reload();
                    },5000);
                }else{
                    window.location.reload();
                }


            },
            error: function(res) {
                if (res.status == 404) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Oops...',
                        text: 'Stock Out.'
                    })
                }
            }
        })
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

</script>

@endsection
@endsection
