@extends('layouts.super-admin.master')
@section('title', 'Userwise Test Reports')
@push('styles')
<link href="{{ asset('assets/vendor/simple-datatables/style.css')}}" rel="stylesheet">
@endpush
@section('content')

<div class="pagetitle">
    <h1>Test report userwise</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('super-admin-dashboard') }}">Home</a></li>
        <li class="breadcrumb-item active">Test report userwise</li>
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
                <h3 class="card-title">Test report userwise</h3>
              </div>
              <div class="col-sm-3">
                <a href="{{ route('EXPORT-TEST-REPORT') }}" class="btn btn-primary">Export</a>
              </div>
            </div>

          </div>
          <div class="card-body">
                <table class="table datatable-column-search-inputs">
                    <thead>
                    <tr>
                        <th>Serial no.</th>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Published Status</th>
                        <th>Test Results</th>
                        <th class="text-center">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->serial_no }}</td>
                            <td>{{ $user->first_name .' '. $user->middle_name .' '.$user->last_name }}</td>
                            <td>{{ $user->username }}</td>
                            <td>{!! $user->active_status ? '<p class="label label-success">Active</p>' : '<p class="label label-default">Disabled</p>' !!}</td>
                            <td>{{ $user->test_results->count()}}</td>
                            <td class="text-center">
                                <a href="{{ route('e-learning.test-report.userwise.view', $user->id) }}" class="btn btn-info">View</a>
                            </td>
                        </tr>
    
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <td>Serial no.</td>
                        <td>Name</td>
                        <td>Username</td>
                        <td>Published Status</td>
                        <td>Test Results</td>
                        <td class="text-center">Actions</td>
                    </tr>
                    </tfoot>
                </table>

                <!-- Basic Pagination -->
            <nav aria-label="Page navigation example">
                {{ $users->render("pagination::bootstrap-4") }}
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