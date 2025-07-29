<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ env('APP_NAME') }}- Cryptocurrency trading Platform -Dashboard</title>
    <!-- Favicon Icon -->
    <link rel="icon" href="{{ asset('assets/img/favicon.jpg') }}">
    <link href="{{ asset('dashboard/assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css') }}"
        rel="stylesheet" type="text/css" />
    <link href="{{ asset('dashboard/assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('dashboard/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/flaticon.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('dashboard/assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    <link href="//cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
    {{-- CSS Yield --}}
    @yield('css')
</head>

<body>
    <div id="layout-wrapper">
        <header id="page-topbar" style="background-color: #7D85EC;">
            <div class="navbar-header">
                <div class="d-flex">
                    <!-- LOGO -->
                    <div class="navbar-brand-box">
                        <a href="{{ route('admin') }}" class="logo logo-dark">
                            <span class="logo-sm">
                                <img style="height:42px" src="{{ asset('assets/img/logo.png') }}">
                            </span>
                            <span class="logo-lg">
                                <img style="height:42px" src="{{ asset('assets/img/logo.png') }}">
                            </span>
                        </a>
                    </div>
                    <button type="button" class="btn btn-sm px-3 text-white font-size-24 header-item waves-effect"
                        id="vertical-menu-btn">
                        <i class="mdi mdi-menu"></i>
                    </button>
                </div>
                <div class="d-flex">
                    <div class="dropdown d-none d-lg-inline-block ms-1">
                        <button type="button" class="btn  header-item noti-icon waves-effect" data-toggle="fullscreen">
                            <i class="mdi text-white mdi-fullscreen"></i>
                        </button>
                    </div>
                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="rounded-circle header-profile-user"
                                src="{{ asset('dashboard/assets/images/default-profile-picture.jpg') }}"
                                alt="Header Avatar">
                            <span class="d-none text-white d-xl-inline-block ms-1">{{ Auth::user()->name }}</span>
                            <i class="mdi mdi-chevron-down d-none text-white d-xl-inline-block"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <!-- item-->
                            <a class="dropdown-item" target="blank" href="{{ url('/') }}"><i
                                    class="mdi mdi-web font-size-16 align-middle me-1"></i> Website</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                          document.getElementById('logout-form').submit();">
                                <i
                                    class="mdi mdi-power font-size-16 align-middle me-1 text-danger"></i>{{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <div class="vertical-menu">
            <div data-simplebar class="h-100">
                <div id="sidebar-menu">
                    <!-- Left Menu Start -->
                    <ul class="metismenu list-unstyled" id="side-menu">
                        <li class="menu-title">Menu</li>
                        <li>
                            <a href="{{ route('admin') }}" class="waves-effect">
                                <i class="dripicons-home"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('users') }}" class="waves-effect">
                                <i class="fas fa-users "></i>
                                <span>User Management</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('deposit_request_list') }}" class="waves-effect">
                                <i class="fas fa-dollar-sign "></i>
                                <span>Deposite Management</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('withdrawal_request_list') }}" class="waves-effect">
                                <i class="fas fa-dollar-sign "></i>
                                <span>Withdrawal</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('report.referral') }}" class="waves-effect">
                                <i class="fas fa-cubes"></i>
                                <span>Referral Report</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('service_fees') }}" class="waves-effect">
                                <i class="fa fa-comment-dollar"></i>
                                <span>Fees Management</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('fixed_deposit') }}" class="waves-effect">
                                <i class="fa fa-comment-dollar"></i>
                                <span>Manage Fix Deposit</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('supplier.index') }}" class="waves-effect">
                                <i class="fa fa-comment-dollar"></i>
                                <span>Supplier Management</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('fixed_deposit_list') }}" class="waves-effect">
                                <i class="fa fa-comment-dollar"></i>
                                <span>Investment Management</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('about.edit') }}" class="waves-effect">
                                <i class="fa fa-info"></i>
                                <span>About Management</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('notice.index') }}" class="waves-effect">
                                <i class="fas fa-bell"></i>
                                <span>Notification Management</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('history.transactions') }}" class="waves-effect">
                                <i class="fas fa-exchange-alt"></i>
                                <span>Transaction History</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('history.team') }}" class="waves-effect">
                                <i class="fas fa-hospital-user"></i>
                                <span>Team Incomes</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('inbox') }}" class="waves-effect">
                                <i class="fa fa-envelope-open"></i>
                                <span>Inbox</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('send_mail_view') }}" class="waves-effect">
                                <i class="fa fa-envelope"></i>
                                <span>Send Email</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        @yield('content')
        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <script>
                            document.write(new Date().getFullYear())
                        </script> © {{ config('app.name', 'Laravel') }}
                    </div>
                    <div class="col-sm-6">
                        <div class="text-sm-end d-none d-sm-block">
                            Developed <i class="mdi mdi-heart text-danger"></i>By Rakib Hasan</p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    </div>
    <script src="{{ asset('dashboard/assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('dashboard/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('dashboard/assets/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('dashboard/assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('dashboard/assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('dashboard/assets/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('dashboard/assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js') }}">
    </script>
    <script
        src="{{ asset('dashboard/assets/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-world-mill-en.js') }}">
    </script>
    <script src="{{ asset('dashboard/assets/js/pages/dashboard.init.js') }}"></script>
    <script src="{{ asset('dashboard/assets/js/app.js') }}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="//cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    {{-- delete confirmation --}}
    <script>
        function deleteData(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You want to delete this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#deleteData' + id).submit()
                }
            })
        }
    </script>

    @if (session('success'))
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 1000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })
            Toast.fire({
                icon: 'success',
                title: "{{ session('success') }}"
            })
        </script>
    @endif
    @if (session('error'))
        <script>
            Swal.fire({
                title: "Warning",
                text: "{{ session('error') }}",
                icon: 'warning',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
            })
        </script>
    @endif
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
    {{-- Script Yield --}}
    @yield('javacript')
</body>

</html>
