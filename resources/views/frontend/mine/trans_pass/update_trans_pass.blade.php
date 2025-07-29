@extends('layouts.fontend')
@php
   $correct_ans = session()->get('correct_ans');
@endphp
@section('main-content')
    @if ($correct_ans >=2)
        @include('partOfFrontend.small_form.change_trans_pass')
    @else
        @include('frontend.mine.trans_pass.give_secret_ans')
    @endif
@endsection
