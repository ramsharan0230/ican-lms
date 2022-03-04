@extends('master-layouts.app-master-layouts.app-master-layout-super-admin')

@section('additional-theme-js')
    <!-- Theme JS files -->
    <script type="text/javascript" src="{{ asset('assets/js/plugins/media/fancybox.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/plugins/forms/selects/select2.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/plugins/tables/datatables/datatables.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/pages/datatables_api.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/pages/user_pages_team.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/pages/components_modals.js')}}"></script>
    <!-- /theme JS files -->
@endsection


@section('page-header')
    <div class="panel page-header page-header-xs border-bottom-teal">

        <div class="page-header-content">
            <div class="page-title">
                <h6>
                    <span class="text-semibold">Tests Datewise Report: </span>
                    
                <span class="pull-right custom-breadcrumb">

                     <ul class="breadcrumb">
                         <li><a href="{{ route('super-admin-dashboard') }}"><i class="icon-home2 position-left"></i> Home</a></li>
                         <li class="active">Datewise report</li>
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
    <div class="content">
        @include('flash-messages.partial_flash_alert_message')
        <div class="panel panel-flat">
            <div class="p-20">
            {!! Form::open(['route' => 'e-learning.test-report.datewise.search', 'method' => 'GET']) !!}
            <div class="col-md-4">
                <div class="form-group{{ $errors->has('from') ? ' has-error' : '' }}">
                    {{ Form::label('from', 'From: ') }}
                    {!! Form::date('from', Request::get('from') ?: Request::old('from'), ['class' => 'form-control', 'required' => 'required']) !!}
                    @if($errors->has('from'))
                        <span class="help-block">{{ $errors->first('from') }}</span>
                    @endif
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group{{ $errors->has('to') ? ' has-error' : '' }}">
                    {{ Form::label('to', 'To: ') }}
                    {!! Form::date('to', Request::get('to') ?: Request::old('to'), ['class' => 'form-control', 'required' => 'required']) !!}
                    @if($errors->has('to'))
                        <span class="help-block">{{ $errors->first('to') }}</span>
                    @endif
                </div>
            </div>    
            <button type="submit" class="btn btn-info m-t-25">Search</button>
            {!! Form::close() !!}

            </div>
            
            <table class="table datatable-column-search-inputs">
                <thead>
                <tr>
                    <th>Test</th>
                    <th>Result ID</th>
                    <th>Student Name</th>
                    <th>Student Serial No.</th>
                    <th>Date</th>
                    <th class="text-center">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($test_results as $result)
                    <tr>
                        <td>@if(isset($result->test)) {{ $result->test->name }} @endif</td>
                        <td>{{ $result->id }}</td>
                        <td>@if(isset($result->user)){{ $result->user->first_name .' '. $result->user->last_name }} ({{ $result->user->username ?: 'No username available' }})@endif</td>
                        <td>@if(isset($result->user)){{ $result->user->serial_no }}@endif</td>
                        <td>{{ date('m/d/Y', strtotime($result->created_at)) }}</td>
                        <td class="text-center">
                            <a href="{{ route('e-learning.tests.result', $result->id) }}" class="btn btn-info">View</a>
                        </td>
                    </tr>

                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <td>Test</td>
                    <td>Result ID</td>
                    <td>Student Name</td>
                    <td>Date</td>
                    <td class="text-center">Actions</td>
                </tr>
                </tfoot>
            </table>
        </div>
        <!-- /individual column searching (selects) -->

    </div>
@endsection