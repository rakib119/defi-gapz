@extends('layouts.fontend')
@section('main-content')

    <section class="team padding-top padding-bottom bg-color">
        <div class="section-header section-header--max65">
            <h6 class="mb-10 mt-minus-5"><span>Personal</span> Information <span></h6>
            <p class="text_color-secondary">{{ $auth->role == '2' ? '( Verified CEO )' : '' }}</p>
        </div>
        <div class="container">
            <div class="team__wrapper">
                <div class="row g-4 align-items-center">
                    <div class="col-sm-12 col-lg-12">
                        <div class="team__item team__item--shape">
                            <div class="d-flex flex-column">
                                <div class="my-5">
                                    <h6 class="text-danger text-center">Note : Be careful and conscious while adding your payment method is not editable further in case of  any missing.</h6>
                                </div>
                                @if (!$auth->name)
                                    <h6 class="ml-2">Name:</h6>
                                    <div class="p-2">
                                        <div class="d-flex justify-content-between">
                                            <p style="font-size: 20px"> {{ $auth->name }}</p>

                                            <button type="button" class="trk-btn trk-btn--border trk-btn--secondary" data-bs-toggle="modal" data-bs-target="#changeName">Modify</button>
                                        </div>
                                    </div>

                                    <!-- Modal -->
                                    <div class="modal fade" id="changeName" tabindex="-1" aria-labelledby="changeNameLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h6 class="modal-title fs-5">Update User Name</h6>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('change_name') }}" method="post">
                                                        @csrf
                                                        <div class="row g-4 mb-4">
                                                            <div class="col-12">
                                                                <div>
                                                                    <label for="first-name" class="form-label"> Name</label>
                                                                    <input type="text" value="{{ $auth->name }}" name="name" class="form-control" onfocus="" required>

                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="text-end">
                                                                    <button type="button" class="trk-btn trk-btn--secondary3" data-bs-dismiss="modal">Close</button>
                                                                    <button type="submit" class="trk-btn trk-btn--border trk-btn--secondary">Update</button>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                @else
                                    <div class="d-flex flex-column">
                                        <div class="p-2">
                                            <h6>Name:</h6>
                                            <div class="d-flex justify-content-between">
                                                <div>
                                                    <p style="font-size: 20px"> {{ $auth->name }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <div class="p-2">
                                            <h6>Email:</h6>
                                            <div class="d-flex justify-content-between">
                                                <div>
                                                    <p style="font-size: 20px"> {{ $auth->email }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                @endif
                                @if (!$auth->wallet_address)
                                    <div class="p-2">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <h6> Trc20 Wallet Address</h6>
                                                @error('wallet_address')
                                                    <p class="text-danger">{{$message}}</p>
                                                @enderror
                                            </div>
                                            <div>
                                                <button type="button" class="trk-btn trk-btn--border trk-btn--secondary" data-bs-toggle="modal" data-bs-target="#changeWallet_address">Add Wallet</button>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- MODAL --}}
                                    <div class="modal fade" id="changeWallet_address" tabindex="-1" aria-labelledby="changeWallet_addressLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h6 class="modal-title fs-5">Add Wallet Address</h6>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('change_wallet_address') }}" method="post">
                                                        @csrf
                                                        <div class="row g-4 mb-4">
                                                            <div class="col-12">
                                                                <div>
                                                                    <label for="first-name" class="form-label"> Trc20 wallet Address</label>
                                                                    <input type="text" placeholder="Trc20 wallet Address" name="wallet_address" class="form-control" value="{{ $auth->wallet_address }}" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="text-end">
                                                                    <button type="button" class="trk-btn trk-btn--secondary3" data-bs-dismiss="modal">Close</button>
                                                                    <button type="submit" class="trk-btn trk-btn--border trk-btn--secondary">Submit</button>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="d-flex flex-column">
                                        <div class="p-2">
                                            <h6>Trc20 Wallet Address:</h6>
                                            <div class="d-flex justify-content-between">
                                                <div>
                                                    <p style="font-size: 20px"> {{ $auth->wallet_address }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                @if (!$auth->bank_account_no)
                                    <div class="p-2">
                                        <div class="d-flex justify-content-between">
                                            <h6>Bank Account No:</h6>
                                            <button type="button" class="trk-btn trk-btn--border trk-btn--secondary" data-bs-toggle="modal" data-bs-target="#addBankAccountNo">Add
                                                Details</button>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="addBankAccountNo" tabindex="-1" aria-labelledby="changeWallet_addressLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h6 class="modal-title fs-5">Bank Details</h6>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('add_bank_details') }}" method="post">
                                                        @csrf
                                                        <div class="row g-4 mb-4">
                                                            <div class="col-12">
                                                                <div>
                                                                    <label for="first-name" class="form-label"> Full Name *</label>
                                                                    <input type="text" name="full_name" class="form-control" value="{{ $auth->full_name }}">
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div>
                                                                    <label for="first-name" class="form-label"> Bank Name *</label>
                                                                    <input type="text" name="bank_name" class="form-control" value="{{ $auth->bank_name }}">
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div>
                                                                    <label for="first-name" class="form-label"> Bank  Account No *</label>
                                                                    <input type="text" name="bank_account_no" class="form-control" value="{{ $auth->bank_account_no }}">
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div>
                                                                    <label for="first-name" class="form-label"> Branch Name *</label>
                                                                    <input type="text" placeholder="Branch Name *" name="branch_name" class="form-control" value="{{ $auth->branch_name }}">
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div>
                                                                    <label for="first-name" class="form-label"> SWIFT or IBAN code</label>
                                                                    <input type="text" name="swift_or_iban_code" class="form-control" value="{{ $auth->swift_or_iban_code }}">
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="text-end">
                                                                    <button type="button" class="trk-btn trk-btn--secondary3" data-bs-dismiss="modal">Close</button>
                                                                    <button type="submit" class="trk-btn trk-btn--border trk-btn--secondary">Submit</button>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="d-flex flex-column">
                                        <div class="p-2">
                                            <h6>Bank Account No:</h6>
                                            <div class="d-flex justify-content-between">
                                                <div>
                                                    <p style="font-size: 20px"> {{ $auth->bank_account_no }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <div class="p-2">
                                            <h6>Bank Name:</h6>
                                            <div class="d-flex justify-content-between">
                                                <div>
                                                    <p style="font-size: 20px"> {{ $auth->bank_name }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <div class="d-flex flex-column">
                                    <div class="p-2">
                                        <h6>Mobile Number:</h6>
                                        <p style="font-size: 20px"> {{ $auth->mobile }}</p>
                                    </div>
                                </div>
                                <div class="d-flex flex-column">
                                    <div class="p-2">
                                        <div class="d-flex justify-content-between">
                                            <h6>Login Password</h6>
                                            <a href="{{ route('password.request') }}" class="trk-btn trk-btn--border trk-btn--secondary">Modify</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex flex-column">
                                    <div class="p-2">
                                        <div class="d-flex justify-content-between">
                                            <h6>Transaction Password</h6>
                                            @if ($auth->transaction_password)
                                                <a href="{{ route('update_trans_pass') }}" class="trk-btn trk-btn--border trk-btn--secondary">Modify</a>
                                            @else
                                                <a href="{{ route('set_trans_pass') }}" class="trk-btn trk-btn--border trk-btn--secondary">Set Password</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex flex-column">
                                    <div class="p-2">
                                        <h6>UID:</h6>
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <p style="font-size: 20px"> {{ $auth->uid }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
@section('javaScript')
    <script>
     /*    $.ajaxSetup({
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

                $('#orderNo').html(data.order_no);
                $('#transactionAmount').html(data.transaction_amount);;
                $('#Profit').html(data.profit);
                immediateCompititionDiv.hide();
                Congratulations.show();
            },
        }); */
    </script>
@endsection
