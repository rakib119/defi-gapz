<!DOCTYPE html>
<html lang="en" data-bs-theme="light">


<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
    <title>{{ env('APP_NAME') }}- Cryptocurrency Trading Platform </title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Sites meta Data -->
    <meta name="application-name"  content="Bitrader - Professional Multipurpose HTML Template for Your Crypto, Forex, Stocks & Day Trading Business">
    <meta name="author" content="thetork">
    <meta name="keywords" content="Bitrader, Crypto, Forex, and Stocks Trading Business">
    <meta name="description"
        content="Experience the power of Bitrader, the ultimate HTML template designed to transform your trading business. With its sleek design and advanced features, Bitrader empowers you to showcase your expertise, engage clients, and dominate the markets. Elevate your online presence and unlock new trading possibilities with Bitrader.">

    <!-- OG meta data -->
    <meta property="og:title"
        content="Bitrader - Professional Multipurpose HTML Template for Your Crypto, Forex, Stocks & Day Trading Business">
    <meta property="og:site_name" content=Bitrader>
    <meta property="og:url" content="index-2.html">
    <meta property="og:description"
        content="Welcome to Bitrader, the game-changing HTML template meticulously crafted to revolutionize your trading business. With its sleek and modern design, Bitrader provides a cutting-edge platform to showcase your expertise, attract clients, and stay ahead in the competitive trading markets.">
    <meta property="og:type" content="website">
    <meta property="og:image" content="{{ asset("assets/images/og.png") }}">


    <link rel="shortcut icon" href="{{ asset("assets/images/favicon.png") }}" type="image/x-icon">

    <link rel="stylesheet" href="{{ asset("assets/css/bootstrap.min.css") }}">
    <link rel="stylesheet" href="{{ asset("assets/css/aos.css") }}">
    <link rel="stylesheet" href="{{ asset("assets/css/all.min.css") }}">

    <link rel="stylesheet" href="{{ asset("assets/css/swiper-bundle.min.css") }}">
    <!-- main css for template -->
    <link rel="stylesheet" href="{{ asset("assets/css/style.css") }}">
    <link rel="stylesheet" href="{{ asset("assets/css/custom.css") }}">
    @yield('css')
