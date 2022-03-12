{{-- new ddd --}}

@extends('layouts.super-admin.master')
@section('title', 'Add Course')
@push('styles')
@endpush
@section('content')

<div class="pagetitle">
    <h1>Add Course</h1>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('super-admin-dashboard') }}"><strong>Home</strong> </a></li>
        <li><a href="{{ route('courses.index') }}"><strong>Courses</strong></a>/</li>
        <li class="breadcrumb-item active">Add Course</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->
  {{-- new datatable-column-search-inputs --}}
  <section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3>Add Course</h3>
                </div>
                <div class="card-body">
                    {!! Form::open(['route' => 'courses.store', 'class'=>'form-horizontal']) !!}
                    <div class="row">
                        <select class="form-control selectpicker" id="select-country" data-live-search="true">
                            <option data-tokens="china">China</option>
                                <option data-tokens="malayasia">Malayasia</option>
                                <option data-tokens="singapore">Singapore</option>
                        </select>
                    </div>
                    <div class="panel panel-flat">
                        <div class="panel-body">
                            <div class="row">
                                <fieldset class="text-semibold">
                                    <legend>Course Form</legend>
                    
                                    <div class="form-group">
                    
                                        <label for="lesson_name"
                                               class="control-label col-md-2 {{ (!$errors->has('name') ? : 'text-danger') }}">Name
                                            <span class="text-danger pull-right"><i
                                                        class="glyphicon glyphicon-asterisk"></i> Required</span></label>
                    
                                        <div class="col-md-10">
                                            {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter Course Name']) !!}
                    
                                            @if($errors->has('name'))
                                                <label class="validation-error-label">{{ $errors->first('name') }}</label>
                                            @endif
                    
                                        </div>
                                    </div>
                    
                                </fieldset>
                            </div>
                    
                            <div class="row">
                    
                                <fieldset class="text-semibold">
                    
                                    <div class="form-group">
                                        <label for="display_name" class="control-label col-md-2">Display Name</label>
                    
                                        <div class="col-md-10">
                                            {!! Form::text('display_name', null, ['class' => 'form-control', 'placeholder' => 'Display Name'])
                                            !!}
                                        </div>
                                    </div>
                    
                                </fieldset>
                            </div>
                    
                            <div class="row">
                    
                                <fieldset class="text-semibold">
                    
                                    <div class="form-group">
                                        <label for="category_id" class="control-label col-md-2">Category</label>
                    
                                        <div class="col-md-10">
                                            {!! Form::select('category_id', $categories, null, ['class' => 'select-search', 'required' => 'required']) !!}
                                        </div>
                                    </div>
                    
                                </fieldset>
                            </div>
                    
                            
                            <div class="row">
                    
                                <fieldset class="text-semibold">
                    
                                    <div class="form-group">
                                        <label for="price" class="control-label col-md-2">Price</label>
                    
                                        <div class="col-md-10">
                                            {!! Form::input('number','price', null, ['class' => 'form-control', 'placeholder' => 'Selling Price of this lesson'])
                                            !!}
                                        </div>
                                    </div>
                    
                                </fieldset>
                            </div>
                    
                            <div class="row">
                    
                                <fieldset class="text-semibold">
                    
                                    <div class="form-group">
                                        <label for="cpe_price" class="control-label col-md-2">Cpe Price</label>
                    
                                        <div class="col-md-10">
                                            {!! Form::input('number','cpe_price', null, ['class' => 'form-control', 'placeholder' => 'cpe price'])
                                            !!}
                                        </div>
                                    </div>
                    
                                </fieldset>
                            </div>
                    
                            <div class="row">
                    
                                <fieldset class="text-semibold">
                    
                                    <div class="form-group">
                                        <label for="for_days" class="control-label col-md-2">For Days</label>
                    
                                        <div class="col-md-10">
                                            {!! Form::input('number', 'for_days', null, ['class' => 'form-control', 'placeholder' => 'Enter No of Days'])
                                            !!}
                                        </div>
                                    </div>
                    
                                </fieldset>
                            </div>
                            
                            
                            <div class="row">
                                <fieldset class="text-semibold">
                    
                                    <div class="form-group">
                                        <label for="video" class="control-label col-md-2">Vimeo Video</label>
                    
                                        <div class="col-md-10">
                                            {!! Form::input('text', 'video', null, ['class' => 'form-control', 'placeholder' => 'Video code'])
                                            !!}
                                        </div>
                                    </div>
                    
                                </fieldset>
                            </div>
                            <div class="row">
                                @if(isset($course->video) && !empty($course->video))
                                <iframe title="vimeo-player" src="https://player.vimeo.com/video/{{$course->video}}" width="400" height="250" frameborder="0" allowfullscreen></iframe>
                                @endif
                            </div>
                    
                    
                    
                            <div class="row">
                    
                                <fieldset class="text-semibold">
                    
                                    <div class="form-group">
                                        <label for="for_days" class="control-label col-md-2">Video time</label>
                                        <p> In minutes .Example 2 hr 54 min equal to 152.4</p>
                                        <div class="col-md-10">
                                            {!! Form::input('number', 'video_time', null, ['class' => 'form-control', 'placeholder' => '152.4'])
                                            !!}
                                        </div>
                                    </div>
                    
                                </fieldset>
                            </div>
                            
                            
                            <div class="row">
                    
                                <fieldset class="text-semibold">
                    
                                    <div class="form-group">
                                        <label for="you_tube_video" class="control-label col-md-2">Youtube Video</label>
                    
                                        <div class="col-md-10">
                                            {!! Form::input('text', 'you_tube_video', null, ['class' => 'form-control', 'placeholder' => 'Youtube Video code'])
                                            !!}
                                        </div>
                                    </div>
                    
                                </fieldset>
                            </div>
                    
                                <div class="row">
                                        @if(isset($course->you_tube_video) && !empty($course->you_tube_video))
                                            <iframe width="400" height="250" src="https://www.youtube.com/embed/{{$course->you_tube_video}}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> 
                                        @endif
                                </div>
                    
                                <div class="row">
                                    <fieldset class="text-semibold">
                                        <div id="question-true-false-answer" class="form-group {{ (!$errors->has('lesson_name') ? : 'has-error') }}">
                    
                                            <label for="lesson_name"
                                                class="control-label col-md-2 {{ (!$errors->has('lesson_name') ? : 'text-danger') }}">
                                                Published Status
                                            </label>
                    
                                            <div class="col-md-10">
                                                <label class="radio-inline">
                                                    {{ Form::radio('published_status', 1, null, ['class' => 'control-info']) }} Yes
                                                </label>
                                                <label class="radio-inline">
                                                    {{ Form::radio('published_status', 0, null, ['class' => 'control-info']) }} No
                                                </label>
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>
                    
                                <div clas="row">
                                    <fieldset class="text-semibold">
                    
                                        <!-- Multiple selection -->
                                        <div class="form-group">
                                            {!! Form::label('course_lessons', 'Choose Lessons For This Course', null, null) !!}
                                            {{ Form::select('course_lessons[]', $lessons, $course ? $course->lessons->lists('id')->toArray() : null, ['class' => 'form-control listbox-no-selection', 'multiple', 'required' => 'required']) }}
                                        </div>
                                        <!-- /multiple selection -->
                                    </fieldset>
                                </div>
                    
                                <div class="row">
                                    <fieldset class="text-semibold">
                    
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="term">Description</label>
                    
                                                {!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => 5, 'id' => 'course-description-editor']) !!}
                                            </div>
                                        </div>
                    
                                    </fieldset>
                                </div>
                            
                            <div class="text-right">
                                <button type="submit" class="btn btn-primary btn-lg">Save <i
                                            class="icon-arrow-right14 position-right"></i></button>
                            </div>
                        </div>
                        
                        <h3>Finding the embed code on Vimeo:</h3>
                    
                        <p>1.Go to Vimeo.</p>
                        <p>2.Navigate to the video you wish to embed.</p>
                        <p>3.Click the Share button, in the top right corner of your video.</p>
                        <p>4.A pop-up will appear with the embed link information. You will need to copy the embed link in order to add it to your page in the Employer Center.</p>
                        <hr>
                        
                        <h3>Finding the embed code on YouTube:</h3>
                    
                        <p>1.Go to YouTube.</p>
                        <p>2.Navigate to the video you wish to embed.</p>
                        <p>3.Click the Share link below the video, then click the Embed link.</p>
                        <p>4.The embed link will be highlighted in blue. You will need to copy this link in order to add it to your page in the Employer Center.</p>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
            
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>
@endpush