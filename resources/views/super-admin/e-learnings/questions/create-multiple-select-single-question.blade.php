@extends('master-layouts.app-master-layouts.app-master-layout-super-admin')

@section('page-header')
    <div class="panel page-header page-header-xs border-bottom-teal">

        <div class="page-header-content">
            <div class="page-title">
                <h6>
                    <span class="text-semibold">Add Multiple Select Single Correct Answer Question</span>
                    
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
        <div class="panel panel-flat">
            <div class="panel-body">
                <div class="tabbable">
                    <div class="slide-header">
                        <h3>Add Multiple Select Single Correct Answer Question Form</h3>
                    </div>
                    <!-- //slide header -->

                    {!! Form::open(['route' => 'e-learning.questions.multiple-select-single-question-store' ]) !!}
                    @include('super-admin.e-learnings.questions.partials.partial-multiple-select-single-question')
                    {!! Form::close() !!}<!-- form -->
                </div>
                <!-- tabbable -->
            </div>
            <!-- panel-body -->
        </div>
        <!-- panel -->
        <!-- /2 columns form -->
    </div>
@endsection