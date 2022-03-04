@extends('master-layouts.app-master-layouts.app-master-layout-super-admin')

@section('page-header')
    <div class="panel page-header page-header-xs border-bottom-teal">

        <div class="page-header-content">
            <div class="page-title">
                <h6>
                    <span class="text-semibold">Edit User</span>
                                    
                    <span class="pull-right custom-breadcrumb">
                         <ul class="breadcrumb">
                             <li><a href="{{ route('super-admin-dashboard') }}"><i class="icon-home2 position-left"></i> Home</a></li>
                             <li><a href="{{ route('users.index') }}">Users</a></li>
                             <li class="active">Edit User</li>
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
        {!! Form::model($user, ['method' => 'PATCH', 'route' => ['users.update', $user->id] ]) !!}
            @include('super-admin.users.partials.partial-create-update-user')
        {!! Form::close() !!}
        {{--add user form ends--}}
        <!-- /2 columns form -->
    </div>
@endsection

