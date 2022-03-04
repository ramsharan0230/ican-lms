@section('additional-theme-js')
    <script type="text/javascript" src="{{ URL::asset('assets/js/plugins/forms/selects/select2.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/js/plugins/forms/inputs/duallistbox.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/custom/js/custom-dual-listboxes.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/custom/ckeditor/ckeditor.js') }}"></script>
    {{--<script type="text/javascript" src="{{ URL::asset('//cdn.ckeditor.com/4.5.6/full/ckeditor.js') }}"></script>--}}
@endsection

<div class="panel panel-flat">

    <div class="panel-body">
        <div class="row">
            <fieldset class="text-semibold">
                <legend>Course Form</legend>

                <div class="form-group">

                    <label for="lesson_name"
                           class="control-label col-md-2 {{ (!$errors->has('name') ? : 'text-danger') }}">Name
                        <span class="text-danger pull-right"><i
                                    class="glyphicon glyphicon-asterisk"></i> Required</span></label>

                    <div class="col-md-10">
                        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter Course Name']) !!}

                        @if($errors->has('name'))
                            <label class="validation-error-label">{{ $errors->first('name') }}</label>
                        @endif

                    </div>
                </div>

            </fieldset>
        </div>

        <div class="row">

            <fieldset class="text-semibold">

                <div class="form-group">
                    <label for="display_name" class="control-label col-md-2">Display Name</label>

                    <div class="col-md-10">
                        {!! Form::text('display_name', null, ['class' => 'form-control', 'placeholder' => 'Display Name'])
                        !!}
                    </div>
                </div>

            </fieldset>
        </div>

        <div class="row">

            <fieldset class="text-semibold">

                <div class="form-group">
                    <label for="category_id" class="control-label col-md-2">Category</label>

                    <div class="col-md-10">
                        {!! Form::select('category_id', $categories, null, ['class' => 'select-search', 'required' => 'required']) !!}
                    </div>
                </div>

            </fieldset>
        </div>

        
                <div class="row">

            <fieldset class="text-semibold">

                <div class="form-group">
                    <label for="price" class="control-label col-md-2">Price</label>

                    <div class="col-md-10">
                        {!! Form::input('number','price', null, ['class' => 'form-control', 'placeholder' => 'Selling Price of this lesson'])
                        !!}
                    </div>
                </div>

            </fieldset>
        </div>

        <div class="row">

            <fieldset class="text-semibold">

                <div class="form-group">
                    <label for="cpe_price" class="control-label col-md-2">Cpe Price</label>

                    <div class="col-md-10">
                        {!! Form::input('number','cpe_price', null, ['class' => 'form-control', 'placeholder' => 'cpe price'])
                        !!}
                    </div>
                </div>

            </fieldset>
        </div>

        <div class="row">

            <fieldset class="text-semibold">

                <div class="form-group">
                    <label for="for_days" class="control-label col-md-2">For Days</label>

                    <div class="col-md-10">
                        {!! Form::input('number', 'for_days', null, ['class' => 'form-control', 'placeholder' => 'Enter No of Days'])
                        !!}
                    </div>
                </div>

            </fieldset>
        </div>
        
        
    <div class="row">
        

            <fieldset class="text-semibold">

                <div class="form-group">
                    <label for="video" class="control-label col-md-2">Vimeo Video</label>

                    <div class="col-md-10">
                        {!! Form::input('text', 'video', null, ['class' => 'form-control', 'placeholder' => 'Video code'])
                        !!}
                    </div>
                </div>

            </fieldset>
        </div>
        <div class="row">
            @if(isset($course->video) && !empty($course->video))
                        
                        <iframe title="vimeo-player" src="https://player.vimeo.com/video/{{$course->video}}" width="400" height="250" frameborder="0" allowfullscreen></iframe>
                        @endif
        </div>



        <div class="row">

            <fieldset class="text-semibold">

                <div class="form-group">
                    <label for="for_days" class="control-label col-md-2">Video time</label>
                    <p> In minutes .Example 2 hr 54 min equal to 152.4</p>
                    <div class="col-md-10">
                        {!! Form::input('number', 'video_time', null, ['class' => 'form-control', 'placeholder' => '152.4'])
                        !!}
                    </div>
                </div>

            </fieldset>
        </div>
        
        
    <div class="row">

            <fieldset class="text-semibold">

                <div class="form-group">
                    <label for="you_tube_video" class="control-label col-md-2">Youtube Video</label>

                    <div class="col-md-10">
                        {!! Form::input('text', 'you_tube_video', null, ['class' => 'form-control', 'placeholder' => 'Youtube Video code'])
                        !!}
                    </div>
                </div>

            </fieldset>
        </div>
        <div class="row">

   
                         @if(isset($course->you_tube_video) && !empty($course->you_tube_video))
                        
                            <iframe width="400" height="250" src="https://www.youtube.com/embed/{{$course->you_tube_video}}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> 
                        @endif


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

        <div clas="row">
            <fieldset class="text-semibold">

                <!-- Multiple selection -->
                <div class="form-group">
                    {!! Form::label('course_lessons', 'Choose Lessons For This Course', null, null) !!}
                    {{ Form::select('course_lessons[]', $lessons, $course ? $course->lessons->lists('id')->toArray() : null, ['class' => 'form-control listbox-no-selection', 'multiple', 'required' => 'required']) }}
                </div>
                <!-- /multiple selection -->
            </fieldset>
        </div>

        <div class="row">
            <fieldset class="text-semibold">

                <div class="col-md-12">
                    <div class="form-group">
                        <label for="term">Description</label>

                        {!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => 5, 'id' => 'course-description-editor']) !!}
                    </div>
                </div>

            </fieldset>
        </div>
gs
        
        <div class="text-right">
            <button type="submit" class="btn btn-primary btn-lg">Save <i
                        class="icon-arrow-right14 position-right"></i></button>
        </div>
    </div>
    
    <h3>Finding the embed code on Vimeo:</h3>

 <p>1.Go to Vimeo.</p>
 <p>2.Navigate to the video you wish to embed.</p>
 <p>3.Click the Share button, in the top right corner of your video.</p>
 <p>4.A pop-up will appear with the embed link information. You will need to copy the embed link in order to add it to your page in the Employer Center.</p>
    <hr>
    
    <h3>Finding the embed code on YouTube:</h3>

 <p>1.Go to YouTube.</p>
 <p>2.Navigate to the video you wish to embed.</p>
 <p>3.Click the Share link below the video, then click the Embed link.</p>
 <p>4.The embed link will be highlighted in blue. You will need to copy this link in order to add it to your page in the Employer Center.</p>
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
        CKEDITOR.replace('course-description-editor');    //to transform normal text area to ckeditor text area.
        CKEDITOR.config.height = 300;
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