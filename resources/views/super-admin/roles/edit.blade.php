@extends('master-layouts.app-master-layouts.app-master-layout-super-admin')

@section('page-header')
    <div class="panel page-header page-header-xs border-bottom-teal">

        <div class="page-header-content">
            <div class="page-title">
                <h6>
                
                <span class="text-semibold">Edit Role</span>    
                <span class="pull-right custom-breadcrumb">

                     <ul class="breadcrumb">
                         <li><a href="{{ route('super-admin-dashboard') }}"><i class="icon-home2 position-left"></i> Home</a></li>
                         <li><a href="{{ route('roles.index') }}">Roles</a></li>
                         <li class="active">Edit Role</li>
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
        {{--add user form starts--}}
        {!! Form::model($role, ['method' => 'PATCH', 'route' => ['roles.update', $role->id] ]) !!}
            @include('super-admin.roles.partials.partial-create-update-role')
        {!! Form::close() !!}
        {{--add user form ends--}}
        <!-- /2 columns form -->
    </div>
@endsection

@section('additional-js-code')
    <script src="{{ URL::asset('assets/custom/js/custom-checkboxes-radios.js') }}"></script>
@endsection
