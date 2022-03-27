@extends('layouts.super-admin.master')
@section('title', 'Course Orders')
@push('styles')
<link href="{{ asset('assets/vendor/simple-datatables/style.css')}}" rel="stylesheet">
@endpush
@section('content')

<div class="pagetitle">
    <h1>Courses</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('super-admin-dashboard') }}">Home</a></li>
        <li class="breadcrumb-item active">Course Orders</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->
  {{-- new datatable-column-search-inputs --}}
  <section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Course Orders</h5>
            {{-- new --}}
            <div class="row">
                <div class="col-md-12" style="display: flex;align-items: center">
                    <div class="date-filer-wrapper" style="padding: 0px 20px; font-size: 16px; display:flex;">
                        <label>
                            From: <input type="date"  class="form-control" name="from_date" id="fromDate" value="{{ app('request')->input('from_date') }}">
                        </label>
                        <label>
                            To: <input type="date"  class="form-control" name="to_date" id="toDate" value="{{ app('request')->input('to_date') }}">
                        </label>
                        <!--<button class="btn btn-primary btn-sm ml-2" id="clearDateFilter">Clear Date Filter</button>-->    
                    </div>
                    {{ Form::open(array('route' => 'course-orders.index', 'method' => 'get', 'style'=>' display:flex; align-items:center')) }}
                    <div class="date-filer-wrapper" style="padding-right: 20px;">
                        
                        <input type="hidden" name="from_date" id="fromDateFilter" value="{{ app('request')->input('from_date') }}">
                        
                        <input type="hidden" name="to_date" id="toDateFilter" value="{{ app('request')->input('to_date') }}">
                        
                        {{-- <input type="hidden" name="payment" id="paymentModeValue"> --}}
                        <label>
                            Payment:
                            <select name="payment" class="form-control" id="payment_mode">
                                <option value="{{null}}" @if(!app('request')->input('payment')) selected @endif>Show All</option>
                                @foreach($paymentMethods as $provider)
                                    @if($provider)
                                        <option name="{{$provider}}" @if(app('request')->input('payment') == $provider) selected @endif>{{$provider}} </option>
                                    @endif
                                @endforeach
                            </select>
                        </label>
                        
                        <!--<button class="btn btn-primary btn-sm ml-2" id="clearDateFilter">Clear Date Filter</button>-->
                    </div>
                    
                        <button type="submit" class="btn btn-primary"> <i class="fa fa-filter"></i> Filter</button>
                    
                    
                    {{ Form::close() }}
                    <div class="col-md-4" style='display: flex; justify-content: space-evenly; padding: 0 20px;'>
                        
        
                            {{ Form::open(array('route' => 'EXPORT-COURSE-PAYMENT-REPORT', 'method' => 'post', )) }}
                                <input type="hidden" name="from_date" id="exportFromDate" value="{{ app('request')->input('from_date') }}">
                                <input type="hidden" name="to_date" id="exportToDate" value="{{ app('request')->input('to_date') }}">
                                
                                <button type="submit" class="btn btn-primary">Export</button>
                                
                            {{ Form::close() }}
        
                            <a href="{{ route('EXPORT-COURSE-PAYMENT-REPORT_FISCAL') }}" style="" class="btn btn-primary">Export Fiscal Year wise</a>
                        
                    </div>
                </div>
            </div>
            {{-- end new --}}
            <!-- Table with stripped rows -->
            <table class="table datatable" id="courseTable">
                <thead>
                <tr>
                    <th>Reference ID</th>
                    <th>Member No.</th>
                    <th>Member Type</th>
                    <!--<th>Subject</th>-->
                    <th>User</th>
                    <th>Course</th>
                    <th>Amount</th>
                    <th>Payment</th>
                    <th>Payment Method</th>
                    <th>Paid Date</th>
                    <th>Created Date</th>
                    <th class="text-center">Actions</th>
                </tr>
                </thead>
                <tbody id="courseTabl   eBody">
                @foreach($orders as $order)
                    <tr>
                        <td>{{ $order->operation_id}}</td>
                        <td>{{ $order->user->serial_no}}</td>
                        <td>{{ $order->user->category}}</td>
                        
                        <td>@if(isset($order->user)){{ $order->user->first_name }} {{ $order->user->last_name }}@endif</td>
                        <td>@if(isset($order->course)){{ $order->course->name }}@endif</td>
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
            <!-- End Table with stripped rows -->
            {{ $orders->appends(app('request')->toArray())->links() }}
          </div>
        </div>

      </div>
    </div>
  </section>
@endsection

@section('scripts')
<script src="{{ asset('assets/vendor/simple-datatables/simple-datatables.js')}}"></script>

@endsection