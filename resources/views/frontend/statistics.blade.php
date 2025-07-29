@extends('layouts.fontend')
@section('main-content')
    <div id="mainContent">
        <section class="pricing padding-top padding-bottom-2">
            <div class="container">
                <div class="pricing__wrapper">
                    <div class="pricing__item aos-init aos-animate" data-aos="fade-up" data-aos-duration="1000">
                        <div class="pricing__item-inner" style="background: var(--tertiary-color3);">
                        <div class="row">
                            <div class="col-4">
                                <p class="mb-15 text-light">Total Number Of Orders</p>
                            </div>
                            <div class="col-4">
                                <p class="mb-15 text-light"><i class="fa fa-exchange icon-svg mr-2"></i>Total Amounts</p>
                            </div>
                            <div class="col-4">
                                <p class="mb-15 text-light"><i class="fa fa-wallet icon-svg mr-2"></i>Total Profits</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <p class="mb-25 text_color-secondary">{{ $account_transaction->count() }} </p>
                            </div>
                            <div class="col-4">
                                <p class="mb-25 text_color-secondary"> ${{ $account_transaction->sum('transaction_amount') }}</p>
                            </div>
                            <div class="col-4">
                                <p class="mb-25 text_color-secondary">+${{ $account_transaction->sum('profit') }}</p>
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
    </div>


    <section class="pricing padding-top-2 padding-bottom-2 bg--cover" style="background-image:url({{ asset("assets/images/pricing/bg.png") }})" id="howitworks">
        <div class="section-header section-header--max50">
        <h6 class="mb-10 mt-minus-5">Treading <span>History</span></h6>
        </div>
        <div class="container pb-5">
            <div class="tm-comparison-table text-center">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr style='background:'>
                                <th style='width:25%'>Date</th>
                                <th style='width:25%'>Order Numbers</th>
                                <th style='width:25%'>Transaction Amount</th>
                                <th style='width:25%'>Profit</th>
                            </tr>
                        </thead>
                    </table>
                    <div id="contain">
                        <table class="table table-bordered" id="table_fixed">
                            <tbody id="table_scroll">
                                @foreach ($account_transaction as $data)
                                    <tr>
                                        <td style='width:25%'> {{ $data->created_at->format('d M Y') }} </td>
                                        <td style='width:25%'>{{ $data->transaction_id }} </td>
                                        <td style='width:25%'>${{ $data->transaction_amount }}</td>
                                        <td style='width:25%'>${{ $data->profit }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    <div>
                </div>
            </div>
        </div>
        <div class="pricing__shape">
            <span class="pricing__shape-item pricing__shape-item--5"> <img src="{{ asset("assets/images/icon/shape/3.png") }}" alt="shape-icon"></span>
            <span class="pricing__shape-item pricing__shape-item--6"> <img src="{{ asset("assets/images/icon/shape/1.png") }}" alt="shape-icon"></span>
        </div>
    </section>

@endsection
