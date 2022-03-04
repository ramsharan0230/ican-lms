@section('additional-theme-js')
    <!-- Theme JS files -->
    <script type="text/javascript" src="{{ asset('assets/js/plugins/media/fancybox.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/pages/user_pages_team.js')}}"></script>
    {{-- // <script type="text/javascript" src="{{ asset('assets/js/plugins/pickers/pickadate/picker.date.js')}}"></script> --}}
    <script type="text/javascript" src="{{ asset('assets/js/plugins/forms/selects/select2.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/custom/ckeditor/ckeditor.js') }}"></script>
    <!-- /theme JS files -->
@endsection

<div class="panel panel-flat">
    <div class="panel-body">
        <div class="tabbable">
            <ul class="nav nav-tabs nav-tabs-bottom">
                <li class="active"><a href="#bottom-tab1" data-toggle="tab">Tests</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="bottom-tab1">

                    <div class="panel-heading">
                        <h5 class="panel-title"><i class="icon-reading position-left"></i> Add Test</h5>
                    </div>

                    <div class="panel-body">
                        <div class="row add-new">
                            <div class="col-md-12">
                            {!! Form::open(['route' => 'e-learning.tests.store']) !!}
                            <div class="form-group">
                                <label for="name">Name</label>
                                {!! Form::text('name', null, ['placeholder' => 'Enter Test Name', 'class' =>
                                'form-control']) !!}
                            </div>
                        
                            <div class="form-group">
                                <label for="lesson_id">Choose Related Lesson</label>
                                {!! Form::select('lesson_id', $lessons, null, ['class' => 'select-search']) !!}
                            </div>

                            <div class="form-group">
                                <label for="duration">Duration in Minutes <span class="text-warning">(0 For No Limit)</span></label>
                                {!! Form::input('number', 'duration', null, ['class' => 'form-control',
                                'placeholder' => 'Enter Test Duration in minutes']) !!}
                            </div>

                            <div class="form-group">
                                <label for="repetition">Test Repetitions <span class="text-warning">(0 For Unlimited)</span></label>
                                {!! Form::input('number', 'repetition', null, ['class' => 'form-control',
                                'placeholder' => 'Enter Test Repetition Times']) !!}
                            </div>

                            <div class="form-group">
                                <label for="full_marks">Full Marks</label>
                                {!! Form::input('number', 'full_marks', null, ['class' => 'form-control',
                                'placeholder'=>'Enter Full Marks']) !!}
                            </div>

                            <div class="form-group">
                                <label for="pass_marks">Pass Marks</label>
                                {!! Form::input('number', 'pass_marks', null, ['class' => 'form-control',
                                'placeholder'=>'Enter Pass Marks']) !!}
                            </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="published_status">Published</label>
                                    </br>
                                    <label class="radio-inline m-t-5">
                                        {{ Form::radio('published_status', 1, ['class' => 'control-info', 'checked']) }} Yes
                                    </label>
                                    <label class="radio-inline m-t-5">
                                        {{ Form::radio('published_status', 0, ['class' => 'control-info']) }} No
                                    </label>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="shuffle_questions">Shuffle Questions </label>
                                    </br>
                                    <label class="radio-inline m-t-5">
                                        {{ Form::radio('shuffle_questions', 1, ['class' => 'control-info', 'checked']) }} Yes
                                    </label>
                                    <label class="radio-inline m-t-5">
                                        {{ Form::radio('shuffle_questions', 0, ['class' => 'control-info']) }} No
                                    </label>
                                </div>
                            </div>

                        </div>
                        <!-- row -->

                        <div class="form-group">
                            <label for="student_role_id">Description</label>

                            {!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => 5, 'id' =>
                            'add-test-description']) !!}
                        </div>
                        <!-- readmoreinfo -->
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary btn-lg">Save <i class="icon-arrow-right14 position-right"></i></button>
                        </div>
                        {{ Form::close() }}
                    </div>

                </div>
                <!-- 1st tab finishes here -->
            </div>
            <!-- tab-content -->
        </div>
        <!-- tabbable -->
    </div>
    <!-- panel body -->
</div>  <!-- panl flat -->

@section('additional-css')
<style>
    .modal-dialog {
        width: 1000px;
    }
</style>
@endsection

@section('additional-js-code')
    <script>
        var roxyFileman = '{{ asset('assets/custom/fileman/index.html') }}';
        $(function () {
            CKEDITOR.replace('add-test-description', {
                filebrowserBrowseUrl: roxyFileman,
                filebrowserImageBrowseUrl: roxyFileman + '?type=image',
                removeDialogTabs: 'link:upload;image:upload'
            });
        });
    </script>

    <script>
        $('.select-search').select2();    //to activate select drop down with search functionality...
    </script>

    <script type="text/javascript" src="{{ asset('assets/js/plugins/tables/datatables/datatables.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/pages/datatables_api.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/plugins/loaders/blockui.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/pages/extension_blockui.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/custom/js/custom-checkboxes-radios.js') }}"></script>
@endsection