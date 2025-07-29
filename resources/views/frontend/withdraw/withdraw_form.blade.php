@extends('layouts.fontend')
@section('main-content')
    <section class="account padding-top padding-bottom sec-bg-color2">
        <div class="container">
            <div class="account__wrapper" data-aos="fade-up" data-aos-duration="800">
                <div class="row g-4">
                    <div class="col-lg-12">
                        <div class="account__content account__content--style1">
                            <div class="account__header">
                                <h6><span>{{ session()->get('withdrawal_amount') ?'Withdrawal Confirmation':  'Withdraw  Now'}}</span></h6>
                            </div>
                            @if (session()->get('withdraw_success'))
                                <h6 class="text-center py-2">{{ session()->get('withdraw_success') }} </h6>
                            @endif
                            @if (session()->get('withdrawal_amount'))
                                <form action="{{ route('send_withdraw_request') }}" method="POST">
                                    @csrf
                                    <div class="row g-4">
                                        <div class="col-12">
                                            <div>
                                                <label class="form-label">Withdrawal Amount <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" value="${{ session()->get('withdrawal_amount') }}"  readonly>
                                            </div>
                                            @error('withdrawal_amount')
                                                <span class="my-2 text-danger"> {{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-12">
                                            <div>
                                                <label for="serviceCharge" class="form-label">Service Charge <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" value="${{ session()->get('service_fee') }}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div>
                                                <label class="form-label">Total Withdrawal Amount <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" value="${{ session()->get('total_withdrawal_amount') }}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div>
                                                <label for="otp" class="form-label">OTP <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="otp" placeholder="Enter OTP" name='otp' value=''>
                                                {{-- {{session()->get('otp')}} --}}
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
                                <form action="{{ route('withdraw_otp') }}" method="POST">
                                    @csrf
                                    <div class="row g-4">
                                        <div class="col-12">
                                            <div>
                                                <label for="withdrawal_method" class="form-label">Withdrawal Method <span class="text-danger">*</span></label>
                                                <select required name="withdrawal_method" class="form-control">
                                                    @php
                                                        $methods = DB::table('withdrawal_methods')->where('status',1)->get(['method_id','method']);
                                                        $total_method = count( $methods );
                                                    @endphp
                                                        <option value="">-- Select Method --</option>
                                                    @foreach ($methods as $method)
                                                        <option value="{{$method->method_id}}">{{$method->method}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @error('withdrawal_method')
                                                <span class="my-2 text-danger"> {{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-12">
                                            <div>
                                                <label for="withdrawal_amount" class="form-label">Withdrawal Amount <span class="text-danger">*</span></label>
                                                <input class="form-control" min="10" value="{{ old('withdrawal_amount') ? old('withdrawal_amount') : 0 }}"  type="number" placeholder="Withdrawal Amount"  name='withdrawal_amount' id='withdrawal_amount' required>
                                                <p class="text-capitalize">Withdrawable Amount: ${{ $balance - $freeze_deposit }} </p>
                                            </div>
                                            @error('withdrawal_amount')
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
                                    <button type="submit" class="trk-btn trk-btn--border trk-btn--primary d-block mt-4">Withdraw</button>
                                </form>
                            @endif
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
    </script>
@endsection
