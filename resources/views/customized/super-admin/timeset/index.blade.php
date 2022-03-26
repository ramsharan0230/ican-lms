@extends('layouts.super-admin.master')
@section('title', 'Time Set')
@push('styles')
<link href="{{ asset('assets/vendor/simple-datatables/style.css')}}" rel="stylesheet">
@endpush
@section('content')

<div class="pagetitle">
    <h1>Set Time</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('super-admin-dashboard') }}">Home</a></li>
        <li class="breadcrumb-item active">Set Time</li>
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
                <h3 class="card-title">Set Time</h3>
              </div>
            </div>

          </div>
          <div class="card-body">
              @foreach($data as $editdata)
              {!! Form::model($editdata, ['method' => 'PATCH', 'route' => ['time_set.update', $editdata->id] ]) !!}
              <ol class="list-group list-group mb-2">
                <li class="list-group-item">
                  <div class="form-group">
                    <label for="start_date">Start Date</label>
                    {!! Form::text('start_date', old('start_date'), ['class' => 'form-control',]) !!}
                  </div>
                </li>

                <li class="list-group-item">
                  <div class="form-group">
                    <label for="end_date">End Date</label>
                    {!! Form::text('end_date', old('end_date'), ['class' => 'form-control',]) !!}
                  </div>
                </li>
                <li class="list-group-item">
                  <input class="btn btn-secondary btn-sm" type="submit" value="Submit">
                </li>
              </ol>
              {!! Form::close() !!}
              @endforeach
          </div>
        </div>

      </div>
    </div>
  </section>
@endsection

@section('scripts')
<script src="{{ asset('assets/vendor/simple-datatables/simple-datatables.js')}}"></script>

@endsection