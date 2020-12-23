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
                    <h3>Kids's Collection</h3>
                    <div><span class="btn_1">Shop Now</span></div>
                </div>
            </a>
        </li>
    </ul>


</main>


<div class="popup_wrapper">
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
                        <label class="container_check d-inline">Don't show this PopUp again
                            <input type="checkbox">
                            <span class="checkmark"></span>
                        </label>
                    </div>

                </div>
            </div>
        </div>
    </div>
    </div>
</div>

@section('js')

<script>

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
