@extends('layouts.fontend')
@section('main-content')
    <section class="team padding-top padding-bottom bg-color">
        <div class="container">
            <div class="team__wrapper">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h4 class="mb-15">Availabe Balance</h4>
                        <h6 class="text_color-secondary">${{ $account_statement->balance }}</h6>
                        <hr>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-4 mb-5 text-center">
                        <a class="trk-btn trk-btn--outline" href="{{ route('deposit_view') }}"> Deposit </a>
                    </div>
                    <div class="col-md-4 mb-5 text-center">
                        <a class="trk-btn trk-btn--outline active" href="{{ route('withdraw_money') }}">Withdraw</a>
                    </div>
                    <div class="col-md-4 mb-5 text-center">
                        <a class="trk-btn trk-btn--outline" href="{{ route('transfer_money_form') }}"> Transfer </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="pricing padding-top padding-bottom bg--cover" style="background-image:url({{ asset("assets/images/pricing/bg.png") }})" id="howitworks">
        <div class="section-header section-header--max50">
        <h6 class="mb-10 mt-minus-5">My <span>accounts</span></h6>
        </div>
        <div class="container pb-5">
            <div class="row text-center">
                <div class="col-sm-6 col-lg-3 col-md-3 mb-2 my-account-item">
                    <a href="{{ route('persoal_information') }}">
                        <div class="my-account-icon"><i class="fas fa-address-card"></i></div>
                        <p>Personal Information</p>
                    </a>
                </div>
                <div class="col-sm-6 col-lg-3 col-md-3  mb-2 my-account-item">
                    <a href="{{ route('deposit_records') }}">
                        <div class="my-account-icon"><i class="fa-solid fa-wallet"></i></div>
                        <p>Deposit Records</p>
                    </a>
                </div>
                <div class="col-sm-6 col-lg-3 col-md-3  mb-2 my-account-item">
                    <a href="{{ route('withdrawal_records') }}">
                        <div class="my-account-icon"><i class="fa-solid fa-money-bill-transfer"></i></div>
                        <p>Withdrawal Records</p>
                    </a>
                </div>
                <div class="col-sm-6 col-lg-3 col-md-3  mb-2 my-account-item">
                    <a href="{{ route('merchant_list') }}">
                        <div class="my-account-icon"><i class="fa-solid fa-file-invoice-dollar"></i></div>
                        <p>CEO</p>
                    </a>
                </div>
                <div class="col-sm-6 col-lg-3 col-md-3  mb-2 my-account-item">
                    <a href="{{ route('identify_authenticate') }}">
                        <div class="my-account-icon"><i class="fa-solid fa-user-check"></i></div>
                        <p>Identity Authentication</p>
                    </a>
                </div>
                <div class="col-sm-6 col-lg-3 col-md-3  mb-2 my-account-item">
                    <a href="{{ route('my_team') }}">
                        <div class="my-account-icon"><i class="fa-solid fa-users"></i></div>
                        <p>My Team</p>
                    </a>
                </div>
                <div class="col-sm-6 col-lg-3 col-md-3  mb-2 my-account-item">
                    <a href="{{ route('team_income') }}">
                        <div class="my-account-icon"><i class="fa-solid fa-money-check-dollar"></i></div>
                        <p>Team Income</p>
                    </a>
                </div>
                <div class="col-sm-6 col-lg-3 col-md-3  mb-2 my-account-item">
                    <a href="javascript:void(0)" id="shareBtn">
                        <div class="my-account-icon"><i class="fa-solid fa-user-group"></i></div>
                        <p>Invite Your Friends</p>
                    </a>
                </div>
            </div>
        </div>
        <div class="pricing__shape">
            <span class="pricing__shape-item pricing__shape-item--5"> <img src="{{ asset("assets/images/icon/shape/3.png") }}" alt="shape-icon"></span>
            <span class="pricing__shape-item pricing__shape-item--6"> <img src="{{ asset("assets/images/icon/shape/1.png") }}" alt="shape-icon"></span>
        </div>
    </section>

@endsection

