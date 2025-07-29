@extends('layouts.dashbooard')
@section('css')
    <link rel="stylesheet" href="//cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css">
@endsection
@section('javaScript')
    <script src="//cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#usersTable').DataTable();
            $('#messagesTable').DataTable();
        });
    </script>
@endsection
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
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
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
                            <div class="row">
                                <div class="col-xl-3 col-md-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="text-center">
                                                <p class="font-size-16">Total Users</p>
                                                <div class="mini-stat-icon mx-auto mb-4 mt-3">
                                                    <span class="avatar-title rounded-circle bg-soft-primary">
                                                        <i
                                                            class="mdi mdi-account-multiple-outline text-primary font-size-20"></i>
                                                    </span>
                                                </div>
                                                <h5 class="font-size-22">{{ $users }}</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-md-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="text-center">
                                                <p class="font-size-16">Deposit Request</p>
                                                <div class="mini-stat-icon mx-auto mb-4 mt-3">
                                                    <span class="avatar-title rounded-circle bg-soft-primary">
                                                        <i class="fas fa-dollar-sign text-primary font-size-20"></i>
                                                    </span>
                                                </div>
                                                <h5 class="font-size-22">{{ $deposit_request }}</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-md-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="text-center">
                                                <p class="font-size-16">Withdraw Request</p>
                                                <div class="mini-stat-icon mx-auto mb-4 mt-3">
                                                    <span class="avatar-title rounded-circle bg-soft-primary">
                                                        <i class="fas fa-dollar-sign text-primary font-size-20"></i>
                                                    </span>
                                                </div>
                                                <h5 class="font-size-22">{{ $withdrawal_records }}</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-md-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <a href="{{ route('verify_request_list') }}">
                                                <div class="text-center">
                                                    <p class="font-size-16"> Verify Request</p>
                                                    <div class="mini-stat-icon mx-auto mb-4 mt-3">
                                                        <span class="avatar-title rounded-circle bg-soft-primary">
                                                            <i class="fa fa-check text-primary font-size-20"></i>
                                                        </span>
                                                    </div>
                                                    <h5 class="font-size-22">{{ $verify_request }}</h5>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-3 justify-content-center">
                            <div class="col-12 ">
                                <h2 class="text-primary">Add Fund</h2>
                            </div>
                        </div>
                        <form action="{{route('add_fund')}}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6 mb-3">
                                    <label for="">UID <span class="text-danger">*</span></label>
                                    <input type="text" name="uid" class="form-control" placeholder="UID">
                                    @error('uid')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 mb-3"> 
                                    <label for="">Transaction Amount <span class="text-danger">*</span></label>
                                    <input type="text" name="transaction_amount" class="form-control" placeholder="Amount">
                                    @error('transaction_amount')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <button class="btn btn-primary">Send Fund</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-3 justify-content-center">
                            <div class="col-12 ">
                                <h2>Withdrawal Method Controll</h2>
                            </div>
                        </div>
                        <div class="row">
                            <table id="userTable " class="table table-striped table-nowrap mb-0 text-center">
                                <thead class="thead-light ">
                                    <tr class="text-center">
                                        <th>SL</th>
                                        <th>Method</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody >
                                    @foreach ($withdrawal_methdos as $w_methdo)
                                        @php
                                            $status = $w_methdo->status;
                                        @endphp
                                        <tr>
                                            <th>{{$loop->iteration}}</th>
                                            <th>{{$w_methdo->method}}</th>
                                            <th> <span class="badge {{$status==1 ? 'bg-success' : 'bg-danger'}}  "> {{$status==1 ? 'Active' : 'Disabled'}}</span></th>
                                            <th>
                                                <form action="{{route('change_withdrawal_method_status',$w_methdo->id)}}" method="post">
                                                    @csrf
                                                    @method('put')
                                                    <button type="submit" class="btn btn-sm btn-{{$status==1 ? 'danger' : 'success'}}">{{$status==1 ? 'Disable' : 'Active'}}</button>
                                                </form>
                                            </th>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-6">
                                <h4 class="header-title mb-4">Users</h4>
                            </div>
                            <div class="col-6">
                                <div class="d-flex">
                                    <input type="search" class="form-control" id="datatable-search-input" placeholder="Search By - Name/UID/Email/Mobile/Wallet Address">
                                    <a href="javaScript:void(0)" id="searchUser" class="btn btn-primary"> Search </a>
                                </div>
                                <small class="text-dancer" id="search_error"></small>
                            </div>
                        </div>
                        <div class="row">
                            <table id="userTable" class="table table-centered table-nowrap mb-0">
                                <thead class="thead-light ">
                                    <tr class="text-center">
                                        <th>SL</th>
                                        <th>User Name</th>
                                        <th>Uid</th>
                                        <th>Role </th>
                                        <th>Current Balance </th>
                                        <th>Status </th>
                                        <th>Country </th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="table-row">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('javacript')
    <script>
        var inputStr = $("#datatable-search-input");
        if (inputStr.val()) {
            search_user(inputStr.val());
        } else {
            search_user();
        }
        $("#searchUser").click(function() {
            var query_str = inputStr.val();
            search_user(query_str);
        });

        function search_user(query_str = '') {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                url: "{{ route('get_users') }}",
                data: {
                    query_str: query_str
                },
                success: function(data, query_str, ghgf, rytry) {
                    if (data) {
                        var input = $("#datatable-search-input");
                        if (data.query && data.user) {
                            input.css("border", "1px solid #34c38f");
                        } else if (data.query == null && data.user) {
                            input.css("border", "1px solid #ced4da");
                        } else {
                            input.css("border", "1px solid #f46a6a");
                        }
                    }
                    $('#table-row').html(data.view);
                },
            });
        }
    </script>
@endsection
