@extends('layouts.frontend.app')


@section('content')
@section('css')

    <link href="{{ asset('assets/css/contact.css') }}" rel="stylesheet">
@endsection


<main class="bg_gray" style="background-image: url('/images/contact-1.jpg');">
    <div class="container margin_60">
        <div class="main_title">
            <h2>Contact Us</h2>
        </div>
    </div>
<div class="bg_white">
    <div class="container margin_60_35">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-6 col-md-8 add_bottom_25">
                <form action="{{ route('contact.store') }}" method="POST">
                    @csrf
                    <h4 class="pb-3">Got Any Questions?</h4>
                    <p>Use the form below to get in touch with us.</p>
                    <div class="form-group">
                        <input name="name" class="form-control" type="text" placeholder="Name *">
                    </div>
                    <div class="form-group">
                        <input name="email" class="form-control" type="email" placeholder="Email *">
                    </div>
                    <div class="form-group">
                        <input name="phone" class="form-control" type="text" placeholder="Phone *">
                    </div>
                    <div class="form-group">
                        <textarea name="message" class="form-control" style="height: 150px;" placeholder="Message *"></textarea>
                    </div>
                    <div class="form-group">
                        <input class="btn_1 full-width" type="submit" value="Submit">
                    </div>
                </form>
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
