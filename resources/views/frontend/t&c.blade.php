@extends('layouts.fontend')
@section('main-content')
    <section class="roadmap padding-top padding-bottom bg-color" id="roadmap">
        <div class="container">
            <div class="section-header text-center">
                <h6 class="mb-10 mt-minus-5">Terms  <span> And Conditions</span></h6>
            </div>
            <div class="row">
                <div class="col-sm-12 col-lg-12">
                    <div class="service__item service__item--style1 aos-init aos-animate" data-aos="fade-left" data-aos-duration="800">
                        <div class="row">
                            <div class="col-lg-12 text-justify">
                                <h5> Welcome to One Top Trade (OTT), the Crypto Currency Trading Platform. These Terms and Conditions ("Terms") govern your use of the OTT platform, so please read them carefully. </h5>

                                <h6> 1. Acceptance of Terms  </h6>
                                <p> By accessing or using the OTT platform, you agree to be bound by these Terms. If you do not agree to these Terms, do not use the platform. </p>

                                <h6> 2. Eligibility </h6>
                                <p> To use the OTT platform, you must be at least 18 years old and have the legal capacity to enter into a binding agreement. By using the platform, you represent and warrant that you meet these eligibility requirements. </p>

                                <h6> 3. Registration </h6>
                                <p> To use the OTT platform, you must register for an account. You agree to provide accurate and complete information during the registration process and to keep your account information up to date. You are responsible for maintaining the confidentiality of your account login credentials and for any activity that occurs under your account. </p>

                                <h6> 4. Trading </h6>
                                <p> The OTT platform enables you to buy and sell crypto currencies. You are solely responsible for any trades you make on the platform. OTT does not provide investment advice and is not liable for any losses you may incur as a result of your trading activity. </p>

                                <h6> 5. Fees </h6>
                                <p> OTT charges fees for certain transactions on the platform. By using the platform, you agree to pay the applicable fees. OTT reserves the right to change the fee schedule at any time. </p>

                                <h6> 6. Compliance </h6>
                                <p> You agree to comply with all applicable laws and regulations related to your use of the OTT platform. You are solely responsible for any taxes that may be due as a result of your trading activity on the platform. </p>

                                <h6> 7. Suspension or Termination </h6>
                                <p> OTT may suspend or terminate your access to the platform at any time for any reason. OTT is not liable for any losses you may incur as a result of your access to the platform being suspended or terminated. </p>

                                <h6> 8. Intellectual Property </h6>
                                <p> The OTT platform and all content and materials contained on the platform are the property of OTT and its licensors and are protected by copyright, trademark, and other intellectual property laws. You may not use or reproduce any content or materials from the platform without OTT's prior written consent. </p>

                                <h6> 9. Disclaimer of Warranties </h6>
                                <p> The OTT platform is provided "as is" without any warranties of any kind, whether express or implied. OTT does not warrant that the platform will meet your requirements or that the platform will be error-free or uninterrupted. </p>

                                <h6> 10. Limitation of Liability </h6>
                                <p> In no event will OTT be liable for any indirect, special, incidental, or consequential damages arising out of or in connection with your use of the platform, even if OTT has been advised of the possibility of such damages. </p>

                                <h6> 11. Governing Law and Dispute Resolution </h6>
                                <p> These Terms are governed by the laws of the jurisdiction in which OTT is located. Any disputes arising out of or related to these Terms or your use of the platform will be resolved through binding arbitration in accordance with the rules of the American Arbitration Association. </p>

                                <h6> 12. Changes to Terms </h6>
                                <p> OTT reserves the right to update these Terms at any time. OTT will notify you of any material changes to the Terms by email or through the platform. Your continued use of the platform following any changes to the Terms constitutes your acceptance of the updated Terms. </p>

                                <p> If you have any questions about these Terms, please contact us at <span style="color:var(--s-font-color)">{{env('SUPPORT_EMAIL')}}</span> </p>

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
