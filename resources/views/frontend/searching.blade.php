@extends('layouts.fontend')
@section('main-content')
    <div class="error-modal">
        <div class="error-modal-content mt-5 center">
            <div class="errorIcon ">
                <i class="fa-solid fa-circle-xmark"></i>
            </div>
            <div class="row my-3">
                <div class=" col-md-12 col-sm-12">
                    <p class="text-center">Your current balance is Less than 5</p>
                </div>
            </div>
        </div>
    </div>
@endsection
