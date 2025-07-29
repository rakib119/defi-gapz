@extends('layouts.fontend')
@section('main-content')
    <div id="mainContent">
        <section class="pricing padding-top padding-bottom" id="transictionHall">
            <div class="section-header section-header--max50">
                <h6 class="mb-10 mt-minus-5">Identity <span>Authentication</span></h6>
                @if  ($info->identification_status==1)
                    <p>Your photo ID has been verified successfully. You can now enjoy all the features of our platform.</p>
                @elseif($info->identification_status==2)
                    <p>Your photo ID verification has been rejected. Please ensure that your ID is clear and legible, and try again.</p>
                @elseif($info->identification_status==3)
                    <p>Your photo ID has been submitted successfully. Please wait while we validate your identification. You will be notified once the verification process is complete.</p>
                @else
                    <p>Hold your ID card, passport or driving license beside your face to verify your identity through photo ID verification.  Once you submit everything, your account can be verified within short time.</p>
                @endif
            </div>
            <div class="container">
                <div class="pricing__wrapper">
                    <div class="pricing__item aos-init aos-animate" data-aos="fade-up" data-aos-duration="1000">
                        <div class="row">
                            <div class="col-lg-12 text-center  py-3">
                                <div class=" mb-2">
                                    @if ($info->identification_status == 1)
                                        <i style="font-size:30px; color:var(--brand-color); padding:10px; border: 1px solid var(--brand-color);border-radius:50px"
                                            class="fa fa-check"></i>
                                        <p class="text-success">Verified</p>
                                    @elseif ($info->identification_status == 2)
                                        <i style="font-size:30px; color:red; padding:10px; border: 1px solid red;border-radius:50px"
                                            class="fa fa-x"></i>
                                        <p class="text-danger">Rejected</p>
                                    @elseif ($info->identification_status == 3)
                                        <i style="font-size:30px; color:var(--brand-color); padding:10px; border: 1px solid var(--brand-color);border-radius:50px"
                                            class="fa fa-spinner "></i>
                                        <p>Pending</p>
                                    @endif
                                </div>
                                @if ($info->identification_status== 1 || $info->identification_status == 3)
                                    <img src="{{ asset('assets\upload\identification_image/' . $info->identification_image) }}" width="500" height="300" class="mb-3">
                                @else
                                    <div class="d-flex justify-content-center mb-3">
                                        <img src="" id="imgOutput" width="500" height="300" style="display:none;">
                                    </div>
                                    <div class="upload-box" >
                                        <i class="fa-solid fa-cloud-arrow-up upload-icon" id="uploadPhoto" style="color:var(--brand-color); font-size:80px;"></i>
                                    </div>
                                    <div>
                                        <p>Click here to upload your photo Id</p>
                                    </div>
                                    {{-- <img src="{{ asset('assets/img/upload.png') }}" id="uploadPhoto" width="100" height="100" class="mb-3"> --}}
                                    @error('identification_image')
                                        <span class="text-danger"> {{ $message }}</span>
                                    @enderror
                                @endif
                            </div>
                        </div>
                        @if ($info->identification_status!= 1 && $info->identification_status != 3)
                            <div class="d-flex pb-4 justify-content-center">
                                <form action="{{ route('identify_authenticate_post') }}" method="post"
                                    enctype="multipart/form-data" id="uploadImageFrom">
                                    @csrf
                                    <input accept=".jpg,.png" id="fileinput" type="file" name="identification_image"
                                        style="display:none"  onchange="loadFile(event,'imgOutput')" />
                                    <div style="width: 30%" id="upload_btn_div">
                                        <a type="submit" class="trk-btn trk-btn--border trk-btn--secondary" href="javascript:void(0)"
                                            onclick="event.preventDefault(); document.getElementById('uploadImageFrom').submit()">Upload</a>
                                    </div>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="pricing__shape">
                <span class="pricing__shape-item pricing__shape-item--1"> <span></span> </span>
                <span class="pricing__shape-item pricing__shape-item--2"> <img src="{{ asset("assets/images/icon/1.png") }}" alt="shape-icon"></span>
            </div>
        </section>
    </div>

    @if ($info->identification_status!= 1 && $info->identification_status != 3)
        <section class="team padding-top padding-bottom bg-color">
            <div class="container">
                <div class="team__wrapper">
                    <div class="row g-4 align-items-center">
                        <div class="col-sm-12 col-lg-12">
                            <div class="team__item team__item--shape" data-aos="fade-up" data-aos-duration="900">
                                <div class="team__item-inner team__item-inner--shape comment__body-inner"  style="background: var(--tertiary-color3);padding-top:30px;">
                                    <div class="row">
                                        <img style="height: 400px" src="{{ asset('assets/img/identity.jpg') }}" width="100%">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
@endsection
@section('javaScript')
    @if ($info->identification_status!= 1 && $info->identification_status != 3)
        <script>
            $(document).ready(function() {
                // trigger file input
                $('#uploadPhoto').click(function() {
                    $('#fileinput').trigger('click');
                });
                // upload_btn_div
                $('#upload_btn_div').hide();
                $('#fileinput').change(function() {
                    $('#upload_btn_div').show();
                });
            });
        </script>
    @endif
@endsection
