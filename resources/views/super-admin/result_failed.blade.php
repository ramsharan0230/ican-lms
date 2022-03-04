@extends('master-layouts.app-master-layouts.app-master-layout-super-admin')

@section('additional-theme-js')
    <!-- Theme JS files -->
    <script type="text/javascript" src="{{ asset('assets/js/plugins/media/fancybox.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/plugins/forms/selects/select2.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/plugins/tables/datatables/datatables.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/pages/datatables_api.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/pages/user_pages_team.js')}}"></script>
    <!-- /theme JS files -->
@endsection

@section('page-header')
    <div class="panel page-header page-header-xs border-bottom-teal">

        <div class="page-header-content">
            <div class="page-title">
                <h6>
                    <span class="text-semibold">Users List</span>
                <span class="pull-right custom-breadcrumb">

                     <ul class="breadcrumb">
                         <li><a href="{{ route('super-admin-dashboard') }}"><i class="icon-home2 position-left"></i> Home</a></li>
                         <li><a href="{{ route('users.index') }}">Users</a></li>
                         <li class="active">Test Users Failed</li>
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

            <div class="panel-body">
                <a href="{{ route('EXPORT-TEST-REPORT_FAILED') }}" class="btn btn-custom btn-lg"><i class="icon-file-excel"></i> &nbsp;&nbsp;Export Excel Sheet</a>
                                <a href="{{ route('EXPORT-TEST-REPORT_FAILED_FISCAL') }}" class="btn btn-custom btn-lg"><i class="icon-file-excel"></i> &nbsp;&nbsp;Export Excel Sheet Fiscal Year Wise</a>

            </div>
            <table class="table datatable-column-search-inputs">
                <thead>
                <tr>
                 <td>Name</td>
                    <td>Member Serail no.</td>
                    <td>Member Type</td>
                    <td>Test Name</td>
                    <td>Status</td>
                    <td>Test Date</td>
                </tr>
                </thead>
                <tbody>
                @foreach($results as $result)
                @if(!get_result_check($result->id,$result))
                    <tr>
                        <td>{{ get_user($result->user_id) }}</td>
                        <td>{{ get_user_serial_no($result->user_id) }}</td>
                        <td>{{ get_user_category($result->user_id) }}</td>
                        <td>{{ get_test($result->test_id) }}</td>
                        <td>{!!get_result($result->id,$result) !!}</td>
                        <td>{{ $result->created_at}}</td>

                    </tr>
                    @endif
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                 <td>Name</td>
                     <td>Member Serail no.</td>
                    <td>Member Type</td>
                    <td>Test Name</td>
                    <td>Status</td>
                    <td>Test Date</td>
                   
                </tr>
                </tfoot>
            </table>
        </div>
        <!-- /individual column searching (selects) -->

    </div>




@endsection

@section('additional-js-code')

@endsection