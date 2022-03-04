@extends('master-layouts.app-master-layouts.app-master-layout-super-admin')

@section('additional-theme-js')
    <!-- Theme JS files -->
    <script type="text/javascript" src="{{ asset('assets/js/plugins/media/fancybox.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/plugins/forms/selects/select2.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/plugins/tables/datatables/datatables.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/pages/datatables_api.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/pages/user_pages_team.js')}}"></script>
    <!-- /theme JS files -->
@endsection

@section('page-header')
    <div class="panel page-header page-header-xs border-bottom-teal">

        <div class="page-header-content">
            <div class="page-title">
                <h6>
                    <span class="text-semibold">Users List</span>
                <span class="pull-right custom-breadcrumb">

                     <ul class="breadcrumb">
                         <li><a href="{{ route('super-admin-dashboard') }}"><i class="icon-home2 position-left"></i> Home</a></li>
                         <li><a href="{{ route('users.index') }}">Users</a></li>
                         <li class="active">List Users</li>
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

            <div class="panel-body">
                <a href="{{ route('users.create') }}" class="btn btn-info btn-lg"><i class="icon-add"></i> &nbsp;&nbsp;Add New User</a>
                <a href="#" data-toggle="modal" data-target="#modal_import_excel_student" class="btn btn-custom btn-lg"><i class="icon-file-excel"></i> &nbsp;&nbsp;Import Excel Sheet</a>
                <a href="{{ route('users.export-users-excel-sheet') }}" class="btn btn-custom btn-lg"><i class="icon-file-excel"></i> &nbsp;&nbsp;Export Excel Sheet</a>
            </div>

            <table class="table datatable-column-search-inputs">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Role</th>
                    <th>Email</th>
                    <th>Assigned Course</th>
                    <th>Active Status</th>
                    <th>Registered Date</th>
                    <th>Modified Date</th>
                    <th class="text-center">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->first_name.' '.($user->middle_name!=''?$user->middle_name.' ':'').$user->last_name }}</td>
                        <td>{{ $user->role->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{!! $user->assigned_course->count() ? '<span class="label label-primary f-s-14">Yes</span>' : '<span class="label label-default f-s-14">No</span>' !!}</td>
                        <td>
                            @if($user->active_status==1)
                                <span class="label label-success custom-label">Active</span>
                            @else
                                <span class="label label-danger custom-label">InActive</span>
                            @endif
                        </td>
                        <td>{{ $user->created_at }}</td>
                        <td>{{ $user->updated_at }}</td>
                        <td class="text-center">
                            <ul class="icons-list">
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <i class="icon-menu9"></i>
                                    </a>

                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li><a href="{{ route('users.edit', [$user->id]) }}"><i
                                                        class="icon-database-edit2"></i> <span
                                                        class="text-info">Edit</span></a></li>
                                        <li>
                                        
                                        <a href="#" data-toggle="modal" data-target="#modal_delete_student_{{ $user->id }}"><i class="icon-database-remove"></i> <span class="text-danger">Delete</span></a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </td>
                    </tr>

                        <!-- Delete Modal Custom background color starts-->
                        <div id="modal_delete_student_{{ $user->id }}" class="modal fade">
                            <div class="modal-dialog">
                                <div class="modal-content bg-danger">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>

                                    <div class="modal-body">
                                        <h3>Do You Really Want To Delete??</h3>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-warning pull-right m-l-10" data-dismiss="modal">Cancel</button>
                                        {{ Form::open(array('route' => array('users.destroy', $user->id), 'method' => 'delete')) }}
                                            <button type="submit" class="btn bg-success">Yes</button>
                                        {{ Form::close() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Delete Modal custom background color ends-->
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <td>Name</td>
                    <td>Role</td>
                    <td>Email</td>
                    <td>Assigned Course</td>
                    <td>Active Status</td>
                    <td>Registered Date</td>
                    <td>Modified Date</td>
                    <td></td>
                </tr>
                </tfoot>
            </table>
        </div>
        <!-- /individual column searching (selects) -->

    </div>

    <!--Import Student Excel Sheet starts-->
    <!-- Delete Modal Custom background color starts-->
    <div id="modal_import_excel_student" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content bg-indigo">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">
                    {!! Form::open(['route' => 'users.import-users-excel-sheet', 'enctype'=>'multipart/form-data']) !!}
                    {!! Form::file('import_users_excel_sheet',['required'=>'required', 'class' => 'form-control'])!!}
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn bg-success">Yes</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <!-- Delete Modal custom background color ends-->
    <!--Import Student Excel Sheet ends-->




@endsection

@section('additional-js-code')

@endsection