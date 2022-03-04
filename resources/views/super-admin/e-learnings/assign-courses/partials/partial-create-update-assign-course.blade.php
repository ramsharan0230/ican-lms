<div class="panel panel-flat">
    <div class="panel-body">
        <div class="row">
            <fieldset class="text-semibold">
                <legend>Assign Course To User Form</legend>

                <div class="col-md-12">
                    <div class="form-group">

                        <label for="grade_name">Select Student </label> <span
                                class="text-danger pull-right"><i
                                    class="glyphicon glyphicon-asterisk"></i> Required</span>
                         {!! Form::select('user_id', $students, null, ['class' => 'select-search']) !!}
                        {{-- <select name="user_id" class="select-search" required>
                            @foreach($students as $student)
                                <option value="{{ $student->id }}">
                                    {{ $student->first_name.' '.$student->last_name . ' ('. $student->username . ')'}}
                                </option>
                            @endforeach
                        </select> --}}
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label for="grade_name">Select Course </label> 
                        <span class="text-danger pull-right"><i class="glyphicon glyphicon-asterisk"></i> Required</span>
                        {!! Form::select('course_id', $courses, null, ['class' => 'select-search', 'required' =>
                        'required']) !!}
                    </div>
                </div>

            </fieldset>
        </div>

        <div class="text-right">
            <button type="submit" class="btn btn-primary btn-lg">Assign <i
                        class="icon-arrow-right14 position-right"></i></button>
        </div>
    </div>
</div>