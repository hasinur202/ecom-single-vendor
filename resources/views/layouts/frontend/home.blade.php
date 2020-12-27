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

    {{-- @foreach ($products as $product)
    @if($product->flash_timing != null && $product->flash_status == 1) --}}
    <div class="container margin_60_35" id="flash">
        <div class="main_title">
            <h2>Flash Sale</h2>
            <span>Products</span>
            <h4 style="margin-top: 15px;text-align: left; font-size:16px; position: absolute; color: darkslateblue;">Ending In</h4>
            {{-- <div data-countdown="2020/12/30" class="countdown">aedfa sdf</div> --}}
            <div id="clockdiv" class="clock">
                <i class="fa fa-clock-o"></i>
                <div class="des-time">
                    <small id="d" class="hours">00</small>
                    <div class="smalltext">D</div>
                </div>
                <div class="des-time">
                    <small id="h" class="hours">00</small>
                    <div class="smalltext">H</div>
                </div>
                <div class="des-time">
                    <small id="m" class="minutes">00</small>
                    <div class="smalltext">M</div>
                </div>

                <div class="des-time">
                    <small id="s" class="seconds">00</small>
                    <div class="smalltext">S</div>
                </div>
            </div>
        </div>
        <div class="owl-carousel owl-theme products_carousel">
            @foreach ($products as $product)
            @if ($product->position == "flash sale")
            <input type="hidden" id="time" value="{{$product->flash_timing}}">
                <div class="item">
                    <div class="grid_item">
                        @foreach ($product->get_product_avatars as $avtr)
                        <figure>
                            <a href="{{ route('quick',$product->slug) }}">
                                <img class="owl-lazy resp_img_pro" src="{{asset('/images/'.$avtr->front)}}" data-src="{{asset('/images/'.$avtr->front)}}" alt="">
                            </a>
                        </figure>
                        @endforeach
                        <div class="rating"><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star"></i></div>
                        <a href="{{ route('quick',$product->slug) }}">
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
    {{-- @endif
    @endforeach --}}

    <div >
        <div class="container margin_30" style="margin-bottom: 1rem;">
            <div class="main_title">
                <h2>Shop By Brand</h2><span>Products</span>
            </div>
            <div id="brands" class="owl-carousel owl-theme bg_gray">
                @foreach ($brands as $item)
                <div class="item">
                    <a href="{{route('product.by.brand',$item->slug)}}"><img src="{{asset('/images/'.$item->logo)}}" data-src="{{asset('/images/'.$item->logo)}}" alt="" class="brnd_hght owl-lazy"></a>
                </div>
                @endforeach
            </div>
            <!-- /carousel -->
        </div>
        <!-- /container -->
    </div>
    <!-- /bg_gray -->


    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                @foreach ($ads as $ad)
                @if($ad->position == "body-top left")
                <a href="{{ $ad->link }}">
                    <figure>
                        <img class="lazy img_ad_banner" src="{{ asset('/images/' . $ad->avatar) }}" data-src="{{ asset('/images/' . $ad->avatar) }}" alt="ads">
                    </figure>
                </a>
                @endif
                @endforeach
            </div>
            <!-- /box_news -->
            <div class="col-lg-6">
                @foreach ($ads as $ad)
                @if($ad->position == "body-top right")
                <a href="{{ $ad->link }}">
                    <figure>
                        <img class="lazy img_ad_banner" src="{{ asset('/images/' . $ad->avatar) }}" data-src="{{ asset('/images/' . $ad->avatar) }}" alt="ads">
                    </figure>
                </a>
                @endif
                @endforeach
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
            <div class="shop_more">
                <a href="{{url('shop-more/own mall')}}" class="btn_outline">Shop More</a>
            </div>
        </div>
        <div class="row small-gutters">
            @foreach ($products as $product)
            @if ($product->position == "own mall")
            <div class="col-4 col-md-2 col-xl-2">
                <div class="grid_item">
                    @foreach ($product->get_product_avatars as $avtr)
                    <figure>
                        <a href="{{ route('quick',$product->slug) }}">
                            <img class="img-fluid lazy resp_img_pro" src="{{asset('/images/'.$avtr->front)}}" data-src="{{asset('/images/'.$avtr->front)}}" alt="">
                            <img class="img-fluid lazy resp_img_pro" src="{{asset('/images/'.$avtr->front)}}" data-src="{{asset('/images/'.$avtr->front)}}" alt="">
                        </a>
                    </figure>
                    @endforeach
                    <div class="rating"><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star"></i></div>
                    <a href="{{ route('quick',$product->slug) }}">
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
            <div class="shop_more">
                <a href="{{url('shop-more/upcoming product')}}" class="btn_outline">Shop More</a>
            </div>
        </div>
        <div class="row small-gutters">
            @foreach ($products as $product)
            @if ($product->position == "upcoming product")
            <div class="col-4 col-md-2 col-xl-2">
                <div class="grid_item">
                    @foreach ($product->get_product_avatars as $avtr)
                    <figure>
                        <a href="{{ route('quick',$product->slug) }}">
                            <img class="img-fluid lazy resp_img_pro" src="{{asset('/images/'.$avtr->front)}}" data-src="{{asset('/images/'.$avtr->front)}}" alt="">

                            <img class="img-fluid lazy resp_img_pro" src="{{asset('/images/'.$avtr->back)}}" data-src="{{asset('/images/'.$avtr->front)}}" alt="">
                        </a>
                    </figure>
                    @endforeach
                    <div class="rating"><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star"></i></div>
                    <a href="{{ route('quick',$product->slug) }}">
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
                @foreach($ads as $ad)
                @if($ad->position == "body-bottom left")
                <a href="{{ $ad->link }}">
                    <figure>
                        <img class="lazy img_ad_banner" src="{{ asset('/images/' . $ad->avatar) }}" data-src="{{ asset('/images/' . $ad->avatar) }}" alt="ads">
                    </figure>
                </a>
                @endif
                @endforeach
            </div>
            <!-- /box_news -->
            <div class="col-lg-6">
                @foreach($ads as $ad)
                @if($ad->position == "body-bottom right")
                <a href="{{ $ad->link }}">
                    <figure>
                        <img class="lazy img_ad_banner" src="{{ asset('/images/' . $ad->avatar) }}" data-src="{{ asset('/images/' . $ad->avatar) }}" alt="ads">
                    </figure>
                </a>
                @endif
                @endforeach
            </div>
        </div>
    </div>

    <div class="container margin_60_35">
        <div class="main_title">
            <h2>Global</h2>
            <span>Products</span>
            <div class="shop_more">
                <a href="{{url('shop-more/global product')}}" class="btn_outline">Shop More</a>
            </div>
        </div>
        <div class="row small-gutters">
            @foreach ($products as $product)
            @if ($product->position == "global product")
            <div class="col-4 col-md-2 col-xl-2">
                <div class="grid_item">
                    @foreach ($product->get_product_avatars as $avtr)
                    <figure>
                        <a href="{{ route('quick',$product->slug) }}">
                            <img class="img-fluid lazy resp_img_pro" src="{{asset('/images/'.$avtr->front)}}" data-src="{{asset('/images/'.$avtr->front)}}" alt="">
                            <img class="img-fluid lazy resp_img_pro" src="{{asset('/images/'.$avtr->front)}}" data-src="{{asset('/images/'.$avtr->front)}}" alt="">
                        </a>
                    </figure>
                    @endforeach
                    <div class="rating"><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star"></i></div>
                    <a href="{{ route('quick',$product->slug) }}">
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
        <div class="row small-gutters" id="load_more">
            @include('layouts.frontend.load_more')
        </div>
        <div style="text-align: center;">
            <button onclick="loadMore()" class="btn_1" style="border: 1px solid #ddd;
            color: #fff;
            padding: 6px 13px;">Load More</button>

        </div>
    </div>




    <div class="featured lazy" data-bg="url(assets/img/featured_home.jpg)" style="height: 200px !important">
        <div class="opacity-mask d-flex align-items-center" data-opacity-mask="rgba(0, 0, 0, 0.5)">
            <div class="container margin_60">
                <div class="row justify-content-center justify-content-md-start">
                    <div class="col-lg-6 wow" data-wow-offset="150">
                        <h3>Get the Latest Deals</h3>
                        <p>Subscribe Now</p>
                        <form action="javascript:void(0)" type="post">
                           {{-- {{ csrf_field() }} --}}
                        <div id="newsletter">
                            <div class="form-group">
                                <input onfocus="enableSubscriber()" onfocusout="checkSubscriber()" type="email" name="subscriber_email" id="subscriber_email" style="background:#fff"
                                class="form-control" placeholder="Your email" required>
                                <button onclick="addSubscriber();" type="submit" id="btnSubmit"><i class="ti-angle-double-right"></i></button>
                            </div>
                        </div>
                        <span id="statusSubscribe" style="display: none;"></span>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- /featured -->
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
    function loadMore(){
        $.ajax({
            url: "{{ route('load.more') }}",
            type: "POST",
            dataType:"html",
            data: {
                "_token": "{{ csrf_token() }}",
                'val': 12,
                'len':$("#len").val()
            },
            success:function(response)
            {
                $("#load_more").html(response);
            },
            error: function(e) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'You are not logged in!'
                })
                
            }
        })
    }
        function addSubscriber(){
            var subscriber_email = $("#subscriber_email").val();
            $.ajax({
                type:'post',
                url:'/add-subscriber',
                data:{
                    "_token":"{{ csrf_token() }}",
                    subscriber_email:subscriber_email
                },
                success:function(resp){
                    if(resp == "exists"){
                        $("#statusSubscribe").show();
                        $("#btnSubmit").hide();
                        $("#statusSubscribe").html("Error: Subscriber Email Already Exists.");
                        $("#statusSubscribe").css({ 'background':'red', 'color':'#fff', 'border-radius':'12px', 'padding':'5px' });
                    }else if(resp == "saved"){
                        $("#statusSubscribe").show();
                        $("#statusSubscribe").html("Success: Thanks for Subscribing!");
                        $("#statusSubscribe").css({ 'background':'green', 'color':'#fff', 'border-radius':'12px', 'padding':'5px' });
                    }
                },
                error:function(){
                    alert("Error");
                }
            });
        }

        function checkSubscriber(){
            var subscriber_email = $("#subscriber_email").val();
            $.ajax({
                type:'post',
                url:'/check-subscriber-email',
                data:{
                    "_token":"{{ csrf_token() }}",
                    subscriber_email:subscriber_email
                },
                success:function(resp){
                    if(resp == "exists"){
                        $("#statusSubscribe").show();
                        $("#btnSubmit").hide();
                        $("#statusSubscribe").html("Error: Subscriber Email Already Exists.");
                        $("#statusSubscribe").css({ 'background':'red', 'color':'#fff', 'border-radius':'12px', 'padding':'5px' });
                    }
                },
                error:function(){
                    alert("Error");
                }
            });
        }

        function enableSubscriber(){
            $("#btnSubmit").show();
            $("#statusSubscribe").hide();
        }


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

    window.onload = displayClock();
    function displayClock(){
        if(document.getElementById("time").value != null){
            var countDownDate = document.getElementById("time").value;
        }
        
        // Update the count down every 1 second
        var x = setInterval(function() {

            // Get today's date and time
            var now = new Date().getTime();

            // Find the distance between now and the count down date
            var distance = countDownDate - now;

            // Time calculations for days, hours, minutes and seconds
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            $("#d").text(days);
            $("#h").text(hours);
            $("#m").text(minutes);
            $("#s").text(seconds);
            if (distance < 0) {
                clearInterval(x);
                $("#clockdiv").hide();
                $.ajax({
                    url: "{{ route('product.flash.update') }}",
                    type: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}"
                    },
                    success:function(response)
                    {
                        window.location.reload();
                    }
                })
            }
        }, 1000);
    }
</script>

@endsection
@endsection
