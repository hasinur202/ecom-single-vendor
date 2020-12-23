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
        <h1>Wishlist page</h1>
    </div>
    <!-- /page_header -->
    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>
                                    Product
                                </th>
                                <th>
                                    Price
                                </th>
                                <th>
                                    Stock Status
                                </th>
                                <th>

                                </th>
                                <th>

                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($wish_lists as $wish)
                            <tr>
                                <td>
                                    <div class="thumb_cart">
                                        @foreach ($wish->get_product->get_product_avatars as $pro_avatar)
                                        <img src="assets/img/products/product_placeholder_square_small.jpg" data-src="{{ asset('/images/' . $pro_avatar->front) }}" class="lazy" alt="Image">
                                        @endforeach
                                    </div>
                                    <span class="item_cart">{{$wish->get_product->product_name}}</span>
                                </td>
                                <td>
                                    <strong>{{$wish->get_product->sale_price}}</strong>
                                </td>
                                <td>
                                    @if ($wish->get_product->qty != 0)
                                    <span class="item_cart">In Stock</span>
                                    @else
                                    <span class="item_cart">Stock Out</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="#" onclick="addToCart({{ $wish->get_product }})" class="btn_1 cartaddbtn">Add to Cart</a>
                                </td>
                                <td class="options">
                                    <form action="{{ route('wishlist.delete',$wish->get_product->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" style="border: none;background: red;border-radius: 5px; color: #fff;">
                                            <i class="ti-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>

    </div>
    <!-- /container -->

</main>
<!--/main-->





@section('js')

<script>
    function addToCart(pro){
        $.ajax({
            url: "{{ route('cart.store') }}",
            type: "POST",
            dataType:"html",
            data: {
                "_token": "{{ csrf_token() }}",
                'slug': pro.slug,
                'id':pro.id,
                'sale_price':pro.sale_price
            },
            success:function(response)
            {
                $("#cartPortion").html(response);
            },
            error: function(e) {
                if (e.status == 422) {
                    swal("Opps! Product already in cart", {
                        icon: "error"
                    });
                    setTimeout(function() {
                        swal.close();
                    },3000);
                }else{
                    swal("Opps! You are not logged In", {
                        icon: "error"
                    });
                    setTimeout(function() {
                        swal.close();
                    },3000);
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
