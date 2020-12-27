@extends('layouts.frontend.app')


@section('content')
@section('css')
    <link href="{{ asset('/assets/css/product_page.css') }}" rel="stylesheet">

    <style>
        .wishlist_btn{
            width: 100%; margin-top:0px; background:#54964b !important;
        }

        @media (max-width: 600px){
            .wishlist_btn{
                width: 100%; margin-top:10px; background:#54964b !important;
            }
        }
    </style>
@endsection


<main>
    <div class="container margin_30">
        <div class="row">
            <div class="col-md-6">
                <div class="all">
                    @foreach ($product->get_product_avatars as $avatar)
                    <div class="slider">
                        <div class="owl-carousel owl-theme main">
                            <div style="background-image: url({{ asset('/images/' . $avatar->front) }});" class="item-box"></div>
                            <div style="background-image: url({{ asset('/images/' . $avatar->back) }});" class="item-box"></div>
                            <div style="background-image: url({{ asset('/images/' . $avatar->left) }});" class="item-box"></div>
                            <div style="background-image: url({{ asset('/images/' . $avatar->right) }});" class="item-box"></div>
                        </div>
                        <div class="left nonl"><i class="ti-angle-left"></i></div>
                        <div class="right"><i class="ti-angle-right"></i></div>
                    </div>
                    <div class="slider-two">
                        <div class="owl-carousel owl-theme thumbs">
                            <div style="background-image: url({{ asset('/images/' . $avatar->front) }});" class="item active"></div>
                            <div style="background-image: url({{ asset('/images/' . $avatar->back) }});" class="item"></div>
                            <div style="background-image: url({{ asset('/images/' . $avatar->left) }});" class="item"></div>
                            <div style="background-image: url({{ asset('/images/' . $avatar->right) }});" class="item"></div>
                        </div>
                        <div class="left-t nonl-t"></div>
                        <div class="right-t"></div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="col-md-6">
                <div class="breadcrumbs">
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li><a href="#">Product-details</a></li>
                        <li>Page active</li>
                    </ul>
                </div>
                <!-- /page_header -->
                <div class="prod_info">
                    <h1>{{ $product->product_name }}</h1>
                    <p><small>Brand</small><br>{{ $product->get_brand->brand_name }}</p>
                    <div class="prod_options">
                        <div class="row">
                            <label class="col-xl-5 col-lg-5  col-md-6 col-6 pt-0"><strong>Color</strong></label>
                            <div class="col-xl-4 col-lg-5 col-md-6 col-6 colors">
                                <ul>
                                    <li>
                                        <a href="#" class="color color_1 active" style="background-color: {{ $product->color }} !important"></a>

                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-xl-5 col-lg-5 col-md-6 col-6"><strong>Size</strong> - Size Guide <a href="#0" data-toggle="modal" data-target="#size-modal"><i class="ti-help-alt"></i></a></label>
                            <div class="col-xl-4 col-lg-5 col-md-6 col-6">

                                <div class="custom-select-form">
                                    <select id="size" onchange="priceBySize(this.value,{{$product->id}})" class="wide">

                                        @foreach ($product->get_attribute as $size)
                                            <option value="{{ optional($size)->size }}" selected="selected">{{ optional($size)->size }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-xl-5 col-lg-5  col-md-6 col-6"><strong>Quantity</strong></label>
                            <div class="col-xl-4 col-lg-5 col-md-6 col-6">
                                <div class="numbers-row">
                                    <input type="text" value="1" id="qty" class="qty2" name="qty">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-xl-5 col-lg-5  col-md-6 col-6"><strong>Price</strong></label>
                            <div class="col-xl-4 col-lg-5 col-md-6 col-6">
                                <div class="price_main">
                                    <span id="sale_price" class="new_price">{{ $product->get_attribute[0]->sale_price }} Tk.</span>
                                    <span id="promo_price" class="old_price">{{ $product->get_attribute[0]->promo_price }} Tk.</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-6">
                            <a href="#" onclick="addToCart({{ $product->id }})" style="width: 100%" class="btn_1">Add to Cart</a>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <a href="#" class="btn_1 wishlist_btn" onclick="addWishList({{ $product }})">Add to Wishlist</a>
                        </div>
                    </div>
                </div>
                <!-- /prod_info -->
            </div>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->

    <div class="tab_content_wrapper" style="padding: 15px 0 10px 0;">
        <div class="container">
                <div class="card tab-pane fade active show" role="tabpanel" aria-labelledby="tab-A">
                    <div class="card-header" role="tab" id="heading-A">
                        <h5 class="mb-0">
                            <a class="collapsed" data-toggle="collapse" href="#collapse-A" aria-expanded="false" aria-controls="collapse-A">
                                Description
                            </a>
                        </h5>
                    </div>
                    <div id="collapse-A" class="collapse" role="tabpanel" aria-labelledby="heading-A">
                        <div class="card-body">
                            <div class="row justify-content-between">
                                <div class="col-lg-6">
                                    <h3>Details</h3>
                                    <p>{{ $product->product_name }}</p>
                                </div>
                                <div class="col-lg-5">
                                    <h3>Specifications</h3>
                                    <div class="table-responsive">
                                        <table class="table table-sm table-striped">
                                            <tbody>
                                                <tr>
                                                    <td><strong>Color</strong></td>
                                                    <td>{{ optional($product)->color }}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Brand</strong></td>
                                                    <td>{{ optional($product->get_brand)->brand_name }}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Price</strong></td>
                                                    <td>{{ $product->get_attribute[0]->sale_price }} Tk.</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <!-- /tab-content -->
        </div>
        <!-- /container -->
    </div>


    <div class="container margin_60_35">
        <div class="main_title">
            <h2>Related</h2>
            <span>Products</span>
        </div>
        <div class="owl-carousel owl-theme products_carousel">

            @foreach ($products as $pro)
            @if ($pro->get_brand->id == $product->brand_id && $pro->slug != $product->slug)
            <div class="item">
                <div class="grid_item">
                    <span class="ribbon hot">Hot</span>
                    <figure>
                        <a href="{{ route('quick',$pro->slug) }}">
                            @foreach ($pro->get_product_avatars as $avtr)
                            <img class="owl-lazy" src="/assets/img/products/product_placeholder_square_medium.jpg" data-src="{{ asset('/images/' . $avtr->front) }}" alt="">
                            @endforeach
                        </a>
                    </figure>
                    <div class="rating"><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star"></i></div>
                    <a href="{{ route('quick',$pro->slug) }}">
                        <h3>{{$pro->product_name}}</h3>
                    </a>
                    <div class="price_box">
                        <span class="new_price">{{$pro->sale_price}}</span>
                        <span class="old_price">{{$pro->promo_price}}</span>
                    </div>
                    <ul>
                        <li><a onclick="addWishList({{ $product }})" href="#" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to favorites"><i class="ti-heart"></i><span>Add to favorites</span></a></li>
                        <li><a onclick="addToCart({{ $pro }})" href="#" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to cart"><i class="ti-shopping-cart"></i><span>Add to cart</span></a></li>
                    </ul>
                </div>
            </div>
            @endif
            @endforeach
            <!-- /item -->
        </div>
        <!-- /products_carousel -->
    </div>
    <!-- /container -->

    <div class="feat">
        <div class="container">
            <ul>
                <li>
                    <div class="box">
                        <i class="ti-gift"></i>
                        <div class="justify-content-center">
                            <h3>Free Shipping</h3>
                            <p>For all oders over Tk. 2000</p>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="box">
                        <i class="ti-wallet"></i>
                        <div class="justify-content-center">
                            <h3>Secure Payment</h3>
                            <p>100% secure payment</p>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="box">
                        <i class="ti-headphone-alt"></i>
                        <div class="justify-content-center">
                            <h3>24/7 Support</h3>
                            <p>Online top support</p>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <!--/feat-->

</main>
<!-- /main -->


@section('js')
<script>
    function addToCart(id){
        $.ajax({
            url: "{{ route('cart.store') }}",
            type: "POST",
            dataType:"html",
            data: {
                "_token": "{{ csrf_token() }}",
                'id': id,
                'size':$("#size").val(),
                'sale_price':$("#sale_price").val(),
                'qty':$("#qty").val()
            },
            success:function(response)
            {
                $("#cartPortion").html(response);
            },
            error: function(e) {
                if (e.status == 422) {
                    Swal.fire({
                        icon:'error',
                        title:'Opps!',
                        text:'Product already in cart.'
                    })
                }else{
                    Swal.fire({
                        icon:'error',
                        title:'Opps!',
                        text:'You are not logged In.'
                    })
                }
            }
        })
    }

    function addWishList(product){

        $.ajax({
            url: "{{ route('wishlist.store') }}",
            type: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                'slug': product.slug
            },
            success:function(response)
            {
                if(response.guest == 'guest'){
                    Swal.fire({
                        icon:'error',
                        title:'Opps!',
                        text:'You are not logged In.'
                    })
                }else if(response.errors == 'match'){
                    Swal.fire({
                        icon:'error',
                        title:'Opps!',
                        text:'Product already in wishlist.'
                    })
                }else{
                    $("#count").text(response.count);
                }
            }
        })
    }

    function priceBySize(val,id){
        $.ajax({
            url: "{{ route('price.by.size') }}",
            type: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                'id': id,
                'val':val
            },
            success:function(response)
            {
                $("#sale_price").text(response.price.sale_price+' TK');
                $("#promo_price").text(response.price.promo_price+' TK');
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

<script src="{{ asset('assets/js/carousel_with_thumbs.js') }}"></script>
@endsection
@endsection
