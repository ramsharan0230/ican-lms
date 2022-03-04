@extends('layouts.super-admin.master')
@section('title', 'Users')
@push('styles')
<link href="{{ asset('assets/vendor/simple-datatables/style.css')}}" rel="stylesheet">
@endpush
@section('content')

<div class="pagetitle">
    <h1>Users</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('super-admin-dashboard') }}">Home</a></li>
        <li class="breadcrumb-item active">Users</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->
  {{-- new datatable-column-search-inputs --}}
  <section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Users</h5>
            <div class="panel-body">
                <a href="{{ route('users.create') }}" class="btn btn-info btn-lg"><i class="icon-add"></i> &nbsp;&nbsp;Add New User</a>
                <a href="#" data-toggle="modal" data-target="#modal_import_excel_student" class="btn btn-custom btn-lg"><i class="icon-file-excel"></i> &nbsp;&nbsp;Import Excel Sheet</a>
                <a href="{{ route('users.export-users-excel-sheet') }}" class="btn btn-custom btn-lg"><i class="icon-file-excel"></i> &nbsp;&nbsp;Export Excel Sheet</a>
            </div>
            <!-- Table with stripped rows -->
            <table class="table datatable">
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
                        <div class="filter">
                            <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                              <li>
                                <a href="{{ route('users.edit', [$user->id]) }}"><i class="bx bxs-pencil"></i> <span class="text-info">Edit</span></a>
                              </li>
                              <li>
                                <a href="#" data-toggle="modal" data-target="#modal_delete_student_{{ $user->id }}"><i class="bx bxs-trash"></i> <span class="text-danger">Delete</span></a>
                              </li>
                            </ul>
                        </div>
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
            </table>
            <!-- End Table with stripped rows -->

          </div>
        </div>

      </div>
    </div>
  </section>
  {{-- end new datatable-column-search-inputs --}}
  <section class="section dashboard">
    <div class="row">

    {{-- <div class="content">
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
                                        <li>
                                            <a href="{{ route('users.edit', [$user->id]) }}"><i class="icon-database-edit2"></i> <span class="text-info">Edit</span></a>
                                        </li>
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

    </div> --}}

    <!--Import Student Excel Sheet starts-->
    <!-- Delete Modal Custom background color starts-->
    {{-- <div id="modal_import_excel_student" class="modal fade">
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
    </div> --}}
    <!-- Delete Modal custom background color ends-->
    <!--Import Student Excel Sheet ends-->


    </div>
  </section>

@endsection

@section('scripts')
<script src="{{ asset('assets/vendor/simple-datatables/simple-datatables.js')}}"></script>

@endsection