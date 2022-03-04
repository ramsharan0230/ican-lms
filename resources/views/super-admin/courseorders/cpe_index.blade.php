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
                    <span class="text-semibold">Course Orders List</span>
                    <a href="{{ route('CPE_EXPORT-COURSE-PAYMENT-REPORT') }}" class="btn btn-primary">Export</a>
                   <a href="{{ route('CPE_EXPORT-COURSE-PAYMENT-REPORT_FISCAL') }}" class="btn btn-primary">Export Fiscal Year wise</a>

                    <span class="pull-right custom-breadcrumb">

                     <ul class="breadcrumb">
                         <li><a href="{{ route('super-admin-dashboard') }}"><i class="icon-home2 position-left"></i> Home</a></li>
                         <li><a href="{{ route('course-orders.index') }}">Course Orders</a></li>
                         <li class="active">List Orders</li>
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

            {{--<div class="panel-body">
                <a href="{{ route('users.export-users-excel-sheet') }}" class="btn btn-custom btn-lg"><i class="icon-file-excel"></i> &nbsp;&nbsp;Export Excel Sheet</a>
            </div>--}}

            <table class="table datatable-column-search-inputs">
                <thead>
                <tr>
                    <th>OrderID</th>
                    <th>Member No.</th>
                    <th>Member Type</th>
                    <!--<th>Subject</th>-->
                    <th>User</th>
                    <th>Course</th>
                    <th>Video time</th>
                    <th>Amount</th>
                    <th>Payment</th>
                    <th>Payment Method</th>
                    <th>Paid Date</th>
                    <th>Created Date</th>
                    <th class="text-center">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->user->serial_no}}</td>
                        <td>{{ $order->user->category}}</td>
                        
                        <td>@if(isset($order->user)){{ $order->user->first_name }} {{ $order->user->last_name }}@endif</td>
                        <td>@if(isset($order->course)){{ $order->course->name }}@endif</td>
                                                    <td>@if(isset($order->video_time)){!! $order->video_time !!}@else N/A @endif</td>

                        <td>{!! $order->paid_amount !!}</td>
                        <td>
                            @if($order->payment=="paid")
                                <span class="label label-success custom-label">Paid</span>
                            @else
                                <span class="label label-danger custom-label">{{ $order->payment }}</span>
                            @endif
                        </td>

                        <td>
                            {{ $order->payment_method }}
                        </td>
                        <td>{{ $order->paid_datetime }}</td>
                        <td>{{ $order->created_at }}</td>
                        <td class="text-center">
                            <ul class="icons-list">
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <i class="icon-menu9"></i>
                                    </a>

                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li><a href="{{ route('course-orders.show', $order->id) }}"><i
                                                        class="icon-database-edit2"></i> <span
                                                        class="text-info">View Details</span></a></li>
                                    </ul>
                                </li>
                            </ul>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <!-- /individual column searching (selects) -->
    </div>
@endsection

@section('additional-js-code')

@endsection