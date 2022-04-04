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
            <div class="panel-body">
                <a href="{{ route('EXPORT-TEST-REPORT') }}" class="btn btn-custom btn-lg"><i class="icon-file-excel"></i> &nbsp;&nbsp;Export Excel Sheet</a>
                    <a href="{{ route('EXPORT-TEST-REPORT_FISCAL') }}" class="btn btn-custom btn-lg"><i class="icon-file-excel"></i> &nbsp;&nbsp;Export Excel Sheet FISCAL Year WISE</a>

            </div>

            <table class="table datatable-column-search-inputs">
                <thead>
                <tr>
                    <td>Name</td>
                    <td>Member Serial no.</td>
                    <td>Member Type</td>
                    <td>Test Name</td>
                    <td>Status</td>
                    <td>Test Date</td>
                </tr>
                </thead>
                <tbody>
                @foreach($results as $result)
                    <tr>
                        <td>{{ get_user($result->user_id) }}</td>
                        <td>{{ get_user_serial_no($result->user_id) }}</td>
                        <td>{{ get_user_category($result->user_id) }}</td>
                        <td>{{ get_test($result->test_id) }}</td>
                        <td>{!!get_result($result->id,$result) !!}</td>
                        <td>{{ $result->created_at}}</td>

                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                <td>Name</td>
                    <td>Member Serial no.</td>
                    <td>Member Type</td>
                    <td>Test Name</td>
                    <td>Status</td>
                    <td>Test Date</td>
                </tr>
                </tfoot>
            </table>
            <!-- End Table with stripped rows -->
            <!-- Basic Pagination -->
            <nav aria-label="Page navigation example">
                {{ $results->render("pagination::bootstrap-4") }}
            </nav><!-- End Basic Pagination -->
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection