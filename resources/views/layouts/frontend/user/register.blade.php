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
					<li><a href="#">Home</a></li>
					<li><a href="#">Category</a></li>
					<li>Page active</li>
				</ul>
		</div>
		<h1>Create an Account</h1>
	</div>
	<!-- /page_header -->
			<div class="row justify-content-center">

            <div class="col-xl-6 col-lg-6 col-md-8">
				<div class="box_account">
					<h3 class="new_client">New User</h3> <small class="float-right pt-2">* Required Fields</small>
					<div class="form_container">
                    <form action="{{route('user.store')}}" method="post">
                        @csrf
						<div class="form-group">
							<input type="email" class="form-control" name="email" id="email_2" placeholder="Email*">
						</div>
						<div class="form-group">
							<input type="password" class="form-control" name="password" id="password_in_2" value="" placeholder="Password*">
                        </div>
                        <hr>
						<div class="private box">
							<div class="row no-gutters">
								<div class="col-6 pr-1">
									<div class="form-group">
										<input type="text" name="name" class="form-control" placeholder="Name">
									</div>
								</div>
								<div class="col-6 pl-1">
									<div class="form-group">
										<input type="text" class="form-control" name="phn" placeholder="Number">
									</div>
								</div>
								<div class="col-12">
									<div class="form-group">
										<input type="text" class="form-control" name="address" placeholder="Full Address">
									</div>
								</div>
							</div>
							<!-- /row -->

                        </div>
                        <hr>
						<div class="form-group">
							<label class="container_check">Accept <a href="#0">Terms and conditions</a>
								<input type="checkbox">
								<span class="checkmark"></span>
							</label>
						</div>
                        <div class="text-center">
							<button type="submit" class="btn_1 full-width">Register</button>
						</div>

                    </form>

                    <div class="form-group">
                        <a href="{{ url('login') }}">Already have an account?</a>
                    </div>
					</div>
					<!-- /form_container -->
				</div>
				<!-- /box_account -->
            </div>

		</div>
		<!-- /row -->
		</div>
		<!-- /container -->
	</main>
    <!--/main-->

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
            $("#searchData1").fadeOut();
            window.location.href="/"+$("#data").val();
        });
    }
</script>

@endsection
@endsection
