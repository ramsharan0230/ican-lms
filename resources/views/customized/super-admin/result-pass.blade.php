@extends('layouts.super-admin.master')
@section('title', 'Pass Test Results')
@push('styles')
<link href="{{ asset('assets/vendor/simple-datatables/style.css')}}" rel="stylesheet">
@endpush
@section('content')

<div class="pagetitle">
    <h1>Pass Results</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('super-admin-dashboard') }}">Home</a></li>
        <li class="breadcrumb-item active">Pass Results</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->
  {{-- new datatable-column-search-inputs --}}
  <section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Pass Results</h5>
            </div>
          <div class="card-body">
            {{-- new --}}
            <div class="page-title mt-2 mb-2">
                <a href="{{ route('EXPORT-TEST-REPORT_PASS') }}" class="btn btn-primary"><i class="icon-file-excel"></i> &nbsp;&nbsp;Export Excel Sheet</a>
                <a href="{{ route('EXPORT-TEST-REPORT_PASS_FISCAL') }}" class="btn btn-success"><i class="icon-file-excel"></i> &nbsp;&nbsp;Export Excel Sheet Fiscal Year Wise</a>
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
                @if(get_result_check($result->id,$result))
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
            </table>
            <!-- End Table with stripped rows -->
          </div>
          <div class="card-footer">
                <div class="pagination justify-content-center">
                    <!-- Basic Pagination -->
                    <nav aria-label="Page navigation example">
                        {{ $results->render("pagination::bootstrap-4") }}
                    </nav>
                    <!-- End Basic Pagination -->
                </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection