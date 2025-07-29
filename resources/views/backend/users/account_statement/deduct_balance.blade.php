@extends('layouts.dashbooard')
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
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
                                    <li class="breadcrumb-item"><a href="{{ route('admin') }}">DashBoard</a></li>
                                    <li class="breadcrumb-item active">Edit Account Statement</li>
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
                                            <h2 class=" mb-4">Deduct Balance</h2>
                                        </div>
                                        <div>
                                            <a href="{{route('user_details', $user_id)}}" class="btn btn-primary waves-effect waves-light mt-2 float-end">
                                                <i class="fas fa-long-arrow-alt-left"></i> Back
                                            </a>
                                        </div>
                                    </div>
                                    <div class="form py-3">
                                        <form id="accountStatement"
                                            action="{{ route('deduct_blance_post', $old_statement->uid) }}"
                                            enctype="multipart/form-data" method="post">
                                            @csrf
                                            @method('PUT')
                                            <div class="row">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="balance">Balance <span class="text-danger">*</span></label>
                                                            <input id="balance" type="text" class="form-control"
                                                                value="{{ $old_statement->balance }}" name="balance"
                                                                autofocus>
                                                        </div>
                                                        @error('balance')
                                                            <h6 class="text-danger"> {{ $message }}</h6>
                                                        @enderror
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <label class="form-label" for="total_deposite">Email Body <span class="text-danger">*</span></label>
                                                        <div class="mb-3">
                                                            <textarea class="form-control" id="body" name="email_body" placeholder="Body"></textarea>
                                                            @error('email_body')
                                                                <h6 class="text-danger"> {{ $message }}</h6>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12 mt-3">
                                                    <div class="mb-3">
                                                        <a onclick="submitStatement()" href="javascript:void(0)"
                                                            class="btn btn-warning">Update</a>
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
@section('javacript')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#body').summernote({
                toolbar: [
                    // [groupName, [list of button]]
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']]
                ]
            });
        });
    </script>
    <script>
        function submitStatement() {
            Swal.fire({
                title: 'Are you sure?',
                html: '<b>You want to update this statement!</b> </br>' +
                    'If need please  <b>check again</b></br>' +
                    'or <b>Confirm </b>',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Confirm',
                cancelButtonText: 'No, Check Again',
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#accountStatement').submit()
                }
            })
        }
    </script>
@endsection
