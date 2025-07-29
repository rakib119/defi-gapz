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
                                    <li class="breadcrumb-item active">Supplier Management</li>
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
                                            <h2 class=" mb-4">Supplier List</h2>
                                        </div>
                                        <div>
                                            <a href="{{ route('supplier.create') }}" class="btn btn-primary">Add
                                                Supplier</a>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table id="myTable" class="table table-centered  table-nowrap mb-0">
                                            <thead class="thead-light ">
                                                <tr class="text-center">
                                                    <th>SL</th>
                                                    <th>Supplier Name</th>
                                                    <th>Region</th>
                                                    <th>Min Market Price</th>
                                                    <th>Max Market Price</th>
                                                    <th>Min Transaction Price</th>
                                                    <th>Max Transaction Price</th>
                                                    <th>Currency</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($suppliers as $supplier)
                                                    <tr class="text-center">
                                                        <td>{{ $loop->index + 1 }}</td>
                                                        <td class="text-capitalize"> {{ $supplier->supplier_name }} </td>
                                                        <td class="text-capitalize"> {{ $supplier->region }} </td>
                                                        <td class="text-capitalize"> {{ $supplier->min_market_price }}
                                                        </td>
                                                        <td class="text-capitalize"> {{ $supplier->max_market_price }}
                                                        </td>
                                                        <td class="text-capitalize">
                                                            {{ $supplier->min_transaction_price }}
                                                        </td>
                                                        <td class="text-capitalize">
                                                            {{ $supplier->max_transaction_price }}
                                                        </td>
                                                        <td class="text-capitalize"> {{ $supplier->currency }} </td>
                                                        <td>
                                                            <a href="{{ route('supplier.edit', $supplier->id) }}"
                                                                class="btn btn-primary"> Edit</a>
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
