@extends('layouts.fontend')
@section('main-content')
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
                <form action="{{ route('payment.create') }}" method="POST">
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
                            <a href="https://nowpayments.io/payment/?iid=6269064812&source=button" target="_blank" rel="noreferrer noopener">
                                <img src="https://nowpayments.io/images/embeds/payment-button-black.svg" alt="Crypto payment button by NOWPayments">
                            </a>
                        </div>
                    </div>
                </form>
                <div class="empty-space col-md-b55 col-xs-b55"></div>
            </div>
        </div>
    </section>
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
