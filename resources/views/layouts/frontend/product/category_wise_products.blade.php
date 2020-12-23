@extends('layouts.frontend.app')


@section('content')
@section('css')
    <link href="{{ asset('assets/css/listing.css') }}" rel="stylesheet">

@endsection

<main>
    <div class="top_banner">
        <div class="opacity-mask d-flex align-items-center" data-opacity-mask="rgba(0, 0, 0, 0.3)">
            <div class="container">

                @if($category)
                <h1 onclick="getAllProduct()">{{ optional($category)->child_name }}</h1>
                @else
                <h1 onclick="getAllProduct()">{{ optional($sub_category)->sub_child_name }}</h1>
                @endif
            </div>
        </div>
        @if($category !=null)
            <img style="height: 250px !important;" src="/images/{{optional($category->get_category)->cover}}" class="img-fluid" alt="">

        @elseif($sub_category != null)
            <img style="height: 250px !important;" src="/images/{{optional($sub_category->get_category)->cover}}" class="img-fluid" alt="">
        @endif

    </div>

    <div class="container margin_30">
        <div class="row">
            <aside class="col-lg-3" id="sidebar_fixed">
                <div class="filter_col">
                    <div class="inner_bt"><a href="#" class="open_filters"><i class="ti-close"></i></a></div>
                    <div class="filter_type version_2">
                        <div class="breadcrumbs">
                            <ul>
                                <li><a href="{{route('home')}}">Home</a></li>
                                <li>Category</li>
                                @if($category)
                                <li>{{ optional($category)->child_name }}</li>
                                @else
                                <li>{{ optional($sub_category)->sub_child_name }}</li>
                                @endif
                            </ul>
                        </div>
                        <h4><a href="#filter_1" data-toggle="collapse" class="opened">Categories</a></h4>
                        <div class="collapse show" id="filter_1">
                            <ul>
                                <li>
                                    @if($category)
                                    <label onclick="getAllProduct()" style="padding-left:0px !important;color: green;font-weight: 700;" class="container_check">
                                        <span><i class="fa fa-star"></i></span>
                                        {{ optional($category)->child_name }}
                                    </label>
                                    @else
                                    <label onclick="getAllProduct()" style="padding-left:0px !important;color: green;font-weight: 700;" class="container_check">
                                        <span><i class="fa fa-star"></i></span>
                                        {{ optional($sub_category)->sub_child_name }}
                                    </label>
                                    @endif
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="filter_type version_2">
                        <h4><a href="#filter_2" data-toggle="collapse" class="opened">Brands</a></h4>
                        <div class="collapse show" id="filter_2">
                            <ul>
                                @foreach ($product as $pro)
                                <li>
                                    <label class="container_check">{{optional($pro->get_brand)->brand_name}}
                                        <input onclick="selectProperty({{optional($pro->get_brand)->id}},{{ $category ? $category->id : "null" }},{{ $sub_category ? $sub_category->id : "null" }},'brand_id','child_category_id','sub_child_category_id')" type="checkbox">
                                        <span class="checkmark"></span>
                                    </label>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="filter_type version_2">
                        <h4><a href="#filter_3" data-toggle="collapse" class="closed">Color</a></h4>
                        <div class="collapse" id="filter_3">
                            <ul>
                                @foreach ($products->unique('color') as $color)
                                    <li>
                                        <label class="container_check">{{optional($color)->color}}
                                            <input onclick="selectProperty(`{{$color->color}}`,{{ $category ? $category->id : "null" }},{{ $sub_category ? $sub_category->id : "null" }},'color','child_category_id','sub_child_category_id')" type="checkbox">
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <div class="filter_type version_2">
                        <h4><a href="#filter_4" data-toggle="collapse" class="closed">Size</a></h4>
                        <div class="collapse" id="filter_4">
                            <ul>
                                @foreach ($productSize as $pro)
                                    @foreach ($pro->get_attribute as $size)
                                    <li>
                                        <label class="container_check">{{optional($size)->size}}
                                            <input onclick="selectProperty({{optional($size)->id}},{{ $category ? $category->id : "null" }},{{ $sub_category ? $sub_category->id : "null" }},'id','child_category_id','sub_child_category_id')" type="checkbox">
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                    @endforeach
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <div class="filter_type version_2">
                        <h4><a href="#filter_5" data-toggle="collapse" class="opened">Price</a></h4>
                        <div class="collapse show" id="filter_5">
                            <ul>
                                <li>
                                    <label onchange="Price('0','500',{{ $category ? $category->id : "null" }},{{ $sub_category ? $sub_category->id : "null" }},'child_category_id','sub_child_category_id')" class="container_check">TK 0 — TK 500

                                        <input type="checkbox">
                                        <span class="checkmark"></span>
                                    </label>
                                </li>
                                <li>
                                    <label onchange="Price('500','1000',{{ $category ? $category->id : "null" }},{{ $sub_category ? $sub_category->id : "null" }},'child_category_id','sub_child_category_id')" class="container_check">TK 500 — TK 1000
                                        <input type="hidden" id="min" value="500">
                                        <input type="hidden" id="max" value="1000">
                                        <input type="checkbox">
                                        <span class="checkmark"></span>
                                    </label>
                                </li>
                                <li>
                                    <label onchange="Price('1000','2500',{{ $category ? $category->id : "null" }},{{ $sub_category ? $sub_category->id : "null" }},'child_category_id','sub_child_category_id')" class="container_check">TK 1000 — TK 2500
                                        <input type="hidden" id="min" value="1000">
                                        <input type="hidden" id="max" value="2500">
                                        <input type="checkbox">
                                        <span class="checkmark"></span>
                                    </label>
                                </li>
                                <li>
                                    <label onchange="Price('2500','5000',{{ $category ? $category->id : "null" }},{{ $sub_category ? $sub_category->id : "null" }},'child_category_id','sub_child_category_id')" class="container_check">TK 2500 — TK 5000
                                        <input type="hidden" id="min" value="2500">
                                        <input type="hidden" id="max" value="5000">
                                        <input type="checkbox">
                                        <span class="checkmark"></span>
                                    </label>
                                </li>
                            </ul>
                        </div>
                        <div class="slidecontainer">
                            <input style="width:100% !important;" onchange="Price('0','',{{ $category ? $category->id : "null" }},{{ $sub_category ? $sub_category->id : "null" }},'child_category_id','sub_child_category_id')" id="inputPrice" type="range" min="1" max="100000" value="0">
                            <p>Price : TK 0 - <span id="maxValue"></span> TK</p>
                        </div>
                    </div>
                    <div class="buttons">
                        <a onclick="getAllProduct()" style="width: 100% !important;" href="#" class="btn_1">Reset</a>
                    </div>
                </div>
            </aside>
            <div class="col-lg-9">

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
                    @include('layouts.frontend.product.all_products')
                </div>
            </div>
        </div>
    </div>

