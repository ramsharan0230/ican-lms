@extends('layouts.super-admin.master')
@section('title', 'Categories')
@push('styles')
@endpush
@section('content')

<div class="pagetitle">
    <h1>Categories</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('super-admin-dashboard') }}">Home</a></li>
        <li class="breadcrumb-item active">Categories</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->
  {{-- new datatable-column-search-inputs --}}
  <section class="section">
    <div class="row">
        <div class="col-lg-12">

        </div>
    </div>
</section>
@endsection

@section('scripts')

@endsection