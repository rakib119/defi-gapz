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
                                            <h2 class=" mb-4">Transaction History</h2>
                                        </div>
                                    </div>
                                    <table id="transactionTable" class="table table-centered table-nowrap mb-0">
                                        <thead class="thead-light ">
                                            <tr class="text-center">
                                                <th>Uid</th>
                                                <th>Transaction ID </th>
                                                <th>Transaction Amount</th>
                                                <th>Profit</th>
                                                <th>Old Balance</th>
                                                <th>Current Balance</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="text-center">

                                            </tr>
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
@section('javacript')
    <script>
        let url = "{{route('get_transactions_history')}}"
        $('#transactionTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: url,
            columns: [{
                    data: 'uid',
                    name: 'uid'
                },
                {
                    data: 'transaction_id',
                    name: 'transaction_id'
                },
                {
                    data: 'transaction_amount',
                    name: 'transaction_amount'
                },
                {
                    data: 'profit',
                    name: 'profit'
                },
                {
                    data: 'old_balance',
                    name: 'old_balance'
                },
                {
                    data: 'current_balance',
                    name: 'current_balance'
                },
            ]
        });
    </script>
@endsection
