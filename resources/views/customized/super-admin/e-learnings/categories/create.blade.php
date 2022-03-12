@extends('layouts.super-admin.master')
@section('title', 'Add Category')
@push('styles')
@endpush
@section('content')

<div class="pagetitle">
    <h1>Add Category</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('super-admin-dashboard') }}">Home</a></li>
        <li class="breadcrumb-item active">Add Category</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->
  {{-- new datatable-column-search-inputs --}}
  <section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header"></div>
                <div class="card-body">
                    <!-- 2 columns form -->
                    <form action="{{ route('categories.store')}}" method="post">
                    <div class="row">
                        <div class="col-sm-6 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="name">Name</legend>
                                <input type="text" name="name" class="form-control" placeholder="Enter category name ...">
                                @if($errors->has('name'))
                                    <label class="validation-error-label">{{ $errors->first('name') }}</label>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="display_name">Display Name</legend>
                                <input type="text" name="display_name" class="form-control" placeholder="Enter category display_name ...">
                                @if($errors->has('display_name'))
                                    <label class="validation-error-label">{{ $errors->first('display_name') }}</label>
                                @endif
                            </div>
                        </div>
                    </div>
            
                    <div class="row">
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="" id="" class="quill-editor-default" cols="30" rows="10"></textarea>
                        </div>
                    </div>
            
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary btn-lg">Save <i
                                    class="icon-arrow-right14 position-right"></i></button>
                    </div>
                </form>
                    <!-- /2 columns form -->
                </div>
            </div>
            
        </div>
    </div>
</section>
@endsection

@section('scripts')

@endsection