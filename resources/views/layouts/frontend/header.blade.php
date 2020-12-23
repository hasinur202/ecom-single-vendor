<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="_token" content="{{ csrf_token() }}">
    <meta name="author" content="Idea Tech">
    <title>{{ config('app.name', 'Online Life CSA') }}</title>

    <!-- Favicons-->
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" type="image/x-icon" href="assets/img/apple-touch-icon-57x57-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="assets/img/apple-touch-icon-72x72-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="assets/img/apple-touch-icon-114x114-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="assets/img/apple-touch-icon-144x144-precomposed.png">
    <link rel="stylesheet"
    href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- GOOGLE WEB FONT -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="anonymous">
    <link rel="preload" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900&display=swap" as="fetch" crossorigin="anonymous">
    <script>
    !function(e,n,t){"use strict";var o="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900&display=swap",r="__3perf_googleFonts_c2536";function c(e){(n.head||n.body).appendChild(e)}function a(){var e=n.createElement("link");e.href=o,e.rel="stylesheet",c(e)}function f(e){if(!n.getElementById(r)){var t=n.createElement("style");t.id=r,c(t)}n.getElementById(r).innerHTML=e}e.FontFace&&e.FontFace.prototype.hasOwnProperty("display")?(t[r]&&f(t[r]),fetch(o).then(function(e){return e.text()}).then(function(e){return e.replace(/@font-face {/g,"@font-face{font-display:swap;")}).then(function(e){return t[r]=e}).then(f).catch(a)):a()}(window,document,localStorage);
    </script>

    <!-- BASE CSS -->
    <link href="{{ asset('assets/css/bootstrap.custom.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

	<!-- SPECIFIC CSS -->
    <link href="{{ asset('assets/css/home_1.css') }}" rel="stylesheet">

    <style>


        header .main_header #logo a img {
            padding: 10px; width: 140px; height: 51px;
        }
        .cartaddbtn {
            padding: 8px 10px !important;
            font-size: 0.8rem !important;
        }
        .usr_actvity strong{
            border-radius: 50%;
            padding: 3px;
            width: 11px;
            height: 12px;
            display: block;
            position: absolute;
            bottom: 30px;
            right: -3px;
        }
        .toolbox{
            display: none;
        }

        .img_ad_banner{
            width: 100%;
            height: 9rem;
        }

        .to-be-share-holder{
            float: right;
            background-color: yellow;
            padding: 10px;
            border-radius: 30px;
            margin-top: -37px;
        }

        .main_menu_ul{
            display:none;
        }

        @media (max-width: 600px){
            header .main_header #logo a img {
                height: 30px;
                width: auto;
                padding:0px;
            }
            .toolbox{
                display: block;
            }

            .main_menu_ul{
                display:block;
            }

            .img_ad_banner{
                width: 100%;
                height: 86px;
            }

            .cartaddbtn{
                padding:5px 5px !important; font-size:0.5rem !important;
            }
            .usr_actvity strong{
                border-radius: 50%;
                padding: 3px;
                width: 11px;
                height: 12px;
                display: block;
                position: absolute;
                right: -3px;
                bottom: 15px;
            }
            .wishlist strong{
                bottom:0px !important;
            }

			.mb-search-dropdown{
				position:absolute;display: none;background-color: #fff;
				margin-left: 15px;
				margin-right: 15px;
				border-radius: 2px;
				margin-top: -9px;
				padding-left: 8px;
				height: auto;
				width: 90%
			}

			.search_mob_wp{
				display: block;
			}

			.to-be-share-holder{
                float: left;
                background-color: white;
                border-radius: 30px;
                margin-top: -7px;
                font-size: 11px;
                padding-left: 10px;
                padding-right: 10px;
                padding-top: 2px;
                padding-bottom: 2px;
                margin-left: -10px;
            }

        }

		.search_mob_wp{
			display: none;
		}
		.slidecontainer {
			width: 100%;
		}

		.slider {
			-webkit-appearance: none;
			width: 100%;
			height: 25px;
			background: #d3d3d3;
			outline: none;
			opacity: 0.7;
			-webkit-transition: .2s;
			transition: opacity .2s;
		}

		.slider:hover {
			opacity: 1;
		}

		.slider::-webkit-slider-thumb {
			-webkit-appearance: none;
			appearance: none;
			width: 25px;
			height: 25px;
			background: #4CAF50;
			cursor: pointer;
		}

		.slider::-moz-range-thumb {
			width: 25px;
			height: 25px;
			background: #4CAF50;
			cursor: pointer;
		}

		.n-search-dropdown{
			position: absolute;
			background: #fff;
			width: 98.3%;
			border-radius: 5px;
			margin-top: 11px;
			display:none;
		}

    </style>

    @yield('css')

