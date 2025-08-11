<section class="account padding-top padding-bottom sec-bg-color2">
    <div class="container">
        <div class="account__wrapper" data-aos="fade-up" data-aos-duration="800">
            <div class="row g-4">
                <div class="col-lg-12">
                    <div class="account__content account__content--style1">
                        <!-- account tittle -->
                        <div class="account__header">
                            <h6>Secret Questions</h6>
                            <p>To ensure the security of your account, we’ve enabled <strong class="text_color-secondary">'two secret questions'</strong> that will be used to verify your identity for sensitive account changes. Please remember your answers or note it down , as they will be required for important actions like password resets or account recovery. </p>
                            <ul>
                                <li>* Keep your answers <strong class="text_color-secondary">memorable but secure</strong> (avoid easily guessable information).</li>
                                <li>* <strong class="text_color-secondary">Don’t share</strong> them with anyone.  </li>
                            </ul>
                            <p style="margin-top: 7px;">Thank you for helping us keep your account safe!</p>
                        </div>

                        <form action="{{ route('set_ans.create')}}" method="POST" class="account__form needs-validation" novalidate>
                            @csrf
                            <div class="row g-4">
                                @foreach (get_questions() as $qsn)
                                    <div class="col-12">
                                        <div>
                                            <label class="form-label">{{$qsn->question}}</label>
                                            <input type="text" placeholder="{{$qsn->question}}" name="qsn**{{$qsn->id}}" class="form-control">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <button type="submit" class="trk-btn trk-btn--border trk-btn--primary d-block mt-4">{{ __('Save') }}</button>
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