</main>
<!-- /main -->




@section('js')

<script>
    function getAllProduct(){
        window.location.reload();
    }

    function selectProperty(data,data1,data2,col_name,col_name1,col_name2){
        $.ajax({
            url: "{{ route('search.product') }}",
            method: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                'data':data,
                'data1':data1,
                'data2':data2,
                'col_name':col_name,
                'col_name1':col_name1,
                'col_name2':col_name2,
                'col_name3':null
            },
            dataType: 'html',
            success: function(response) {
                $("#products").html(response);
            },
        })
    }

    function Price(min,max,data1,data2,col_name1,col_name2){
        $("#maxValue").text($("#inputPrice").val());
        $.ajax({
            url: "{{ route('search.product') }}",
            method: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                'min':min,
                'max':max ? max : $("#inputPrice").val(),
                'data1':data1,
                'data2':data2,
                'col_name1':col_name1,
                'col_name2':col_name2,
                'col_name3':'price'
            },
            dataType: 'html',
            success: function(response) {
                $("#products").html(response);
            },
        })
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
            $("#searchData1").fadeOut();
            window.location.href="/"+$("#data").val();
        });
    }

</script>

<script src="{{ asset('assets/js/specific_listing.js') }}"></script>

<script src="{{ asset('assets/js/sticky_sidebar.min.js') }}"></script>

@endsection
@endsection
