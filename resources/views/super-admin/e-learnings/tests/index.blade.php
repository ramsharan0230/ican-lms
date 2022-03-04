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
                    <span class="text-semibold">Tests List</span>
                    
                    <span class="pull-right custom-breadcrumb">
                         <ul class="breadcrumb">
                             <li><a href="{{ route('super-admin-dashboard') }}"><i class="icon-home2 position-left"></i> Home</a></li>
                             <li><a href="{{ route('e-learning.tests.index') }}">Tests</a></li>
                             <li class="active">List Tests</li>
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
            {!! Form::open(['route' => 'e-learning.tests.filter', 'class' => 'form-inline p-20 p-b-0 increase', 'method' => 'GET']) !!}
                <div class="form-group">
                    <label for="exampleInputName2">Show Tests For Lesson</label>
                    {!! Form::select('lesson_id', $lessons, Request::get('lesson_id') ?: null, ['class' => 'select-search', 'placeholder' => 'All Lessons']) !!}
                </div>
                <button type="submit" class="btn btn-info m-t-26"><i class="icon-search4 m-r-5"></i>Show</button>
            {!! Form::close() !!}

            <div class="panel-body">
                <div class="tabbable">
                    <ul class="nav nav-tabs nav-tabs-bottom">
                        <li class="active"><a href="#bottom-tab1" data-toggle="tab">Tests</a></li>
                        <li><a href="#bottom-tab2" data-toggle="tab">Questions</a></li>
                        <li><a href="#bottom-tab3" data-toggle="tab">Recently Completed Tests</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="bottom-tab1">
                            <div class="table-responsive test-test">
                                    <a href="{{ route('e-learning.tests.create') }}" class="btn btn-info btn-lg"><i class="icon-add"></i> &nbsp;&nbsp;Add New Tests</a>
                                <table class="table datatable-column-search-inputs">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Published status</th>
                                        <th>Related Lesson</th>
                                        <th>Full Mark</th>
                                        <th>Pass Mark</th>
                                        <th>Created Date</th>
                                        <th>Modified Date</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($tests as $test)
                                        <tr>
                                            <td>{{ $test->name }}</td>
                                            <td>
                                                @if($test->published_status===1)
                                                    <span class="label label-success custom-label">Published</span>
                                                @else
                                                    <span class="label label-danger custom-label">Unpublished</span>
                                                @endif
                                            </td>
                                            <td>{{ $test->lesson->name }}</td>
                                            <td>{{ $test->full_marks }}</td>
                                            <td>{{ $test->pass_marks }}</td>
                                            <td>{{ $test->created_at }}</td>
                                            <td>{{ $test->updated_at }}</td>
                                            <td class="text-center">
                                                <ul class="icons-list">
                                                    <li class="dropdown">
                                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                            <i class="icon-menu9"></i>
                                                        </a>

                                                        <ul class="dropdown-menu dropdown-menu-right">
                                                            <li><a href="{{ route('e-learning.tests.edit', [$test->id]) }}"><i class="icon-database-edit2"></i> <span class="text-info">Edit</span></a></li>
                                                            <li><a href="#" data-toggle="modal" data-target="#modal_delete_test_{{ $test->id }}"><i class="icon-database-remove"></i> <span class="text-danger">Delete</span></a></li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>

                                            <!-- Delete Modal Custom background color starts-->
                                            <div id="modal_delete_test_{{ $test->id }}" class="modal fade">
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
                                                            {{ Form::open(array('route' => array('e-learning.tests.destroy', $test->id), 'method' => 'delete')) }}
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
                                        <td>Published Status</td>
                                        <td>Related Lesson</td>
                                        <td>Full Mark</td>
                                        <td>Pass Mark</td>
                                        <td>Registered Date</td>
                                        <td>Modified Date</td>
                                        <td></td>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div> <!-- 1st tab finishes here -->
                        <div class="tab-pane" id="bottom-tab2">
                            <div class="table-responsive test-test">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Parent Unit</th>
                                        <th>Published</th>
                                        <th>Questions</th>
                                        <th>Average Score</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>Small Self Assesment Test</td>
                                        <td>-</td>
                                        <td><i class="fa fa-check-square"></i></td>
                                        <td>5</td>
                                        <td>5</td>
                                    </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div> <!-- 2nd tab finishes here -->
                        <div class="tab-pane" id="bottom-tab3">
                            <div class="table-responsive test-test">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Parent Unit</th>
                                        <th>Published</th>
                                        <th>Questions</th>
                                        <th>Average Score</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>Small Self Assesment Test</td>
                                        <td>-</td>
                                        <td><i class="fa fa-check-square"></i></td>
                                        <td>5</td>
                                        <td>5</td>
                                    </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div> <!-- 3rd tab finishes here -->
                    </div> <!-- tab-content -->
                </div> <!-- tabbable -->
            </div> <!-- panel body -->
        </div>  <!-- panl flat -->
    </div>
@endsection

@section('additional-js-code')
    <script>
        $('.select-search').select2();    //to activate select drop down with search functionality...
    </script>
@endsection

