@extends('layouts.fontend')
@section('main-content')
    <div id="mainContent">
        <section class="blog padding-top padding-bottom">
            <div class="container">
                <div class="section-header d-md-flex align-items-center justify-content-between">
                    <div class="section-header section-header--max50">
                        <h6 class="mb-10 mt-minus-5">Team  <span>Income</span></h6>
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
                                                <th>Date </th>
                                                <th>Profit From </th>
                                                <th>Genaration</th>
                                                <th>Profit Ratio</th>
                                                <th>Profit</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $total = 0;
                                            @endphp
                                            @foreach ($incomes as $data)
                                                <tr>
                                                    <td> {{ $data->created_at->format('d M Y') }} </td>
                                                    <td> {{ $data->team_member_uid }} </td>
                                                    <td> {{ $data->genaration != 9 ? $data->genaration  :'CEO Ref.'}}
                                                        <sup>{{ $data->genaration == 1 ? 'st' : ($data->genaration == 2 ? 'nd' : ($data->genaration == 3 ? 'rd' : '')) }}</sup>
                                                    </td>
                                                    <td>{{ $data->profit_ratio }}% </td>
                                                    <td>${{ $data->profit }} </td>
                                                </tr>
                                                @php
                                                    $total += $data->profit;
                                                @endphp
                                            @endforeach
                                            <tr>
                                                <td colspan="4">Total:</td>
                                                <td>${{ $total }}</td>
                                            </tr>
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
