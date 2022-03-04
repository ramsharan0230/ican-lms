@extends('master-layouts.app-master-layouts.app-master-layout-super-admin')

@section('page-header')
    <div class="panel page-header page-header-xs border-bottom-teal">

        <div class="page-header-content">
            <div class="page-title">
                <h6>
                    <span class="text-semibold">Edit Settings</span>
                    
                <span class="pull-right custom-breadcrumb">

                     <ul class="breadcrumb">
                         <li><a href="{{ route('super-admin-dashboard') }}"><i class="icon-home2 position-left"></i> Home</a></li>
                         <li><a href="{{ route('e-learning.course.setting') }}">Setting</a></li>
                         <li class="active">Edit Setting</li>
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
        <!-- 2 columns form -->
        {!! Form::model($setting, ['method' => 'POST', 'route' => ['e-learning.setting.update', $setting->id], 'class' => 'form-horizontal' ]) !!}
            @include('super-admin.e-learnings.settings.partials.form')
        {!! Form::close() !!}
    
        <div class="panel panel-flat">
    
            <div class="panel-heading left">
                <span class="panel-title"><i class="icon-gear position-left"></i> Fiscal Year </span>
                <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                                                                                                data-target="#createFiscal" style="margin-top: 8px;">
                    + Add Fiscal Year
                </button>
            </div>
            
            
            <table class="table">
                <thead>
                    <th>SN.</th>
                    <th>Fiscal year</th>
                    <th>Start</th>
                    <th>End</th>
                    <th>Current Fiscal</th>
                    <th></th>
                </thead>
                <tbody>
                @foreach($fiscals as $key=>$fiscal)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$fiscal->fiscal_year}}</td>
                        <td>{{$fiscal->start_from}}</td>
                        <td>{{$fiscal->end_to}}</td>
                        <td>{{$fiscal->running_fiscal}}</td>
                        <td>
                            <button type="button" class="btn btn-info btn-sm"  data-target="#edit{{$fiscal->id}}" data-toggle="modal"
                                    style="margin-top: 8px;">
                                <i class="icon-database-edit2"></i> <span
                                        class="text-info">Edit</span>
                            </button>
                        </td>
                    </tr>
                    <div class="modal fade" id="edit{{$fiscal->id}}" role="dialog">
                        <div class="modal-dialog">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header" style="background-color: #035680; color: white;">
                
                                    <h4 class="modal-title" style="padding-bottom: 8px;">Create Fiscal Year</h4>
                                </div>
            
                                <div class="modal-body">
                                    <form class="" action = "{{route('fiscal.update',$fiscal->id)}}" method="POST">
                                        {{ csrf_field() }}
                    
                                        <label> Fiscal year</label>
                                        <input name="fiscal_year"  value="{{$fiscal->fiscal_year}}" type="text" class="form-control" >
                    
                                        <label> Start From</label>
                                        <input name="start_from" type="date" value="{{$fiscal->start_from}}"class="form-control" >
                                        
                                        <label> End To</label>
                                        <input name="end_to" type="date" value="{{$fiscal->end_to}}"class="form-control" >
                                        <br/>
    
                                        <label> Is current Fiscal year</label>
    
    
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="running_fiscal" id="running_fiscal1" value="1" @if($fiscal->running_fiscal ==1)checked @endif>
                                            <label class="form-check-label" for="exampleRadios1">
                                               Yes
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="running_fiscal" id="exampleRadios2" value="0" @if($fiscal->running_fiscal ==0)checked @endif>
                                            <label class="form-check-label" for="exampleRadios2">
                                               No
                                            </label>
                                        </div>
                                        

                                        <br/>
                    
                                        <button value="Confirm" type="submit" class="btn btn-primary">Save</button>
                                        <button type="button"  data-dismiss="modal" class="btn btn-default">Close</button>
                                    </form>
                                </div>
                            </div>
    
                        </div>
                    </div>

                @endforeach
                </tbody>
            </table>
        </div>
        <!-- /2 columns form -->
    </div>

    
{{--    form create fiscal year modal--}}
    <div class="modal fade" id="createFiscal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header" style="background-color: #035680; color: white;">
                    
                    <h4 class="modal-title" style="padding-bottom: 8px;">Create Fiscal Year</h4>
                </div>
    
                <div class="modal-body">
                    <form class="" action = "{{route('fiscal.store')}}" method="POST">
                    {{ csrf_field() }}

                        <label> Fiscal year</label>
                        <input name="fiscal_year" type="text" class="form-control" >
        
                        <label> Start From</label>
                        <input name="start_from" type="date" class="form-control" >
                        <label> End To</label>
                        <input name="end_to" type="date" class="form-control" >
    
                        <label> Is current Fiscal year</label>
    
    
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="running_fiscal" id="running_fiscal1" value="1" >
                            <label class="form-check-label" for="exampleRadios1">
                                Yes
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="running_fiscal" id="exampleRadios2" value="0" checked>
                            <label class="form-check-label" for="exampleRadios2">
                                No
                            </label>
                        </div>
    
                        
                        <br/>
        
                        <button value="Confirm" type="submit" class="btn btn-primary">Save</button>
                        <button type="button"  data-dismiss="modal" class="btn btn-default">Close</button>
                    </form>
            </div>
            </div>
    
        </div>
    </div>

@endsection