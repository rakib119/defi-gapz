@extends('layouts.fontend')
@section('main-content')
    @if ($previous_deposit)
        <section class="tm-about-wrap" id="mine">
            <div class="empty-space col-md-b90 col-xs-b55"></div>
            <div class="container mt-5">
                <div class="tm-countdown-wrap tm-style1 bg-secondary text-center">
                    <div class="tm-countdown-box">
                        <div class="row mt-5">
                            <div class="col-md-6 col-lg-6 col-sm-12">
                                <div class="card-body">
                                    <div class="mt-2">
                                        <div style="">
                                            <img class="qr-img" width="100%" src="{{ asset('assets/qr.jpeg') }}">
                                        </div>
                                        <div class="mt-4" id="copyto">
                                            <a style="width: 100px" href="javascript:void(0)" class="btn-copy"
                                                id="clipboard" data-toggle="tooltip" title="Copy to clipboard"
                                                onclick="copy_Share_Button()">
                                                Copy TRC20 Address
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
                                    {{-- <h4 class="card-title text-left">Note: you are requested to transfer (deposited amount + charge) by scanning QR code or copying the address Tether (TRC20) </h4> --}}
                                    <div class="mt-3 text-left">
                                        <h5 class="text-white"> Payment instructions </h5>
                                                <p>Transfer {{$previous_deposit->subtotal}} by scanning the QR code or copying (Tether)TRC20 wallet address.</p>
                                        <div class="row align-items-center">
                                            <div class="col-10">
                                                <div style="margin:15px 0 15px ">
                                                    <table border="0">
                                                        <tr>
                                                            <td  width='50%'>Deposit amount</td>
                                                            <td width='50%'>: ${{ $previous_deposit->transaction_amount}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Charge</td>
                                                            <td>:{{ $service_charge }}%</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Total Payable</td>
                                                            <td>: ${{$previous_deposit->subtotal}}</td>
                                                        </tr>
                                                    </table>
                                                </div>

                                            </div>
                                            <div class="col-2">
                                                <i class="fas fa-spinner fa-pulse" style="font-size: 40px;"></i>
                                            </div>
                                        </div>
                                        <p> Your deposit request will be declined automatically if you fail to pay within 30 min after making deposit request.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            <div class="empty-space col-md-b85 col-xs-b55"></div>
        </section>
    @else  {{-- FORM --}}
        <section class=" tm-about-wrap">
            <div class="empty-space col-md-b90 col-xs-b55"></div>
            <div class="container mt-5">
                <div class="row text-center">
                    <div class="col-lg-12">
                        <h2 class="title-head"><span>Deposit</span> Now</h2>
                    </div>
                </div>
                <div class="tm-countdown-wrap  tm-modal tm-color1">
                    @error('email')
                        <h5 class="my-2 text-danger"> {{ $message }}</h5>
                    @enderror
                    <form action="{{ route('make_deposit_request') }}" method="POST">
                        @csrf
                        <div class="row mt-3">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label>Deposit Method <span class="text-danger">*</span></label>
                                    <select name="method" class="form-control" disabled>
                                        <option value=""> Tether (TRC20)</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <div class="mb-3">
                                        <label>Deposit Amount <span class="text-danger">*</span></label>
                                        <input name="transaction_amount" id="transactionAmount" @if ($service_charge) onkeyUp="getPayableAmount()" @endif
                                            value="{{ old('transaction_amount') }}" class="form-control"
                                            type="text" placeholder="Amount of Deposit" required>
                                        @if ($service_charge)
                                            <span style="font-size:12px;color:var(--s-font-color);"> Charge: {{$service_charge}}%</span>
                                        @endif
                                    </div>
                                    @error('transaction_amount')
                                        <h5 class="my-2 text-danger"> {{ $message }}</h5>
                                    @enderror
                                </div>
                                @if ($service_charge)
                                    <div class="mb-3">
                                        <div class="mb-3 d-none" id="payableAmountBlock">
                                            <label>Payable Amount</label>
                                            <input name="transaction_amount" id="payableAmount"
                                                value="{{ old('transaction_amount') }}" class="form-control"
                                                type="text" disabled>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <button class="tm-btn tm-style1 w-100" type="submit">Confirm</button>
                            </div>
                        </div>
                    </form>
                    <div class="empty-space col-md-b55 col-xs-b55"></div>
                </div>
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
            var walletAddress = "TRWw2cD2v2mvxheskSLCpHenaKsn8RWKZW";
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
