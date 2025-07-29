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
                                    <li class="breadcrumb-item active">User Management</li>
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
                                            <h2 class=" mb-4">User List</h2>
                                        </div>
                                        <div>
                                            <a href="{{ route('suspended_user_list') }}" class="btn btn-primary"><i
                                                    class="fa fa-trushed"></i> Suspended
                                                Users</a>
                                        </div>
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
