<footer class="revealed">
    <div class="container">
        <div class="row">
            <div class="col-lg-2 col-md-4">
                <h3 data-target="#collapse_1">Quick Links</h3>
                <div class="collapse dont-collapse-sm links" id="collapse_1">
                    <ul>
                        <li><a href="{{ route('about.us') }}">About us</a></li>
                        @auth
                        <li><a href="{{ route('user.profile') }}">My account</a></li>
                        @endauth
                        <li><a href="{{ route('user.contact') }}">Contacts</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-md-8">
                <h3 data-target="#collapse_2">Website Description</h3>
                <div class="collapse dont-collapse-sm links" id="collapse_2">
                    <p style="text-align: justify; color: #A2C7D6;">{{ optional($setting)->description }} </p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                    <h3 data-target="#collapse_3">Contacts</h3>
                <div class="collapse dont-collapse-sm contacts" id="collapse_3">
                    <ul>
                        <li><i class="ti-home"></i>{{ optional($setting)->address }}</li>
                        <li><i class="ti-headphone-alt"></i>{{ optional($setting)->contact }}</li>
                        <li><i class="ti-email"></i><a href="#0">{{ optional($setting)->email }}</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                  <h3 data-target="#collapse_4">Follow Us</h3>
                <div class="collapse dont-collapse-sm" id="collapse_4">
                
                    <div class="follow_us">
                        <ul>
                            <li><a href="{{ optional($setting)->twitt_link }}" target="_blank">
                                <img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-src="/assets/img/twitter_icon.svg" alt="" class="lazy">
                            </a></li>
                            <li><a href="{{ optional($setting)->fb_link }}" target="_blank">
                                <img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-src="/assets/img/facebook_icon.svg" alt="" class="lazy">
                            </a></li>
                            <li><a href="{{ optional($setting)->insta_link }}" target="_blank">
                                <img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-src="/assets/img/instagram_icon.svg" alt="" class="lazy">
                            </a></li>
                            <li><a href="{{ optional($setting)->tube_link }}" target="_blank">
                                <img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-src="/assets/img/youtube_icon.svg" alt="" class="lazy">
                            </a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- /row-->
        <hr>
        <div class="row add_bottom_25">
            <div class="col-lg-6">
                <ul class="footer-selector clearfix">
                    <li><img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-src="/assets/img/cards_all.svg" alt="" width="198" height="30" class="lazy"></li>
                </ul>
            </div>
            <div class="col-lg-6">
                <ul class="additional_links">
                    <li><a href="#">Terms and conditions</a></li>
                    <li><a href="#">Privacy</a></li>
                    <li><span>© 2020 Idea Tech Solution</span></li>
                </ul>
            </div>
        </div>
    </div>
</footer>
<!--/footer-->
</div>
<!-- page -->

<div id="toTop"></div><!-- Back to top button -->



<!-- COMMON SCRIPTS -->
<script src="{{ asset('assets/js/common_scripts.min.js') }}"></script>

<script src="{{ asset('assets/js/main.js') }}"></script>

<script src="{{ asset('assets/js/carousel-home.js') }}"></script>
<script src="{{ asset('sweetalert2.js') }}"></script>
<script>
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })
</script>

@yield('js')
@include('sweetalert::alert')
</body>
</html>
