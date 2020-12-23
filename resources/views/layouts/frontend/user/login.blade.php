@extends('layouts.frontend.app')


@section('content')
@section('css')
    <link href="{{ asset('assets/css/account.css') }}" rel="stylesheet">
@endsection

<main class="bg_gray">

	<div class="container margin_30">
		<div class="page_header">
			<div class="breadcrumbs">
				<ul>
					<li><a href="{{route('home')}}">Home</a></li>
				</ul>
		    </div>
		    <h1>Sign In or Create an Account</h1>
	    </div>
        <!-- /page_header -->
		<div class="row justify-content-left">

			<div class="col-xl-6 col-lg-6 col-md-8">
				<div class="box_account">
					<h3 class="client">Already User</h3>
					<div class="form_container">
						<div class="row no-gutters">
							<div class="col-lg-6 pr-lg-1">
								<a href="#" class="social_bt facebook">Login with Facebook</a>
							</div>
							<div class="col-lg-6 pl-lg-1">
								<a href="#" class="social_bt google">Login with Google</a>
							</div>
						</div>
                        <div class="divider"><span>Or</span></div>
                            <form id="login">
                                <div class="form-group">
                                    <input type="email" class="form-control" name="email" id="email" placeholder="Email*">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" name="password" id="password" value="" placeholder="Password*">
                                </div>
                                <div class="clearfix add_bottom_15">
                                    <div class="checkboxes float-left">
                                        <label class="container_check">Remember me
                                            <input type="checkbox">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                    <div class="float-right"><a id="forgot" href="javascript:void(0);">Lost Password?</a></div>
                                </div> 
                            </form>
                            <div class="row no-gutters">
                                <div class="col-lg-6 pr-lg-1">
                                    <button onclick="login()" class="btn_1 full-width" style="background: rgb(197, 167, 89) !important;">Login</button>
                                </div>
                                <div class="col-lg-6 pl-lg-1">
                                    <a href="{{ url('user-register') }}" class="btn_1 full-width">Register Now</a>
                                </div>
                            </div>
                            <div id="forgot_pw">
                                <div class="form-group">
                                    <input type="email" class="form-control" name="email_forgot" id="email_forgot" placeholder="Type your email">
                                </div>
                                <p>A new password will be sent shortly.</p>
                                <div class="text-center"><input type="submit" value="Reset Password" class="btn_1"></div>
                            </div>
				    </div>
	    	    </div>
            </div>


            <div class="col-xl-6 col-lg-6 col-md-8">
				<div class="box_account" style="margin-top: 2.4rem;">

					<div class="form_container">
						 <img style="height: 16.8rem; width: 100%;" src="/images/1127001430.jpg">


				    </div>
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

    function login(){

        $.ajax({
          url: "{{ route('user.login') }}",
          method: "POST",
          data: {
              "_token": "{{ csrf_token() }}",
              'email':$("#email").val(),
              'password':$("#password").val()
          },
          success: function(res) {
              window.location.href ='/';
              Toast.fire({
                icon: 'success',
                title: 'Login successfull'
              })
          },
          error: function() {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Access Denied.'
            })
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
