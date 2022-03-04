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
                <div class="fieldsGroup">
                    @if($question_options)
                        @foreach($question_options as $key => $option)
                        <div class="tbContainer multi-select" id="{{ $key }}">
                            {{-- <input type="hidden" name="question_answer[{{ $key }}]" value="false" /> --}}
                            <input type="checkbox" name="question_answer[{{ $key }}]" value="true"
                            @foreach($question_answers as $anskey => $question_answer)
                                @if($key == $anskey)
                                    checked
                                @endif
                            @endforeach
                            />
                            
                            <!-- <input type="checkbox" name="question_answer[]" value="Yes" checked> -->
                            <input type="text" class="form-control" placeholder="Enter Option" name="question_options[]" value="{{ $option }}"/>
                            <button class="remove btn btn-danger m-l-10">Remove</button>
                        </div>
                        @endforeach
                    @else 
                        <div class="tbContainer multi-select" id="0">
                            {{-- <input type="hidden" name="question_answer[0]" value="false"> --}}
                            <input type="checkbox" name="question_answer[0]" value="true">
                            
                            <!-- <input type="checkbox" name="question_answer[]" value="Yes" checked> -->
                            <input type="text" class="form-control" placeholder="Enter Option" name="question_options[]" />
                            <button class="remove btn btn-danger hidden m-l-10">Remove</button>
                        </div>

                        <div class="tbContainer multi-select" id="1">
                            {{-- <input type="hidden" name="question_answer[1]" value="false"> --}}
                            <input type="checkbox" name="question_answer[1]" value="true">
                            
                            <!-- <input type="checkbox" name="question_answer[]" value="Yes" checked> -->
                            <input type="text" class="form-control" placeholder="Enter Option" name="question_options[]" />
                            <button class="remove btn btn-danger hidden m-l-10">Remove</button>
                        </div>

                        <div class="tbContainer multi-select" id="2">
                            {{-- <input type="hidden" name="question_answer[2]" value="false"> --}}
                            <input type="checkbox" name="question_answer[2]" value="true">
                            
                            <!-- <input type="checkbox" name="question_answer[]" value="Yes" checked> -->
                            <input type="text" class="form-control" placeholder="Enter Option" name="question_options[]" />
                            <button class="remove btn btn-danger hidden m-l-10">Remove</button>
                        </div>

                        <div class="tbContainer multi-select" id="3">
                            {{-- <input type="hidden" name="question_answer[3]" value="false"> --}}
                            <input type="checkbox" name="question_answer[3]" value="true">
                            
                            <!-- <input type="checkbox" name="question_answer[]" value="Yes" checked> -->
                            <input type="text" class="form-control" placeholder="Enter Option" name="question_options[]" />
                            <button class="remove btn btn-danger hidden m-l-10">Remove</button>
                        </div>
                    @endif
                    <a href="#" class="addInput btn btn-primary m-l-37"><i class="icon-plus2"></i> Add Option</a>
                </div>
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

    <script type="text/javascript">
        $(document).ready(function() {

            var $addInput = $('a.addInput');
            $addInput.on("click", function(e) {
                e.preventDefault();
                var $this = $(this);
                var $lastTbContainer = $this.closest('.fieldsGroup').children('.tbContainer:last');

                //var $div = $('div[class^="tbContainer"]:last');
                var num = parseInt( $lastTbContainer.prop("id").match(/\d+/g), 10 ) +1;
                console.log(num);

                var $clone = $lastTbContainer.clone().prop('id', num);
                $clone.find('button').removeClass('hidden');
                $clone.find('input:checkbox').prop('name', 'question_answer[' + num + ']');
                // $clone.find('input:hidden').prop('name', 'question_answer[' + num + ']');
                $clone.find('input:text').val('').prop('name', 'question_options[]');
                $lastTbContainer.after($clone);
            });
        });

        $('.fieldsGroup').on('click', 'button.remove', function() {
            $(this).closest('.tbContainer').remove();
        });
    </script>

@endsection