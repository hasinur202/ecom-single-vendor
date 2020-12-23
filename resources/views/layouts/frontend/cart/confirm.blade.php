@extends('layouts.frontend.app')


@section('content')
@section('css')
    <link href="{{ asset('assets/css/checkout.css') }}" rel="stylesheet">
@endsection


<main class="bg_gray">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div id="confirm">
                    <div class="icon icon--order-success svg add_bottom_15">
                        <svg xmlns="http://www.w3.org/2000/svg" width="72" height="72">
                            <g fill="none" stroke="#8EC343" stroke-width="2">
                                <circle cx="36" cy="36" r="35" style="stroke-dasharray:240px, 240px; stroke-dashoffset: 480px;"></circle>
                                <path d="M17.417,37.778l9.93,9.909l25.444-25.393" style="stroke-dasharray:50px, 50px; stroke-dashoffset: 0px;"></path>
                            </g>
                        </svg>
                    </div>
                <h2>Order completed!</h2>
                <p>Thank you! Stay with us to get exclusive offer... <a href="{{ route('home') }}">Shop More</a> </p>
                </div>
            </div>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->

</main>
<!--/main-->

@section('js')

<script>

</script>

@endsection
@endsection
