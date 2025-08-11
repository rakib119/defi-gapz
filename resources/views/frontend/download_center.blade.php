@extends('layouts.fontend')
@section('css')
@section('main-content')


    <div class="error padding-top padding-bottom sec-bg-color2">
        <div class="container">
            <div class="error__wrapper">
                <div class="error__inner" data-aos="fade-up" data-aos-duration="800">
                    <div class="error__thumb text-center">
                        <img src="{{ asset("assets/images/others/error.png")}}" alt="404 image">
                    </div>
                     <div class="error__content text-center">
                        <h2><span>ooops!</span> page not found</h2>
                        <p>Oops! It looks like you're lost. The page you were looking for couldn't be found. Don't worry, it happens to the best of us.</p>
                        <a href="{{route('index')}}" class="trk-btn trk-btn--border trk-btn--primary">Back to home</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
