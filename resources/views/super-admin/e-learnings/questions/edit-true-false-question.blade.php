@extends('master-layouts.app-master-layouts.app-master-layout-super-admin')

@section('page-header')
    <div class="panel page-header page-header-xs border-bottom-teal">

        <div class="page-header-content">
            <div class="page-title">
                <h6>
                    <span class="text-semibold">Edit True / False Question</span>
                    
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
                        <h3>Add True - False Question Form</h3>
                    </div>
                    <!-- //slide header -->

                    {!! Form::model($true_false, ['method' => 'PATCH', 'route' => ['e-learning.questions.true-false-question-update', $true_false->id]]) !!}
                    @include('super-admin.e-learnings.questions.partials.partial-true-false-question')
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