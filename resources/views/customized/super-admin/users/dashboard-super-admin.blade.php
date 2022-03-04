@extends('master-layouts.app-master-layouts.app-master-layout-super-admin')

@section('page-header')
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
          rel="stylesheet">
    <div class="panel page-header page-header-xs border-bottom-teal">

        <div class="page-header-content">
            <div class="page-title">
                <h6>
                    <span class="text-semibold">Dashboard</span>
                    
                <span class="pull-right custom-breadcrumb">

                     <ul class="breadcrumb">
                        <li> IP Addresss : {{ $ip }} </li>
                        <li>Country :  {{ $country }} </li>

                         <li><a href="{{ route('super-admin-dashboard') }}" class="active"><i class="icon-home2 position-left"></i></a> Home</li>
                     </ul>
                </span>
                </h6>
            </div>
            <div class="heading-elements">
                <a href="#" class="btn btn-primary btn-float btn-rounded heading-btn"><i
                            class="glyphicon glyphicon-edit"></i></a>
                <a href="#" class="btn btn-success btn-float btn-rounded heading-btn"><i class="icon-google-drive"></i></a>
                <a href="#" class="btn btn-info btn-float btn-rounded heading-btn"><i class="icon-twitter"></i></a>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <style>
        .card-body{
            margin : 20px;
        }
        .card-footer span{
            margin : 20px;
        }

        .material-icons{
            font-size : 55px;
            line-height : 1.5;
        }

        .mr-5{
            font-size : 20px;
            font-weight : 500;
        }

        .float-left{
            font-size : 15px;
        }
    </style>
    <div class="content">
        @include('flash-messages.partial_flash_alert_message')
        <div class="row">
            <div class="col-xl-3 col-sm-3 mb-3">
                <div class="card text-white bg-primary o-hidden h-100">
                    <div class="card-body">
                        <div class="card-body-icon">
                            <i class="material-icons">
                                Members
                            </i>
                        </div>
                        <div class="mr-5"><a href="{{ route('users.index') }}" style="color: #000000">{{$members}} Members!</a></div>
                    </div>
                    @if(\Illuminate\Support\Facades\Auth::user()->id == 1)
                    <a class="card-footer text-white clearfix small z-1" href="{{ route('users.index') }}">
                        <span class="float-left">View Details</span>
                    </a>
                    @else
                    <a class="card-footer text-white clearfix small z-1" href="#">
                        <span class="float-left">View Details</span>
                    </a>
                    @endif
                </div>
            </div>
            <div class="col-xl-3 col-sm-3 mb-3">
                <div class="card text-white bg-warning o-hidden h-100">
                    <div class="card-body">
                        <div class="card-body-icon">
                            <i class="material-icons">
                                Tests Taken
                            </i>
                        </div>
                        <div class="mr-5"><a href="{{ route('tests-taken') }}" style="color: #000000">{{ $test_taken }} Tests Taken!</a></div>
                    </div>
                    <a class="card-footer text-white clearfix small z-1" href="{{ route('tests-taken') }}">
                        <span class="float-left">View Details</span>
                    </a>
                </div>
            </div>
            <div class="col-xl-3 col-sm-3 mb-3">
                <div class="card text-white bg-success o-hidden h-100">
                    <div class="card-body">
                        <div class="card-body-icon">
                            <i class="material-icons">
                                Passed
                            </i>
                        </div>
                        <div class="mr-5"><a href="{{ route('tests-pass') }}" style="color: #000000">{{ $passed }} Total Passed!</a></div>
                    </div>
                    <a class="card-footer text-white clearfix small z-1" href="{{ route('tests-pass') }}">
                        <span class="float-left">View Details</span>
                    </a>
                </div>
            </div>
            <div class="col-xl-3 col-sm-3 mb-3">
                <div class="card text-white bg-danger o-hidden h-100">
                    <div class="card-body">
                        <div class="card-body-icon">
                            <i class="material-icons">
                               Total Failed
                            </i>
                        </div>
                        <div class="mr-5"><a href="{{ route('tests-failed') }}" style="color: #000000">{{ $failed }} Total Failed!</a></div>
                    </div>
                    <a class="card-footer text-white clearfix small z-1" href="{{ route('tests-failed') }}">
                        <span class="float-left">View Details</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
