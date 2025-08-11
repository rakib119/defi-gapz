@extends('layouts.fontend')
@section('main-content')
    <section class="pricing padding-top padding-bottom" id="transictionHall">
        <div class="section-header section-header--max50">
            <h6 class="mb-10 mt-minus-5">Return On <span>Investment</span></h6>
            {{-- <p>We offer the best pricings around - from installations to repairs, maintenance, and more!</p> --}}
        </div>
        <div class="container">
            <div class="pricing__wrapper">
                <div class="pricing__item aos-init aos-animate" data-aos="fade-up" data-aos-duration="1000">
                    <div class="pricing__item-inner active" style="background: var(--tertiary-color3);">
                        <div class="pricing__item-content">
                        <div class="pricing__item-middle">
                            <div class="d-flex ">
                                <div class="card-body">
                                    <p class="card-title">Total Income</p>
                                    @php
                                        $total_investment  = $account_statement->total_investment;
                                        $investment_profit = $account_statement->investment_profit;
                                        $profit_per        = $investment_profit > 0 ? ($investment_profit / $total_investment) * 100 : 0;
                                    @endphp
                                    <p class="card-text  text_color-secondary">{{ $investment_profit>0?"+":"" }}${{ number_format($investment_profit, 2) }}</p>
                                </div>
                                <div class="card-body">
                                    <p class="card-title">Locked Amount(ROI)</p>
                                    <p class="card-text  text_color-secondary"> ${{ number_format($freez_amount, 2) }}</p>
                                </div>
                            </div>
                            <div class="d-flex" style="margin-top:20px;">
                                <div class="card-body">
                                    <p class="card-title"><i class="fa fa-exchange  text_color-secondary"></i>&nbsp;&nbsp;Available Balance</p>
                                    <p class="card-text  text_color-secondary" > ${{ number_format($account_statement->balance, 2) }}</p>
                                </div>
                                <div class="card-body">
                                    <p class="card-title"><i class="fa fa-wallet  text_color-secondary"></i>&nbsp;&nbsp;Deposited Amount</p>
                                    <p class="card-text  text_color-secondary">${{ number_format($account_statement->total_deposite, 2) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="pricing__shape">
            <span class="pricing__shape-item pricing__shape-item--1"> <span></span> </span>
            <span class="pricing__shape-item pricing__shape-item--2"> <img src="{{ asset("assets/images/icon/1.png") }}" alt="shape-icon"></span>
        </div>
    </section>

    <section class="blog padding-top padding-bottom">
        <div class="container">
            <div class="section-header d-md-flex align-items-center justify-content-between">
                <div class="section-header section-header--max50">
                    <h6 class="mb-10 mt-minus-5">List Of <span>Agreement</span></h6>
                </div>
            </div>
            <div class="blog__wrapper" data-aos="fade-up" data-aos-duration="1000">
                <div class="tm-countdown-wrap tm-style1 text-center bg-tm-dark">
                    <div class="row ">
                        <div class="col-12">
                            <div class="tm-comparison-table text-center">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="width:35%">Time</th>
                                            <th style="width:35%">Income</th>
                                            <th style="width:30%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($fixed_deposits as $data)
                                            <tr>
                                                <td> {{ $data->days }} {{ $data->days > 1 ? ' Days' : ' Day' }}</td>
                                                <td>{{ $data->profit . '%' }} </td>
                                                <td> <a href="{{ route('immediate_purchase', Crypt::encrypt( $data->id ) ) }}" class="trk-btn trk-btn--border trk-btn--primary">Immediate Purchase</a></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
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

    <section class="roadmap padding-top padding-bottom bg-color" id="roadmap">
        <div class="container">
            <div class="section-header section-header--max50">
                <h6 class="mb-10 mt-minus-5">ROI <span>Records</span></h6>
                <p>Your latest ROI investment records</p>
            </div>
            <div class="row">
                <div class="col-sm-12 col-lg-12">
                    <div class="service__item service__item--style1 aos-init aos-animate" data-aos="fade-left" data-aos-duration="800">
                        <div class="tm-comparison-table text-center">
                            <div class="table-responsive">
                                <table class="table" id=" small-table">
                                    <thead>
                                        <tr>
                                            <th width="3%" >#SL</th>
                                            <th width="10%">Investment Period</th>
                                            <th width="22%">Transaction ID</th>
                                            <th width="20%">Transaction Amount</th>
                                            <th width="25%">Profit</th>
                                            <th width="20%">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($deposit_histories as $history)
                                            @php
                                            $invest_for = $history->no_of_days;
                                            $status = $history->status;
                                            if ( $status == 0) {
                                                $created_at = carbon_parse($history->created_at);
                                                $execution_time = $created_at->addDays($invest_for);
                                               /*  $now = carbon_parse(now());

                                                $diff = $execution_time->diff($now);
                                                $status = $diff; */
                                                $date1 = new DateTime(now());
                                                $date2 = new DateTime($execution_time);
                                                $diff = $date1->diff($date2);
                                                $diffInSeconds = $diff->s ;
                                                $diffInMinutes = ($diff->i )?$diff->i.": ":"";
                                                $diffInHours   = ($diff->h )?$diff->h.": ":"";
                                                $diffInDays    = ($diff->d > 0)?$diff->d.": ":"";
                                                $msg = $diffInDays. $diffInHours .$diffInMinutes.$diffInSeconds;
                                                $status_txt = trim( $msg,':')  .' Remaining' ;
                                            }else{
                                                $status_txt = 'Completed' ;
                                            }

                                            @endphp
                                            <tr>
                                                <td><p>{{ $loop->iteration }}</p> </td>
                                                <td><p>{{ $invest_for }} {{ $invest_for > 1 ? ' Days' : ' Day' }}</p> </td>
                                                <td><p>{{ $history->transaction_id }}</p> </td>
                                                <td><p>${{ $history->investment_amount }}</p> </td>
                                                <td><p>+${{ $history->total_profit }}</p></td>
                                                <td><p class="{{$status ? 'text-success' : ''}}"> {{$status_txt}} </p></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
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
@endsection
