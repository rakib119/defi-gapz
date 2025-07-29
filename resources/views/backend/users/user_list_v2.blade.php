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
                                    <table id="autoloadTable" class="table table-centered table-nowrap mb-0">
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
                                        <tbody id="test">
                                            @forelse ($users as $user)
                                                @php
                                                    $status = $user->identification_status;
                                                    $balance =  $user->balance;
                                                    $role = $user->role;
                                                    $original_balance = (float) original_balance($user->uid) - (float) $balance;
                                                    $status = false;
                                                    if ($original_balance < 0) {
                                                        $status = true;
                                                    }
                                                @endphp
                                                <tr class="text-center">
                                                    <td>{{ $loop->index + 1 }}</td>
                                                    <td><a href="{{ route('user_details', $user->id) }}"> {{ $user->name }} </a></td>
                                                    <td>{{ $user->uid }}</td>
                                                    <td><span class="badge {{ $role == 0 ? 'bg-primary' : ($role == 2 ? 'bg-secondary' : 'bg-success') }}">
                                                            {{ $role == 0 ? 'User' : ($role == 2 ? 'Merchant' : 'Admin') }}</span> </td>
                                                    <td>{{ $balance }}</td>
                                                    <td><span class="badge {{ $status ? 'bg-danger' : 'bg-success' }}">{{ $status ? 'Need To Check' : 'Look Great' }}
                                                        </span></td>
                                                    <td>{{ $user->country }}</td>
                                                    <td>
                                                        <div class="btn-group text-center">
                                                            <button type="button" class="btn btn-primary has-arrow dropdown-toggle" data-bs-toggle="dropdown"
                                                                aria-expanded="false">
                                                                Action <i class="fas fa-angle-down"></i>
                                                            </button>
                                                            <ul class="dropdown-menu ">
                                                                <li>
                                                                    <a class="dropdown-item" href="{{ route('user_details', $user->id) }}"><i
                                                                            class=" fa  fa-info"></i>&nbsp;&nbsp;&nbsp;Details</a>
                                                                </li>
                                                                <li>
                                                                    <form method="POST" action="{{ route('users.destroy', $user->id) }}">
                                                                        @csrf
                                                                        <button type="submit" class="dropdown-item"><i class=" fa  fa-ban"></i>&nbsp;&nbsp;
                                                                            Suspend</button>
                                                                    </form>
                                                                </li>
                                                                <li>
                                                                    <form method="POST" action="{{ route('user_delete_permanently', $user->id) }}">
                                                                        @csrf
                                                                        @method('delete')
                                                                        <button type="submit" class="dropdown-item"><i class="fa fa-trash"></i>&nbsp;&nbsp;
                                                                            Delete</button>
                                                                    </form>
                                                                </li>
                                                            </ul>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr class="text-center">
                                                    <td class="no-data" colspan="8">Data Not Found!</td>
                                                </tr>
                                            @endforelse
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
