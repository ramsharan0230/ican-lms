@section('additional-theme-js')
    <!-- Theme JS files -->
    <script src="{{ URL::asset('assets/custom/js/custom-checkboxes-radios.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/js/plugins/forms/selects/select2.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/custom/ckeditor/ckeditor.js') }}"></script>
    <!-- /theme JS files -->
@endsection

<div class="row add-new">
    <div class="col-md-12">
        <div class="form-group">
            <label for="lesson_id">Releated Lesson</label>
            {!! Form::select('lesson_id', $lessons, null, ['class' => 'select-search']) !!}
        </div>
    </div>
</div>
<!-- row -->

<div class="row add-new m-t-20">
    <div class="col-md-12">
        <div class="form-group">
            <label for="question_text">Question Text</label>
            {!! Form::textarea('question_text', null, ['class' => 'form-control', 'rows' =>5, 'id' => 'question-text-editor']) !!}
        </div>
        <!-- form-group -->
    </div>
    <!-- col -->
</div>

<div class="row">
    <fieldset class="text-semibold">
        <div class="form-group">

            <label for="question_answer" class="control-label col-md-2">
                Correct Answer
            </label>

            <div class="col-md-10">
                <label class="radio-inline">
                    <input type="radio" name="question_answer" class="control-info" value="Yes" {{ (isset($true_false) && ($true_false->question_answer=='s:3:"Yes";') ) ? 'checked':'' }}> Yes
                </label>
                <label class="radio-inline">
                    <input type="radio" name="question_answer" class="control-info" value="No" {{ (isset($true_false) && ($true_false->question_answer=='s:2:"No";') ) ? 'checked':'' }}> No
                </label>
            </div>
        </div>
    </fieldset>
</div>

<!-- row -->
<div class="row">
    <div class="col-md-12">
        <button type="submit" class="btn btn-info m-r-5 pull-right">Save question</button>
    </div>
    <!-- col -->
</div>
<!-- row -->

@section('additional-js-code')
    {{--<script>
        var roxyFileman = '{{ asset('assets/custom/fileman/index.html') }}';
        $(function () {
            CKEDITOR.replace('question-text-editor', {
                filebrowserBrowseUrl: roxyFileman,
                filebrowserImageBrowseUrl: roxyFileman + '?type=image',
                removeDialogTabs: 'link:upload;image:upload'
            });
        });
    </script>--}}

    <script>
        $('.select-search').select2();    //to activate select drop down with search functionality...
    </script>
@endsection