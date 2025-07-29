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
                                    <li class="breadcrumb-item active">Deposit</li>
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
                                            <h2 class=" mb-4">Deposit Request</h2>
                                        </div>
                                    </div>
                                    <div class='table-responsive'>
                                        <table id="myTable" class="table table-centered table-nowrap mb-0">
                                            <thead class="thead-light ">
                                                <tr class="text-center">
                                                    <th>SL</th>
                                                    <th>Uid</th>
                                                    <th>Name</th>
                                                    <th>Wallet Address</th>
                                                    <th>Subtotal</th>
                                                    <th>Amount</th>
                                                    <th>Status</th>
                                                    <th>Time Count</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($InTransitions as $InTransition)
                                                    <tr class="text-center">
                                                        <form method="POST" action="{{ route('success_deposit', $InTransition->id) }}">
                                                            @csrf
                                                            <td>{{ $loop->index + 1 }}</td>
                                                            <td> <a href="{{ route('user_details', $InTransition->id ) }}"> {{ $InTransition->uid }}</a></td>
                                                            <td> <a href="{{ route('user_details', $InTransition->id ) }}"> {{ $InTransition->name }}</a></td>
                                                            <td>{{ $InTransition->wallet_address }}</td>
                                                            <td>
                                                                <input type="text" class="form-control" name="subtotal" value="{{ $InTransition->subtotal }}">
                                                                @error('subtotal')
                                                                    <span class="text-danger">{{$message}}</span>
                                                                @enderror
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control" name="transaction_amount" value="{{ $InTransition->transaction_amount }}">
                                                                @error('transaction_amount')
                                                                    <span class="text-danger">{{$message}}</span>
                                                                @enderror
                                                            </td>
                                                            <td> <span
                                                                    class="badge bg-{{ $InTransition->status == 1 ? 'success' : ($InTransition->status == 2 ? 'danger' : 'primary') }}">
                                                                    {{ $InTransition->status == 1 ? 'Success' : ($InTransition->status == 2 ? 'Decline' : 'Pending') }}</span>
                                                            </td>
                                                            <td> {{ carbon_parse($InTransition->created_at)->diffForHumans() }} </td>
                                                            @if ($InTransition->status != 1)
                                                                <td>
                                                                    <div class="btn-group text-center">
                                                                        <button type="button"
                                                                            class="btn btn-primary has-arrow dropdown-toggle"
                                                                            data-bs-toggle="dropdown" aria-expanded="false">
                                                                            Action <i class="fas fa-angle-down"></i>
                                                                        </button>
                                                                        <ul class="dropdown-menu ">
                                                                            <li>
                                                                                <button type="submit" class="dropdown-item"><i class="fa fa-check"></i>&nbsp;&nbsp; Verify Payment</button>
                                                                            </li>
                                                                            <li>
                                                                                <a class="dropdown-item"
                                                                                    href="{{ route('decline_deposit', $InTransition->id) }} "><i
                                                                                        class=" fa  fa-ban"></i>&nbsp;&nbsp;
                                                                                    Decline</a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </td>
                                                            @else
                                                                <td>N/A</td>
                                                            @endif
                                                        </form>
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
