@extends('layouts.fontend')
@section('main-content')

    @if ($previous_deposit)
        <section class="roadmap padding-top padding-bottom bg-color" id="roadmap">
            <div class="container">
                <div class="section-header-2 d-md-flex align-items-center justify-content-between">
                    <div class="section-header section-header--max50">
                        <h6 class="mb-10 mt-minus-5"><span>Deposit</span> Now</h6>
                    </div>
                </div>
                <div class="row aos-init aos-animate" data-aos="fade-left" data-aos-duration="800">
                    <div class="col-md-6 col-lg-6 col-sm-12">
                        <div class="card-body">
                            <div class="mt-2 text-center text-md-start" >
                                <div style="">
                                    <img class="qr-img" width="100%" src="{{ asset('assets/qr.jpeg') }}">
                                </div>
                                <div class="mt-4" id="copyto">
                                    <a style="width: 100px" href="javascript:void(0)" class="btn-copy"
                                        id="clipboard" data-toggle="tooltip" title="Copy to clipboard"
                                        onclick="copy_Share_Button()">
                                        <i class="fa-solid fa-copy"></i> Copy TRC20 Address
                                    </a>
                                </div>
                                <div class="mt-4" id="copied" style="display:none">
                                    <a href="javascript:void(0)" id="clipboard2" class="btn-copy"
                                        data-toggle="tooltip" title="Coppied" onclick="copy_Share_Button()">Copy TRC20 Address
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-sm-12">
                        <div class="card-body">
                            <div class="mt-3 text-left">
                                <h6 class="text_color-secondary text-center"> Payment instructions </h6>
                                <p class="mb-15">Transfer <span class="text_color-secondary"> {{$previous_deposit->subtotal}}</span> by scanning the QR code or copying <span class="text_color-secondary">(Tether)TRC20</span> wallet address.</p>

                                <div class="row align-items-center">
                                    <div class="col-12 text-center">
                                        <i class="fas fa-spinner fa-pulse text_color-secondary" style="font-size: 40px;"></i>
                                    </div>
                                    <div class="col-12">
                                        <div style="margin:15px 0 15px ">
                                            <div class="tm-comparison-table text-center">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered">
                                                        <tbody>
                                                            <tr>
                                                                <td align="left"  width='50%'>Deposit amount</td>
                                                                <td align="left" width='50%'>${{ $previous_deposit->transaction_amount}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td align="left">Charge</td>
                                                                <td align="left">{{ $service_charge }}%</td>
                                                            </tr>
                                                            <tr>
                                                                <td align="left">Total Payable</td>
                                                                <td align="left">${{$previous_deposit->subtotal}}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <p class="mb-15"> Your deposit request will be declined automatically if you fail to pay within 30 min after making deposit request.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="roadmap__shape">
                <span class="roadmap__shape-item roadmap__shape-item--1"> <span></span> </span>
                <span class="roadmap__shape-item roadmap__shape-item--2"> <img src="{{ asset("assets/images/icon/1.png") }}" alt="shape-icon">
            </span>
            </div>
        </section>
    @else  {{-- FORM --}}
        <section class="account padding-top padding-bottom sec-bg-color2">
            <div class="container">
                <div class="section-header-2 d-md-flex align-items-center justify-content-between">
                    <div class="section-header section-header--max50">
                        <h6 class="mb-10 mt-minus-5"><span>Deposit</span> Now</h6>
                    </div>
                </div>
                <div class="account__wrapper" data-aos="fade-up" data-aos-duration="800">
                    <div class="row g-4">
                        <div class="col-lg-12">
                            <div class="account__content account__content--style1">
                                <!-- account tittle -->
                                {{-- <div class="account__header">
                                    <h6><span>Deposit</span> Now</h6>
                                    <p>If you had any text......</p>
                                </div> --}}
                                <!-- account form -->
                                <form action="{{ route('make_deposit_request') }}" method="POST">
                                    @csrf
                                    <div class="row g-4">
                                        <div class="col-12">
                                            <div>
                                                <label>Deposit Method <span class="text-danger">*</span></label>
                                                <select name="method" class="form-control">
                                                    <option value=""> Tether (TRC20)</option>
                                                </select>
                                            </div>
                                            @error('email')
                                                <span class="my-2 text-danger"> {{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-12">
                                            <div>
                                                <label>Deposit Amount <span class="text-danger">*</span></label>
                                                <input name="transaction_amount" id="transactionAmount" @if ($service_charge) onkeyUp="getPayableAmount()" @endif
                                                    value="{{ old('transaction_amount') }}" class="form-control"
                                                    type="text" placeholder="Amount of Deposit" required>
                                                @if ($service_charge)
                                                    <span style="font-size:12px;color:var(--brand-color);"> Charge: {{$service_charge}}%</span>
                                                @endif
                                            </div>
                                            @error('transaction_amount')
                                                <span class="text-danger"> {{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-12">
                                            @if ($service_charge)
                                                <div>
                                                    <div class="d-none" id="payableAmountBlock">
                                                        <label>Payable Amount</label>
                                                        <input name="transaction_amount" id="payableAmount"
                                                            value="{{ old('transaction_amount') }}" class="form-control"
                                                            type="text" readonly>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>

                                    </div>


                                    <button type="submit" class="trk-btn trk-btn--border trk-btn--primary d-block mt-4">Confirm</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="account__shape">
            <span class="account__shape-item account__shape-item--1"><img src="{{ asset("assets/images/contact/4.png")}}"
                alt="shape-icon"></span>
            </div>
        </section>
    @endif
@endsection
@section('javaScript')
    <script>
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        })
        function copy_Share_Button() {
            var walletAddress = "TArER5bTuJrQtiBCfpRnXTCHtu9bnvU9Kv";
            sTemp = "<input id=\"copy_to_Clipboard\" value=\"" + walletAddress + "\" />"
            $("body").append(sTemp);
            $("#copy_to_Clipboard").select();
            document.execCommand("copy");
            // alert
            document.getElementById('copied').style.display = "block";
            document.getElementById('copyto').style.display = "none";
            $("#copy_to_Clipboard").remove();
        }
        function getPayableAmount(){
            let transactionAmount = parseInt( $('#transactionAmount').val() );
            let fees =  {{$service_charge}} ;
            if(!isNaN(transactionAmount) && transactionAmount > 0){
                if(fees){
                    let charge =  transactionAmount *(fees/100);
                    let total =  transactionAmount + charge ;
                    $('#payableAmount').val(total.toFixed(2));
                    $('#payableAmountBlock').removeClass('d-none');
                }
            }else{
                $('#payableAmountBlock').addClass('d-none');
            }
        }
    </script>
@endsection
