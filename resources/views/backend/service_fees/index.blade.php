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
                                    <li class="breadcrumb-item active">Service Fees</li>
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
                                            <h2 class=" mb-4">Service Fees</h2>
                                        </div>
                                    </div>
                                    <table id="myTable" class="table table-centered table-nowrap mb-0">
                                        <thead class="thead-light ">
                                            <tr class="text-center">
                                                <th>SL</th>
                                                <th>Service Name</th>
                                                <th>Fees</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($service_fees as $service_fee)
                                                <tr class="text-center">
                                                    <td>{{ $loop->index + 1 }}</td>
                                                    <td class="text-capitalize">{{ $service_fee->get_service_name->type }}
                                                    </td>
                                                    <td>{{ $service_fee->fees }}</td>
                                                    <td>
                                                        <a href="{{ route('service_fees_edit', $service_fee->id) }}"
                                                            class="btn btn-primary"> Update Fee</a>
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
