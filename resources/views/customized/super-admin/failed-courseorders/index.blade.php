@extends('layouts.super-admin.master')
@section('title', 'Failed Course Orders')
@push('styles')
<link href="{{ asset('assets/vendor/simple-datatables/style.css')}}" rel="stylesheet">
@endpush
@section('content')

<div class="pagetitle">
    <h1>Courses</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('super-admin-dashboard') }}">Home</a></li>
        <li class="breadcrumb-item active">Failed Course Orders</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->
  {{-- new datatable-column-search-inputs --}}
  <section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Failed Course Orders</h5>
            {{-- new --}}
            <div class="row">
                <div class="col-md-6">
                    {{ Form::open(array('route' => 'course.orders.failed.search', 'method' => 'get', 'style'=>' display:flex; align-items:center')) }}
                    <div class="date-filer-wrapper" style="padding: 0px 20px; font-size: 16px; display:flex;">
                        <label>
                            From: <input type="date"  class="form-control" name="from_date" id="fromDate" value="{{ app('request')->input('from_date') }}">
                        </label>
                        <label>
                            To: <input type="date"  class="form-control" name="to_date" id="toDate" value="{{ app('request')->input('to_date') }}">
                        </label>
                        <!--<button class="btn btn-primary btn-sm ml-2" id="clearDateFilter">Clear Date Filter</button>-->    
                        <button type="submit" class="btn btn-primary mt-4" style="margin-left: 5px"> <i class="fa fa-filter"></i> Filter</button>
                    </div>
                    {{ Form::close() }}
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-sm-6">
                            {{ Form::open(array('route' => 'EXPORT-FAILED-COURSE-PAYMENT-REPORT', 'method' => 'post')) }}
                                <button type="submit" class="btn btn-primary">Export</button>
                            {{ Form::close() }}
                        </div>
                        <div class="col-sm-6">
                            <a href="{{ route('EXPORT-FAILED-COURSE-PAYMENT-REPORT_FISCAL') }}" class="btn btn-primary">Export Fiscal Year wise</a>
                        </div>
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
                        <td>{{ $order->created_at?$order->created_at->format('d M, Y'):'' }}</td>
                        <td class="text-center">
                            <a href="{{ route('course-orders.show', $order->id) }}"><i
                                class="bi bi-eye"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <!-- End Table with stripped rows -->
            <!-- Basic Pagination -->
            <nav aria-label="Page navigation example">
                {{ $orders->render("pagination::bootstrap-4") }}
            </nav><!-- End Basic Pagination -->
          </div>
        </div>

      </div>
    </div>
  </section>
@endsection

@section('scripts')
<script src="{{ asset('assets/vendor/simple-datatables/simple-datatables.js')}}"></script>

@endsection