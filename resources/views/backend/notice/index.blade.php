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
                                    <li class="breadcrumb-item active">Notice Management</li>
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
                                            <h2 class=" mb-4">Notice List</h2>
                                        </div>
                                        <div>
                                            <a href="{{ route('notice.create') }}" class="btn btn-primary">Add
                                                Notice</a>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table id="myTable" class="table table-centered  table-nowrap mb-0">
                                            <thead class="thead-light ">
                                                <tr class="text-center">
                                                    <th width="10%">SL</th>
                                                    <th width="80%">Message</th>
                                                    <th width="10%">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($notices as $notice)
                                                    <tr class="text-center">
                                                        <td>{{ $loop->index + 1 }}</td>
                                                        <td> {{ Str::words($notice->message, 15) }} </td>
                                                        <td>
                                                            <div class="btn-group text-center">
                                                                <button type="button"
                                                                    class="btn btn-primary has-arrow dropdown-toggle"
                                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                                    Action <i class="fas fa-angle-down"></i>
                                                                </button>
                                                                <ul class="dropdown-menu ">
                                                                    <li>
                                                                        <a class="dropdown-item"
                                                                            href="{{ route('notice.edit', $notice->id) }}">
                                                                            Edit</a>
                                                                    </li>
                                                                    <li>
                                                                        <form method="POST"
                                                                            action="{{ route('notice.destroy', $notice->id) }}">
                                                                            @csrf
                                                                            @method('delete')
                                                                            <button type="submit" class="dropdown-item">
                                                                                Delete</button>
                                                                        </form>
                                                                    </li>
                                                                </ul>
                                                            </div>
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
    </div>
@endsection
