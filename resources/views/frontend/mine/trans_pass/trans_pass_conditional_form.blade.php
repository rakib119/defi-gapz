@extends('layouts.fontend')
@section('main-content')
    @if (total_ans() < 2 && !(auth()->user()->transaction_password))
        @include('partOfFrontend.small_form.set_secret_qsn')
    @else
        @include('partOfFrontend.small_form.change_trans_pass')
    @endif

@endsection
