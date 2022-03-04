@extends('master-layouts.app-master-layouts.app-master-layout-super-admin')

@section('additional-theme-js')
    <!-- Theme JS files -->
    <script type="text/javascript" src="{{ asset('assets/js/plugins/media/fancybox.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/plugins/forms/selects/select2.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/plugins/tables/datatables/datatables.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/pages/datatables_api.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/pages/user_pages_team.js')}}"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/3.1.3/js/bootstrap-datetimepicker.min.js"></script>
    <!-- /theme JS files -->
    <script type="text/javascript">
        $(function () {
            $('.datePick').datetimepicker({
                viewMode: 'years',
                format: 'YYYY-MM-DD'
            });
        });
    </script>
@endsection

@section('page-header')
    <div class="panel page-header page-header-xs border-bottom-teal">

        <div class="page-header-content">
            <div class="page-title">
                <h6>
                    <span class="text-semibold">Set Time</span>
                    <span class="pull-right custom-breadcrumb">
                     <ul class="breadcrumb">
                         <li><a href="{{ route('super-admin-dashboard') }}"><i class="icon-home2 position-left"></i> Home</a></li>
                         <li><a href="{{ route('course-orders.index') }}">Set Time</a></li>
                         <li class="active">Set Time</li>
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
        @include('flash-messages.partial_flash_alert_message')
        <div class="panel panel-flat">
            @foreach($data as $editdata)
                {!! Form::model($editdata, ['method' => 'PATCH', 'route' => ['time_set.update', $editdata->id] ]) !!}
                <div class="row">
                    <div class="col-md-6 control-group">
                        <label for="start_date"></label>
                        {!! Form::text('start_date', old('start_date'), ['class' => 'form-control datePick',]) !!}
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-6 control-group">
                        <label for="end_date"></label>
                        {!! Form::text('end_date', old('end_date'), ['class' => 'form-control datePick',]) !!}
                    </div>
                </div>
                <input class="control-group" type="submit" value="Submit">
                {!! Form::close() !!}
            @endforeach
        </div>
        <!-- /individual column searching (selects) -->
    </div>
@endsection