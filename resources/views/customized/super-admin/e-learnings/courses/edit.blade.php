@extends('master-layouts.app-master-layouts.app-master-layout-super-admin')

@section('page-header')
    <div class="panel page-header page-header-xs border-bottom-teal">

        <div class="page-header-content">
            <div class="page-title">
                <h6>
                    <span class="text-semibold">Edit Course</span>
                    
                    <span class="pull-right custom-breadcrumb">
                         <ul class="breadcrumb">
                             <li><a href="index-2.html"><i class="icon-home2 position-left"></i> Home</a></li>
                             <li><a href="components_page_header.html">Current</a></li>
                             <li class="active">Location</li>
                         </ul>
                    </span>
                </h6>
            </div>
            <div class="heading-elements">
                <a href="#" class="btn btn-primary btn-float btn-rounded heading-btn"><i
                            class="glyphicon glyphicon-edit"></i></a>
                <a href="#" class="btn btn-success btn-float btn-rounded heading-btn"><i class="icon-google-drive"></i></a>
                <a href="#" class="btn btn-info btn-float btn-rounded heading-btn"><i class="icon-twitter"></i></a>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="content">

        <!-- 2 columns form -->
        {!! Form::model($course, ['method' => 'PATCH', 'route' => ['e-learning.courses.update', $course->id], 'class' => 'form-horizontal' ]) !!}
            @include('super-admin.e-learnings.courses.partials.partial-create-update-course')
        {!! Form::close() !!}
        <!-- /2 columns form -->
    </div>
@endsection