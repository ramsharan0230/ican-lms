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
            <div class="page-header-content">
                <div class="page-title">
                    <h6>
                        <a href="{{ route('CPE_EXPORT-COURSE-PAYMENT-REPORT') }}" class="btn btn-primary">Export</a>
                        <a href="{{ route('CPE_EXPORT-COURSE-PAYMENT-REPORT_FISCAL') }}" class="btn btn-primary">Export Fiscal Year wise</a>
                    </h6>
                </div>
            </div>
            {{-- end new --}}
            <!-- Table with stripped rows -->
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
            <!-- End Table with stripped rows -->
            <!-- Basic Pagination -->
            {{-- <nav aria-label="Page navigation example">
                {{ $orders->render("pagination::bootstrap-4") }}
            </nav><!-- End Basic Pagination --> --}}
          </div>
        </div>

      </div>
    </div>
  </section>
@endsection

@section('scripts')
<script src="{{ asset('assets/vendor/simple-datatables/simple-datatables.js')}}"></script>

@endsection