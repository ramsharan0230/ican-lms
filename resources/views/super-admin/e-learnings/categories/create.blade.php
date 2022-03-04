@extends('master-layouts.app-master-layouts.app-master-layout-super-admin')

@section('additional-theme-js')
    <script type="text/javascript" src="{{ URL::asset('assets/js/plugins/forms/selects/select2.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/custom/ckeditor/ckeditor.js') }}"></script>
@endsection

@section('page-header')
    <div class="panel page-header page-header-xs border-bottom-teal">

        <div class="page-header-content">
            <div class="page-title">
                <h6>
                    <span class="text-semibold">Add Category</span>
                    
                <span class="pull-right custom-breadcrumb">

                     <ul class="breadcrumb">
                         <li><a href="{{ route('super-admin-dashboard') }}"><i class="icon-home2 position-left"></i> Home</a></li>
                         <li><a href="{{ route('e-learning.categories.index') }}">Categories</a></li>
                         <li class="active">Add Category</li>
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
        {!! Form::open(['route' => 'e-learning.categories.store']) !!}
            @include('super-admin.e-learnings.categories.partials.partial-create-update-category')
        {!! Form::close() !!}
        <!-- /2 columns form -->
    </div>
@endsection

@section('additional-js-code')
    <script>
        $('.select-search').select2();    //to activate select drop down with search functionality...
    </script>

    <script>
        CKEDITOR.replace('description');    //to transform normal text area to ckeditor text area.
        CKEDITOR.config.height = 300;
    </script>
@endsection