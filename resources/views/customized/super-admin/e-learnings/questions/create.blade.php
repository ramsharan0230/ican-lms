@extends('layouts.super-admin.master')
@section('title', 'Add Lesson')
@push('styles')
@endpush
@section('content')

<div class="pagetitle">
    <h1>Add Lesson</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('super-admin-dashboard') }}">Home</a></li>
        <li class="breadcrumb-item active">Add Lesson</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->
  {{-- new datatable-column-search-inputs --}}
  <section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Add Lesson</h3>
                </div>
                <div class="card-body">
                    <form action="{{route('lessons.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name">Title</legend>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Enter Lesson title ..." value="{{ old('name')}}">
                            @if($errors->has('name'))
                                <label class="validation-error-label">{{ $errors->first('name') }}</label>
                            @endif
                        </div>
                        
                        <div class="form-group">
                            <label for="credit_hour">Display Name</legend>
                            <input type="text" name="credit_hour" class="form-control" placeholder="Enter category credit_hour ..." value="{{ old('credit_hour')}}">
                            @if($errors->has('credit_hour'))
                                <label class="validation-error-label">{{ $errors->first('credit_hour') }}</label>
                            @endif
                        </div>

                        <div class="form-group">
                            <div class="row mb-3">
                                <legend class="col-form-label col-sm-2 pt-0">Publish</legend>
                                <div class="col-sm-10">
                                  <div class="form-check">
                                    <input class="form-check-input" type="radio" name="published_status" id="published_status" value="1" checked>
                                    <label class="form-check-label" for="published_status">
                                      Yes
                                    </label>
                                  </div>
                                  <div class="form-check">
                                    <input class="form-check-input" type="radio" name="published_status" id="gridRadios2" value="0">
                                    <label class="form-check-label" for="gridRadios2">
                                      No
                                    </label>
                                  </div>
                                  
                                </div>
                                @if($errors->has('published_status'))
                                    <label class="validation-error-label">{{ $errors->first('published_status') }}</label>
                                @endif
                            </div>
                        </div>
                       
                        <div class="row">
                            <div class="form-group">
                                <label for="lesson_content">Description</label>
                                <textarea name="lesson_content" id="lesson_content" class="tinymce-editor"></textarea>
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