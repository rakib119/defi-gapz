@extends('layouts.dashbooard')
@section('content')
    @php
    $uid = $old_statement->uid;
    $deposit = total_deposit_amount($uid);
    $withdraw = total_withdraw_amount($uid);
    $received_amount = total_received_amount($uid);
    $send_money = send_money($uid);
    $team_income = team_income($uid);
    $trade_profit = profit_from_trade($uid);
    $investment_profit = total_investment_profit($uid);
    @endphp
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
                                    <li class="breadcrumb-item active">Edit Account Statement</li>
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
                                            <h2 class=" mb-4">Update Account Statement</h2>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <h6>
                                            Deposit + Team_income + Trade Profit + Received Amount+ Investment Profit -
                                            (Withdraw + Send Money)
                                            = Balance
                                        </h6>
                                        <h6>
                                            <span class="text-danger"> {{ $deposit }}</span> +<span
                                                class="text-danger"> {{ $team_income }}</span> +<span
                                                class="text-danger"> {{ $trade_profit }}</span>+<span
                                                class="text-danger"> {{ $received_amount }}</span>+<span
                                                class="text-danger"> {{ $investment_profit }}</span> -
                                            (<span class="text-danger"> {{ $withdraw }}</span> + <span
                                                class="text-danger"> {{ $send_money }})</span> =
                                            <span class="text-danger">{{ original_balance($uid) }}</span>
                                        </h6>
                                    </div>
                                    <div class="form py-3">
                                        <form id="accountStatement"
                                            action="{{ route('edit_blance_statement_post', $uid) }}"
                                            enctype="multipart/form-data" method="post">
                                            @csrf
                                            @method('PUT')
                                            <div class="row">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="balance">Balance
                                                                ({{ original_balance($old_statement->uid) }})</label>
                                                            <input id="balance" type="text" class="form-control"
                                                                value="{{ $old_statement->balance }}" name="balance"
                                                                autofocus>
                                                        </div>
                                                        @error('balance')
                                                            <h6 class="text-danger"> {{ $message }}</h6>
                                                        @enderror
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="total_deposite">Total
                                                                Deposit
                                                                ({{ total_deposit_amount($old_statement->uid) }})</label>
                                                            <input id="total_deposite" type="text" class="form-control"
                                                                value="{{ $old_statement->total_deposite }}"
                                                                name="total_deposite">
                                                        </div>
                                                        @error('total_deposite')
                                                            <h6 class="text-danger"> {{ $message }}</h6>
                                                        @enderror
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="total_withdraw">Total
                                                                Withdraw
                                                                ({{ total_withdraw_amount($old_statement->uid) }})</label>
                                                            <input id="total_withdraw" type="text" class="form-control"
                                                                value="{{ $old_statement->total_withdraw }}"
                                                                name="total_withdraw">
                                                            @error('total_withdraw')
                                                                <h6 class="text-danger"> {{ $message }}</h6>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12 mt-3">
                                                    <div class="mb-3">
                                                        <a onclick="submitStatement()" href="javascript:void(0)"
                                                            class="btn btn-warning">Update</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
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
@section('javacript')
    <script>
        function submitStatement() {
            Swal.fire({
                title: 'Are you sure?',
                html: '<b>You want to update this statement!</b> </br>' +
                    'If need please  <b>check again</b></br>' +
                    'or <b>Confirm </b>',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Confirm',
                cancelButtonText: 'No, Check Again',
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#accountStatement').submit()
                }
            })
        }
    </script>
@endsection
