@extends('master-layouts.app-master-layouts.app-master-layout-super-admin')

@section('page-header')
    <div class="panel page-header page-header-xs border-bottom-teal">

        <div class="page-header-content">
            <div class="page-title">
                <h6>
                    <span class="text-semibold">Add Role</span>

                <span class="pull-right custom-breadcrumb">

                     <ul class="breadcrumb">
                         <li><a href="{{ route('super-admin-dashboard') }}"><i class="icon-home2 position-left"></i> Home</a></li>
                         <li><a href="{{ route('roles.index') }}">Push Notification</a></li>
                         <li class="active">Version Notification</li>
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
        <div class="row">
            @if(isset($success))
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
                    <span class="text-semibold f-s-25">!!! Push Notification Sent {{ $success }}. Failed {{ $failure }}.</span>
                </div>
            @endif
        <div class="panel">
            <div class="panel-body">
                <form class="form-horizontal m-t-30" method="post" action="{{ route('POST-SEND-GCM-PUSH-NOTIFICATION') }}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="title" class="col-sm-1 control-label">Title</label>
                        <div class="col-sm-11">
                            <input type="text" class="form-control" id="title" placeholder="Title" name="title">
                        </div>
                    </div> <!-- // form - group -->
                    <div class="form-group">
                        <label for="message" class="col-sm-1 control-label">Message</label>
                        <div class="col-sm-11">
                            <textarea class="form-control" rows="6" placeholder="Message" name="message"></textarea>
                        </div>
                    </div> <!-- // form - group -->

                    <div class="form-group">
                        <div class="col-sm-offset-1 col-sm-11">
                            <button class="btn btn-success" type="submit"><i class="fa fa-paper-plane-o m-r-5"></i>Send Notifications</button>
                        </div>
                    </div>
                </form>
            </div> <!-- //panel body -->
        </div> <!-- // panel -->
        </div>
    </div>
@endsection
