@extends('master-layouts.app-master-layouts.app-master-layout-super-admin')

@section('additional-theme-js')
    <!-- Theme JS files -->
    <script type="text/javascript" src="{{ asset('assets/js/pages/components_popups.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/pages/appearance_panel_heading.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/pages/components_modals.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/custom/css/fullscreen.css')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/custom/js/fullscreen.js')}}"></script>
    <!-- /theme JS files -->
    <style>
        .disable-select {
            -webkit-touch-callout: none;
            -webkit-user-select: none;
            -khtml-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }
    </style>
@endsection

@section('page-header')
    <div class="panel page-header page-header-xs border-bottom-teal">

        <div class="page-header-content">
            <div class="page-title">
                <h6>
                    <span class="text-semibold">View Lesson</span>
                    
                <span class="pull-right custom-breadcrumb">

                     <ul class="breadcrumb">
                         <li><a href="{{ route('super-admin-dashboard') }}"><i class="icon-home2 position-left"></i> Home</a></li>
                         <li><a href="{{ route('e-learning.lessons.index') }}">Lessons</a></li>
                         <li class="active">List Lessons</li>
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
        <div class="col-md-12">
            <!-- Tabs -->
            <div class="panel panel-default" id="lesson-tab-panel-1">
                <div class="panel-heading">
                    <h6 class="panel-title">{{ $lesson->name }}</h6>

                    <div class="heading-elements panel-tabs">
                        <ul class="nav nav-tabs nav-tabs-bottom">
                            <li class="active"><a href="#panel-tab1" data-toggle="tab"> {{ $lesson->name }}</a></li>

                            <li>
                                <button id="fullscreen" class="btn"><i class="icon-screen-full position-left"></i>
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>


                <div class="panel-tab-content tab-content">
                    <div class="tab-pane active has-padding disable-select div-scroll">
                        <a href="{{ route('e-learning.lessons.edit', $lesson->id) }}"
                           class="btn btn-primary btn-transparent pull-right">Edit</a>
                        {!! $lesson->lesson_content !!}
                    </div>
                </div>
            </div>
            <!-- /tabs -->
        </div>


    </div>
@endsection


@section('additional-js-code')
    <script>
        $("#fullscreen").click(function () {
            // open element in fullscreen
            $("#lesson-tab-panel-1").toggleFullScreen(true);
        });

    </script>

    {{--<script>
        $(document).bind('keydown', 'ctrl+s', function(e) {
            e.preventDefault();
            alert('You cannot save this page');
            return false;
        });
    </script>--}}
@endsection