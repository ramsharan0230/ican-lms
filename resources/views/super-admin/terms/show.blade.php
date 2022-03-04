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
                    <span class="text-semibold">View Term Details</span>

                    <span class="pull-right custom-breadcrumb">
                        <ul class="breadcrumb">
                            <li><a href="{{ route('super-admin-dashboard') }}"><i class="icon-home2 position-left"></i> Home</a></li>
                            <li><a href="{{ route('terms.index') }}">Terms</a></li>
                            <li class="active">View Term Details</li>
                        </ul>
                    </span>
                </h6>
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
                    <h3 class="panel-title">Term ID : {{ $term->id }}</h3>
                    <h3>Title : {{ $term->title }}</h3>
                    {!! $term->description !!}
                </div>
            </div>
            <!-- /tabs -->
        </div>
    </div>
@endsection
