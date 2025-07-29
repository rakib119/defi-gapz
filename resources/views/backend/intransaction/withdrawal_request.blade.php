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
                                    <li class="breadcrumb-item active">Withdrawal Request</li>
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
                                            <h2 class=" mb-4">Withdrawal Request</h2>
                                        </div>
                                    </div>
                                    <div class='table-responsive'>
                                        <table id="myTable" style='overflow-y: scroll;'
                                            class="table table-centered table-nowrap mb-0">
                                            <thead class="thead-light ">
                                                <tr class="text-center">
                                                    <th>SL</th>
                                                    <th>Uid</th>
                                                    <th>Status</th>
                                                    <th>Name</th>
                                                    <th>Method</th>
                                                    <th>Account No</th>
                                                    <th>Transaction Id</th>
                                                    <th>Transaction Amount</th>
                                                    <th>Old Balance</th>
                                                    <th>Current Balance</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($withdrawal_records as $withdrawal_record)
                                                    @php
                                                        $user = app\Models\User::where('uid', $withdrawal_record->uid)
                                                            ->select('id', 'uid', 'name', 'wallet_address', 'bank_account_no', 'bank_name')
                                                            ->first();
                                                        $account_balance = DB::table('account_statements')
                                                            ->where('uid', $withdrawal_record->uid)
                                                            ->select('balance')
                                                            ->first();
                                                        $original_balance = (float) original_balance($withdrawal_record->uid) - (float) $account_balance->balance;
                                                        $status = false;
                                                        if ($original_balance < -1) {
                                                            $status = true;
                                                        }
                                                    @endphp
                                                    <tr class="text-center">
                                                        <td>{{ $loop->index + 1 }}</td>
                                                        <td><a
                                                                href="{{ $user ? route('user_details', $user->id) : 'javascript:void(0)' }}">
                                                                {{ $withdrawal_record->uid }}</a> </td>
                                                        <td><span
                                                                class="badge {{ $status ? 'bg-danger' : 'bg-success' }}">{{ $status ? 'Need To Check' : 'Look Great' }}
                                                            </span></td>
                                                        <td> <a
                                                                href="{{ $user ? route('user_details', $user->id) : 'javascript:void(0)' }}">
                                                                {{ $user ? $user->name : 'N/A' }}</a></td>
                                                        <td><span
                                                                class="badge bg-{{ $withdrawal_record->withdrawal_method == 0 ? 'primary' : 'info' }}">
                                                                {{ $withdrawal_record->withdrawal_method == 0 ? 'Trc20' : 'Bank' }}</span>
                                                        </td>
                                                        @php
                                                            if ($user) {
                                                                if ($withdrawal_record->withdrawal_method == 0) {
                                                                    $account_no = $user->wallet_address;
                                                                } else {
                                                                    $account_no = $user->bank_account_no;
                                                                }
                                                            } else {
                                                                $account_no = 'N/A';
                                                            }
                                                        @endphp
                                                        <td>{{ $account_no }}
                                                            @if ($withdrawal_record->withdrawal_method)
                                                                <a
                                                                    href="{{ $user ? route('user_details', $user->id) . '#bank-details' : 'javascript:void(0)' }}">
                                                                    Bank: {{ $user->bank_name }}</a>
                                                            @endif
                                                        </td>
                                                        <td>{{ $withdrawal_record->transaction_id }}</td>
                                                        <td>{{ $withdrawal_record->transaction_amount }}</td>
                                                        <td>{{ $withdrawal_record->old_balance }}</td>
                                                        <td>{{ $withdrawal_record->current_balance }}</td>
                                                        <td> <span
                                                                class="badge bg-{{ $withdrawal_record->status == 1 ? 'success' : ($withdrawal_record->status == 2 ? 'danger' : 'primary') }}">
                                                                {{ $withdrawal_record->status == 1 ? 'Success' : ($withdrawal_record->status == 2 ? 'Decline' : 'Pending') }}</span>
                                                        </td>
                                                        @if ($withdrawal_record->status == 0)
                                                            <td>
                                                                <div class="btn-group text-center">
                                                                    <button type="button"
                                                                        class="btn btn-primary has-arrow dropdown-toggle"
                                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                                        Action <i class="fas fa-angle-down"></i>
                                                                    </button>
                                                                    <ul class="dropdown-menu ">
                                                                        <li>
                                                                            <form method="POST"
                                                                                action="{{ route('withdrawal_success', $withdrawal_record->id) }}">
                                                                                @csrf
                                                                                <button type="submit"
                                                                                    class="dropdown-item"><i
                                                                                        class=" fa  fa-check"></i>&nbsp;&nbsp;
                                                                                    Success</button>
                                                                            </form>
                                                                        </li>
                                                                        <li>
                                                                            <form method="POST"
                                                                                action="{{ route('withdrawal_decline', $withdrawal_record->id) }}">
                                                                                @csrf
                                                                                <button type="submit"
                                                                                    class="dropdown-item"><i
                                                                                        class=" fa  fa-ban"></i>&nbsp;&nbsp;
                                                                                    Decline</button>
                                                                            </form>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </td>
                                                        @else
                                                            <td>N/A</td>
                                                        @endif
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