</head>
<body>

  <!-- ===============>> Preloader start here <<================= -->
  <div class="preloader">
    <img src="{{ asset("assets/images/logo/preloader.png") }}" alt="preloader icon">
  </div>
  <!-- ===============>> Preloader end here <<================= -->



  <!-- ===============>> light&dark switch start here <<================= -->
  <div class="lightdark-switch" style="display: none;">
    <span class="switch-btn" id="btnSwitch"><img src="{{ asset("assets/images/icon/moon.svg") }}" alt="light-dark-switchbtn"
        class="swtich-icon"></span>
  </div>
  <!-- ===============>> light&dark switch start here <<================= -->


  <!-- ===============>> Header section start here <<================= -->
  <header class="header-section header-section--style2">
    <div class="header-bottom">
        <div class="container">
            <div class="header-wrapper">
                <div class="logo">
                    <a href="{{ route('index') }}">
                        <img class="dark" src="{{ asset('assets/img/logo.png') }}" alt="logo2">
                    </a>
                </div>
                <div class="menu-area">
                    <ul class="menu menu--style1">
                        <li class="megamenu">
                            <a href="{{ route('index') }}" class="nav-link">Home</a>
                        </li>
                        <li>
                            <a href="{{ route('transactionHall') }}" class="nav-link">Trade </a>
                        </li>
                        <li>
                            <a href="{{ route('earn') }}" class="nav-link">ROI</a>
                        </li>
                        <li>
                            <a href="{{ route('mine') }}" class="nav-link">Mine</a>
                        </li>
                    </ul>

                </div>
                <div class="header-action">
                    <div class="menu-area">
                        <div class="header-btn d-lg-block">
                            @guest
                                <a href="{{ route('register') }}" class="trk-btn trk-btn-auth trk-btn--border trk-btn--primary"><span>Join Now</span> </a>
                                <a href="{{ route('login') }}" class="trk-btn trk-btn-auth trk-btn--border trk-btn--secondary"><span>Sign In</span> </a>

                            @else
                                <a href="{{ route('persoal_information') }}" class="trk-btn trk-btn-auth trk-btn--border trk-btn--primary">{{ Str::words(auth()->user()->name, 1, '') }}
                                    @if (auth()->user()->identification_status == 1)
                                        <sup><img src="{{ asset('assets/img/check.png') }}"></sup>
                                    @endif
                                </a>
                                <a class="trk-btn trk-btn-auth trk-btn--border trk-btn--secondary" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            @endguest
                        </div>

                        <!-- toggle icons -->
                        <div class="header-bar d-none d-lg-none header-bar--style1">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </header>
  <!-- ===============>> Header section end here <<================= -->

  @yield('main-content')

    @if (session()->has('popup_message'))
        <div class="custom-modal" id="popupNotification">
            <div class="custom-modal-content mt-5 center">
                <div class="successIcon ">
                    <i class="fas fa-bell"></i>
                </div>
                <div class="row  my-2" id="notification-body">
                    <div class=" col-md-12 col-sm-12">
                        <h5>{{ session('popup_message') }}</h5>
                    </div>
                </div>
                <div class="text-center mt-4 mt-3">
                    <button class="hideBtn text-center  btn btn-primary px-4">Got It</button>
                </div>
            </div>
        </div>
    @endif
    @if (session('error'))
        <div class="custom-modal" id="successMessage">
            <div class="custom-modal-content mt-5 center">
                <div class="errorIcon ">
                    <i class="fa fa-solid fa-xmark"></i>
                </div>
                <div class="row  my-2">
                    <div class=" col-md-12 col-sm-12">
                        <h4 class="text-center mb-3" style="color: var(--s-font-color);">Opps!</h4>
                        <h5 class=" text-center text-capitalize" style="color: var(--s-font-color);">{{ session('error') }}</h5>
                    </div>
                </div>
                <div class="text-center mt-4 mt-3">
                    <button id="okHide" class="text-center  btn btn-primary" style="width:100%">ok</button>
                </div>
            </div>
        </div>
    @endif

    @if (session('success'))
        <div class="custom-modal" id="successMessage">
            <div class="custom-modal-content mt-5 center">
                <div class="successIcon ">
                    <i class="fa-solid fa-circle-check"></i>
                </div>
                <div class="row  my-2">
                    <div class=" col-md-12 col-sm-12">
                        <h4 class="text-center mb-3">Congratulations</h4>
                        <h5 class=" text-center">{{ session('success') }}</h5>
                    </div>
                </div>
                <div class="text-center mt-4 mt-3">
                    <button id="okHide" class="text-center  btn btn-primary"  style="width:100%">ok</button>
                </div>
            </div>
        </div>
    @endif
    <section id="android-menu">
        <div class="menu-wrapper">
            <div class="android-menu-bar">
                <a class="android-menu-item nav-link" href="{{ route('index') }}">
                    <div class="item-inner  {{url()->current() == route('index') ? 'active' : ''  }} ">
                        <i class="fa-solid fa-home"></i>
                        <p>Home</p>
                    </div>
                </a>
                <a class="android-menu-item nav-link " href="{{ route('transactionHall') }}">
                    <div class="item-inner {{url()->current() == route('transactionHall') ? 'active' : ''  }}">
                        <i class="fas fa-chart-line"></i>
                        <p>Trade</p>
                    </div>
                </a>
                <a class="android-menu-item nav-link " href="{{ route('earn') }}">
                    <div class="item-inner {{url()->current() == route('earn') ? 'active' : ''  }}">
                        <i class="fas fa-hand-holding-usd"></i>
                        <p>ROI</p>
                    </div>
                </a>
                <a class="android-menu-item nav-link " href="{{ route('mine') }}">
                    <div class="item-inner {{url()->current() == route('mine') ? 'active' : ''  }}">
                        <i class="fa-solid fa-recycle"></i>
                        <p>Mine</p>
                    </div>
                </a>
                @auth
                    <a class="android-menu-item nav-link " href="{{ route('persoal_information') }}">
                        <div class="item-inner {{url()->current() == route('persoal_information') ? 'active' : ''  }}">
                            <i class="fa-solid fa-user"></i>
                            <p>Info</p>
                        </div>
                    </a>
                @endauth
            </div>
        </div>
    </section>
    <!-- ===============>> footer start here <<================= -->
    <footer class="footer ">
        <div class="container">
        <div class="footer__wrapper">
            <div class="footer__top footer__top--style1">
            <div class="row gy-5 gx-4">
                <div class="col-md-6">
                <div class="footer__about">
                    <a href="{{ route('index') }}" class="footer__about-logo"><img src="{{ asset("assets/images/logo/logo.png") }}"
                        alt="Logo"></a>
                    <p class="footer__about-moto ">Welcome to our trading site! We offer the best, most
                    affordable products and services around. Shop now and start finding great deals!</p>
                    <div class="footer__app">
                    <div class="footer__app-item footer__app-item--apple">
                        <div class="footer__app-inner">
                        <div class="footer__app-thumb">
                            <a href="https://www.apple.com/app-store/" target="_blank" class="stretched-link">
                            <img src="{{ asset("assets/images/footer/apple.png") }}" alt="apple-icon">
                            </a>
                        </div>
                        <div class="footer__app-content">
                            <span>Download on the</span>
                            <p class="mb-0">App Store</p>
                        </div>
                        </div>
                    </div>
                    <div class="footer__app-item footer__app-item--playstore">
                        <div class="footer__app-inner">
                        <div class="footer__app-thumb">
                            <a href="https://play.google.com/store" target="_blank" class="stretched-link">
                            <img src="{{ asset("assets/images/footer/play.png") }}" alt="playstore-icon">
                            </a>
                        </div>
                        <div class="footer__app-content">
                            <span>GET IT ON</span>
                            <p class="mb-0">Google Play</p>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
                <div class="col-md-2 col-sm-4 col-6">
                <div class="footer__links">
                    <div class="footer__links-tittle">
                    <h6>Quick links</h6>
                    </div>
                    <div class="footer__links-content">
                    <ul class="footer__linklist">
                        <li class="footer__linklist-item"> <a href="about.html">About Us</a>
                        </li>
                        <li class="footer__linklist-item"> <a href="team.html">Teams</a>
                        </li>
                        <li class="footer__linklist-item"> <a href="service.html">Services</a> </li>
                        <li class="footer__linklist-item"> <a href="#">Features</a>
                        </li>
                    </ul>
                    </div>
                </div>

                </div>
                <div class="col-md-2 col-sm-4 col-6">
                <div class="footer__links">
                    <div class="footer__links-tittle">
                    <h6>Support</h6>
                    </div>
                    <div class="footer__links-content">
                    <ul class="footer__linklist">
                        <li class="footer__linklist-item"> <a href="#">Terms & Conditions</a>
                        </li>
                        <li class="footer__linklist-item"> <a href="#">Privacy Policy</a>
                        </li>
                        <li class="footer__linklist-item"> <a href="#">FAQs</a></li>
                        <li class="footer__linklist-item"> <a href="#">Support Center</a> </li>
                    </ul>
                    </div>
                </div>

                </div>
                <div class="col-md-2 col-sm-4">
                <div class="footer__links">
                    <div class="footer__links-tittle">
                    <h6>Company</h6>
                    </div>
                    <div class="footer__links-content">
                    <ul class="footer__linklist">
                        <li class="footer__linklist-item"> <a href="#">Careers</a>
                        </li>
                        <li class="footer__linklist-item"> <a href="#">Updates</a>
                        </li>
                        <li class="footer__linklist-item"> <a href="#">Job</a> </li>
                        <li class="footer__linklist-item"> <a href="#">Announce</a>
                        </li>
                    </ul>
                    </div>
                </div>

                </div>
            </div>
            </div>
            <div class="footer__bottom">
            <div class="footer__end">
                <div class="footer__end-copyright">
                <p class=" mb-0">© {{ date('Y') }} All Rights Reserved By <a href="/"
                    target="_blank">{{ env('APP_NAME') }}</a> </p>
                </div>
                <div>
                <ul class="social">
                    <li class="social__item">
                    <a href="#" class="social__link social__link--style22"><i class="fab fa-facebook-f"></i></a>
                    </li>
                    <li class="social__item">
                    <a href="#" class="social__link social__link--style22 "><i class="fab fa-instagram"></i></a>
                    </li>
                    <li class="social__item">
                    <a href="#" class="social__link social__link--style22"><i class="fa-brands fa-linkedin-in"></i></a>
                    </li>
                    <li class="social__item">
                    <a href="#" class="social__link social__link--style22"><i class="fab fa-youtube"></i></a>
                    </li>
                    <li class="social__item">
                    <a href="#" class="social__link social__link--style22 "><i class="fab fa-twitter"></i></a>
                    </li>
                </ul>
                </div>
            </div>
            </div>
        </div>
        </div>
        <div class="footer__shape">
        <span class="footer__shape-item footer__shape-item--1"><img src="{{ asset("assets/images/footer/1.png") }}"
            alt="shape icon"></span>
        <span class="footer__shape-item footer__shape-item--2"> <span></span> </span>
        </div>
    </footer>
    <!-- ===============>> footer end here <<================= -->
    <!-- ===============>> scrollToTop start here <<================= -->
    <a href="#" class="scrollToTop scrollToTop--style1"><i class="fa-solid fa-arrow-up-from-bracket"></i></a>
    <!-- ===============>> scrollToTop ending here <<================= -->


    <!-- vendor plugins -->

    <script src="{{ asset("assets/js/bootstrap.bundle.min.js") }}"></script>
    <script src="{{ asset("assets/js/all.min.js") }}"></script>
    <script src="{{ asset("assets/js/swiper-bundle.min.js") }}"></script>
    <script src="{{ asset("assets/js/aos.js") }}"></script>
    <script src="{{ asset("assets/js/fslightbox.js") }}"></script>
    <script src="{{ asset("assets/js/purecounter_vanilla.js") }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset("assets/js/custom.js") }}"></script>

    @yield('javaScript')
    <script>
        $('#okHide').click(function() {
            $('#successMessage').hide();
        });
        $('.hideBtn').click(function() {
            $('#popupNotification').hide();
        });
    </script>
    @auth
        @php
            $uid = auth()->user()->uid;
        @endphp
        <script>
            $(document).ready(function() {
                let postUrl = encodeURI("{{ route('register', 'ref=' . $uid) }}");
                let postTitle = 'Join using this link';

                $('#shareBtn').click(function()
                {
                    if (navigator.share)
                    {
                        navigator.share({
                            title: postTitle,
                            url: postUrl
                        }).then((result) => {}).catch((err) => {
                            console.log(err);
                        });
                    }else{
                        window.Android.share(postTitle, "", postUrl);
                    }
                });

                /* $('#shareButton').click(function() {
                    // Call the share function in the Android code
                    window.Android.share(postTitle, "", postUrl);
                }); */
            });

        </script>
    @endauth
    {{-- ======================================== Inspect Disable Start ============================================= --}}
    <script>
       /*  //   disable write click
          $(document).bind("contextmenu", (e) => false);
          disable mouse hold
          $(document).on("mousedown", "*", null, function(ev) {
            ev.preventDefault();
          });
        //   disable some keys
          document.onkeydown = function(e) {
            if (e.keyCode == 123) {
              return false;
            }
            if (e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0)) {
              return false;
            }
            if (e.ctrlKey && e.keyCode == 'S'.charCodeAt(0)) {
              return false;
            }
            if (e.ctrlKey && e.shiftKey && e.keyCode == 'J'.charCodeAt(0)) {
              return false;
            }
            if (e.ctrlKey && e.keyCode == 'U'.charCodeAt(0)) {
              return false;
            }

            if (e.ctrlKey && e.shiftKey && e.keyCode == 'C'.charCodeAt(0)) {
              return false;
            }
          } */
    </script>
    {{-- ======================================== Inspect Disable End ============================================= --}}


</body>
</html>

