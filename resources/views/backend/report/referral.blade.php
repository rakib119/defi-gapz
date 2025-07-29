@extends('layouts.dashbooard')
@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="page-title-box">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-sm-6">
                            <div class="page-title">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="{{ route('admin') }}">DashBoard</a></li>
                                    <li class="breadcrumb-item active">Referral Report</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="page-content-wrapper">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h2 class=" mb-4">Referral Report</h2>
                                        </div>
                                        <div class="d-flex">
                                            <div  style="margin-right: 5px">
                                                <span class="text-primary">Num of records</span>
                                            </div>
                                            <div >
                                                <select id="num_of_record" onchange="redirect()">
                                                    <option {{$num == 10 ? 'selected' : ''}} value="10">10</option>
                                                    <option {{$num == 20 ? 'selected' : ''}} value="20">20</option>
                                                    <option {{$num == 50 ? 'selected' : ''}} value="50">50</option>
                                                    <option {{$num == 100 ? 'selected' : ''}} value="100">100</option>
                                                    <option {{$num == 150 ? 'selected' : ''}} value="150">150</option>
                                                    <option {{$num == 200 ? 'selected' : ''}} value="200">200</option>
                                                 </select>
                                            </div>
                                        </div>
                                    </div>
                                    <table id="myTable" class="table table-centered table-nowrap mb-0">
                                            <thead class="thead-light ">
                                                <tr class="text-center">
                                                    <th>SL</th>
                                                    <th>Name</th>
                                                    <th>UID</th>
                                                    <th>Email</th>
                                                    <th>Dep. Amount</th>
                                                    <th>Total Ref.</th>
                                                    <th>Ref. Amount</th>
                                                    <th>Total Contribution</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($top_ref_arr as $uid => $info)
                                                    <tr class="text-center">
                                                        <td>{{$loop->iteration}}</td>
                                                        <td>{{$info['name']}}</td>
                                                        <td>{{$info['uid']}}</td>
                                                        <td>{{$info['email']}}</td>
                                                        <td>${{$info['deposite']}}</td>
                                                        <td>{{$info['total_ref']}}</td>
                                                        <td>${{$info['ref_amount']}}</td>
                                                        <td>${{$info['ref_amount'] + $info['deposite']}}</td>
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
        </div>
    </div>
@endsection
@section('javacript')
    <script>
        function redirect(){
            let num = $('#num_of_record').val();
            let link = "{{route('report.referral')}}"+'/'+num;
            window.location.href = link;
        };
    </script>
@endsection
