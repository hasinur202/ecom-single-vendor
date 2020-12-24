@extends('layouts.frontend.app')

@section('content')

<main>
    <div id="carousel-home" class="add_top_5">
        <div class="owl-carousel owl-theme">
        @foreach ($banars as $banar)
            <div class="owl-slide cover" style="background-image: url({{ $banar ? asset('/images/' . $banar->image) : '' }});">
                <div class="opacity-mask d-flex align-items-center">
                    <div class="container">
                        <div class="row justify-content-center justify-content-md-end">
                            <div class="col-lg-6 static">
                                <div class="slide-text text-right white">
                                    @if($banar->slug)
                                    <div class="owl-slide-animated owl-slide-cta"><a class="btn_1" href="{{route('quick',$banar->slug)}}" role="button">Shop Now</a></div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
        <div id="icon_drag_mobile"></div>
    </div>
    <!--/carousel-->

    <ul id="banners_grid" class="clearfix">
        <li>
            <a href="#0" class="img_container">
                <img src="assets/img/banners_cat_placeholder.jpg" data-src="assets/img/banner_1.jpg" alt="" class="lazy">
                <div class="short_info opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.5)">
                    <h3>Men's Collection</h3>
                    <div><span class="btn_1">Shop Now</span></div>
                </div>
            </a>
        </li>
        <li>
            <a href="#0" class="img_container">
                <img src="assets/img/banners_cat_placeholder.jpg" data-src="assets/img/banner_2.jpg" alt="" class="lazy">
                <div class="short_info opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.5)">
                    <h3>Womens's Collection</h3>
                    <div><span class="btn_1">Shop Now</span></div>
                </div>
            </a>
        </li>
        <li>
            <a href="#0" class="img_container">
                <img src="assets/img/banners_cat_placeholder.jpg" data-src="assets/img/banner_3.jpg" alt="" class="lazy">
                <div class="short_info opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.5)">
                    <h3>Kids Collection</h3>
                    <div><span class="btn_1">Shop Now</span></div>
                </div>
            </a>
        </li>
    </ul>


    <div class="container margin_60_35">
        <div class="main_title">
            <h2>Flash Sale</h2>
            <span>Products</span>
            <h4 style="text-align: left; font-size:20px; position: absolute; color: darkslateblue;">End In</h4>
            <div data-countdown="2020/12/30" class="countdown">aedfa sdf</div>
        </div>
        <div class="owl-carousel owl-theme products_carousel">
            @foreach ($products as $product)
            @if ($product->position == "flash sale")

                <div class="item">
                    <div class="grid_item">
                        @foreach ($product->get_product_avatars as $avtr)
                        <figure>
                            <a href="{{ route('quick',$product->slug) }}">
                                <img style="height: 200px !important;
                                width: 100% !important;" class="owl-lazy" src="{{asset('/images/'.$avtr->front)}}" data-src="{{asset('/images/'.$avtr->front)}}" alt="">
                            </a>
                        </figure>
                        @endforeach
                        <div class="rating"><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star"></i></div>
                        <a href="product-detail-1.html">
                            <h3>Air Wildwood ACG</h3>
                        </a>
                        <div class="price_box">
                            <span class="new_price">$75.00</span>
                            <span class="old_price">$155.00</span>
                        </div>
                        <ul>
                            <li><a href="#0" onclick="addWishList({{$product}})" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to favorites"><i class="ti-heart"></i><span>Add to favorites</span></a></li>
                        <li><a href="#0" onclick="addToCart({{$product}})" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to cart"><i class="ti-shopping-cart"></i><span>Add to cart</span></a></li>
                        </ul>
                    </div>
                </div>
            @endif
            @endforeach
        </div>
    </div>



    <div >
        <div class="container margin_30" style="margin-bottom: 1rem;">
            <div class="main_title">
                <h2>Shop By Brand</h2><span>Products</span>
            </div>
            <div id="brands" class="owl-carousel owl-theme bg_gray">
                <div class="item">
                    <a href="#0"><img src="assets/img/brands/placeholder_brands.png" data-src="assets/img/brands/logo_1.png" alt="" class="brnd_hght owl-lazy"></a>
                </div>
                <!-- /item -->
                <div class="item">
                    <a href="#0"><img src="assets/img/brands/placeholder_brands.png" data-src="assets/img/brands/logo_2.png" alt="" class="brnd_hght owl-lazy"></a>
                </div>
                <!-- /item -->
                <div class="item">
                    <a href="#0"><img src="assets/img/brands/placeholder_brands.png" data-src="assets/img/brands/logo_3.png" alt="" class="brnd_hght owl-lazy"></a>
                </div>
                <!-- /item -->
                <div class="item">
                    <a href="#0"><img src="assets/img/brands/placeholder_brands.png" data-src="assets/img/brands/logo_4.png" alt="" class="brnd_hght owl-lazy"></a>
                </div>
                <!-- /item -->
                <div class="item">
                    <a href="#0"><img src="assets/img/brands/placeholder_brands.png" data-src="assets/img/brands/logo_5.png" alt="" class="brnd_hght owl-lazy"></a>
                </div>
                <!-- /item -->
                <div class="item">
                    <a href="#0"><img src="assets/img/brands/placeholder_brands.png" data-src="assets/img/brands/logo_6.png" alt="" class="brnd_hght owl-lazy"></a>
                </div>
                <!-- /item -->
            </div>
            <!-- /carousel -->
        </div>
        <!-- /container -->
    </div>
    <!-- /bg_gray -->


    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <a href="#">
                    <figure>
                        <img class="lazy img_ad_banner" src="/assets/img/blog-thumb-placeholder.jpg" data-src="images/612670428.jpg" alt="">
                    </figure>
                </a>
            </div>
            <!-- /box_news -->
            <div class="col-lg-6">
                <a href="#">
                    <figure>
                        <img class="lazy img_ad_banner" src="/assets/img/blog-thumb-placeholder.jpg" data-src="images/2130407414.jpg" alt="">

                    </figure>
                </a>
            </div>
        </div>
    </div>



    {{-- <div class="container" style="margin-bottom: 0rem">
        <div class="main_title">
            <h2>Explore Popular Categories</h2>
        </div>

        <div class="row">
            <div class="col-6 col-sm-8 col-lg-3" style="margin-bottom: 5px;">
                <a target="_blank" href="#" class="icon-box icon-box-side">
                <div style="border: 1px solid #ddd; width:100%; padding-top:.3rem !important; padding-bottom: .3rem !important;">
                    <img style="width: 35px !important; margin-right:10px;margin-left:20px;
                    height: 30px !important;" src="https://jinershop.com/images/598180269.png" alt="">
                    <span>Sports &amp; Outdoor</span>

                </div>
                </a>
            </div>
            <div class="col-6 col-sm-8 col-lg-3" style="margin-bottom: 5px;">
                <a target="_blank" href="#" class="icon-box icon-box-side">
                <div style="border: 1px solid #ddd; width:100%; padding-top:.3rem !important; padding-bottom: .3rem !important;">
                    <img style="width: 35px !important; margin-right:10px;margin-left:20px;
                    height: 30px !important;" src="https://jinershop.com/images/598180269.png" alt="">
                    <span>Sports &amp; Outdoor</span>

                </div>
                </a>
            </div>
            <div class="col-6 col-sm-8 col-lg-3" style="margin-bottom: 5px;">
                <a target="_blank" href="#" class="icon-box icon-box-side">
                <div style="border: 1px solid #ddd; width:100%; padding-top:.3rem !important; padding-bottom: .3rem !important;">
                    <img style="width: 35px !important; margin-right:10px;margin-left:20px;
                    height: 30px !important;" src="https://jinershop.com/images/598180269.png" alt="">
                    <span>Sports &amp; Outdoor</span>

                </div>
                </a>
            </div>
            <div class="col-6 col-sm-8 col-lg-3" style="margin-bottom: 5px;">
                <a target="_blank" href="#" class="icon-box icon-box-side">
                <div style="border: 1px solid #ddd; width:100%; padding-top:.3rem !important; padding-bottom: .3rem !important;">
                    <img style="width: 35px !important; margin-right:10px;margin-left:20px;
                    height: 30px !important;" src="https://jinershop.com/images/598180269.png" alt="">
                    <span>Sports &amp; Outdoor</span>

                </div>
                </a>
            </div>
            <div class="col-6 col-sm-8 col-lg-3" style="margin-bottom: 5px;">
                <a target="_blank" href="#" class="icon-box icon-box-side">
                <div style="border: 1px solid #ddd; width:100%; padding-top:.3rem !important; padding-bottom: .3rem !important;">
                    <img style="width: 35px !important; margin-right:10px;margin-left:20px;
                    height: 30px !important;" src="https://jinershop.com/images/598180269.png" alt="">
                    <span>Sports &amp; Outdoor</span>

                </div>
                </a>
            </div>
            <div class="col-6 col-sm-8 col-lg-3" style="margin-bottom: 5px;">
                <a target="_blank" href="#" class="icon-box icon-box-side">
                <div style="border: 1px solid #ddd; width:100%; padding-top:.3rem !important; padding-bottom: .3rem !important;">
                    <img style="width: 35px !important; margin-right:10px;margin-left:20px;
                    height: 30px !important;" src="https://jinershop.com/images/598180269.png" alt="">
                    <span>Sports &amp; Outdoor</span>

                </div>
                </a>
            </div>


        </div>

    </div> --}}


    <div class="container margin_60_35">
        <div class="main_title">
            <h2>Idea Tech Mall</h2>
            <span>Products</span>
            <div style="text-align: right;">
                <a href="#" class="btn_outline">Shop More</a>
            </div>
        </div>
        <div class="row small-gutters">
            @foreach ($products as $product)
            @if ($product->position == "own mall")
            <div class="col-6 col-md-4 col-xl-2">
                <div class="grid_item">
                    @foreach ($product->get_product_avatars as $avtr)
                    <figure>
                        <a href="{{ route('quick',$product->slug) }}">
                            <img style="    height: 200px !important;
                            width: 100% !important;" class="img-fluid lazy" src="{{asset('/images/'.$avtr->front)}}" data-src="{{asset('/images/'.$avtr->front)}}" alt="">
                            <img style="    height: 200px !important;
                            width: 100% !important;" class="img-fluid lazy" src="{{asset('/images/'.$avtr->front)}}" data-src="{{asset('/images/'.$avtr->front)}}" alt="">
                        </a>
                    </figure>
                    @endforeach
                    <div class="rating"><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star"></i></div>
                    <a href="product-detail-1.html">
                        <h3>{{$product->product_name}}</h3>
                    </a>
                    <div class="price_box">
                        @foreach ($product->get_attribute->unique('product_id') as $attr)
                            <span class="new_price">{{$attr->sale_price}}</span>
                            <span class="old_price">{{$attr->promo_price}}</span>
                        @endforeach
                    </div>
                    <ul>
                        <li><a href="#0" onclick="addWishList({{$product}})" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to favorites"><i class="ti-heart"></i><span>Add to favorites</span></a></li>
                        <li><a href="#0" onclick="addToCart({{$product}})" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to cart"><i class="ti-shopping-cart"></i><span>Add to cart</span></a></li>
                    </ul>
                </div>
            </div>
            @endif
            @endforeach
        </div>
    </div>


    <div class="container margin_60_35">
        <div class="main_title">
            <h2>Upcoming</h2>
            <span>Products</span>
            <div style="text-align: right;">
                <a href="#" class="btn_outline">Shop More</a>
            </div>
        </div>
        <div class="row small-gutters">
            @foreach ($products as $product)
            @if ($product->position == "upcoming product")
            <div class="col-6 col-md-4 col-xl-2">
                <div class="grid_item">
                    @foreach ($product->get_product_avatars as $avtr)
                    <figure>
                        <a href="{{ route('quick',$product->slug) }}">
                            <img style="    height: 200px !important;
                            width: 100% !important;" class="img-fluid lazy" src="{{asset('/images/'.$avtr->front)}}" data-src="{{asset('/images/'.$avtr->front)}}" alt="">
                            <img style="    height: 200px !important;
                            width: 100% !important;" class="img-fluid lazy" src="{{asset('/images/'.$avtr->front)}}" data-src="{{asset('/images/'.$avtr->front)}}" alt="">
                        </a>
                    </figure>
                    @endforeach
                    <div class="rating"><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star"></i></div>
                    <a href="product-detail-1.html">
                        <h3>{{$product->product_name}}</h3>
                    </a>
                    <div class="price_box">
                        @foreach ($product->get_attribute->unique('product_id') as $attr)
                            <span class="new_price">{{$attr->sale_price}}</span>
                            <span class="old_price">{{$attr->promo_price}}</span>
                        @endforeach
                    </div>
                    <ul>
                        <li><a href="#0" onclick="addWishList({{$product}})" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to favorites"><i class="ti-heart"></i><span>Add to favorites</span></a></li>
                        <li><a href="#0" onclick="addToCart({{$product}})" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to cart"><i class="ti-shopping-cart"></i><span>Add to cart</span></a></li>
                    </ul>
                </div>
            </div>
            @endif
            @endforeach
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <a href="#">
                    <figure>
                        <img src="/assets/img/blog-thumb-placeholder.jpg" data-src="images/649374269.jpg" alt="" width="600" height="160" class="lazy img_ad_banner">
                    </figure>
                </a>
            </div>
            <!-- /box_news -->
            <div class="col-lg-6">
                <a href="#">
                    <figure>
                        <img src="/assets/img/blog-thumb-placeholder.jpg" data-src="images/2130407414.jpg" alt="" width="600" height="160" class="lazy img_ad_banner">

                    </figure>
                </a>
            </div>
        </div>
    </div>

    <div class="container margin_60_35">
        <div class="main_title">
            <h2>Global</h2>
            <span>Products</span>
            <div style="text-align: right;">
                <a href="#" class="btn_outline">Shop More</a>
            </div>
        </div>
        <div class="row small-gutters">
            @foreach ($products as $product)
            @if ($product->position == "global product")
            <div class="col-6 col-md-4 col-xl-2">
                <div class="grid_item">
                    @foreach ($product->get_product_avatars as $avtr)
                    <figure>
                        <a href="{{ route('quick',$product->slug) }}">
                            <img style="    height: 200px !important;
                            width: 100% !important;" class="img-fluid lazy" src="{{asset('/images/'.$avtr->front)}}" data-src="{{asset('/images/'.$avtr->front)}}" alt="">
                            <img style="    height: 200px !important;
                            width: 100% !important;" class="img-fluid lazy" src="{{asset('/images/'.$avtr->front)}}" data-src="{{asset('/images/'.$avtr->front)}}" alt="">
                        </a>
                    </figure>
                    @endforeach
                    <div class="rating"><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star"></i></div>
                    <a href="product-detail-1.html">
                        <h3>{{$product->product_name}}</h3>
                    </a>
                    <div class="price_box">
                        @foreach ($product->get_attribute->unique('product_id') as $attr)
                            <span class="new_price">{{$attr->sale_price}}</span>
                            <span class="old_price">{{$attr->promo_price}}</span>
                        @endforeach
                    </div>
                    <ul>
                        <li><a href="#0" onclick="addWishList({{$product}})" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to favorites"><i class="ti-heart"></i><span>Add to favorites</span></a></li>
                        <li><a href="#0" onclick="addToCart({{$product}})" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to cart"><i class="ti-shopping-cart"></i><span>Add to cart</span></a></li>
                    </ul>
                </div>
            </div>
            @endif
            @endforeach
        </div>
    </div>


    <div class="container margin_60_35" style="padding-bottom:10px !important;">
        <div class="main_title">
            <h2>Just For You</h2>
            <span>Products</span>
        </div>
        <div class="row small-gutters">
            @foreach ($products as $product)
            @if ($product->position == "just for you")
            <div class="col-6 col-md-4 col-xl-2">
                <div class="grid_item">
                    @foreach ($product->get_product_avatars as $avtr)
                    <figure>
                        <a href="{{ route('quick',$product->slug) }}">
                            <img style="    height: 200px !important;
                            width: 100% !important;" class="img-fluid lazy" src="{{asset('/images/'.$avtr->front)}}" data-src="{{asset('/images/'.$avtr->front)}}" alt="">
                            <img style="    height: 200px !important;
                            width: 100% !important;" class="img-fluid lazy" src="{{asset('/images/'.$avtr->front)}}" data-src="{{asset('/images/'.$avtr->front)}}" alt="">
                        </a>
                    </figure>
                    @endforeach
                    <div class="rating"><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star"></i></div>
                    <a href="product-detail-1.html">
                        <h3>{{$product->product_name}}</h3>
                    </a>
                    <div class="price_box">
                        @foreach ($product->get_attribute->unique('product_id') as $attr)
                            <span class="new_price">{{$attr->sale_price}}</span>
                            <span class="old_price">{{$attr->promo_price}}</span>
                        @endforeach
                    </div>
                    <ul>
                        <li><a href="#0" onclick="addWishList({{$product}})" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to favorites"><i class="ti-heart"></i><span>Add to favorites</span></a></li>
                        <li><a href="#0" onclick="addToCart({{$product}})" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to cart"><i class="ti-shopping-cart"></i><span>Add to cart</span></a></li>
                    </ul>
                </div>
            </div>
            @endif
            @endforeach
        </div>
        <div style="text-align: center;">
            <a href="#" class="btn_1">Load More</a>

        </div>
    </div>







