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
                    <span class="text-semibold">Failed Course Orders List</span>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="date-filer-wrapper" style="padding: 0px 20px; display: none;">
                                From Date: <input type="date" name="from_date" id="fromDate">
                                To Date: <input type="date" name="to_date" id="toDate">
                                <!--<button class="btn btn-primary btn-sm ml-2" id="clearDateFilter">Clear Date Filter</button>-->
                            </div>
                            {{ Form::open(array('route' => 'course-orders.failed-orders', 'method' => 'get')) }}
                            <div class="date-filer-wrapper" style="padding: 0px 20px; display: none;">
                                <input type="hidden" name="from_date" id="fromDateFilter">
                                <input type="hidden" name="to_date" id="toDateFilter">
                                <!--<button class="btn btn-primary btn-sm ml-2" id="clearDateFilter">Clear Date Filter</button>-->
                            </div>
                            <button type="submit" class="btn btn-primary">Filter</button>
                            {{ Form::close() }}
                        </div>
                        <div class="col-md-6">
                            <form action="{{ route('course.orders.failed.search') }}" method="get" class="form-inline">
                                {{-- {{ csrf_field() }} --}}
                                <input type="text" required name="search" class="form-control">
                                <button class="btn btn-info">Search</button>
                            </form>
                        </div>
                    </div>
                    {{ Form::open(array('route' => 'EXPORT-FAILED-COURSE-PAYMENT-REPORT', 'method' => 'post')) }}

                        <button type="submit" class="btn btn-primary">Export</button>
                    {{ Form::close() }}
                    <a href="{{ route('EXPORT-FAILED-COURSE-PAYMENT-REPORT_FISCAL') }}" class="btn btn-primary">Export Fiscal Year wise</a>

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
            
            <table class="table datatable" id="courseTable">
                <thead>
                <tr>
                    <th>Reference ID</th>
                    <th>Member No.</th>
                    <th>Member Type</th>
                    <!--<th>Subject</th>-->
                    <th>User</th>
                    <th>Amount</th>
                    <th>Payment</th>
                    <th>Payment Method</th>
                    <th>Paid Date</th>
                    <th>Created Date</th>
                    <th class="text-center">Actions</th>
                </tr>
                </thead>
                <tbody id="courseTableBody">
                @foreach($orders as $order)
                    <tr>
                        <td>{{ $order->operation_id}}</td>
                        <td>{{ $order->serial_no}}</td>
                        <td>{{ $order->category}}</td>
                        
                        <td>{{ $order->first_name }} {{ $order->last_name }}</td>
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

                                        <li><a href="{{ route('course-orders.status-paid', $order->id) }}"><i
                                                        class="icon-database-edit2"></i> <span
                                                        class="text-info">View Details</span></a></li>
                                        <li><a class="failed-details" data-orderId="{{$order->id}}" href="{{ route('course.orders.failed.edit', $order->id) }}"><i
                                            class="icon-database-edit2"></i> <span
                                            class="text-info">Edit Details</span></a></li>
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
<script>
$(document).ready(function(){

    // var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    {{--var APP_URL = {!! json_encode(url('/')) !!}--}}
    $("#fromDate").change(function() {
        let fromDate = $("#fromDate").val();
        $("#fromDateFilter").val(fromDate);

    });

    $("#toDate").change(function() {
        let toDate = $("#toDate").val();
        $("#toDateFilter").val(toDate);
    });

    function filterData(fromDate, toDate){
            $.ajax({
                url: APP_URL + '/get-course-payment-ajax',
                type: "GET",
                data: {_token : CSRF_TOKEN, from_date: fromDate, to_date: toDate},
                dataType: 'json',
                success: function(data) {
                    if(data) {
                        console.log(data);
                        var Parent = document.getElementById("courseTableBody");
                        while(Parent.hasChildNodes())
                        {
                            Parent.removeChild(Parent.firstChild);
                        }

                        $.each(data, function(key, value) {
                            var tr = $("<tr />")
                            $.each(value, function(k, v) {
                                tr.append(
                                    $("<td />", {
                                        html: v
                                    })[0].outerHTML
                                );
                                $("table tbody").append(tr)
                            })
                        })
                    }else {

                    }
                }

            });
    }

    $.fn.dataTable.ext.search.push(
        
        function( settings, data, dataIndex ) {
        
            var min = new Date($('#fromDate').val()).getTime();
            
            var max = new Date($('#toDate').val()).getTime();
            
            var date = new Date(data[8]).getTime();
            
            if ( ( isNaN( min ) && isNaN( max ) ) ||
    
            ( isNaN( min ) && date <= max ) ||
    
            ( min <= date && isNaN( max ) ) ||
    
            ( min <= date && date <= max ))
    
            {
                return true;
            }
            return false;
        }

    );
    
    // var table = $('.datatable').DataTable();
    
    $('.date-filer-wrapper').css('display','block');
    // $("#fromDate, #toDate").change(function() {
    //     table.draw();
    // });
    //
    // $('#clearDateFilter').click(function(event){
    //     event.preventDefault();
    //
    //     $('#fromDate').val('');
    //     $('#toDate').val('');
    //
    //     table.draw();
    // });

});
</script>
@endsection