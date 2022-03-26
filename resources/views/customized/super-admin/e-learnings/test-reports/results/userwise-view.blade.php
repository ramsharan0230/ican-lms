@extends('layouts.super-admin.master')
@section('title', 'Test Reports')
@push('styles')
<link href="{{ asset('assets/vendor/simple-datatables/style.css')}}" rel="stylesheet">
@endpush
@section('content')

<div class="pagetitle">
    <h1>
        <span class="text-semibold">Test Report: {{ $user->first_name .' '. $user->last_name }} ({{ $user->username }})</span>
    </h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('super-admin-dashboard') }}">Home</a></li>
        <li class="breadcrumb-item active">Userwise report</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->
  {{-- new datatable-column-search-inputs --}}
  <section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-header">
            <div class="row">
              <div class="col-sm-9">
                <h3 class="card-title">
                    <span class="text-semibold">Test Report: {{ $user->first_name .' '. $user->last_name }} ({{ $user->username }})</span>
                </h3>
              </div>
              <div class="col-sm-3">
                <a class="btn btn-primary btn-sm pull-right" href="{{ url()->previous() }}"><i class="bi bi-arrow-left-circle"></i> Go Back</a>
              </div>
            </div>

          </div>
          <div class="card-body">
            <table class="table datatable-column-search-inputs">
                <thead>
                <tr>
                    <th>Test</th>
                    <th>Result ID</th>
                    <th>Date</th>
                    <th>IP</th>
                    <th>Country</th>
                    <th class="text-center">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($test_results as $result)
                    <tr>
                        <td>@if(isset($result->test)) {{ $result->test->name }} @endif</td>
                        <td>{{ $result->id }}</td>
                        <td>{{ date('d,F, Y', strtotime($result->created_at)) }}</td>
                        <td>{{ $result->user_ip }}</td>
                        <td>{{ $result->user_country }}</td>
                        <td class="text-center">
                            <a href="{{ route('e-learning.tests.result', $result->id) }}" class="btn btn-info">View</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
          </div>
        </div>

      </div>
    </div>
  </section>
@endsection

@section('scripts')
<script src="{{ asset('assets/vendor/simple-datatables/simple-datatables.js')}}"></script>

@endsection