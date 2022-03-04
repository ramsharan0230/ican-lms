<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#single_select_question">
<i class="icon-add"></i>
Add Single Select Question
</button>
<!-- Modal -->
<div class="modal fade" id="single_select_question" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Add Single Select Question</h4>
            </div>
            {{ Form::open(['route' => 'e-learning.tests.ajax-post-test-questions-multiple-select-single', 'id' => 'multiple_select_single_form']) }}
            <div class="modal-body">
                <input type="hidden" name="lesson_id" value="{{ $test->lesson->id }}">

                <div class="row add-new m-t-20">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="question_text">Question Text</label>
                            {!! Form::textarea('question_text', null, ['class' => 'form-control', 'rows' =>5, 'id' => 'question-text-editor', 'required']) !!}
                            @if($errors->has('question_text'))
                                <span class="help-block">{{ $errors->first('question_text') }}</span>
                            @endif
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
                                    <div class="tbContainer multi-select" id="0">
                                        {{-- <input type="hidden" name="question_answer[]" value="false" /> --}}
                                        <input type="radio" name="question_answer[0]" value="true">
                                        
                                        <!-- <input type="radio" name="question_answer" value="Yes" checked> -->
                                        <input type="text" class="form-control" placeholder="Enter Option" name="question_options[]" required/>
                                        <button class="remove btn btn-danger hidden m-l-10">Remove</button>
                                    </div>

                                    <div class="tbContainer multi-select" id="1">
                                        {{-- <input type="hidden" name="question_answer[]" value="false" /> --}}
                                        <input type="radio" name="question_answer[1]" value="true">
                                        
                                        <!-- <input type="radio" name="question_answer" value="Yes" checked> -->
                                        <input type="text" class="form-control" placeholder="Enter Option" name="question_options[]" required/>
                                        <button class="remove btn btn-danger hidden m-l-10">Remove</button>
                                    </div>

                                    <div class="tbContainer multi-select" id="2">
                                        {{-- <input type="hidden" name="question_answer[]" value="false" /> --}}
                                        <input type="radio" name="question_answer[2]" value="true">
                                        
                                        <!-- <input type="radio" name="question_answer" value="Yes" checked> -->
                                        <input type="text" class="form-control" placeholder="Enter Option" name="question_options[]" required/>
                                        <button class="remove btn btn-danger hidden m-l-10">Remove</button>
                                    </div>

                                    <div class="tbContainer multi-select" id="3">
                                        {{-- <input type="hidden" name="question_answer[]" value="false" /> --}}
                                        <input type="radio" name="question_answer[3]" value="true">
                                        
                                        <!-- <input type="radio" name="question_answer" value="Yes" checked> -->
                                        <input type="text" class="form-control" placeholder="Enter Option" name="question_options[]" required/>
                                        <button class="remove btn btn-danger hidden m-l-10">Remove</button>
                                    </div>
                                    
                                    <a href="#" class="addSingleInput btn btn-primary m-l-37"><i class="icon-plus2"></i> Add Option</a>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>