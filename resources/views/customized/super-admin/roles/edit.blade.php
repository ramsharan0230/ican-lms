{{-- new codee --}}{{-- new design --}}

@extends('layouts.super-admin.master')
@section('title', 'Edit Role')
@push('styles')
<link href="{{ asset('assets/vendor/simple-datatables/style.css')}}" rel="stylesheet">
@endpush
@section('content')

<div class="pagetitle">
    <h1>Edit Role</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('super-admin-dashboard') }}">Home</a></li>
        <li class="breadcrumb-item active">Edit Role</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->
  {{-- new datatable-column-search-inputs --}}
  <section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Edit Role</h5>
            
            <!-- Table with stripped rows -->
            {!! Form::model($role, ['method' => 'PATCH', 'route' => ['roles.update', $role->id] ]) !!}
                {{ csrf_field() }}
                <div class="col-md-12">
                    <div class="form-group {{ (!$errors->has('name') ? : 'has-error') }}">

                        <label for="name" class="{{ (!$errors->has('name') ? : 'text-danger') }}">Role Name </label> <span
                                class="text-danger pull-right"><i class="glyphicon glyphicon-asterisk"></i> Required</span>

                        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter role name', 'required']) !!}

                        @if($errors->has('name'))
                            <label class="validation-error-label">{{ $errors->first('name') }}</label>
                        @endif

                    </div>
                </div>
                <div class="col-sm-12">
                    <label>
                        <input type="checkbox" id="select_all" />
                        Select All
                    </label>
                </div>

                <div class="row">
                    <legend class="text-semibold">Choose Permissions</legend>
                    
                    <div class="col-md-3">
                        <h6>Manage Roles Permissions</h6>
                        @foreach($roles_permissions as $role_permission)
                            <div class="checkbox">
                                <label>
                                    {!! Form::checkbox('permissions[]', $role_permission->id, Request::old('permissions'), ['class' => 'control-info', 'id' => 'check-mate']) !!}
                                    {{ $role_permission->description }}
                                </label>
                            </div>
                        @endforeach
        
                        {{-- <div class="form-group{{ $errors->has('meta_tags') ? ' has-error' : '' }}">
                            {{ Form::label('meta_tags', 'Meta Tags: ') }}
                            <div>
                                @foreach($meta_tags as $tags)
                                    {{ Form::checkbox('meta_tags[]', $tags->id, $meta_details && $meta_details->tags->contains($tags->id) ? true : false) }} {{ $tags->name }}
                                @endforeach    
                            </div>
                        </div> --}}
                    </div>
        
                    <div class="col-md-3">
                        <h6>Manage Categories Permissions</h6>
                        @foreach($categories_permissions as $category_permission)
                            <div class="checkbox">
                                <label>
                                    {!! Form::checkbox('permissions[]', $category_permission->id, Request::old('permissions'), ['class' => 'control-info']) !!}
                                    {{ $category_permission->description }}
                                </label>
                            </div>
                        @endforeach
                    </div>
        
                    <div class="col-md-3">
                        <h6>Manage Courses Permissions</h6>
                        @foreach($courses_permissions as $course_permission)
                            <div class="checkbox">
                                <label>
                                    {!! Form::checkbox('permissions[]', $course_permission->id, Request::old('permissions'), ['class' => 'control-info']) !!}
                                    {{ $course_permission->description }}
                                </label>
                            </div>
                        @endforeach
                    </div>
        
                    <div class="col-md-3">
                        <h6>Manage Users Permissions</h6>
                        @foreach($users_permissions as $users_permission)
                            <div class="checkbox">
                                <label>
                                    {!! Form::checkbox('permissions[]', $users_permission->id, Request::old('permissions'), ['class' => 'control-info']) !!}
                                    {{ $users_permission->description }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="row">
                    <legend class="text-semibold"></legend>
        
                    <div class="col-md-3">
                        <h6>Manage Lessons Permissions</h6>
                        @foreach($lessons_permissions as $lesson_permission)
                            <div class="checkbox">
                                <label>
                                    {!! Form::checkbox('permissions[]', $lesson_permission->id, Request::old('permissions'), ['class' => 'control-info']) !!}
                                    {{ $lesson_permission->description }}
                                </label>
                            </div>
                        @endforeach
                    </div>
        
                    <div class="col-md-3">
                        <h6>Manage Assign Course Permissions</h6>
                        @foreach($assign_courses_permissions as $assign_course_permission)
                            <div class="checkbox">
                                <label>
                                    {!! Form::checkbox('permissions[]', $assign_course_permission->id, Request::old('permissions'), ['class' => 'control-info']) !!}
                                    {{ $assign_course_permission->description }}
                                </label>
                            </div>
                        @endforeach
                    </div>
        
                    <div class="col-md-3">
                        <h6>Manage Questions Permissions</h6>
                        @foreach($questions_permissions as $question_permission)
                            <div class="checkbox">
                                <label>
                                    {!! Form::checkbox('permissions[]', $question_permission->id, Request::old('permissions'), ['class' => 'control-info']) !!}
                                    {{ $question_permission->description }}
                                </label>
                            </div>
                        @endforeach
                    </div>
        
                    <div class="col-md-3">
                        <h6>Manage Tests Permissions</h6>
                        @foreach($tests_permissions as $test_permission)
                            <div class="checkbox">
                                <label>
                                    {!! Form::checkbox('permissions[]', $test_permission->id, Request::old('permissions'), ['class' => 'control-info']) !!}
                                    {{ $test_permission->description }}
                                </label>
                            </div>
                        @endforeach
                    </div>
        
                </div>

                <div class="row">
                    <fieldset class="text-semibold">
                        <div class="col-md-12">
                            <div class="form-group">
                                {!! Form::label('description', 'Description', null, null) !!}
                                {!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => 8]) !!}
                            </div>
                        </div>
                    </fieldset>
                </div>
        
                <div class="text-right">
                    <button type="submit" class="btn btn-primary btn-lg">Save <i
                                class="icon-arrow-right14 position-right"></i></button>
                </div>
            {!! Form::close() !!}
            <!-- End Table with stripped rows -->

          </div>
        </div>

      </div>
    </div>
  </section>
  {{-- end new datatable-column-search-inputs --}}


@endsection

@push('scripts')
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script language="JavaScript">
    $('#select_all').click(function(event) {
      if(this.checked) {
          // Iterate each checkbox
          $(':checkbox').each(function() {
              this.checked = true;
          });
      }
      else {
        $(':checkbox').each(function() {
              this.checked = false;
          });
      }
    });
</script>

@endpush
