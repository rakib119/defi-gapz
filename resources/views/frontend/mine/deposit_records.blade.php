@extends('layouts.fontend')
@section('main-content')

    <div id="mainContent">
        <section class="blog padding-top padding-bottom">
            <div class="container">
                <div class="section-header d-md-flex align-items-center justify-content-between">
                    <div class="section-header section-header--max50">
                        <h6 class="mb-10 mt-minus-5"><span>Deposit</span> Records</h6>
                    </div>
                </div>
                <div class="blog__wrapper" data-aos="fade-up" data-aos-duration="1000">
                    <div class="tm-countdown-wrap tm-style1 text-center bg-tm-dark">
                        <div class="row ">
                            <div class="col-12">
                                <div class="tm-comparison-table text-center">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr class="bg-table-header">
                                                <th>Date</th>
                                                {{-- <th>Transaction Id</th>
                                                <th>Wallet Address</th> --}}
                                                <th>Amount</th>
                                                <th>status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($deposits as $deposit)
                                                <tr>
                                                    <td>{{ $deposit->created_at->format('d M Y') }} </td>
                                                    {{-- <td>{{ $deposit->transaction_id }} </td>
                                                    <td>{{ $deposit->wallet_address }} </td> --}}
                                                    <td>${{ $deposit->transaction_amount }} </td>
                                                    <td><span
                                                            class="badge bg-{{ $deposit->status == 1 ? 'success' : ($deposit->status == 2 ? 'danger' : 'primary') }}">
                                                            {{ $deposit->status == 1 ? 'Success' : ($deposit->status == 2 ? 'Declined' : 'Pending') }}</span>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
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
    </div>
@endsection
