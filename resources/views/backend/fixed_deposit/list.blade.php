@extends('layouts.dashbooard')
@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="page-title-box">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-sm-6">
                            <div class="page-title">
                                <h4>DashBoard</h4>
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="{{ route('admin') }}">DashBoard</a></li>
                                    <li class="breadcrumb-item active">Investmentdds list</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="page-content-wrapper">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h2 class=" mb-4">Investment list</h2>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table id="myTable" class="table table-centered table-nowrap mb-0">
                                            <thead class="thead-light ">
                                                <tr class="text-center">
                                                    <th>SL</th>
                                                    <th>Uid</th>
                                                    <th>No Of Days</th>
                                                    <th>Transaction Id </th>
                                                    <th>Investment Amount </th>
                                                    <th>Investment Time </th>
                                                    <th>Money Back Time </th>
                                                    <th>Profit </th>
                                                    <th>Time Remain </th>
                                                    {{-- <th>Action</th> --}}
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($investments as $investment)
                                                    @php
                                                        $status = $investment->identification_status;
                                                    @endphp
                                                    <tr class="text-center">
                                                        <td>{{ $loop->index + 1 }}</td>
                                                        <td>{{ $investment->uid }}</td>
                                                        <td>{{ $investment->no_of_days }}</td>
                                                        <td>{{ $investment->transaction_id }}</td>
                                                        <td>{{ $investment->investment_amount }}</td>
                                                        <td>{{ $investment->created_at->format('d-m-Y m:s:i') }}</td>
                                                        <td>{{ $investment->created_at->addDays($investment->no_of_days)->format('d-m-Y m:s:i') }}
                                                        </td>
                                                        <td>{{ $investment->total_profit }}</td>
                                                        @php
                                                            $time_remain = $investment->created_at->addDays($investment->no_of_days)->diffInMinutes() -  $investment->created_at->diffInMinutes();
                                                        @endphp
                                                        <td> <span
                                                                class=" badge bg-{{ $time_remain < 1 ? 'success' : 'warning' }}">
                                                                {{ $time_remain < 1 ? 'over' : $time_remain . ' minutes' }}</span>
                                                        </td>
                                                       {{--  <td>
                                                            <a class="btn btn-primary"
                                                                href="{{ route('post_money', $investment->id) }}">Post
                                                                Money</a>
                                                        </td> --}}
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
            </div>

        </div>
    </div>
@endsection
