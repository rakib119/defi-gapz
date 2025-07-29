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
                                    <li class="breadcrumb-item active">Edit Supplier</li>
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
                                            <h2 class=" mb-4">Edit Supplier</h2>
                                        </div>
                                    </div>
                                    <div class="form py-3">
                                        <form action="{{ route('supplier.update', $supplier->id) }}"
                                            enctype="multipart/form-data" method="post">
                                            @csrf
                                            @method('put')
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="supplier_name">Supplier
                                                            Name <span class="text-danger">*</span></label>
                                                        <input id="supplier_name" name="supplier_name" type="text"
                                                            class="form-control" value="{{ $supplier->supplier_name }} "
                                                            required>
                                                        @error('supplier_name')
                                                            <h6 class="text-danger"> {{ $message }}</h6>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="Region">Region<span
                                                                class="text-danger">*</span></label>
                                                        <input id="region" name="region" type="text" class="form-control"
                                                            value="{{ $supplier->region }} " required>
                                                        @error('region')
                                                            <h6 class="text-danger"> {{ $message }}</h6>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="min_market_price">Min Market
                                                            Price<span class="text-danger">*</span></label>
                                                        <input id="min_market_price" name="min_market_price" type="text"
                                                            class="form-control"
                                                            value="{{ $supplier->min_market_price }} " required>
                                                        @error('min_market_price')
                                                            <h6 class="text-danger"> {{ $message }}</h6>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="max_market_price">Max Market
                                                            Price<span class="text-danger">*</span></label>
                                                        <input id="max_market_price" name="max_market_price" type="text"
                                                            class="form-control"
                                                            value="{{ $supplier->max_market_price }} " required>
                                                        @error('max_market_price')
                                                            <h6 class="text-danger"> {{ $message }}</h6>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="min_transaction_price">Min
                                                            Transaction Price<span class="text-danger">*</span></label>
                                                        <input id="min_transaction_price" name="min_transaction_price"
                                                            type="text" class="form-control"
                                                            value="{{ $supplier->min_transaction_price }} " required>
                                                        @error('min_transaction_price')
                                                            <h6 class="text-danger"> {{ $message }}</h6>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="max_transaction_price">Max
                                                            Transaction Price<span class="text-danger">*</span></label>
                                                        <input id="max_transaction_price" name="max_transaction_price"
                                                            type="text" class="form-control"
                                                            value="{{ $supplier->max_transaction_price }} " required>
                                                        @error('max_transaction_price')
                                                            <h6 class="text-danger"> {{ $message }}</h6>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="currency">Currency<span
                                                                class="text-danger">*</span></label>
                                                        <input id="currency" name="currency" type="text"
                                                            class="form-control" value="{{ $supplier->currency }} "
                                                            required>
                                                        @error('currency')
                                                            <h6 class="text-danger"> {{ $message }}</h6>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12 mt-3">
                                                    <div class="mb-3">
                                                        <button type="submit" class="btn btn-success">Update </button>
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
        </div>
    </div>
@endsection
