@extends('layouts.fontend')
@section('main-content')

    <!-- ===============>> Banner section start here <<================= -->
    <section class="banner banner--style1">
        <div class="banner__bg">
            <div class="banner__bg-element">
                    <img src="{{ asset("assets/images/banner/home1/bg.png") }}" alt="section-bg-element" class="dark d-none d-lg-block">
                    <span class="bg-color d-lg-none"></span>
            </div>
        </div>
        <div class="container">
            <div class="banner__wrapper">
                <div class="row gy-5 gx-4">
                    <div class="col-lg-6 col-md-7">
                        <div class="banner__content" data-aos="fade-right" data-aos-duration="1000">
                            <div class="banner__content-coin">
                                <img src="{{ asset("assets/images/banner/home1/3.png") }}" alt="coin icon">
                            </div>
                            <h1 class="banner__content-heading"><span>AI-Powered Crypto Arbitrage:</span> Maximize Returns, Minimize Risk!</h1>
                            <p class="banner__content-moto">AI instantly captures crypto arbitrage spreads across exchanges 24/7.
                            </p>
                            <div class="banner__btn-group btn-group">
                                <a href="javascript:void(0)" id="shareBtn"  class="trk-btn trk-btn--primary trk-btn--arrow">Invite<span><i class="fa-solid fa-arrow-right"></i></span> </a>

                                <a href="{{ route('deposit_view') }}"
                                class="trk-btn trk-btn--outline22">
                                    <span class="style1">
                                        <i class="fa-solid fa-wallet"></i>
                                    </span>
                                    Deposit
                                </a>
                            </div>
                            <div class="banner__content-social">
                                <p>Follow Us</p>
                                <ul class="social">
                                    <li class="social__item">
                                        <a href="#" class="social__link social__link--style1 active"><i class="fab fa-facebook-f"></i></a>
                                    </li>
                                    <li class="social__item">
                                        <a href="#" class="social__link social__link--style1"><i class="fab fa-linkedin-in"></i></a>
                                    </li>
                                    <li class="social__item">
                                        <a href="#" class="social__link social__link--style1"><i class="fab fa-instagram"></i></a>
                                    </li>
                                    <li class="social__item">
                                        <a href="#" class="social__link social__link--style1"><i class="fab fa-youtube"></i></a>
                                    </li>
                                    <li class="social__item">
                                        <a href="signin.html" class="social__link social__link--style1"><i class="fab fa-twitter"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-5">
                        <div class="banner__thumb" data-aos="fade-left" data-aos-duration="1000">
                            <img src="{{ asset("assets/images/banner/home1/1.png") }}" alt="banner-thumb" class="dark">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="banner__shape">
            <span class="banner__shape-item banner__shape-item--1"><img src="{{ asset("assets/images/banner/home1/4.png") }}" alt="shape icon"></span>
        </div>
    </section>
    <!-- ===============>> Banner section end here <<================= -->


    <!-- ===============>> partner section start here <<================= -->
    <div class="partner partner--gradient">
        <div class="container">
            <div class="partner__wrapper">
                <div class="partner__slider swiper">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="partner__item">
                                    <div class="partner__item-inner">
                                        <img src="{{ asset("assets/images/partner/light/1.png") }}" alt="partner logo" class="dark">
                                    </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="partner__item">
                                    <div class="partner__item-inner">
                                        <img src="{{ asset("assets/images/partner/light/2.png") }}" alt="partner logo" class="dark">
                                    </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="partner__item">
                                    <div class="partner__item-inner">
                                        <img src="{{ asset("assets/images/partner/light/3.png") }}" alt="partner logo" class="dark">
                                    </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="partner__item">
                                <div class="partner__item-inner">
                                    <img src="{{ asset("assets/images/partner/light/4.png") }}" alt="partner logo" class="dark">
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="partner__item">
                                <div class="partner__item-inner">
                                    <img src="{{ asset("assets/images/partner/light/5.png") }}" alt="partner logo" class="dark">
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="partner__item">
                                <div class="partner__item-inner">
                                    <img src="{{ asset("assets/images/partner/light/6.png") }}" alt="partner logo" class="dark">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ===============>> partner section end here <<================= -->


    <!-- ===============>> User Dashboard start here <<================= -->
    <section class="service padding-top padding-bottom">
        <div class="container">
            <div class="service__wrapper">
                <div class="row g-4 align-items-center">
                    <div class="col-sm-12 col-md-3 col-lg-3">
                        <a href="{{ route('about-us') }}">
                            <div class="service__item service__item--style1" data-aos="fade-up" data-aos-duration="800">
                                <div class="service__item-inner text-center">
                                    <div class="service__item-thumb mb-30">
                                        <img class="dark" src="{{ asset("assets/images/service/1.png") }}" alt="service-icon">
                                    </div>
                                    <div class="service__item-content">
                                        <h5> <a class="stretched-link" href="{{ route('about-us') }}">About Us</a> </h5>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-12 col-md-3 col-lg-3">
                        <a href="{{route('privacy_policy')}}">
                            <div class="service__item service__item--style1" data-aos="fade-up" data-aos-duration="800">
                                <div class="service__item-inner text-center">
                                    <div class="service__item-thumb mb-30">
                                        <img class="dark" src="{{ asset("assets/images/service/2.png") }}" alt="service-icon">
                                    </div>
                                    <div class="service__item-content">
                                        <h5> <a class="stretched-link" href="{{route('privacy_policy')}}">Privacy Policy</a> </h5>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-12 col-md-3 col-lg-3">
                        <a href="{{route('download_center')}}">
                            <div class="service__item service__item--style1" data-aos="fade-up" data-aos-duration="800">
                                <div class="service__item-inner text-center">
                                    <div class="service__item-thumb mb-30">
                                        <img class="dark" src="{{ asset("assets/images/service/3.png") }}" alt="service-icon">
                                    </div>
                                    <div class="service__item-content">
                                        <h5> <a class="stretched-link" href="{{route('download_center')}}">Download Center</a> </h5>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-12 col-md-3 col-lg-3">
                        <a href="{{ route('contact-us') }}">
                            <div class="service__item service__item--style1" data-aos="fade-up" data-aos-duration="800">
                                <div class="service__item-inner text-center">
                                    <div class="service__item-thumb mb-30">
                                        <img class="dark" src="{{ asset("assets/images/service/4.png") }}" alt="service-icon">
                                    </div>
                                    <div class="service__item-content">
                                        <h5> <a class="stretched-link" href="{{ route('contact-us') }}">Contact Us</a> </h5>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ===============>> User Dashboard end here <<================= -->
    <!-- ========== Transaction Records start Here========== -->
    <section class="roadmap padding-top padding-bottom bg-color" id="roadmap">
        <div class="container">
            <div class="section-header section-header--max50">
                <h6 class="mb-10 mt-minus-5">Transaction <span> Records</span></h6>
                <p>The latest competition for orders.</p>
            </div>
            <div class="row">
                <div class="col-sm-12 col-lg-12">
                    <div class="service__item service__item--style1 aos-init aos-animate" data-aos="fade-left" data-aos-duration="800">
                        {{-- <div class="service__item-inner text-center"> --}}
                            <div class="tm-comparison-table text-center">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr >
                                                <th style='width:30%'>UID</th>
                                                <th style='width:35%'>Amount of Transaction</th>
                                                <th style='width:35%'>Profit</th>
                                            </tr>
                                        </thead>
                                    </table>
                                    <div id="contain">
                                        <table class="table table-bordered" id="table_fixed" >
                                            <tbody id="table_scroll">
                                                @foreach ($transactions as $transaction)
                                                    <tr>
                                                        <td style='width:30%; word-break: break-all;'><p>{{ Str::mask($transaction->uid, '*', -9, 7) }}</p> </td>
                                                        <td style='width:35%; word-break: break-all;'><p>${{ $transaction->transaction_amount }}</p> </td>
                                                        <td style='width:35%; word-break: break-all;'><p>${{ $transaction->profit }}</p></td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        {{-- </div> --}}
                    </div>
                </div>
            </div>
        </div>
        <div class="roadmap__shape">
            <span class="roadmap__shape-item roadmap__shape-item--1"> <span></span> </span>
            <span class="roadmap__shape-item roadmap__shape-item--2"> <img src="{{ asset("assets/images/icon/1.png") }}" alt="shape-icon">
        </span>
        </div>
    </section>
    <!-- ========== Transaction Records Ends Here========== -->

    <!-- ===============>> video Tutorial start here <<================= -->
    {{-- <section class="pricing padding-top padding-bottom">
        <div class="section-header section-header--max50">
            <h6 class="mb-10 mt-minus-5">video  <span>Tutorials </span></h6>
            <p>We offer the best pricings around - from installations to repairs, maintenance, and more!</p>
        </div>
        <div class="container">
            <div class="testimonial__wrapper">
                <div class="testimonial__slider2 swiper">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="testimonial__item testimonial__item--style2">
                                <div class="testimonial__item-inner">
                                    <div class="testimonial__item-content">
                                        <iframe style="border-radius: 10px;" width="100%" height="205" src="https://www.youtube.com/embed/42qmAtmYkJc?si=oEvzE9FVb6yy7P80" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="testimonial__item testimonial__item--style2">
                                <div class="testimonial__item-inner">
                                    <div class="testimonial__item-content">
                                        <iframe style="border-radius: 10px;" width="100%" height="205" src="https://www.youtube.com/embed/GBxNmItmOXo?si=l-kMrEdSDYwtS1vb" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="testimonial__item testimonial__item--style2">
                                <div class="testimonial__item-inner">
                                    <div class="testimonial__item-content">
                                        <iframe style="border-radius: 10px;" width="100%" height="205" src="https://www.youtube.com/embed/8RjHAcSMbhQ?si=2FfC3DoqgUF3DgdV" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-nav swiper-nav--style2">
                    <button class="swiper-nav__btn active  swiper-nav__btn-prev testimonial__slider-prev"><i class="fa-solid fa-angle-left"></i></button>
                    <button class="swiper-nav__btn swiper-nav__btn-next testimonial__slider-next"><i class="fa-solid fa-angle-right"></i></button>
                </div>
            </div>
        </div>
        <div class="pricing__shape">
            <span class="pricing__shape-item pricing__shape-item--1"> <span></span> </span>
            <span class="pricing__shape-item pricing__shape-item--2"> <img src="{{ asset("assets/images/icon/1.png") }}" alt="shape-icon"></span>
        </div>
    </section> --}}
    <!-- ===============>> video Tutorial end here <<================= -->



    <!-- ===============>> Crypto Pricing start here <<================= -->
    <section class="blog padding-top padding-bottom">
        <div class="container">
            <div class="section-header d-md-flex align-items-center justify-content-between">
                <div class="section-header section-header--max50">
                    <h6 class="mb-10 mt-minus-5">Crypto currency <span> Pricing</span></h6>
                    <p>Live Pricing of top ten crypto</p>
                </div>
            </div>
            <div class="blog__wrapper" data-aos="fade-up" data-aos-duration="1000">
                <div class="tm-countdown-wrap tm-style1 text-center bg-tm-dark">
                    <div class="row ">
                        <div class="col-12">
                            <div class="tm-comparison-table text-center" id="live-pricing-table">
                                {!! $crypto_table !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="blog__shape">
            <span class="blog__shape-item blog__shape-item--1"> <span></span> </span>
        </div>
    </section>
    <!-- ===============>> Crypto Pricing start here <<================= -->



@endsection
@section('javaScript')
    {{-- ================================= Live Pricing Start==================================== --}}
    <script>
        let  callPricingTable = ()=>{
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'get',
                url: "{{ route('index') }}",
                success: function(data) {
                    // console.log(data);
                    $('#live-pricing-table').html(data);

                },
            });
        }
        // setInterval(callPricingTable, 10000);// 10 sec interval
    </script>
    {{-- ================================= Live Pricing End ==================================== --}}

@endsection

