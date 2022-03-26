{{-- new --}}
@extends('layouts.super-admin.master')
@section('title', 'Tests Datewise Report')
@push('styles')
<link href="{{ asset('assets/vendor/simple-datatables/style.css')}}" rel="stylesheet">
@endpush
@section('content')

<div class="pagetitle">
    <h1>Tests Datewise Report</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('super-admin-dashboard') }}">Home</a></li>
        <li class="breadcrumb-item active">Tests Datewise Report</li>
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
                <h3 class="card-title">Tests Datewise Report</h3>
              </div>
              <div class="col-sm-3">
                {{-- <a href="{{ route('EXPORT-TEST-REPORT') }}" class="btn btn-primary">Export</a> --}}
              </div>
            </div>

          </div>
          <div class="card-body">

            {!! Form::open(['route' => 'e-learning.test-report.datewise.search', 'method' => 'GET']) !!}
            <div class="row">
              <div class="col-sm-4">
                  <div class="form-group{{ $errors->has('from') ? ' has-error' : '' }}">
                    {{ Form::label('from', 'From: ') }}
                    {!! Form::date('from', Request::get('from') ?: Request::old('from'), ['class' => 'form-control', 'required' => 'required']) !!}
                    @if($errors->has('from'))
                        <span class="help-block">{{ $errors->first('from') }}</span>
                    @endif
                  </div>
              </div>
              <div class="col-sm-4">
                  <div class="form-group{{ $errors->has('to') ? ' has-error' : '' }}">
                  {{ Form::label('to', 'To: ') }}
                  {!! Form::date('to', Request::get('to') ?: Request::old('to'), ['class' => 'form-control', 'required' => 'required']) !!}
                  @if($errors->has('to'))
                      <span class="help-block">{{ $errors->first('to') }}</span>
                  @endif
                  </div>
              </div>
              <div class="col-sm-4">
                <button type="submit" class="btn btn-info mt-4">Search</button>
              </div>
            </div>
            {!! Form::close() !!}
            <hr>
            <table class="table datatable-column-search-inputs">
                <thead>
                <tr>
                    <th>Test</th>
                    <th>Result ID</th>
                    <th>Student Name</th>
                    <th>Student Serial No.</th>
                    <th>Date</th>
                    <th class="text-center">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($test_results as $result)
                    <tr>
                        <td>@if(isset($result->test)) {{ $result->test->name }} @endif</td>
                        <td>{{ $result->id }}</td>
                        <td>@if(isset($result->user)){{ $result->user->first_name .' '. $result->user->last_name }} ({{ $result->user->username ?: 'No username available' }})@endif</td>
                        <td>@if(isset($result->user)){{ $result->user->serial_no }}@endif</td>
                        <td>{{ date('m/d/Y', strtotime($result->created_at)) }}</td>
                        <td class="text-center">
                            <a href="{{ route('e-learning.tests.result', $result->id) }}" class="btn btn-info">View</a>
                        </td>
                    </tr>

                @endforeach
                </tbody>
            </table>

                <!-- Basic Pagination -->
            <nav aria-label="Page navigation example">
                {{ $test_results->render("pagination::bootstrap-4") }}
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