@extends('master-layouts.app-master-layouts.app-master-layout-super-admin')

@section('additional-theme-js')
    <!-- Theme JS files -->
    <script type="text/javascript" src="{{ asset('assets/js/pages/components_popups.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/pages/appearance_panel_heading.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/pages/components_modals.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/custom/css/fullscreen.css')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/custom/js/fullscreen.js')}}"></script>
    <!-- /theme JS files -->
    <style>
        .disable-select {
            -webkit-touch-callout: none;
            -webkit-user-select: none;
            -khtml-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }
    </style>
@endsection

@section('page-header')
    <div class="panel page-header page-header-xs border-bottom-teal">

        <div class="page-header-content">
            <div class="page-title">
                <h6>
                    <span class="text-semibold">View Order Details</span>

                    <span class="pull-right custom-breadcrumb">
                        <ul class="breadcrumb">
                            <li><a href="{{ route('super-admin-dashboard') }}"><i class="icon-home2 position-left"></i> Home</a></li>
                            <li><a href="{{ route('course-orders.index') }}">Course Orders</a></li>
                            <li class="active">View Order Details</li>
                        </ul>
                    </span>
                </h6>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="content">
        <div class="col-md-12">
            <!-- Tabs -->
            <div class="panel panel-default" id="lesson-tab-panel-1">
                <div class="panel-heading">
                    <h6 class="panel-title">Order ID : {{ $order->id }}</h6>
                    @if(isset($order->user))<p>Ordered By : {{ $order->user->first_name }} {{ $order->user->last_name }}</p>@endif
                    @if(isset($order->course))<p>Course Name : {{ $order->course->name }}</p>@endif
                    <p>Status : {{ $order->payment }}</p>
                    @if($order->payment == "paid")<p>Payment Method : {{ $order->payment_method }}</p>@endif
                    <p>Amount : {{ $order->paid_amount }}</p>
                    @if($order->payment == "paid")<p>Reference ID : {{ $order->operation_id }}</p>@endif
                    @if($order->payment_method == "nabil")
                        <p>Nabil Order ID : {{ $order->nabil_order_id }}</p>
                        <p>Nabil Session ID : {{ $order->nabil_session_id }}</p>
                        <p>PAN : {{ $order->pan }}</p>
                        <p>Expiry Date : {{ $order->expiry_date }}</p>
                        <p>CAVV : {{ $order->cavv }}</p>
                        @if($order->customer_details != "")<p>Customer Details : Email - {{ json_decode($order->customer_details)->email }} <br/>
                            Phone - {{ json_decode($order->customer_details)->phone }}</p>@endif
                    @endif

                </div>
            </div>
            <!-- /tabs -->
        </div>
    </div>
@endsection
