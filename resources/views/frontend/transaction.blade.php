@php
    $wallet_balance = $account_statement->balance;
    $inTransaction = $in_the_transaction->sum('subtotal');
    $roi = DB::table('earn_from_investments') ->where(['uid'=>auth()->user()->uid,'status' => 0])->sum('investment_amount');
    $total_assets = $inTransaction + $account_statement->balance + $roi ;
@endphp

@extends('layouts.fontend')

@section('main-content')
    <section class="pricing padding-top padding-bottom-2" id="transictionHall">
        <div class="section-header section-header--max50">
            <h6 class="mb-10 mt-minus-5"><span>AI Arbitrage </span>Machine</h6>
        </div>
        <div class="container">
            <div class="pricing__wrapper">
                <div class="pricing__item aos-init aos-animate" data-aos="fade-up" data-aos-duration="1000">
                    <div class="pricing__item-inner" style="background: var(--tertiary-color3);">
                    <div class="row">
                        <div class="col-4">
                            <p class="mb-15 text-light"><i class="fa fa-dollar mr-2 icon-svg"></i> Total Assets in USDT</p>
                        </div>
                        <div class="col-4">
                            <p class="mb-15 text-light"> <span> <i class="fa fa-exchange mr-2 icon-svg"></i></span> In Order({{ $in_the_transaction->count() }})</p>
                        </div>
                        <div class="col-4">
                            <p class="mb-15 text-light"><i class="fa fa-wallet mr-2 icon-svg"></i>Current Wallet</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <p class="mb-25 text_color-secondary">${{ number_format($total_assets, 2) }} </p>
                        </div>
                        <div class="col-4">
                            <p class="mb-25 text_color-secondary"> ${{ number_format($in_the_transaction->sum('subtotal'), 2) }}</p>
                        </div>
                        <div class="col-4">
                            <p class="mb-25 text_color-secondary">${{ number_format($wallet_balance, 2) }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="team padding-top-2 padding-bottom-2 bg-color">
        <div class="section-header section-header--max65">
            <h6 class="mt-minus-5">Intelligent <span>competition</span>  for orders</h6>
        </div>
        <div class="container">
            <div class="team__wrapper">
                <div class="row g-4 align-items-center">
                    <div class="col-sm-12 col-lg-12">
                        <div class="team__item team__item--shape" data-aos="fade-up" data-aos-duration="900">
                            <div class="team__item-inner team__item-inner--shape comment__body-inner"  style="background: var(--tertiary-color3);padding-top:30px;">
                                <div class="row">
                                    <div class="col-12 d-flex">
                                        <div class="card-body">
                                            <p class="mb-15 text-light"><i class="fa fa-check icon-svg mr-2"></i>Successfull Transaction</p>
                                            <p class="card-text text_color-secondary">{{ $account_transaction->count() }}</p>
                                        </div>
                                        <div class="card-body">
                                            <p class="mb-15 text-light"><i class="fa fa-exchange icon-svg mr-2"></i>Income From Transaction</p>
                                            <p class="card-text text_color-secondary">${{ number_format($account_transaction->sum('profit'), 2) }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 d-flex">
                                        <div class="card-body">
                                            <p class="mb-15 text-light"><i class="fa fa fa-cny icon-svg mr-2"></i>Transaction Amount</p>
                                            <p class="card-text text_color-secondary">${{ number_format($account_transaction->sum('subtotal'), 2) }}
                                            </p>
                                        </div>
                                        <div class="card-body account__switch">
                                            <p class="mb-15" style="text-align: left !important">
                                                <a href="{{ route('competition_statistics') }} ">Income Statistics <i class="fa-solid fa-chart-line icon-svg"></i></a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="order-button pricing__item-bottom" style="margin:25px 0;">
                                    <button id="compititionForOrder" class="trk-btn trk-btn-trade  trk-btn--primary" style="width: 100%; font-size:25px;">Trade Now</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="blog padding-top-2 padding-bottom-2">
        <div class="container">
            <div class="section-header d-md-flex align-items-center justify-content-between">
                <div class="section-header section-header--max50">
                    <h6 class="mb-10 mt-minus-5">Records of <span>Latest</span>  orders</h6>
                </div>
            </div>
            <div class="blog__wrapper" data-aos="fade-up" data-aos-duration="1000">
                <div class="tm-countdown-wrap tm-style1 text-center bg-tm-dark">
                    <div class="row ">
                        <div class="col-12">
                            <div class="tm-comparison-table text-center">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr style='background:'>
                                                <th style='width:30%'>Time</th>
                                                <th style='width:35%'>Amount of Transaction</th>
                                                <th style='width:35%'>Profit</th>
                                            </tr>
                                        </thead>
                                    </table>
                                    <div id="contain">
                                        <table class="table table-bordered" id="table_fixed">
                                            <tbody id="table_scroll">
                                                @foreach ($account_transaction as $data)
                                                    <tr>
                                                        <td style='width:30%'> {{ $data->created_at->format('d M Y') }}
                                                        </td>
                                                        <td style='width:35%'>${{ number_format($data->transaction_amount, 2) }}
                                                        </td>
                                                        <td style='width:35%'> ${{ number_format($data->profit, 2) }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="blog__shape">
            <span class="blog__shape-item blog__shape-item--1"> <span></span> </span>
        </div>
    </section>



    <section>
        <div class="container">
            {{-- Searching Loader Popup --}}
            <div class="custom-modal" id="searchingModal">
                <div  class="mt-5 custom-modal-content center" style="background:var(--tertiary-color);">
                    <div class="text-center">
                        <h6 class="">Searching For <span class="text_color-secondary">High Price</span> Orders For You</h6>
                        <p>Don't close the window</p>
                    </div>
                    <div class="my-5 text-center">
                        @include('partOfFrontend.spinner')
                    </div>
                </div>
            </div>

            {{-- immediate Compitition popup --}}
            <div class="custom-modal" id="immediateCompitition" >
                <div class="custom-modal-content mt-5 center" style="min-height: 300px;background:var(--tertiary-color);">
                    <div class="mb-3" style="text-align: left !important;">
                        <span class="badge bg-danger">Order Ends in <span id="countdown">5:00s</span></span>
                    </div>
                    <div class="mb-3" style="text-align: left !important;">
                        <span >Total opportunities found : <span id="opportunities"></span></span>
                    </div>
                    <div class="mb-3" style="text-align: left !important;">
                        <span >Adv No : <span id="advNo"></span></span>
                    </div>
                    <div>
                        <table>
                            <tr>
                                <td class="borderless" style="width: 50%" align="left">Nick Name :</td>
                                <td class="borderless" align="left"><span id="nickName"></span></td>
                            </tr>
                            <tr>
                                <td class="borderless" align="left">Classify :</td>
                                <td class="borderless" align="left"><span id="classify"></span></td>
                            </tr>
                            <tr>
                                <td class="borderless" align="left">Fiat :</td>
                                <td class="borderless" align="left"><span id="fiat"></span></td>
                            </tr>
                            <tr>
                                <td class="borderless" style="width: 50%" align="left">Market Price:</td>
                                <td class="borderless" align="left"><span id="marketPrice"></span></td>
                            </tr>
                            <tr>
                                <td class="borderless" style="width: 50%" align="left">Transaction Price:</td>
                                <td class="borderless" align="left"><span id="transactionAmount"></span></td>
                            </tr>
                            <tr>
                                <td class="borderless" style="width: 50%" align="left">Amount Of Order:</td>
                                <td class="borderless" align="left">$<span id="amountOfOrder"></span></td>
                            </tr>
                        </table>
                    </div>

                    <div class="d-flex modal-footer justify-content-between mt-3">
                        <div>
                            <a id="cancel-btn" class="trk-btn trk-btn--secondary3 mt-25" href="javascript:void(0)"> Cancel</a>
                        </div>
                        <div>
                            <a id="sellBtn" class="trk-btn trk-btn--border trk-btn--primary mt-25" href="javascript:void(0)"> Sell</a>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Congratulations popup --}}
            <div class="custom-modal" id="Congratulations">
                <div class="custom-modal-content mt-5 center">
                    <div class="successIcon" style="color: var(--brand-color);" >
                        <i class="fa-solid fa-circle-check"></i>
                    </div>
                    <div class="row justify-content-between my-2">
                        <div class=" col-md-12 col-sm-12">
                            <h6 class="text-center">Congratulations for</h6>
                            <h6 class=" text-center"> Successful Transaction!</h6>
                        </div>
                    </div>
                    <table >
                        <tr>
                            <td class="borderless" style="width: 50%" align="left">Order No :</td>
                            <td class="borderless" align="center"><span id="orderNo"></span></td>
                        </tr>
                        <tr>
                            <td class="borderless" style="width: 50%" align="left">Transaction Amount :</td>
                            <td class="borderless"align="center">$<span id="orderAmount"></span></td>
                        </tr>
                        <tr>
                            <td class="borderless" style="width: 50%" align="left">Trading Fees :</td>
                            <td class="borderless" align="center">-$<span id="tradingFees"></span></td>
                        </tr>
                        <tr>
                            <td class="borderless" style="width: 50%" align="left">Realized PNL (USDT) :</td>
                            <td class="borderless" align="center">+$<span id="Profit"></span></td>
                        </tr>
                    </table>
                    <div class="text-center mt-4 mt-3">
                        <button id="okRef" class="trk-btn trk-btn--border trk-btn--primary mt-25" style="width: 100%">Ok</button>
                    </div>
                </div>
            </div>
            <div class="error-modal" id="errorSection" >
                <div class="error-modal-content mt-5 center">
                    <div class="errorIcon text-danger">
                        <i class="fa-solid fa-circle-xmark"></i>
                    </div>
                    <div class="row my-3">
                        <div class=" col-md-12 col-sm-12">
                            <p class="text-center mb-15 text-danger"  style="font-size:16px" id="errMsg"></p>
                        </div>
                    </div>
                    <div class="text-center mt-4 mt-3">
                        <button id="ok_hide" class="text-center trk-btn trk-btn-danger text-white mt-25" style="width:100%">Ok</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
@section('javaScript')
    <script>
        $('document').ready(function() {
            var walletBalance = "{{ $wallet_balance }}";
            var batch_no = "{{ $batch_no }}";
            var last_competition_time = "{{ $last_competition_time }}";
            var url = "{{ url()->current() }}";
            var searchingDiv = $('#searchingModal');
            var compititionForOrderBtn = $('#compititionForOrder');
            var immediateCompititionDiv = $('#immediateCompitition');
            var Congratulations = $('#Congratulations');
            var cancelBtn = $('#cancel-btn');
            var sellBtn = $('#sellBtn');
            var errorSection = $('#errorSection');
            var totalCycle = 0;
            searchingDiv.hide();
            immediateCompititionDiv.hide();
            Congratulations.hide();
            errorSection.hide();

            // error section click
            errorSection.click(function() {
                errorSection.hide();
            });

            function randomIntFromInterval(min, max) { // min and max included
                return (Math.random() * (max - min + 1) + min).toFixed(3);
            }
            if (walletBalance > 4.99) {
                // clicked button
                var countdownInterval;

                compititionForOrderBtn.click(function() {
                    if (batch_no == 4 && last_competition_time > 60) {
                        $('#errMsg').html(
                            'your trading session is over for today. Start Trading as per the next schedule'
                        )
                        errorSection.show();
                    } else {
                        // random time
                        $('#countdown').text('5:00s');
                        arr = [9000, 10000, 11000, 12000];
                        time = arr[Math.floor(Math.random() * arr.length)];
                        const animationDuration = time; // Make animation last exactly the random time
                        const labelCount = 3; // You have 4 labels
                        const labelDuration = animationDuration / labelCount; // Time each label is visible

                        // Apply the dynamic animation to each label
                        $('.ai-label').each(function(index) {
                            $(this).css({
                                'animation': `aiLabelFade ${animationDuration}ms infinite`,
                                'animation-delay': `${index * labelDuration}ms`
                            });
                        });

                        searchingDiv.show();
                        compititionForOrderBtn.hide();

                        setTimeout(function() {
                            searchingDiv.hide();
                            immediateCompititionDiv.show();
                            startCountdown();
                        }, time);

                        let countdownDuration = 5 * 60; // 5 minutes in seconds

                        function startCountdown() {
                            clearInterval(countdownInterval); // reset if already running
                            countdownDuration = 5 * 60;

                            countdownInterval = setInterval(function () {
                                let minutes = Math.floor(countdownDuration / 60);
                                let seconds = countdownDuration % 60;
                                $('#countdown').text(`${minutes}:${seconds < 10 ? '0' : ''}${seconds}s`);

                                if (countdownDuration <= 0) {
                                    totalCycle++;

                                    clearInterval(countdownInterval);
                                    immediateCompititionDiv.hide();
                                    if(totalCycle<2)//autom
                                    {
                                        compititionForOrderBtn.trigger("click"); // restart the cycle
                                    }else{
                                        compititionForOrderBtn.show();
                                    }
                                }

                                countdownDuration--;
                            }, 1000);
                        }


                        var task = "getPrice";
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            type: 'POST',
                            url: "{{ route('get_compitition_pricing') }}",
                            data: {
                                task: task
                            },
                            success: function(data)
                            {
                                // console.log(data);
                                if (data.has_error==true) //insufficient fund
                                {
                                    $('#errMsg').html(data.error_msg);
                                    searchingDiv.hide();
                                    immediateCompititionDiv.hide();
                                    Congratulations.hide();
                                    errorSection.show();
                                    clearInterval(countdownInterval);
                                    compititionForOrderBtn.show();
                                    return;
                                }

                                market_price = data.market_price*1;
                                trans_amount = data.transaction_amount*1;
                                order_amount = data.order_amount*1;
                                if (order_amount>0) {
                                    $('#opportunities').html(data.opportunities);
                                    $('#advNo').html(data.adv_no);
                                    $('#classify').html(data.classify);
                                    $('#nickName').html(data.nick_name);
                                    $('#fiat').html(data.fiat);
                                    $('#marketPrice').html(market_price.toFixed(3));
                                    $('#transactionAmount').html(trans_amount.toFixed(
                                        3));
                                    $('#amountOfOrder').html(order_amount.toFixed(3));
                                }
                                else
                                {
                                    $('#errMsg').html('Something went wrong. Please try again later.');
                                    searchingDiv.hide();
                                    immediateCompititionDiv.hide();
                                    Congratulations.hide();
                                    errorSection.show();
                                    clearInterval(countdownInterval);
                                    compititionForOrderBtn.show();
                                    return;
                                }


                            },
                        });
                    }
                });
                // click sell btn
                sellBtn.click(function() {
                    clearInterval(countdownInterval);
                    totalCycle=0;
                    task = "sell";
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: 'POST',
                        url: "{{ route('compitition_sell') }}",
                        data: {
                            task: task
                        },
                        success: function(data) {
                            console.log(data);

                            $('#orderNo').html(data.order_no);
                            $('#orderAmount').html(data.transaction_amount);
                            $('#Profit').html(data.profit);
                            $('#tradingFees').html(data.trading_fees);
                            immediateCompititionDiv.hide();
                            Congratulations.show();
                        },
                    });
                });
                // click cancel btn
                cancelBtn.click(function() {
                    totalCycle=0;
                    clearInterval(countdownInterval);
                    immediateCompititionDiv.hide();
                    compititionForOrderBtn.show();
                    //this count down not stop properly

                });
            } else {
                // clicked button
                compititionForOrderBtn.click(function() {
                    totalCycle=0;
                    $('#errMsg').html(
                        "You don't have sufficient fund to place the new order for trade. Deposit to continue!")
                    errorSection.show();
                });
            }
            $('#okRef').click(function() {
                location.reload();
            });
        });
    </script>
@endsection
