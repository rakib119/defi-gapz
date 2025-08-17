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
                                    <li class="breadcrumb-item active">Freeze Amount History</li>
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
                                <div class="col-xl-4 col-md-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="text-center">
                                                <p class="font-size-16">Total Trade</p>
                                                <div class="mini-stat-icon mx-auto mb-4 mt-3">
                                                    <span class="avatar-title rounded-circle bg-soft-primary">
                                                        <i class="fas fa-dollar-sign text-primary font-size-20"></i>
                                                    </span>
                                                </div>
                                                <h5 class="font-size-22">{{ $total_transaction }}</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-md-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="text-center">
                                                <p class="font-size-16">Total Investment</p>
                                                <div class="mini-stat-icon mx-auto mb-4 mt-3">
                                                    <span class="avatar-title rounded-circle bg-soft-primary">
                                                        <i class="fas fa-dollar-sign text-primary font-size-20"></i>
                                                    </span>
                                                </div>
                                                <h5 class="font-size-22">{{ $total_investment }}</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-md-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="text-center">
                                                <p class="font-size-16">Total Freeze</p>
                                                <div class="mini-stat-icon mx-auto mb-4 mt-3">
                                                    <span class="avatar-title rounded-circle bg-soft-primary">
                                                        <i class="fas fa-dollar-sign text-primary font-size-20"></i>
                                                    </span>
                                                </div>
                                                <h5 class="font-size-22">{{ $total_transaction+$total_investment }}</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h2 class=" mb-4">Freeze Amount History</h2>
                                        </div>
                                    </div>
                                    <table id="transactionTable" class="table table-centered table-nowrap mb-0">
                                        <thead class="thead-light ">
                                            <tr class="text-center">
                                                <th>SL</th>
                                                <th>Uid</th>
                                                <th>Trade Amount</th>
                                                <th>Investment Amount</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($freeze_amount as $v)
                                                <tr class="text-center">
                                                    <td>{{$loop->iteration}}</td>
                                                    <td>{{$v['uid']}}</td>
                                                    <td>{{$v['total_transaction']}}</td>
                                                    <td>{{$v['total_investment']}}</td>
                                                    <td>{{$v['total_transaction']+$v['total_investment']}}</td>
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

