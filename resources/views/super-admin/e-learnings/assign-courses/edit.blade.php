@extends('master-layouts.app-master-layouts.app-master-layout-super-admin')

@section('additional-theme-js')
    <script type="text/javascript" src="{{ URL::asset('assets/js/plugins/forms/selects/select2.min.js') }}"></script>
@endsection

@section('page-header')
    <div class="panel page-header page-header-xs border-bottom-teal">

        <div class="page-header-content">
            <div class="page-title">
                <h6>
                    <span class="text-semibold">Edit Assigned Course</span>
                    
                <span class="pull-right custom-breadcrumb">

                     <ul class="breadcrumb">
                         <li><a href="{{ route('super-admin-dashboard') }}"><i class="icon-home2 position-left"></i> Home</a></li>
                         <li><a href="{{ route('e-learning.assign-course.index') }}">Assign-Courses</a></li>
                         <li class="active">Edit Assigned Course</li>
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
        {!! Form::model($assign_course, ['method' => 'PATCH', 'route' => ['e-learning.assign-course.update', $assign_course->id] ]) !!}
            @include('super-admin.e-learnings.assign-courses.partials.partial-create-update-assign-course')
        {!! Form::close() !!}
        <!-- /2 columns form -->
    </div>
@endsection

@section('additional-js-code')
    <script>
        $('.select-search').select2();    //to activate select drop down with search functionality...
    </script>
@endsection
