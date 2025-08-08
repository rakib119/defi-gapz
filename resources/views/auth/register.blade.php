@extends('layouts.fontend')
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/intlTelInput.min.css') }}">
@endsection
@section('main-content')
    <!-- ===============>> account start here <<================= -->
    <section class="account padding-top padding-bottom sec-bg-color2">
        <div class="container">
            <div class="account__wrapper" data-aos="fade-up" data-aos-duration="800">
                <div class="row g-4">
                    <div class="col-12">
                        <div class="account__content account__content--style1">
                            <!-- account tittle -->
                            <div class="account__header">
                                <h2>Create Your Account</h2>
                                <p>Hey there! Ready to join the party? We just need a few details from you to get started. Let's do
                                this!</p>
                            </div>
                            <!-- account form -->
                            <form action="{{ route('register') }}" method="POST" class="account__form needs-validation" novalidate>
                                @csrf
                                <div class="row g-4">
                                    <div class="col-12">
                                        <div>
                                            <label for="name" class="form-label">Name <span class="text-danger fs-6">*</span> </label>
                                            <input class="form-control" name="name"  value="{{ old('name') }}" type="text" id="name" placeholder="Ex. Jhon">

                                            @error('name')
                                                <span class="my-2 text-danger"> {{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div>
                                            <label for="account-email" class="form-label">Email <span class="text-danger fs-6">*</span></label>
                                            <input type="email" class="form-control" id="account-email" placeholder="Enter your email" name="email" value="{{ old('email') }}" required>
                                            @error('email')
                                                <span class="my-2 text-danger "> {{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div>
                                            <label for="phone" class="form-label">Mobile <span class="text-danger fs-6">*</span></label>
                                            <input type="text" name="mobile" class="form-control" id="phone" placeholder="Enter your mobile" value="{{ old('mobile') }}" required >

                                            <span class="my-2 text-danger" id="valid-msg"></span>
                                            <span class="my-2 text-danger" id="error-msg"></span>
                                            @error('mobile')
                                                <span class="my-2 text-danger"> {{ $message }}</span>
                                            @enderror
                                            @error('country_code')
                                                <span class="my-2 text-danger"> {{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div>
                                            <label for="reference" class="form-label">Reference <span class="fs-6">(If any)</span></label>
                                            <input type="text" name="reference" class="form-control" id="reference" placeholder="Enter your Reference Id" value="{{ isset($_GET['ref']) ? $_GET['ref'] : '' }}">
                                            @error('reference')
                                                <span class="my-2 text-danger "> {{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-pass">
                                            <label for="newPassword" class="form-label">Password <span class="text-danger fs-6">*</span></label>
                                            <input type="password" name="password" class="form-control" id="newPassword"  placeholder="Password" autocomplete="current-password" required>

                                            <button type="button" id="btnToggle" class="form-pass__toggle"><i id="NewTogglePassword" class="fa fa-eye"></i></button>
                                        </div>
                                        <span class="my-2 text-danger " id="newPasswordError"></span>
                                        @error('password')
                                            <span class="my-2 text-danger"> {{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <div class="form-pass">
                                            <label for="account-cpass" class="form-label">Confirm Password <span class="text-danger fs-6">*</span></label>
                                            <input type="password" name="password_confirmation" class="form-control" id="confirmPassword" placeholder="Re-type password" required>

                                            <button type="button" id="btnCToggle" class="form-pass__toggle"><i  id="eyeIcon2" class="fa fa-eye"></i></button>
                                        </div>
                                        <span class="text-danger" id="confirmPasswordError"> </span>
                                    </div>
                                    <div class="col-12">
                                        <div class="account__check">
                                            <div class="account__check-remember">
                                                <input type="checkbox" name="tmc" class="form-check-input"  value="{{ old('tmc')}}"  id="terms-check" class="tmc">
                                                <label for="terms-check" class="form-check-label">I agree to these <a href="{{route('t&c')}}" style="color:var(--brand-color)">Terms and Conditions. </a>
                                                </label>
                                            </div>
                                        </div>
                                        @error('tmc')
                                            <h5 class="my-2 text-danger"> {{ $message }}</h5>
                                        @enderror
                                    </div>
                                    <input name="country" type="hidden" id="address-country">
                                    <input name="country_code" type="hidden" value="{{old('country_code')}}" id="country-code">
                                    <input name="dial_code" type="hidden" value="{{old('dial_code')}}" id="dial-code">

                                </div>

                                <button type="submit" class="trk-btn trk-btn--border trk-btn--primary d-block mt-4">Sign Up</button>

                            </form>
                            <div class="account__switch">
                                <p>Already have an account? <a href="{{ route('login') }}">Login</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="account__shape">
            <span class="account__shape-item account__shape-item--1"><img src="{{ asset("assets/images/contact/4.png")}}" alt="shape-icon"></span>
        </div>
    </section>
    <!-- ===============>> account end here <<================= -->


@endsection
@section('javaScript')
    <script src="{{ asset('assets/js/intlTelInput.min.js') }}"></script>
    <script>
        var countryData = window.intlTelInputGlobals.getCountryData(),
        input = document.querySelector("#phone"),
        errorMsg = document.querySelector("#error-msg"),
        validMsg = document.querySelector("#valid-msg"),
        countryInput = document.querySelector("#address-country");

        // here, the index maps to the error code returned from getValidationError - see readme
        var errorMap = ["Invalid number", "Invalid country code", "Number is too short", "Number is too long", "Invalid number"];
        let blockedCountries = ["af",'cn','np','ma','dz','eg','ws','gm','ye','bd'];
        // initialise plugin
        var iti = window.intlTelInput(input, {
        utilsScript: "{{ asset('assets/js/utils.js') }}",
        preferredCountries: [],
        initialCountry: "auto",
        separateDialCode:true,
        excludeCountries: blockedCountries,
        geoIpLookup: function(callback) {
            $.getJSON('https://get.geojs.io/v1/ip/country.json', function(resp) {
            var countryCode = resp.country;
            if(blockedCountries.includes(countryCode.toLowerCase()) ){
                $('#error-msg').html('You are in restricted area');
            }else{
                callback(countryCode);
                $('#error-msg').html('');
            }
            });
        }
        });
        // set it's initial value
        iti.promise.then(function() {
                let selectedData = iti.getSelectedCountryData();
                var countryCode = selectedData.iso2;
                if (countryCode) {
                    countryInput.value = selectedData.name;
                    $("#country-code").val(countryCode);
                    $("#dial-code").val(selectedData.dialCode);
                } else {
                    let code = $("#country-code").val();
                    iti.setCountry(code); // set default country to United States
                    countryCode = code; // set countryCode to United States
                }
        });

        // listen to the telephone input for changes
        input.addEventListener('countrychange', function(e) {
            let selectedData =iti.getSelectedCountryData();
            // console.log(selectedData);
            countryInput.value = selectedData.name;
            $("#country-code").val(selectedData.iso2);
            $("#dial-code").val(selectedData.dialCode);
        });

        var reset = function() {
            input.classList.remove("error");
            errorMsg.innerHTML = "";
            errorMsg.classList.add("hide");
            validMsg.classList.add("hide");
        };

        // on blur: validate
        input.addEventListener('blur', function() {
            reset();
            if (input.value.trim()) {
            if (iti.isValidNumber()) {
                validMsg.classList.remove("hide");
            } else {
                input.classList.add("error");
                var errorCode = iti.getValidationError();
                errorMsg.innerHTML = errorMap[errorCode];
                errorMsg.classList.remove("hide");
            }
            }
        });
        // on keyup / change flag: reset
        input.addEventListener('change', reset);
        input.addEventListener('keyup', reset);
    </script>
    <script>
        $('#btnToggle').click(function() {

            var passInput = $("#newPassword");
            if (passInput.attr('type') === 'password') {
                passInput.attr('type', 'text');
            } else {
                passInput.attr('type', 'password');
            }
        });
        $('#btnCToggle').click(function() {
            var passInput = $("#confirmPassword");
            if (passInput.attr('type') === 'password') {
                passInput.attr('type', 'text');
            } else {
                passInput.attr('type', 'password');
            }
        });
        $('#confirmPassword').keyup(function() {
            var newPassword = $("#newPassword").val();
            var confirmPassword = $(this).val();
            if (newPassword) {
                if (newPassword != confirmPassword) {
                    $('#confirmPasswordError').html("Password doesn't matched");
                } else {
                    $('#confirmPasswordError').html("");
                    $('#newPasswordError').html("");
                }
            } else {
                $('#confirmPasswordError').html("Please set a new password first");
            }
        });

        $('#newPassword').keyup(function() {
            var confirmPassword = $("#confirmPassword").val();
            var newPassword = $(this).val();
            if (confirmPassword) {
                if (newPassword != confirmPassword) {
                    $('#newPasswordError').html("password doesn't matched");
                } else {
                    $('#confirmPasswordError').html("");
                    $('#newPasswordError').html("");
                }
            }
        });
    </script>
@endsection
