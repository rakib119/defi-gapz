@extends('layouts.fontend')
@section('main-content')
    <div id="mainContent">
        <section class="blog padding-top padding-bottom">
            <div class="container">
                <div class="section-header d-md-flex align-items-center justify-content-between">
                    <div class="section-header section-header--max50">
                        <h6 class="mb-10 mt-minus-5"><span>Withdrawal</span> Records</h6>
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
                                                <th>Time</th>
                                                <th>Previous Balance</th>
                                                <th>Amount</th>
                                                <th>Current Balance</th>
                                                <th>Transaction Id</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($records as $data)
                                                <tr>
                                                    <td> {{ $data->created_at->format('d M Y') }} </td>
                                                    <td>${{ $data->old_balance }} </td>
                                                    <td>${{ $data->transaction_amount }} </td>
                                                    <td>${{ $data->current_balance }}</td>
                                                    <td>{{ $data->transaction_id }}</td>
                                                    <td>
                                                        <span
                                                            class="badge bg-{{ $data->status == 1 ? 'success' : ($data->status == 2 ? 'danger' : 'primary') }}">
                                                            {{ $data->status == 1 ? 'Success' : ($data->status == 2 ? 'Decline' : 'Pending') }}</span>

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
