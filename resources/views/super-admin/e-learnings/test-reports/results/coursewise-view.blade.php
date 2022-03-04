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
                    <span class="text-semibold">Test Report: {{ $course->name }}</span>
                    
                <span class="pull-right custom-breadcrumb">

                     <ul class="breadcrumb">
                         <li><a href="{{ route('super-admin-dashboard') }}"><i class="icon-home2 position-left"></i> Home</a></li>
                         <li class="active">Userwise report</li>
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

            <table class="table datatable-column-search-inputs">
                <thead>
                <tr>
                    <th>Test Name</th>
                    <th>Student Serial no.</th>
                    <th>Student Name</th>
                    <th>Result Id</th>
                    <th>Date</th>
                    <th class="text-center">Actions</th>
                </tr>
                </thead>
                <tbody>
                   @foreach($lessons as $lesson)
                        @foreach($lesson->tests as $test)
                            @foreach($test->test_results as $result)
                            <tr>
                                <td>{{ $test->name }}</td>
                                <td>{{ $result->user->serial_no }}</td>
                                <td>{{ $result->user->first_name .' '. $result->user->last_name}} ({{ $result->user->username }})</td>
                                <td>{{ $result->id }}</td>
                                <td>{{  date('F d Y', strtotime($result->created_at)) }}</td>
                                <td class="text-center">
                                    <a href="{{ route('e-learning.tests.result', $result->id) }}" class="btn btn-info">View</a>
                                </td>
                            </tr>
                            @endforeach 
                        @endforeach 
                    @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th>Test Name</th>
                    <th>Student Serial no.</th>
                    <th>Student Name</th>
                    <th>Result Id</th>
                    <th>Date</th>
                    <th class="text-center">Actions</th>
                </tr>
                </tfoot>
            </table>
        </div>
        <!-- /individual column searching (selects) -->

    </div>
@endsection