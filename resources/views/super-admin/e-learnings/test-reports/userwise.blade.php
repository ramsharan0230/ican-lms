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
                    <span class="text-semibold">Test report userwise</span>
                    <a href="{{ route('EXPORT-TEST-REPORT') }}" class="btn btn-primary">Export</a>
                    
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
                    <th>Serial no.</th>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Published Status</th>
                    <th>Test Results</th>
                    <th class="text-center">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->serial_no }}</td>
                        <td>{{ $user->first_name .' '. $user->middle_name .' '.$user->last_name }}</td>
                        <td>{{ $user->username }}</td>
                        <td>{!! $user->active_status ? '<p class="label label-success">Active</p>' : '<p class="label label-default">Disabled</p>' !!}</td>
                        <td>{{ $user->test_results->count()}}</td>
                        <td class="text-center">
                            <a href="{{ route('e-learning.test-report.userwise.view', $user->id) }}" class="btn btn-info">View</a>
                        </td>
                    </tr>

                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <td>Serial no.</td>
                    <td>Name</td>
                    <td>Username</td>
                    <td>Published Status</td>
                    <td>Test Results</td>
                    <td class="text-center">Actions</td>
                </tr>
                </tfoot>
            </table>
        </div>
        <!-- /individual column searching (selects) -->

    </div>
@endsection