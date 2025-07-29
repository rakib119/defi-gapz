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
                                    <li class="breadcrumb-item active">User Details</li>
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
                                    <div class="row">
                                        <hr class="my-4">
                                        <div class="row">
                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                                <form action="{{route('user.update',$user->id)}}" method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <div id="bank-details">
                                                        <div class="row">
                                                            <h4 class="text-primary my-3">Personal Info:</h4>
                                                            <div class="col-md-6">
                                                                <label><strong> Name: </strong></label>
                                                                <input type="text" class="form-control" name="name" value="{{ $user->name }}">
                                                                @error('name')
                                                                    <h6 class="text-danger"> {{ $message }}</h6>
                                                                @enderror
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label><strong> Email: </strong></label>
                                                                <input type="text" class="form-control" name="email" value="{{ $user->email }}">
                                                                @error('email')
                                                                    <h6 class="text-danger"> {{ $message }}</h6>
                                                                @enderror
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label><strong> Mobile: </strong></label>
                                                                <input type="text" class="form-control" name="mobile" value="{{ $user->mobile }}">
                                                                @error('mobile')
                                                                    <h6 class="text-danger"> {{ $message }}</h6>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <h4 class="text-primary my-3">Trc20 Details:</h4>
                                                            <div class="col-md-6">
                                                                <label><strong> Trc20 Wallet Address: </strong></label>
                                                                <input type="text" class="form-control" name="wallet_address" value="{{ $user->wallet_address }}">
                                                                @error('wallet_address')
                                                                    <h6 class="text-danger"> {{ $message }}</h6>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <h4 class="text-primary my-3">Bank Details:</h4>
                                                            <div class="col-md-6">
                                                                <label><strong> Name: </strong></label>
                                                                <input type="text" class="form-control" name="full_name" value="{{ $user->full_name }}">
                                                                @error('full_name')
                                                                    <h6 class="text-danger"> {{ $message }}</h6>
                                                                @enderror
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label><strong>Bank Name: </strong></label>
                                                                <input type="text" class="form-control" name="bank_name" value="{{ $user->bank_name }}">
                                                                @error('bank_name')
                                                                    <h6 class="text-danger"> {{ $message }}</h6>
                                                                @enderror
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label><strong>Branch Name: </strong></label>
                                                                <input type="text" class="form-control" name="branch_name" value="{{ $user->branch_name }}">
                                                                @error('branch_name')
                                                                    <h6 class="text-danger"> {{ $message }}</h6>
                                                                @enderror
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label><strong>Bank Account No: </strong></label>
                                                                <input type="text" class="form-control" name="bank_account_no" value="{{ $user->bank_account_no }}">
                                                                @error('bank_account_no')
                                                                    <h6 class="text-danger"> {{ $message }}</h6>
                                                                @enderror
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label><strong>SWIFT or IBAN code: </strong></label>
                                                                <input type="text" class="form-control" name="swift_or_iban_code" value="{{ $user->swift_or_iban_code }}">
                                                                @error('swift_or_iban_code')
                                                                    <h6 class="text-danger"> {{ $message }}</h6>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="row mt-3">
                                                            <div class="col-md-4">
                                                                <div class="mb-3">
                                                                    <button type="submit" class="btn btn-warning">Update
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                       {{--  <h4 class="text-primary my-3"></h4>
                                                        <p class="my-3"><strong> Name:
                                                            </strong><span
                                                                class="text-uppercase">{{ $user->full_name ? $user->full_name : 'N/A' }}</span>
                                                        </p>
                                                        <p class="my-3"><strong>Bank Name:
                                                            </strong><span>{{ $user->bank_name ? $user->bank_name : 'N/A' }}</span>
                                                        </p>
                                                        <p class="my-3"><strong>Branch Name:
                                                            </strong><span>{{ $user->branch_name ? $user->branch_name : 'N/A' }}</span>
                                                        </p>
                                                        <p class="my-3"><strong>Bank Account No:
                                                            </strong><span>{{ $user->bank_account_no ? $user->bank_account_no : 'N/A' }}</span>
                                                        </p>
                                                        <p class="my-3"><strong>SWIFT or IBAN code:
                                                            </strong><span>{{ $user->swift_or_iban_code ? $user->swift_or_iban_code : 'N/A' }}</span>
                                                        </p> --}}
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                                <h4 class="mb-2"><strong> Name: <span
                                                            class="text-uppercase">{{ $user->name }}</span>
                                                    </strong></h4>
                                                <p class="mb-2">Uid: <span> {{ $user->uid }} </span> </p>
                                                <p class="mb-2">Joining Date: <span>
                                                        {{ $user->created_at->format('d M Y') }} </span>
                                                </p>
                                                <p class="mb-2">Email: <span
                                                        class="text-lowercase">{{ $user->email }}</span>
                                                </p>
                                                <p class="mb-2">Mobile: <span
                                                        class="text-uppercase">{{ $user->mobile }}
                                                    </span>
                                                </p>
                                                <p class="mb-2">Country: <span
                                                        class="text-uppercase">{{ $user->country }} </span> </p>
                                                <p class="mb-2">Current Balance: <span class="text-lowercase">
                                                        {{ $user->account_statement->balance }}</span> </p>

                                                <form class="mt-4"
                                                    action="{{ route('user_status_update', $user->id) }}" method="post">
                                                    @csrf
                                                    @method('put')
                                                    <div class="mb-3">
                                                        <h5>Change Role</h5>
                                                        <div class="row">
                                                            <div class="col-md-8">
                                                                <select name="role" id="" class="form-control">
                                                                    <option {{ $user->role == 0 ? 'selected' : '' }}
                                                                        value="0">Normal User</option>
                                                                    <option {{ $user->role == 2 ? 'selected' : '' }}
                                                                        value="2">Merchant</option>
                                                                </select>
                                                                @error('role')
                                                                    <h6 class="text-danger"> {{ $message }}</h6>
                                                                @enderror
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="mb-3">
                                                                    <button type="submit" class="btn btn-warning">Update
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                                <form class="mt-4"
                                                    action="{{ route('user_verify', $user->id) }}" method="post">
                                                    <div class="mb-3">
                                                        <h5>Photo Verification</h5>
                                                        <div class="row">
                                                            @csrf
                                                            @method('put')
                                                            <div class="col-md-8">
                                                                <select name="identification_status" id=""
                                                                    class="form-control">
                                                                    <option
                                                                        {{ $user->identification_status == '' ? 'selected' : '' }}
                                                                        value="null">Not Review Yet</option>
                                                                    <option
                                                                        {{ $user->identification_status == 1 ? 'selected' : '' }}
                                                                        value="1">Verified</option>
                                                                    <option
                                                                        {{ $user->identification_status == 2 ? 'selected' : '' }}
                                                                        value="2">Reject</option>
                                                                </select>
                                                                @error('fees')
                                                                    <h6 class="text-danger"> {{ $message }}</h6>
                                                                @enderror
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="mb-3">
                                                                    <button type="submit" class="btn btn-warning">Update
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                                <form class="mt-4"
                                                    action="{{ route('user_telegram_update', $user->id) }}"
                                                    method="post">
                                                    <div class="mb-3">
                                                        <h5>Telegram Link</h5>
                                                        <div class="row">
                                                            @csrf
                                                            @method('put')
                                                            <div class="col-md-8">
                                                                <input type="text" name='telegram'
                                                                    placeholder="Enter telegram link"
                                                                    class="form-control">
                                                                @error('telegram')
                                                                    <h6 class="text-danger"> {{ $message }}</h6>
                                                                @enderror
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="mb-3">
                                                                    <button type="submit" class="btn btn-warning">Update
                                                                    </button>
                                                                </div>
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
                    <div class="row">
                        <div class="col-xl-12 col-md-12">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between">
                                    <div>
                                        <h4>Accout Statement</h4>
                                    </div>
                                    <div class="d-flex justify-content-between ">
                                        <a href="{{ route('deduct_blance_form', $user->uid) }}"
                                            class="btn btn-success">
                                            Deduct Balance</a>
                                        <a href="{{ route('edit_blance_statement_form', $user->uid) }}"
                                            class="btn btn-warning">
                                            Edit Balance</a>
                                    </div>
                                </div>
                                @php
                                    $account_statement = $user->account_statement;
                                @endphp
                                <div class="card-body" style="background: #e8e8e8">
                                    <div class="row">
                                        <div class="col-xl-4 col-md-4">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="text-center">
                                                        <p class="font-size-16">Deposit</p>
                                                        <div class="mini-stat-icon mx-auto mb-4 mt-3">
                                                            <span class="avatar-title rounded-circle bg-soft-primary">
                                                                <i class="fas fa-dollar-sign text-primary font-size-20"></i>
                                                            </span>
                                                        </div>
                                                        <h5 class="font-size-22">
                                                            {{ $account_statement ? $account_statement->total_deposite : N / A }}
                                                        </h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-md-4">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="text-center">
                                                        <p class="font-size-16">Withdraw</p>
                                                        <div class="mini-stat-icon mx-auto mb-4 mt-3">
                                                            <span class="avatar-title rounded-circle bg-soft-primary">
                                                                <i
                                                                    class="fas fa-dollar-sign text-primary font-size-20"></i>
                                                            </span>
                                                        </div>
                                                        <h5 class="font-size-22">
                                                            {{ $account_statement ? $account_statement->total_withdraw : N / A }}
                                                        </h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-md-4">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="text-center">
                                                        <p class="font-size-16">Transfer</p>
                                                        <div class="mini-stat-icon mx-auto mb-4 mt-3">
                                                            <span class="avatar-title rounded-circle bg-soft-primary">
                                                                <i
                                                                    class="fas fa-dollar-sign text-primary font-size-20"></i>
                                                            </span>
                                                        </div>
                                                        <h5 class="font-size-22">
                                                            {{ $account_statement ? $account_statement->total_transfer : N / A }}
                                                        </h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-md-4">
                                            <div class="card ">
                                                <div class="card-body">
                                                    <div class="text-center ">
                                                        <p class="font-size-16">Team Income <small>(only profit)</small>
                                                        </p>
                                                        <div class="mini-stat-icon mx-auto mb-4 mt-3">
                                                            <span class="avatar-title rounded-circle bg-soft-primary">
                                                                <i
                                                                    class="fas fa-dollar-sign text-primary font-size-20"></i>
                                                            </span>
                                                        </div>
                                                        <h5 class="font-size-22">
                                                            {{ $account_statement ? $account_statement->team_income : N / A }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-md-4">
                                            <div class="card ">
                                                <div class="card-body">
                                                    <div class="text-center ">
                                                        <p class="font-size-16">Current Balance</p>
                                                        <div class="mini-stat-icon mx-auto mb-4 mt-3">
                                                            <span class="avatar-title rounded-circle bg-soft-primary">
                                                                <i
                                                                    class="fas fa-dollar-sign text-primary font-size-20"></i>
                                                            </span>
                                                        </div>
                                                        <h5 class="font-size-22">
                                                            {{ $account_statement ? $account_statement->balance : N / A }}
                                                        </h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Accout Statement <small>(Accouding to Transaction)</small> </h4>
                                </div>
                                <div class="card-body" style="background: #e8e8e8">
                                    <div class="row">
                                        <div class="col-xl-4 col-md-4">
                                            <div class="card">
                                                <div class="card-body">
                                                    <a href="{{ route('history.user_deposit', $user->uid) }}">
                                                        <div class="text-center">
                                                            <p class="font-size-16">Deposit</p>
                                                            <div class="mini-stat-icon mx-auto mb-4 mt-4">
                                                                <span class="avatar-title rounded-circle bg-soft-primary">
                                                                    <i
                                                                        class="fas fa-dollar-sign text-primary font-size-20"></i>
                                                                </span>
                                                            </div>
                                                            <h5 class="font-size-22">
                                                                {{ total_deposit_amount($user->uid) }}
                                                            </h5>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-md-4">
                                            <div class="card">
                                                <div class="card-body">
                                                    <a href="{{ route('history.user_withdrawal', $user->uid) }}">
                                                        <div class="text-center">
                                                            <p class="font-size-16">Withdraw</p>
                                                            <div class="mini-stat-icon mx-auto mb-4 mt-4">
                                                                <span class="avatar-title rounded-circle bg-soft-primary">
                                                                    <i
                                                                        class="fas fa-dollar-sign text-primary font-size-20"></i>
                                                                </span>
                                                            </div>
                                                            <h5 class="font-size-22">
                                                                {{ total_withdraw_amount($user->uid) }}
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-md-4">
                                            <div class="card">
                                                <div class="card-body">
                                                    <a href="{{ route('history.user_transfer', $user->uid) }}">
                                                        <div class="text-center">
                                                            <p class="font-size-16">Transfer(Send Money)</p>
                                                            <div class="mini-stat-icon mx-auto mb-4 mt-4">
                                                                <span class="avatar-title rounded-circle bg-soft-primary">
                                                                    <i
                                                                        class="fas fa-dollar-sign text-primary font-size-20"></i>
                                                                </span>
                                                            </div>
                                                            <h5 class="font-size-22">
                                                                {{ send_money($user->uid) }}
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-md-4">
                                            <div class="card">
                                                <div class="card-body">
                                                    <a href="{{ route('history.user_transfer_received', $user->uid) }}">
                                                        <div class="text-center">
                                                            <p class="font-size-16">Transfer(Received Money)</p>
                                                            <div class="mini-stat-icon mx-auto mb-4 mt-4">
                                                                <span class="avatar-title rounded-circle bg-soft-primary">
                                                                    <i
                                                                        class="fas fa-dollar-sign text-primary font-size-20"></i>
                                                                </span>
                                                            </div>
                                                            <h5 class="font-size-22">
                                                                {{ total_received_amount($user->uid) }}
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-md-4">
                                            <div class="card ">
                                                <div class="card-body">
                                                    <a href="{{ route('history.user_team_income', $user->uid) }}">
                                                        <div class="text-center ">
                                                            <p class="font-size-16">Team Income <small>(only
                                                                    profit)</small>
                                                            </p>
                                                            <div class="mini-stat-icon mx-auto mb-4 mt-4">
                                                                <span class="avatar-title rounded-circle bg-soft-primary">
                                                                    <i
                                                                        class="fas fa-dollar-sign text-primary font-size-20"></i>
                                                                </span>
                                                            </div>
                                                            <h5 class="font-size-22">
                                                                {{ team_income($user->uid) }}
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-md-4">
                                            <div class="card ">
                                                <div class="card-body">
                                                    <a href="{{ route('history.user_trade', $user->uid) }}">
                                                        <div class="text-center ">
                                                            <p class="font-size-16">Trade Income <small>(only
                                                                    profit)</small>
                                                            </p>
                                                            <div class="mini-stat-icon mx-auto mb-4 mt-3">
                                                                <span class="avatar-title rounded-circle bg-soft-primary">
                                                                    <i
                                                                        class="fas fa-dollar-sign text-primary font-size-20"></i>
                                                                </span>
                                                            </div>
                                                            <h5 class="font-size-22">
                                                                {{ profit_from_trade($user->uid) }}
                                                            </h5>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-md-4">
                                            <div class="card ">
                                                <div class="card-body">
                                                    <div class="text-center ">
                                                        <p class="font-size-16">Balance <small>(should be) </small> </p>
                                                        <div class="mini-stat-icon mx-auto mb-4 mt-3">
                                                            <span class="avatar-title rounded-circle bg-soft-primary">
                                                                <i
                                                                    class="fas fa-dollar-sign text-primary font-size-20"></i>
                                                            </span>
                                                        </div>
                                                        <h5 class="font-size-22">
                                                            {{ original_balance($user->uid) }}
                                                        </h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
