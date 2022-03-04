@extends('layouts.super-admin.master')
@section('title', 'Users')
@push('styles')
<link href="{{ asset('assets/vendor/simple-datatables/style.css')}}" rel="stylesheet">
@endpush
@section('content')

<div class="pagetitle">
    <h1>Users</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('super-admin-dashboard') }}">Home</a></li>
        <li class="breadcrumb-item active">Users</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->
  {{-- new datatable-column-search-inputs --}}
  <section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Users</h5>
            <!-- Table with stripped rows -->
            <form action="{{ route('users.update', $user->id)}}" method="POST">
                @method('PATCH')

                <div class="row mb-3 form-group {{ (!$errors->has('first_name') ? : 'has-error') }}">
                    <label for="first_name" class="col-sm-2 col-form-label">First Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="first_name" name="first_name" value="{{ $user->first_name??old('first_name') }}">
                        @if($errors->has('first_name'))
                            <label class="validation-error-label">{{ $errors->first('first_name') }}</label>
                        @endif
                    </div>
                </div>

                <div class="row mb-3 form-group {{ (!$errors->has('middle_name') ? : 'has-error') }}">
                    <label for="middle_name" class="col-sm-2 col-form-label" >Middle Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="middle_name" name="middle_name" value="{{ $user->middle_name??old('middle_name') }}">
                        @if($errors->has('middle_name'))
                            <label class="validation-error-label">{{ $errors->first('middle_name') }}</label>
                        @endif
                    </div>
                </div>

                <div class="row mb-3 form-group {{ (!$errors->has('last_name') ? : 'has-error') }}">
                    <label for="last_name" class="col-sm-2 col-form-label">Last Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="last_name" name="last_name"  value="{{ $user->last_name??old('last_name') }}">
                        @if($errors->has('last_name'))
                            <label class="validation-error-label">{{ $errors->first('last_name') }}</label>
                        @endif
                    </div>
                </div>

                <div class="row mb-3 form-group {{ (!$errors->has('role_id') ? : 'has-error') }}">
                    <label for="role_id" class="col-sm-2 col-form-label">Choose Role </label>
                    <div class="col-sm-10">
                        {!! Form::select('role_id', $roles, Request::old('role_id'), ['class' => 'select-search']) !!}
                        @if($errors->has('role_id'))
                            <label class="validation-error-label">{{ $errors->first('role_id') }}</label>
                        @endif
                    </div>
                </div>

                <div class="row mb-3 form-group{{ $errors->has('active_status') ? ' has-error' : '' }}">
                    <label for="role_id" class="col-sm-2 col-form-label {{ (!$errors->has('email') ? : 'text-danger') }}">Active Status </label>
                    <div class="col-sm-10">
                        <label class="radio-inline m-t-5">
                            {{-- {{ Form::radio('active_status', 1, null, ['class' => 'control-info']) }} Yes --}}
                            <input type="checkbox" name="active_status" {{ $user->active_status==1?'checked':''}}> Yes
                        </label>
                        <label class="radio-inline m-t-5">
                            <input type="checkbox" name="active_status" {{ $user->active_status==0?'checked':''}}> No
                        </label>
        
                        @if($errors->has('active_status'))
                            <span class="help-block">{{ $errors->first('active_status') }}</span>
                        @endif
                    </div>
                    
                </div>

                <div class="row mb-3 form-group {{ (!$errors->has('email') ? : 'has-error') }}">
                    <label for="email" class="col-sm-2 col-form-label {{ (!$errors->has('email') ? : 'text-danger') }}"> Email</label>
                    <div class="col-sm-10">
                        <input type="text" name="email" class="form-control" value="{{ $user->email??old('email')}}">
                        @if($errors->has('email'))
                            <label class="validation-error-label">{{ $errors->first('email') }}</label>
                        @endif
                    </div>
                </div>

                
                <div class="text-right">
                    <button type="submit" class="btn btn-primary btn-lg">Save <i
                                class="icon-arrow-right14 position-right"></i></button>
                </div>
            <!-- End Table with stripped rows -->
            </form>
          </div>
        </div>

      </div>
    </div>
  </section>
  {{-- end new datatable-column-search-inputs --}}

@endsection

@section('scripts')
<script src="{{ asset('assets/vendor/simple-datatables/simple-datatables.js')}}"></script>

@endsection