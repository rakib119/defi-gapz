@extends('layouts.fontend')
@section('main-content')
    <div id="mainContent">
        <section class="blog padding-top padding-bottom">
            <div class="container">
                <div class="section-header d-md-flex align-items-center justify-content-between">
                    <div class="section-header section-header--max50">
                        <h6 class="mb-10 mt-minus-5">Transfer  <span>Records</span></h6>
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
                                                <th>Transaction Id</th>
                                                <th>UID</th>
                                                <th>Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($histories as $history)
                                                <tr>
                                                    <td>{{ $history->created_at }} </td>
                                                    <td>{{ $history->transaction_id }} </td>
                                                    @php
                                                        if ($history->transfer_from == auth()->user()->uid) {
                                                            $sign = '-';
                                                            $type = 'Out';
                                                            $account_number = $history->transfer_to;
                                                        } else {
                                                            $sign = '+';
                                                            $type = 'In';
                                                            $account_number = $history->transfer_from;
                                                        }
                                                    @endphp
                                                    <td>{{ $account_number }} </td>
                                                    {{-- <td>{{ $type }} </td> --}}
                                                    <td>{{ $sign . ' $' . $history->subtotal }} </td>
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
