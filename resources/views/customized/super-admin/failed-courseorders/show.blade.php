@extends('layouts.super-admin.master')
@section('title', $order->user->first_name .' '.$order->user->last_name)
@push('styles')
<link href="{{ asset('assets/vendor/simple-datatables/style.css')}}" rel="stylesheet">
@endpush
@section('content')

<div class="pagetitle">
    <h1>Course Orders</h1>
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
            <div class="card-header">
                <h3 class="card-title">{{ $order->user->first_name }} {{ $order->user->last_name }}</h3>
            </div>
          <div class="card-body">
              <div class="p-2">
                <p class="card-text">Order ID : {{ $order->id }}</p>
                @if(isset($order->user))<p class="pd-2">Ordered By : {{ $order->user->first_name }} {{ $order->user->last_name }}</p>@endif
                @if(isset($order->course))<p class="pd-2">Course Name : {{ $order->course->name }}</p>@endif
                <p class="pd-2">Status : {{ $order->payment }}</p>
                @if($order->payment == "paid")<p class="pd-2">Payment Method : {{ $order->payment_method }}</p>@endif
                <p class="pd-2">Amount : {{ $order->paid_amount }}</p>
                @if($order->payment == "paid")<p class="pd-2">Reference ID : {{ $order->operation_id }}</p>@endif
                @if($order->payment_method == "nabil")
                    <p class="pd-2">Nabil Order ID : {{ $order->nabil_order_id }}</p>
                    <p class="pd-2">Nabil Session ID : {{ $order->nabil_session_id }}</p>
                    <p class="pd-2">PAN : {{ $order->pan }}</p>
                    <p class="pd-2">Expiry Date : {{ $order->expiry_date }}</p>
                    <p class="pd-2">CAVV : {{ $order->cavv }}</p>
                    @if($order->customer_details != "")<p class="pd-2">Customer Details : Email - {{ json_decode($order->customer_details)->email }} <br/>
                        Phone - {{ json_decode($order->customer_details)->phone }}</p>@endif
                @endif
              </div>
          </div>
        </div>
    </div>
</div>
@endsection
