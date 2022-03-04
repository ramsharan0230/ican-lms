@extends('layouts.super-admin.master')
@section('title', 'Roles')
@push('styles')
<link href="{{ asset('assets/vendor/simple-datatables/style.css')}}" rel="stylesheet">
@endpush
@section('content')

<div class="pagetitle">
    <h1>Roles</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('super-admin-dashboard') }}">Home</a></li>
        <li class="breadcrumb-item active">Roles</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->
  {{-- new datatable-column-search-inputs --}}
  <section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Roles</h5>
            <div class="panel-body">
                <a href="{{ route('roles.create') }}" class="btn btn-info btn-sm"><i class="bi bi-plus"></i> &nbsp;&nbsp;Add New Role</a>
            </div>
            <!-- Table with stripped rows -->
            <table class="table datatable">
              <thead>
                <tr>
                    <th>SN.</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Created Date</th>
                    <th class="text-center">Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach($roles as $key=>$role)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $role->name }}</td>
                        <td>{{ $role->description }}</td>
                        <td>{{ $role->created_at }}</td>
                        <td class="text-center">
                            <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                  <li>
                                    <a href="{{ route('roles.edit', [$role->id]) }}"><i class="bx bxs-pencil"></i> <span class="text-info">Edit</span></a>
                                  </li>
                                  <li>
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#basicModal_{{$role->id}}"><i class="bx bxs-trash"></i> <span class="text-danger">Delete</span></a>
                                  </li>
                                </ul>
                            </div>
                        </td>

                         <!-- Delete Modal Custom background color starts-->
                         <div class="modal fade" id="basicModal_{{$role->id}}" tabindex="-1">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title">{{ $role->name }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                Are you sure want to delete Role?
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-warning pull-right m-l-10" data-dismiss="modal">Cancel</button>
                                    {{ Form::open(array('route' => array('roles.destroy', $role->id), 'method' => 'delete')) }}
                                        <button type="submit" class="btn bg-success">Yes</button>
                                    {{ Form::close() }}
                              </div>
                            </div>
                          </div>
                        </div><!-- End Basic Modal-->
                    </tr>
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


@endsection

@section('scripts')
<script src="{{ asset('assets/vendor/simple-datatables/simple-datatables.js')}}"></script>

@endsection