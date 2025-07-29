@extends('layouts.dashbooard')
@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="page-title-box">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-sm-6">
                            <div class="page-title">
                                <h4>Message Details</h4>
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="{{ route('index') }}">Inbox</a></li>
                                    <li class="breadcrumb-item active">{{ $message->subject }}</li>
                                </ol>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="float-end d-none d-sm-block">
                                <a href="{{ url()->previous() }}" class="btn btn-success">Back</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="page-content-wrapper">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-xl-7">
                                            <div class="mt-4 mt-xl-3">
                                                <h3 class="text-primary">Subject: {{ $message->subject }}</h3>
                                                <h5 class="mt-1 mb-3">From: {{ $message->name }}</h5>
                                                <p class="mt-1 mb-3">Uid:
                                                    {{ $message->uid ? $message->uid : 'N/A' }}</p>
                                                <p class="mt-1 mb-3">Email:
                                                    {{ $message->email ? $message->email : 'N/A' }}</p>
                                                <hr class="my-4">
                                                <div class="mt-4">
                                                    <h6>Messages :</h6>
                                                    <div class="mt-4">
                                                        <P> {{ $message->message }}</P>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
