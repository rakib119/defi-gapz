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
                                    <li class="breadcrumb-item active">Transaction History</li>
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
                                            <h2 class=" mb-4">Trade History of <a
                                                    href="{{ route('user_details', user_id($uid)) }}"><span
                                                        class="text-capitalize">
                                                        {{ $name }} </span> </a> </h2>
                                        </div>
                                    </div>
                                    <table id="myTable" class="table table-centered table-nowrap mb-0">
                                        <thead class="thead-light ">
                                            <tr class="text-center">
                                                <th>No</th>
                                                <th>Transaction ID </th>
                                                <th>Old Balance</th>
                                                <th>Transaction Amount</th>
                                                <th>Profit</th>
                                                <th>Total</th>
                                                <th>Current Balance</th>
                                                <th>Created At</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($transactions as $transaction)
                                                <tr class="text-center">
                                                    <td>{{ $loop->index + 1 }}</td>
                                                    <td>{{ $transaction->transaction_id }} </td>
                                                    <td>{{ "$".$transaction->old_balance }}</td>
                                                    <td>{{ "$".$transaction->transaction_amount }}</td>
                                                    <td>{{ "$".$transaction->profit }}</td>
                                                    <td>{{ "$".$transaction->subtotal }}</td>
                                                    <td>{{ "$".$transaction->current_balance }}</td>
                                                    <td>{{ $transaction->created_at }}</td>
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
@endsection