</main>


{{-- <div class="popup_wrapper">
    <div class="popup_content newsletter">
        <span class="popup_close">Close</span>
        <div class="row no-gutters">
        @foreach ($ads as $ad)
            @if ($ad->position == 'popup')
                <div class="col-md-5 d-none d-md-flex align-items-center justify-content-center">
                    <figure><img src="{{ asset('/images/' . $ad->avatar) }}" alt=""></figure>
                </div>
            @endif
        @endforeach

        <div class="col-md-7">
            <div class="content">
                <div class="wrapper">
                <img src="/images/{{ optional($setting)->logo }}" alt="" width="100" height="35">
                <h2>EARN MONEY</h2>
                <p style="font-size: 20px">Become a Successful <strong>Shareholder</strong></p>

                @auth
                    <a href="{{ route('shareholder.register') }}" class="btn_1 mt-2 mb-4">Apply Now</a>
                @else
                    <a href="{{ url('login') }}" class="btn_1 mt-2 mb-4">Apply Now</a>
                @endauth


                    <div class="form-group">
                        <label class="container_check d-inline">Dont show this PopUp again
                            <input type="checkbox">
                            <span class="checkmark"></span>
                        </label>
                    </div>

                </div>
            </div>
        </div>
    </div>
    </div>
</div> --}}

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

@endsection
@endsection
