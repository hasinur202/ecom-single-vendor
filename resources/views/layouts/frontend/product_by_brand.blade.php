@extends('layouts.frontend.app')


@section('content')
@section('css')
    <link href="{{ asset('assets/css/listing.css') }}" rel="stylesheet">

@endsection

<main>
    <div class="top_banner">
        <div class="opacity-mask d-flex align-items-center" data-opacity-mask="rgba(0, 0, 0, 0.3)">
            <div class="container">
                @php
                    $data = '';
                @endphp
                @foreach ($products as $item)
                    @php
                        $data = $item->get_brand->brand_name;
                    @endphp
                @endforeach
                <h1 style="text-transform: capitalize;" onclick="getAllProduct()">Product by {{$data}}</h1>
            </div>
        </div>
        {{-- <img style="height: 250px !important;" src="#" class="img-fluid" alt=""> --}}
    </div>

    <div class="container margin_30">
        <div class="row">
            <div class="col-lg-12">

                <div class="toolbox elemento_stick add_bottom_30">
                    <div class="container">
                        <ul class="clearfix">
                            <li>
                                <span>Filter Product</span>
                            </li>
                            <li>
                                <a href="#" class="open_filters">
                                    <i class="ti-filter"></i><span>Filters</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div id="products" class="row small-gutters">
                    
                    @if($products != null)
                    @foreach ($products as $pro)
                        <div class="col-6 col-md-3">
                            <div class="grid_item">
                                @foreach ($pro->get_product_avatars as $avtr)
                                    <figure>
                                        <a href="{{ route('quick',$pro->slug) }}">
                                        <img style="height: 200px !important;" class="img-fluid lazy" src="/images/{{$avtr->front}}"
                                                data-src="/images/{{$avtr->front}}" alt="">
                                        </a>
                                    </figure>
                                @endforeach
                                <a href="{{ route('quick',$pro->slug) }}">
                                    <h3>{{$pro->product_name}}</h3>
                                </a>
                                <div class="price_box">

                                    @foreach($pro->get_attribute->unique('product_id') as $key => $price)
                                    <span class="new_price">{{$price->sale_price}}</span>
                                    <span class="old_price">{{$price->promo_price}}</span>
                                    @endforeach
                                </div>
                                <ul>
                                    <li>
                                        <a href="#" onclick="addWishList({{$pro}})" class="tooltip-1" data-toggle="tooltip" data-placement="left"
                                            title="Add to favorites"><i class="ti-heart"></i><span>Add to favorites</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" onclick="addToCart({{$pro}})" class="tooltip-1" data-toggle="tooltip" data-placement="left"
                                            title="Add to cart"><i class="ti-shopping-cart"></i><span>Add to cart</span>
                                    </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    @endforeach
                    @endif

                </div>
            </div>
        </div>
    </div>

</main>
<!-- /main -->




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
                    Swal.fire({
                        icon: 'warning',
                        title: 'Oops...',
                        text: 'Product already in cart!'
                    })
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'You are not logged in!'
                    })
                }
            }
        })
    }

    function addWishList(pro){

        $.ajax({
            url: "{{ route('wishlist.store') }}",
            type: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                'slug': pro.slug
            },
            success:function(response)
            {
                if(response.guest == 'guest'){
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'You are not logged in!'
                    })
                }else if(response.errors == 'match'){
                    Swal.fire({
                        icon: 'warning',
                        title: 'Oops...',
                        text: 'Product already in cart!'
                    })
                }else{
                    $("#count").text(response.count);
                }
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
            $("#searchData1").hide();
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
</script>

<script src="{{ asset('assets/js/specific_listing.js') }}"></script>

<script src="{{ asset('assets/js/sticky_sidebar.min.js') }}"></script>

@endsection
@endsection