</head>

<body>

	<div id="page">

	<header class="version_2">
		<div class="layer"></div>
		<div class="main_header">
			<div class="container">
				<div class="row small-gutters">
					<div class="col-xl-3 col-lg-3 d-lg-flex align-items-center">
						<div id="logo">
							<a href="{{ route('home') }}">
                                <img src="/images/{{ optional($setting)->logo }}" alt="logo">
                            </a>
						</div>
					</div>
					<nav class="col-xl-6 col-lg-7">
						<a class="open_close" href="javascript:void(0);">
							<div class="hamburger hamburger--spin">
								<div class="hamburger-box">
									<div class="hamburger-inner"></div>
								</div>
							</div>
						</a>
						<!-- Mobile menu button -->
						<div class="main-menu">
							<div id="header_menu">
								<a href="{{ route('home') }}"><img src="/images/{{ optional($setting)->logo }}" alt="" width="100" height="35"></a>
								<a href="#" class="open_close" id="close_in"><i class="ti-close"></i></a>
                            </div>
                            <ul class="main_menu_ul">
                                <li>
                                    <a href="{{ route('home') }}">
                                        <i style="font-size: 1.3rem;padding-right: 5px;" class="fa fa-home"></i> Home
                                    </a>
                                </li>
                                @auth
                                    <li>
                                        <a href="{{ route('user.profile') }}"><i style="font-size: 1.3rem;padding-right: 5px;" class="fa fa-user"></i> My Account</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('user.profile') }}"><i style="font-size: 1.3rem;padding-right: 5px;" class="fa fa-list"></i> Order History</a>
                                    </li>

                                    <li>
                                        <a href="{{ route('user.logout') }}">
                                            <i style="font-size: 1.3rem;padding-right: 5px; color:red;" class="fa fa-sign-out"></i>
                                            Logout</a>
                                    </li>
                                @else
                                    <li>
                                        <a href="{{ route('user.login') }}"><i style="font-size: 1.3rem;padding-right: 5px;" class="fa fa-sign-in"></i> Login</a>
                                    </li>
                                @endauth


							</ul>

						</div>
						<!--/main-menu -->
					</nav>

					<div class="col-xl-3 col-lg-2 d-lg-flex align-items-center justify-content-end text-right">
                        <a class="phone_top" href="tel://{{ optional($setting)->contact }}">
                            <i class="fa fa-phone" aria-hidden="true" style="font-size: 1.5rem; color: burlywood;"></i>
                            <strong style="color:#5f82bf">Need Help? {{ optional($setting)->contact }}</strong>
                        </a>
					</div>
				</div>
				<!-- /row -->
			</div>
		</div>
		<!-- /main_header -->

		<div class="main_nav Sticky">
			<div class="container">
				<div class="row small-gutters">
					<div class="col-xl-3 col-lg-3 col-md-3">
						<nav class="categories">
							<ul class="clearfix">
								<li><span>
										<a href="#">
											<span class="hamburger hamburger--spin">
												<span class="hamburger-box">
													<span class="hamburger-inner"></span>
												</span>
											</span>
											Categories
										</a>
									</span>
									<div id="menu">
										<ul>
											@foreach ($categories as $cat)
											<li><span><a href="#">{{optional($cat)->cat_name}}</a></span>
												<ul>
													@foreach ($cat->get_child_category as $child)
													<li><span><a href="{{route('category.product',$child->slug)}}">{{optional($child)->child_name}}</a></span>
														<ul>
															@foreach ($child->get_sub_child_category as $sub)
															<li>
																<a href="{{route('category.product',$sub->slug)}}">{{optional($sub)->sub_child_name}}</a>
															</li>
															@endforeach
														</ul>
													</li>
													@endforeach

													{{-- <li><a href="listing-grid-2-full.html">Life style</a></li>
													<li><a href="listing-grid-3.html">Running</a></li>
													<li><a href="listing-grid-4-sidebar-left.html">Training</a></li>
													<li><a href="listing-grid-5-sidebar-right.html">View all Collections</a></li> --}}
												</ul>
											</li>
											@endforeach
										</ul>
									</div>
								</li>
							</ul>
						</nav>
					</div>
					<div class="col-xl-6 col-lg-7 col-md-6 d-none d-md-block">
						<div style="position: relatiove;" class="custom-search-input">
							<input onkeyup="searchProduct(this.value)" value="" type="text" id="data" placeholder="Search products">
							<button type="submit"><i class="header-icon_search_custom"></i></button>
						</div>
						<div id="searchData" class="n-search-dropdown">

						</div>

                    </div>

					<div class="col-xl-3 col-lg-2 col-md-3">
						<ul class="top_tools">
							<li>
								@include('layouts.frontend.cart.headerCartPortion')
							</li>
							<li>
                                <a href="{{ route('wishlist') }}" class="wishlist"><strong id="count">{{ $count }}</strong></a>
							</li>
							<li>
								<div class="dropdown dropdown-access">
                                    @auth
                                        <a href="{{ route('user.profile') }}" class="access_link usr_actvity">
                                            <strong style="background:#CC9966;"></strong>
                                        </a>
                                    @else
                                        <a href="{{ url('login') }}" class="access_link usr_actvity" >
                                            <strong style="background: red;"></strong>
                                        </a>
                                    @endauth
									<div class="dropdown-menu">
                                        @auth
                                        <a href="{{ route('user.logout') }}" class="btn_1">Sign Out</a>
                                        @else
                                        <a href="{{ url('login') }}" class="btn_1">Sign In or Sign Up</a>
                                        @endauth
										@auth
										<ul>
											<li>
												<a href="#"><i class="ti-truck"></i>Track your Order</a>
											</li>
											<li>
												<a href="{{ route('user.profile') }}"><i class="ti-package"></i>My Orders</a>
											</li>
											<li>
												<a href="{{ route('user.profile') }}"><i class="ti-user"></i>My Profile</a>
											</li>
											<li>
												<a href="help.html"><i class="ti-help-alt"></i>Help and Faq</a>
											</li>
										</ul>
										@endauth
									</div>
								</div>
								<!-- /dropdown-access-->
							</li>
							<li>
								<a href="javascript:void(0);" class="btn_search_mob"><span>Search</span></a>
							</li>
							<li>
								<a href="#menu" class="btn_cat_mob">
									<div class="hamburger hamburger--spin" id="hamburger">
										<div class="hamburger-box">
											<div class="hamburger-inner"></div>
										</div>
									</div>
									Categories
								</a>
							</li>
						</ul>
					</div>
				</div>
				<!-- /row -->
			</div>
			<div class="search_mob_wp" style="position: relative">
				<input onkeyup="searchProduct(this.value)" value="" type="text" id="data" class="form-control" placeholder="Search products">
				{{-- <input type="submit" class="btn_1 full-width" value="Search"> --}}
			</div>
			<div id="searchData1" class="mb-search-dropdown">
			</div>

		</div>
	</header>
