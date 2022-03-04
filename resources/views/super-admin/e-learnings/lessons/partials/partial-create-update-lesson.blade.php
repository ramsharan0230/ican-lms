@section('additional-theme-js')
    <script type="text/javascript" src="{{ URL::asset('assets/js/plugins/forms/selects/select2.min.js') }}"></script>
    {{--<script type="text/javascript" src="{{ URL::asset('assets/custom/ckeditor/ckeditor.js') }}"></script>--}}
    <script type="text/javascript" src="{{ URL::asset('assets/custom/ckeditor/ckeditor.js') }}"></script>
@endsection

<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title"><i class="icon-reading position-left"></i> Add lesson</h5>
        {{--<div class="heading-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
                <li><a data-action="reload"></a></li>
                <li><a data-action="close"></a></li>
            </ul>
        </div>--}}
    </div>

    <div class="panel-body">
        <div class="row">
            <fieldset class="text-semibold">
                <legend>Lesson Form</legend>


                <div class="form-group {{ (!$errors->has('name') ? : 'has-error') }}">

                    <label for="lesson_name"
                           class="control-label col-md-2 {{ (!$errors->has('name') ? : 'text-danger') }}">Title
                        <span class="text-danger pull-right"><i
                                    class="glyphicon glyphicon-asterisk"></i> Required</span></label>

                    <div class="col-md-10">
                        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter lesson name']) !!}

                        @if($errors->has('name'))
                            <label class="validation-error-label">{{ $errors->first('name') }}</label>
                        @endif

                    </div>
                </div>

                <div class="form-group{{ $errors->has('credit_hour') ? ' has-error' : '' }}">
                     <label for="lesson_name"
                           class="control-label col-md-2 {{ (!$errors->has('name') ? : 'text-danger') }}">Credit Hour
                        <span class="text-danger pull-right"><i
                                    class="glyphicon glyphicon-asterisk"></i> Required</span></label>
                    <div class="col-md-10">
                        {{ Form::number('credit_hour', Request::old('credit_hour'), ['class' => 'form-control', 'placeholder' => 'Enter credit hour here']) }}
                    </div>

                    @if($errors->has('credit_hour'))
                        <span class="help-block">{{ $errors->first('credit_hour') }}</span>
                    @endif
                </div>

            </fieldset>
        </div>

        <div class="row">
            <fieldset class="text-semibold">
                <div id="question-true-false-answer" class="form-group {{ (!$errors->has('lesson_name') ? : 'has-error') }}">

                    <label for="lesson_name"
                           class="control-label col-md-2 {{ (!$errors->has('lesson_name') ? : 'text-danger') }}">
                    Published Status
                    </label>

                    <div class="col-md-10">
                        <label class="radio-inline">
                            {{ Form::radio('published_status', 1, null, ['class' => 'control-info']) }} Yes
                        </label>
                        <label class="radio-inline">
                            {{ Form::radio('published_status', 0, null, ['class' => 'control-info']) }} No
                        </label>
                    </div>
                </div>
            </fieldset>
        </div>

        <div class="row" style="margin-bottom: 15px;">
            <button type="button" id="add-image" class="btn btn-info btn-lg"> Add image / picture</button>
            <button type="button" data-toggle="modal" data-target="#modal_theme_warning" class="btn btn-info btn-lg">
                <i class="icon icon-file-pdf"></i><span> Add PDF file</span></button>
            <button type="button" class="btn btn-info btn-lg"><i class="icon icon-paperplane"></i><span> Add Office Documents</span>
            </button>
            <button type="button" class="btn btn-info btn-lg"><i class="icon icon-file-video"></i><span> Add Audio / Video</span>
            </button>
        </div>

        <div class="row">
            <fieldset class="text-semibold">
                <div class="col-md-12">
                    <div class="form-group">
                        @if($errors->has('lesson_content'))
                            <label class="validation-error-label">{{ $errors->first('lesson_content') }}</label>
                        @endif
                        {!! Form::textarea('lesson_content', null, ['class' => 'form-control', 'rows'=>5, 'id' =>
                        'lesson-content-editor']) !!}
                    </div>
                </div>
            </fieldset>
        </div>

        <div class="text-right">
            <button type="submit" class="btn btn-primary btn-lg">Save <i
                        class="icon-arrow-right14 position-right"></i></button>
        </div>
    </div>
</div>

{{--Modals starts--}}
<!-- Warning modal -->
<div id="modal_theme_warning" class="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h6 class="modal-title">Add images / pictures</h6>
            </div>

            <div class="modal-body">
                <h6 class="text-semibold">Upload image / picture</h6>
                <!-- All runtimes -->
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h5 class="panel-title">All runtimes</h5>

                        <div class="heading-elements">
                            <ul class="icons-list">
                                <li><a data-action="collapse"></a></li>
                                <li><a data-action="reload"></a></li>
                                <li><a data-action="close"></a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="panel-body">
                        <div class="file-uploader"><p>Your browser doesn't have Flash installed.</p></div>
                    </div>
                </div>
                <!-- /all runtimes -->

                <hr>

                <h2 class="text-center">OR</h2>

                <h6 class="text-semibold">Choose from list</h6>

                <p>Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas
                    eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>

                <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus sagittis lacus vel augue
                    laoreet rutrum faucibus dolor auctor.</p>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
<!-- /warning modal -->
{{--modals ends--}}


@section('additional-js-code')
    <script>
        $('.select-search').select2();    //to activate select drop down with search functionality...
    </script>

    <script>
        var roxyFileman = '{{ asset('assets/custom/fileman/index.html') }}';
        $(function(){
            CKEDITOR.replace( 'lesson-content-editor',{filebrowserBrowseUrl:roxyFileman,
                filebrowserImageBrowseUrl:roxyFileman+'?type=image',
                removeDialogTabs: 'link:upload;image:upload'});
                
                CKEDITOR.config.extraPlugins = 'googledocs';
        });
    </script>

    <script>
        $(document).ready(function () {
            $("#add-image").on("click", function () {
                $.fn.insertAtCaret = function (html) {
                    html = html.trim();
                    CKEDITOR.instances['lesson-content-editor'].insertHtml(html);
                };
                $.fn.insertAtCaret('<img src="http://www.clker.com/cliparts/I/7/e/i/M/N/house-icon-hi.png"/>');
            });
        });
    </script>

    <script>
        $(document).ready(function () {
            $("#upload-image").on("click", function () {
                alert(("image_file").prop("files")['name']);
            });


        });
    </script>

    <script src="{{ URL::asset('assets/custom/js/custom-checkboxes-radios.js') }}"></script>
@endsection