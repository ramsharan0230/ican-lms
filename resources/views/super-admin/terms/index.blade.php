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
                    <span class="text-semibold">Terms List</span>
                    <span class="pull-right custom-breadcrumb">

                     <ul class="breadcrumb">
                         <li><a href="{{ route('super-admin-dashboard') }}"><i class="icon-home2 position-left"></i> Home</a></li>
                         <li><a href="{{ route('terms.index') }}">Terms</a></li>
                         <li class="active">List Users</li>
                     </ul>
                </span>
                </h6>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="content">
        @include('flash-messages.partial_flash_alert_message')
        <div class="panel panel-flat">
            <table class="table datatable-column-search-inputs">
                <thead>
                <tr>
                    <th>InfoID</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Created at</th>
                    <th class="text-center">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($terms as $term)
                    <tr>
                        <td>{{ $term->id }}</td>
                        <td>{{ $term->title }}</td>
                        <td>{{ substr($term->description, 0, 100) }}</td>
                        <td>{{ $term->created_at }}</td>
                        <td class="text-center">
                            <ul class="icons-list">
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <i class="icon-menu9"></i>
                                    </a>

                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li><a href="{{ route('terms.show', $term->id) }}"><i
                                                        class="icon-database-edit2"></i> <span
                                                        class="text-info">View Details</span></a></li>
                                        <li><a href="{{ route('terms.edit', $term->id) }}"><i
                                                        class="icon-database-edit2"></i> <span
                                                        class="text-info">Edit</span></a></li>
                                    </ul>
                                </li>
                            </ul>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <!-- /individual column searching (selects) -->
    </div>
@endsection

@section('additional-js-code')

@endsection