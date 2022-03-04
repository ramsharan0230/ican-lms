<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#true_false_question">
<i class="icon-add"></i>
Add True False
</button>
<!-- Modal -->
<div class="modal fade" id="true_false_question" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Add True False Question</h4>
            </div>
            {{ Form::open(['route' => 'e-learning.tests.ajax-post-test-questions-true-false', 'id' => 'true_false_form']) }}
                <div class="modal-body">
                    <input type="hidden" name="lesson_id" value="{{ $test->lesson->id }}">

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

                                <label for="question_answer" class="control-label col-md-4">
                                    Correct Answer
                                </label>

                                <div class="col-md-10">
                                    <label class="radio-inline">
                                        <input type="radio" name="question_answer" class="control-info" value="Yes" checked required> Yes
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="question_answer" class="control-info" value="No" required> No
                                    </label>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            {{ Form::close() }}
        </div>
    </div>
</div>

