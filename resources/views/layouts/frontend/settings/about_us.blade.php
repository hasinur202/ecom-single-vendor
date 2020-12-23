@extends('layouts.frontend.app')


@section('content')
@section('css')

    <link href="{{ asset('assets/css/contact.css') }}" rel="stylesheet">
@endsection


<main class="bg_gray" style="background-image: url('/images/contact-1.jpg');">
    <div class="container margin_60">
        <div class="main_title">
            <h2>About Us</h2>
        </div>
    </div>
<div class="bg_white">
    <div class="container margin_60_35">
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-10 col-md-12 add_bottom_25">
                {!! htmlspecialchars_decode($about->description) !!}
            </div>
        </div>
    </div>
</div>
</main>


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
