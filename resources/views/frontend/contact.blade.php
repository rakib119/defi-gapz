@extends('layouts.fontend')
@section('main-content')
    <section class="pricing padding-top padding-bottom" id="transictionHall">
        <div class="section-header section-header--max50">
            <h6 class="mb-10 mt-minus-5"><span>Contact</span> Us</h6>
            {{-- <p>We offer the best pricings around - from installations to repairs, maintenance, and more!</p> --}}
        </div>
        <div class="container">
            <div class="pricing__wrapper">
                <div class="pricing__item aos-init aos-animate" data-aos="fade-up" data-aos-duration="1000">
                    <div class="row g-4 align-items-center">
                        <div class="col-sm-12 col-lg-12">
                            <form action="{{ route('contact-post') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 col-lg-6 col-6 col-sm-6 mb-3">
                                        <div>
                                            <label for="account-name" class="form-label">Name<span class="text-danger">*</span></label>
                                            <input name="name" class="form-control" value="{{ old('name') }}" type="text" placeholder="Your Name *" id="account-name" required>
                                        </div>
                                        @error('name')
                                            <h6 class="my-2 text-danger"> {{ $message }}</h6>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-6 col-sm-6 mb-3">
                                        <div>
                                            <label for="account-uid" class="form-label">UID</label>
                                            <input name="uid" class="form-control" value="{{ old('uid') }}" type="text"
                                                placeholder="UID" id="account-uid">
                                        </div>
                                        @error('uid')
                                            <span class="text-danger"> {{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-12 col-lg-12 col-12 col-sm-12 mb-3">
                                        <div>
                                            <label for="account-email" class="form-label">Email <span class="text-danger">*</span></label>
                                            <input name="email" class="form-control" value="{{ old('email') }}" type="email" id="account-email" placeholder="Email Address *" required>
                                        </div>
                                        @error('email')
                                            <span class="text-danger"> {{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-12 col-lg-12 col-12 col-sm-12 mb-3">
                                        <div>
                                            <label for="account-subject" class="form-label">Subject<span class="text-danger">*</span></label>
                                            <input name="subject" class="form-control" value="{{ old('subject') }}" type="subject"  placeholder="Subject *" id="account-subject" required>
                                        </div>
                                        @error('subject')
                                            <span class="text-danger"> {{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-12 col-lg-12 col-12 col-sm-12 mb-3">
                                        <div>
                                            <label for="account-message" class="form-label">Message<span class="text-danger">*</span></label>
                                            <textarea placeholder="Enter your message here...*" name="message" rows="6" id="account-message" class="form-control" required> {{ old('message') }}</textarea>
                                        </div>
                                        @error('message')
                                            <span class="text-danger"> {{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mt-3 text-center">
                                    <div class="col-12">
                                        <button class="trk-btn trk-btn--border trk-btn--primary d-block mt-4" type="submit">Submit</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="pricing__shape">
            <span class="pricing__shape-item pricing__shape-item--1"> <span></span> </span>
            <span class="pricing__shape-item pricing__shape-item--2"> <img src="{{ asset("assets/images/icon/1.png") }}" alt="shape-icon"></span>
        </div>
    </section>
@endsection
