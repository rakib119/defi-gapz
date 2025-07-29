@php
    $qsn_id_array = get_ans_id_arr();
    $questions = DB::table('secret_questions')->select(['id','question'])->whereIn('id',$qsn_id_array)->get();
@endphp
@extends('layouts.fontend')
@section('main-content')
    <section class="account padding-top padding-bottom sec-bg-color2">
        <div class="container">
            <div class="account__wrapper" data-aos="fade-up" data-aos-duration="800">
                <div class="row g-4">
                    <div class="col-lg-12">
                        <div class="account__content account__content--style1">
                            <div class="account__header">
                                <h6><span>Secret</span> Questions</h6>
                                <p>Input minimum two correct answers that you were asked for before.</p>
                            </div>
                            <form action="{{ route('judge_ans')}}" method="POST">
                                @csrf
                                <div class="row g-4">
                                    @foreach ($questions as $qsn)
                                        <div class="col-12">
                                            <div>
                                                <label>{{$qsn->question}}</label>
                                                <input type="text" placeholder="{{$qsn->question}}" name="qsn**{{$qsn->id}}" class="form-control">
                                            </div>
                                            @error('email')
                                                <span class="my-2 text-danger"> {{ $message }}</span>
                                            @enderror
                                        </div>
                                    @endforeach
                                </div>
                                <button type="submit" class="trk-btn trk-btn--border trk-btn--primary d-block mt-4">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="account__shape">
        <span class="account__shape-item account__shape-item--1"><img src="{{ asset("assets/images/contact/4.png")}}"
            alt="shape-icon"></span>
        </div>
    </section>
@endsection

