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
                    <span class="text-semibold">Categories List</span>
                    <span class="pull-right custom-breadcrumb">
                         <ul class="breadcrumb">
                             <li><a href="{{ route('super-admin-dashboard') }}"><i class="icon-home2 position-left"></i> Home</a></li>
                             <li><a href="{{ route('e-learning.categories.index') }}">Categories</a></li>
                             <li class="active">List Categories</li>
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
                <a href="{{ route('e-learning.categories.create') }}" class="btn btn-info btn-lg"><i class="icon-add"></i> &nbsp;&nbsp;Add New Category</a>
            </div>

            <table class="table datatable-column-search-inputs">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Display Name</th>
                    <th>Description</th>
                    <th>Created Date</th>
                    <th>Modified Date</th>
                    <th class="text-center">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($categories as $category)
                    <tr>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->display_name }}</td>
                        <td>{!! str_limit($category->description, $limit = 20, $end = '...') !!}</td>
                        <td>{{ $category->created_at }}</td>
                        <td>{{ $category->updated_at }}</td>
                        <td class="text-center">
                            <ul class="icons-list">
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <i class="icon-menu9"></i>
                                    </a>

                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li><a href="{{ route('e-learning.categories.edit', [$category->id]) }}"><i class="icon-database-edit2"></i> <span class="text-info">Edit</span></a></li>
                                        <li><a href="#" data-toggle="modal" data-target="#modal_delete_role_{{ $category->id }}"><i class="icon-database-remove"></i> <span class="text-danger">Delete</span></a></li>
                                    </ul>
                                </li>
                            </ul>
                        </td>
                    </tr>

                    <!-- Delete Modal Custom background color starts-->
                    <div id="modal_delete_role_{{ $category->id }}" class="modal fade">
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
                                    
                                    {{ Form::open(array('route' => array('e-learning.categories.destroy', $category->id), 'method' => 'delete')) }}
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
                    <td>Display Name</td>
                    <td>Description</td>
                    <td>Created Date</td>
                    <td>Modified Date</td>
                    <td></td>
                </tr>
                </tfoot>
            </table>
        </div>
        <!-- /individual column searching (selects) -->

    </div>

    
@endsection

@section('additional-js-code')

@endsection