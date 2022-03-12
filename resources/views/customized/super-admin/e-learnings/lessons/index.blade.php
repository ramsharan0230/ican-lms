@extends('layouts.super-admin.master')
@section('title', 'Lessons')
@push('styles')
<link href="{{ asset('assets/vendor/simple-datatables/style.css')}}" rel="stylesheet">
@endpush
@section('content')

<div class="pagetitle">
    <h1>Lessons</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('super-admin-dashboard') }}">Home</a></li>
        <li class="breadcrumb-item active">Lessons</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->
  {{-- new datatable-column-search-inputs --}}
  <section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Lessons</h5>
            <div class="panel-body">
                <a href="{{ route('lessons.create') }}" class="btn btn-info btn-lg"><i class="icon-add"></i> &nbsp;&nbsp;Add New Lesson</a>
            </div>
            <!-- Table with stripped rows -->
            <table class="table datatable">
              <thead>
                <tr>
                    <th>SN.</th>
                    <th>Name</th>
                    <th>Credit Hour</th>
                    <th>Published Status</th>
                    <th>Created at</th>
                    <th>Modified at</th>
                    <th class="text-center">Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach($lessons as $key=>$lesson)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $lesson->name }}</td>
                        <td>{{ $lesson->credit_hour }}</td>
                        <td>
                            @if($lesson->published_status==1)
                                <span class="label label-success custom-label">Published</span>
                            @else
                                <span class="label label-danger custom-label">Unpublished</span>
                            @endif
                        </td>
                        <td>{{ $lesson->created_at }}</td>
                        <td>{{ $lesson->updated_at }}</td>
                        <td class="text-center">
                            <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                  <li>
                                    <a href="{{ route('categories.edit', [$lesson->id]) }}"><i class="bx bxs-pencil"></i> <span class="text-info">Edit</span></a>
                                  </li>
                                  <li>
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#basicModal_{{$lesson->id}}"><i class="bx bxs-trash"></i> <span class="text-danger">Delete</span></a>
                                  </li>
                                </ul>
                            </div>
                        </td>
                    </tr>

                    <!-- Delete Modal Custom background color starts-->
                    <div class="modal fade" id="basicModal_{{$lesson->id}}" tabindex="-1">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title">{{ $lesson->name }}</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              Are you sure want to delete lesson?
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-warning pull-right m-l-10" data-dismiss="modal">Cancel</button>
                                  {{ Form::open(array('route' => array('categories.destroy', $lesson->id), 'method' => 'delete')) }}
                                      <button type="submit" class="btn bg-success">Yes</button>
                                  {{ Form::close() }}
                            </div>
                          </div>
                        </div>
                    </div>
                    <!-- End Basic Modal-->

                @endforeach
              </tbody>
            </table>
            <!-- End Table with stripped rows -->

          </div>
        </div>

      </div>
    </div>
  </section>
@endsection

@section('scripts')
<script src="{{ asset('assets/vendor/simple-datatables/simple-datatables.js')}}"></script>

@endsection