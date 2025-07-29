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
                                    <li class="breadcrumb-item active">User vbvb Management</li>
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
                                            <h2 class=" mb-4">Suspended User List</h2>
                                        </div>
                                        <div>
                                            <a href="{{ route('users') }}" class="btn btn-primary">
                                                Users</a>
                                        </div>
                                    </div>
                                    <table id="myTable" class="table table-centered table-nowrap mb-0">
                                        <thead class="thead-light ">
                                            <tr class="text-center">
                                                <th>SL</th>
                                                <th>User Name</th>
                                                <th>Uid</th>
                                                <th>Role </th>
                                                <th>Current Balance </th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($users as $user)
                                                @php
                                                    $status = $user->identification_status;
                                                @endphp
                                                <tr class="text-center">
                                                    <td>{{ $loop->index + 1 }}</td>
                                                    <td>{{ $user->name }}</td>
                                                    <td>{{ $user->uid }}</td>
                                                    <td><span
                                                            class="badge {{ $user->role == 0 ? 'bg-primary' : ($user->role == 2 ? 'bg-secondary' : 'bg-success') }}">
                                                            {{ $user->role == 0 ? 'User' : ($user->role == 2 ? 'Merchant' : 'Admin') }}</span>
                                                    </td>
                                                    <td>{{ $user->account_statement->balance }}</td>
                                                    <td>
                                                        <a href="{{route('cancle_suspenssion',$user->id)}}" class="btn btn-primary">Cancle Suspension</a>
                                                    </td>
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
