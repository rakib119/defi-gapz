@php
    $had_trans_pass = auth()->user()->transaction_password;
@endphp
<section class="account padding-top padding-bottom sec-bg-color2">
    <div class="container">
        <div class="account__wrapper" data-aos="fade-up" data-aos-duration="800">
            <div class="row g-4">
                <div class="col-lg-12">
                    <div class="account__content account__content--style1">
                        <div class="account__header">
                            <h6>Transaction Password</h6>
                        </div>

                        <form action="{{ route('change_transaction_password') }}" method="POST" class="account__form needs-validation" novalidate>
                            @csrf
                            <div class="row g-4">
                                <div class="col-12">
                                    <div>
                                        <label class="form-label">Transaction Password <span class="text-danger">*</span></label>
                                        <input type="text" placeholder="Transaction password" name="transaction_password" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="trk-btn trk-btn--border trk-btn--primary d-block mt-4">{{ $had_trans_pass ? 'Update' : 'Save' }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="account__shape">
        <span class="account__shape-item account__shape-item--1"><img src="{{ asset("assets/images/contact/4.png")}}" alt="shape-icon"></span>
    </div>
</section>

