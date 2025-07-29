@php
   $transfer_amount= session()->get('transfer_amount');
   $otp = session()->get('otp');
@endphp
@extends('layouts.fontend')

@section('main-content')
    <section class="account padding-top padding-bottom sec-bg-color2">
        <div class="container">
            <div class="section-header-2 d-md-flex align-items-center justify-content-between">
                <div class="section-header section-header--max50">
                    <h6 class="mb-10 mt-minus-5">{!! $transfer_amount ? '<span>Confirm</span> Transfer':  __('<span>Transfer</span> Money') !!}</h6>
                </div>
            </div>
            <div class="account__wrapper" data-aos="fade-up" data-aos-duration="800">
                <div class="row g-4">
                    <div class="col-lg-12">
                        <div class="account__content account__content--style1">
                            {{-- <div class="account__header">
                                <h6><span>{{ $transfer_amount ? 'Confirm Transfer':  __('Transfer Money') }}</span></h6>
                            </div> --}}
                            @if (session()->get('transfer_amount'))
                                <form action="{{ route('transfer_money_into_account') }}" method="POST">
                                    @csrf
                                    <div class="row g-4">
                                        <div class="col-12">
                                            <div>
                                                <label for="transfer_amount" class="form-label">Transfer Amount <span class="text-danger">*</span></label>
                                                <input id="transfer_amount" class="form-control" value="{{ session()->get('transfer_amount') }}" type="text" readonly>
                                            </div>
                                            @error('transfer_amount')
                                                <span class="my-2 text-danger"> {{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-12">
                                            <div>
                                                <label for="serviceCharge" class="form-label">Service Charge <span class="text-danger">*</span></label>
                                                <input id="serviceCharge" class="form-control"  value="{{ session()->get('service_fee') }}" type="text">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div>
                                                <label for="total_transfer_amount" class="form-label">Total Transfer Amount <span class="text-danger">*</span></label>
                                                <input id="total_transfer_amount" class="form-control"  value="{{ session()->get('total_transfer_amount') }}" type="text">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div>
                                                <label for="otp" class="form-label">OTP <span class="text-danger">*</span></label>
                                                <input id="otp" class="form-control" name="otp" value="" type="text">
                                            </div>
                                            @error('otp')
                                                <span class="my-2 text-danger"> {{ $message }}</span>
                                            @enderror
                                            @if ($otp_error = session()->get('otp_error'))
                                                <span class="my-2 text-danger"> {{ $otp_error }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div>
                                        <button type="submit" class="trk-btn trk-btn--border trk-btn--primary d-block mt-4">Confirm</button>
                                    </div>
                                    <div class="col-12 mt-3">
                                        <a class="trk-btn trk-btn--border trk-btn--primary" href="{{ route('cancle') }}">{{ __('Cancel') }}</a>
                                    </div>
                                </form>
                            @else
                                <form action="{{ route('transfer_otp') }}" method="POST">
                                    @csrf
                                    <div class="row g-4">
                                        <div class="col-12">
                                            <div>
                                                <label for="user_Uid" class="form-label">Receiver's UID <span class="text-danger">*</span></label>
                                                <input id="user_Uid" class="form-control" value="{{ '  ' ? old('uid') : 0 }}" type="text" placeholder="Receiver's UID" name='uid' required autocomplete="ON">
                                                <p class="text-capitalize" id="userName"></p>
                                            </div>
                                            @error('uid')
                                                <span class="my-2 text-danger"> {{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-12">
                                            <div>
                                                <label for="transferAmount" class="form-label">Transfer Amount <span class="text-danger">*</span></label>
                                                <input id="transferAmount" class="form-control" min="10" value="{{ old('transfer_amount') ? old('transfer_amount') : 0 }}" type="number" placeholder="Transfer Amount" name='transfer_amount' required>
                                                <p class="text-capitalize">Available Balance: {{ $balance }}</p>
                                            </div>
                                            @error('transfer_amount')
                                                <span class="text-danger"> {{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-12">
                                            <div class="form-pass">
                                                <label for="transactionPassword" class="form-label">Transaction Password <span class="text-danger">*</span></label>
                                                <input type="password" name="transaction_password" class="form-control showhide-pass" id="transactionPassword" placeholder="Transaction Password" required autocomplete="off">

                                                <button type="button" id="togglePassword" class="form-pass__toggle"><i  id="eyeIcon" class="fa fa-eye"></i></button>
                                            </div>
                                            @error('transactionPassword')
                                                <span class="my-2 text-danger"> {{ $message }}</span>
                                            @enderror
                                            @if ($err = session()->get('transaction_password'))
                                                <span class="my-2 text-danger"> {{ $err }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <button type="submit" class="trk-btn trk-btn--border trk-btn--primary d-block mt-4">Transfer</button>
                                </form>
                            @endif
                            <div class="account__switch ">
                                <p >Click here to see <a  href="{{ route('transfer_history') }}">{{ __('History') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="account__shape">
        <span class="account__shape-item account__shape-item--1"><img src="{{ asset("assets/images/contact/4.png")}}" alt="shape-icon"></span>
        </div>
    </section>
@endsection
@section('javaScript')
    <script>
        $('#togglePassword').click(function() {
            var passInput = $("#transactionPassword");
            if (passInput.attr('type') === 'password') {
                passInput.attr('type', 'text');
            } else {
                passInput.attr('type', 'password');
            }
        });
        $('#user_Uid').change(function() {
            var uid = $('#user_Uid').val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                url: "{{ route('get_user_name') }}",
                data: {
                    uid: uid
                },
                success: function(data) {
                    $('#userName').html(data);
                },
            });
        });
    </script>
@endsection
