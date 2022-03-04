@extends('master-layouts.app-master-layouts.app-master-layout-super-admin')

@section('page-header')
    <div class="panel page-header page-header-xs border-bottom-teal">

        <div class="page-header-content">
            <div class="page-title">
                <h6>
                    <span class="text-semibold">Edit Course Orders</span>
                    
                <span class="pull-right custom-breadcrumb">

                     <ul class="breadcrumb">
                         <li><a href="{{ route('super-admin-dashboard') }}"><i class="icon-home2 position-left"></i> Home</a></li>
                         <li><a href="{{ route('course-orders.failed-orders') }}">Failed Course Orders</a></li>
                         <li class="active">Edit Failed Course Orders</li>
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
        <div class="panel panel-flat">
            @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <div class="panel-body">
                <div class="tabbable">
                    <ul class="nav nav-tabs nav-tabs-bottom">
                        <li class="active"><a href="#bottom-tab1" data-toggle="tab">Course Orders</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="bottom-tab1">

                            <div class="panel-heading">
                                <h5 class="panel-title"><i class="icon-reading position-left"></i> Add Test</h5>
                            </div>

                            <div class="panel-body">
                                <div class="row add-new">
                                    <div class="col-md-12">
                                    <form action="{{ route('course.orders.failed.update', $course_order->id) }}">
                                        {{ csrf_field() }}

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="memberNo">Member No.</label>
                                                    <input type="text" name="member_no" id="memberNo" value="{{ $course_order->user->serial_no }}" class="form-control" disabled>
                                                </div>        
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="memberName">Member Name</label>
                                                    <input type="text" name="user" id="memberName" value="{{ $course_order->user->full_name }}" class="form-control" disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="payment">Payment Status</label>
                                                    <select name="payment" id="payment" class="form-control">
                                                        <option value="">-- Select Payment Status --</option>
                                                        <option value="paid" {{ $course_order->payment == "paid" ? "selected" : "" }}>Paid</option>
                                                        <option value="unpaid" {{ $course_order->payment == "unpaid" ? "selected" : "" }}>Unpaid</option>
                                                        <option value="failed" {{ $course_order->payment == "failed" ? "selected" : "" }}>Failed</option>
                                                    </select>
                                                </div>        
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="paymentMethod">Payment Method</label>
                                                    <select name="payment_method" id="paymentMethod" class="form-control">
                                                        <option value="">-- Select Payment Method --</option>
                                                        <option value="esewa" {{ $course_order->payment_method == "esewa" }} {{ $course_order->payment_method != null ? "disabled" : "" }}>Esewa</option>
                                                        <option value="Connect Ips" {{ $course_order->payment_method == "Connect Ips" ? "selected" : "" }} {{ $course_order->payment_method != null ? "disabled" : "" }}>Connect IPS</option>
                                                        <option value="HBL" {{ $course_order->payment_method == "HBL" ? "selected" : "" }} {{ $course_order->payment_method != null ? "disabled" : "" }}>Himalayan Bank</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="referenceNo">Reference No.</label>
                                                    <input type="text" name="operation_id" id="referenceNo" value="{{ $course_order->operation_id }}" class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="paidDate">Paid Date</label>
                                                    <input type="datetime-local" name="paid_date" id="paidDate" value="{{ $course_order->paid_datetime }}" class="form-control">
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Update Button -->
                                        <div class="text-right">
                                            <button type="submit" class="btn btn-primary btn-lg">Update <i class="icon-arrow-right14 position-right"></i></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- tab-content -->
                </div>
                <!-- tabbable -->
            </div>
            <!-- panel body -->
        </div>  <!-- panl flat -->
    </div>
@endsection

