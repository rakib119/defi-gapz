@extends('layouts.fontend')
@php
$profit = $fixed_deposit->profit;
$days = $fixed_deposit->days;
$inv_amount = session()->get('investment_amount');
@endphp
@section('main-content')

    <section class="account padding-top padding-bottom sec-bg-color2">
        <div class="container">
            <div class="account__wrapper" data-aos="fade-up" data-aos-duration="800">
                <div class="row g-4">
                    <div class="col-lg-12">
                        <div class="account__content account__content--style1">
                            <!-- account tittle -->
                            <div class="account__header">
                                <h6 class="">
                                    {!! $inv_amount ? "Confirm <span class='text_color-secondary'>Investment</span>" : __("Drive Higher ROI: <span class='text_color-secondary'>Fast Results & Sustainable Growth</span>") !!}
                                </h6>
                                <div class="d-flex justify-content-between">
                                    <h6>{{ $days }} {{ $days > 1 ? 'Days' : 'Day' }} Return On Investment</h4>
                                </div>
                            </div>

                            @if (session()->get('investment_success'))
                                <div class="alert alert-success" role="alert">{{ session()->get('investment_success') }} </div>
                            @endif

                            <!-- account form -->
                            @if ($inv_amount)
                                <form action="{{ route('investment_money', $fixed_deposit->id) }}" method="POST">
                                    @csrf
                                    <div class="row g-4 ">
                                        <div class="col-12">
                                            @error('investment_amount')
                                                <h3 class="my-2 text-danger"> {{ $message }}</h3>
                                            @enderror
                                        </div>
                                        <div class="col-12">
                                            <div class="mb-3  d-flex">
                                                <input type="text" class="form-control" value="Investment Amount: ${{ $inv_amount }}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="mb-3  d-flex">
                                                <input type="text" class="form-control" value="Total Profit: ${{ session()->get('total_profit') }}" >
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="mb-3  d-flex">
                                                <input type="hidden" class="form-control"  id="otp"
                                                    name='otp' value="{{session()->get('otp')}}">
                                            </div>
                                            @error('otp')
                                                <span class="my-2 text-danger"> {{ $message }}</span>
                                            @enderror
                                            @if ($otp_error = session()->get('otp_error'))
                                                <span class="my-2 text-danger"> {{ $otp_error }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 mt-3">
                                            <button class="trk-btn trk-btn--border trk-btn--primary d-block mt-4" type="submit">{{ __('confirm') }}</button>
                                        </div>
                                    </div>
                                </form>
                            @else
                                <form action="{{ route('investment_otp', $fixed_deposit->id) }}" method="POST">
                                    @csrf
                                    <div class="row g-4">
                                        <div class="col-12">
                                            <label for="account-email" class="form-label">Investment Amount <span class='text_color-secondary'>Profit: $<span id="total_profit_amount">0</span></span></label>
                                            <div>
                                                <input class="form-control" id="investmentAmount" min="10"
                                                    value="{{ old('investment_amount') ? old('investment_amount') : 0 }}"  type="number" placeholder="Investment Amount" name='investment_amount' required>
                                                <p class="text-capitalize">available balance: ${{ $balance }}</p>
                                            </div>
                                            @error('investment_amount')
                                                <span class="mb-2 text-danger"> {{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-12">
                                            <div class="form-pass">
                                                <label for="inputPassword" class="form-label">Secure Transaction</label>
                                                <input type="password" name="transaction_password" class="form-control showhide-pass" id="transactionPassword" placeholder="Secure Transaction Password" required>

                                                <button type="button" id="togglePassword" class="form-pass__toggle"><i  id="eyeIcon" class="fa fa-eye"></i></button>
                                            </div>
                                            @error('transactionPassword')
                                                <span class="mb-2 text-danger"> {{ $message }}</span>
                                            @enderror
                                            @if ($err = session()->get('transaction_password'))
                                                <span class="mb-2 text-danger"> {{ $err }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 mt-3">
                                            <button class="trk-btn trk-btn--border trk-btn--primary d-block mt-4" type="submit">{{ __('Submit') }}</button>
                                        </div>
                                    </div>
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
    <script>
        $('#investmentAmount').keydown(function() {
            var investment_amount = $('#investmentAmount').val();
            var profit_ratio = {{ $profit }};
            if (profit_ratio > 0) {
                total_profit = investment_amount * (profit_ratio / 100);
            } else {
                total_profit = 0;
            }
            $('#total_profit_amount').html(total_profit.toFixed(2));
        });
    </script>
@endsection
