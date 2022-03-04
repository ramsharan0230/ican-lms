<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title"><i class="icon-reading position-left"></i> Add Category</h5>
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
                <legend>Category Form</legend>

                <div class="col-md-6">
                    <div class="form-group {{ (!$errors->has('name') ? : 'has-error') }}">

                        <label for="grade_name" class="{{ (!$errors->has('name') ? : 'text-danger') }}">Name </label> <span
                                class="text-danger pull-right"><i class="glyphicon glyphicon-asterisk"></i> Required</span>

                        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter name']) !!}

                        @if($errors->has('name'))
                            <label class="validation-error-label">{{ $errors->first('name') }}</label>
                        @endif

                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">

                        <label for="display_name">Display Name </label>

                        {!! Form::text('display_name', null, ['class' => 'form-control', 'placeholder' => 'Enter display name']) !!}

                    </div>
                </div>

            </fieldset>
        </div>

        <div class="row">
            <fieldset class="text-semibold">

                <div class="col-md-12">
                    <div class="form-group">
                        {!! Form::label('description', 'Description', null, null) !!}
                        {!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => 8]) !!}
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