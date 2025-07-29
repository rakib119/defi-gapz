@extends('layouts.fontend')
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/intlTelInput.min.css') }}">
@endsection
@section('main-content')
    <section class=" tm-about-wrap">
        <div class="empty-space col-md-b90 col-xs-b55"></div>
        <div class="container mt-5">
            <div class="tm-countdown-wrap   tm-modal tm-color1">
                <h2 class="tm-modal-title">Register on {{ env('APP_NAME') }}</h2>
                <form action="{{ route('register') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class=" mb-2">
                                <input name="name" class='form-control' value="{{ old('name') }}" type="text"
                                    placeholder="Name *">
                            </div>
                            @error('name')
                                <h5 class="my-2 text-danger"> {{ $message }}</h5>
                            @enderror
                        </div>
                        <div class="col-12">
                            <div class=" mb-2">
                                <input name="email" class='form-control' value="{{ old('email') }}" type="text"
                                    placeholder="Email *">
                            </div>
                            @error('email')
                                <h5 class="my-2 text-danger "> {{ $message }}</h5>
                            @enderror
                        </div>
                        <div class="col-12">
                            <div class=" mb-2">
                                <input name="mobile" class='form-control' value="{{ old('mobile') }}" type="text"
                                    placeholder="Mobile *" id="phone">
                            </div>
                            <h6 class="my-2 text-danger" id="valid-msg"></h6>
                            <h6 class="my-2 text-danger" id="error-msg"></h6>
                            @error('mobile')
                                <h5 class="my-2 text-danger"> {{ $message }}</h5>
                            @enderror
                            @error('country_code')
                                <h5 class="my-2 text-danger"> {{ $message }}</h5>
                            @enderror
                        </div>
                        <div class="col-12">
                            <div class=" mb-2">
                                <input name="reference" class='form-control'
                                    value="{{ isset($_GET['ref']) ? $_GET['ref'] : '' }}" type="text"
                                    placeholder="Reference ID(If any)">
                            </div>
                            @error('reference')
                                <h5 class="my-2 text-danger"> {{ $message }}</h5>
                            @enderror
                        </div>
                        <div class="col-12">
                            <div class="mb-2 d-flex">
                                <input class="form-control  @error('password') is-invalid @enderror" id="newPassword"
                                    type="password" name="password" autocomplete="current-password" placeholder="Password"
                                    required>
                                <i class="text-white far fa-eye " id="NewTogglePassword"
                                    style="margin:auto -30px; cursor: pointer;"></i></i>
                            </div>
                            <h5 class="my-2 text-danger " id="newPasswordError"> </h5>
                            @error('password')
                                <h5 class="my-2 text-danger"> {{ $message }}</h5>
                            @enderror
                        </div>
                        <div class="col-12">
                            <div class="mb-2 d-flex">
                                <input class="form-control  @error('password') is-invalid @enderror" id="confirmPassword"
                                    type="password" name="password_confirmation" placeholder="Confirm Password" required>
                                <i class="text-white far fa-eye " id="confirmTogglePassword"
                                    style="margin:auto -30px; cursor: pointer;"></i></i>
                            </div>
                            <h5 class="text-danger" id="confirmPasswordError"> </h5>
                        </div>
                        <div class="col-12">
                            <div class="mt-3 d-flex ">
                                <div>
                                    <input id="check" name="tmc" value="1" class='form-control'
                                    value="{{ old('tmc')}}" type="checkbox" >
                                </div>
                                <div>
                                    <label for="check" class="tmc"> I agree to these <a href="{{route('t&c')}}" style="color:var(--s-font-color)">Terms and Conditions. </a></label>
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
                    <div class="row">
                        <div class="col-12">
                            <div class="empty-space col-md-b40 col-xs-b40"></div>
                            <button class="tm-btn tm-style1 w-100" type="submit">Submit</button>
                        </div>
                    </div>

                </form>
                <div class="tm-modal-footer mt-3">
                    <a href="{{ route('login') }}" class="tm-new-signup">Have an Account? Login</a>
                </div>
            </div>
        </div>
        </div>
        <div class="empty-space col-md-b85 col-xs-b55"></div>
    </section>
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
        $('#NewTogglePassword').click(function() {
            var passInput = $("#newPassword");
            if (passInput.attr('type') === 'password') {
                passInput.attr('type', 'text');
            } else {
                passInput.attr('type', 'password');
            }
        });
        $('#confirmTogglePassword').click(function() {
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
