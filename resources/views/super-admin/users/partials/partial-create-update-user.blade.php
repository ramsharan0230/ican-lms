@section('additional-theme-js')
    <script type="text/javascript" src="{{ URL::asset('assets/js/plugins/forms/selects/select2.min.js') }}"></script>
@endsection

<div class="panel panel-flat">
    <div class="panel-body">
        <div class="row">
            <fieldset class="text-semibold">
                <legend>User Form</legend>

                <div class="col-md-4">
                    <div class="form-group {{ (!$errors->has('first_name') ? : 'has-error') }}">

                        <label for="first_name"
                               class="{{ (!$errors->has('first_name') ? : 'text-danger') }}">First Name </label> <span
                                class="text-danger pull-right"><i
                                    class="glyphicon glyphicon-asterisk"></i> Required</span>

                        {!! Form::text('first_name', null, ['class' => 'form-control', 'placeholder' => 'Enter
                        First name', 'id' => 'first_name']) !!}

                        @if($errors->has('first_name'))
                            <label class="validation-error-label">{{ $errors->first('first_name') }}</label>
                        @endif

                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group {{ (!$errors->has('last_name') ? : 'has-error') }}">

                        <label for="last_name"
                               class="{{ (!$errors->has('last_name') ? : 'text-danger') }}">Last
                            Name </label> <span
                                class="text-danger pull-right"><i
                                    class="glyphicon glyphicon-asterisk"></i> Required</span>

                        {!! Form::text('last_name', null, ['class' => 'form-control', 'placeholder' => 'Enter
                        Last name']) !!}

                        @if($errors->has('last_name'))
                            <label class="validation-error-label">{{ $errors->first('last_name') }}</label>
                        @endif

                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">

                        <label for="middle_name">Middle Name</label>

                        {!! Form::text('middle_name', null, ['class' => 'form-control', 'placeholder' => 'Enter
                        Middle Name']) !!}

                    </div>
                </div>

            </fieldset>
        </div>

        <div class="row">
            <fieldset>
                <div class="col-md-6">
                    <div class="form-group">

                        <label for="role_id">Choose Role </label>

                        {!! Form::select('role_id', $roles, Request::old('role_id'), ['class' => 'select-search']) !!}
                            
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group{{ $errors->has('active_status') ? ' has-error' : '' }}">
                        <label for="role_id">Active Status </label>
                         </br>
                        <label class="radio-inline m-t-5">
                            {{ Form::radio('active_status', 1, null, ['class' => 'control-info']) }} Yes
                        </label>
                        <label class="radio-inline m-t-5">
                            {{ Form::radio('active_status', 0, null, ['class' => 'control-info']) }} No
                        </label>

                        @if($errors->has('active_status'))
                            <span class="help-block">{{ $errors->first('active_status') }}</span>
                        @endif
                    </div>
                </div>
            </fieldset>
        </div>

        <div class="row">
            <fieldset class="text-semibold">
                <legend>Login Info</legend>

                <div class="col-md-6">
                    <div class="form-group {{ (!$errors->has('email') ? : 'has-error') }}">

                        <label for="email" class="{{ (!$errors->has('email') ? : 'text-danger') }}">Email</label> <span class="text-danger pull-right"><i class="glyphicon glyphicon-asterisk"></i> 
                        Required</span>

                        {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Enter email']) !!}

                        @if($errors->has('email'))
                            <label class="validation-error-label">{{ $errors->first('email') }}</label>
                        @endif

                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                        {{ Form::label('username', 'Username: ') }}
                        <span class="text-danger pull-right"><i class="glyphicon glyphicon-asterisk"></i> Required</span>
                        {{ Form::text('username', Request::old('username'), ['class' => 'form-control', 'placeholder' => 'Enter username here', 'required' => 'required']) }}
                        @if($errors->has('username'))
                            <span class="help-block">{{ $errors->first('username') }}</span>
                        @endif
                    </div>    
                </div>

        </div>

        <div class="row">

            <fieldset class="text-semibold">
                <div class="col-md-6">
                    <div class="form-group {{ (!$errors->has('password') ? : 'has-error') }}">

                        <label for="password"
                               class="{{ (!$errors->has('password') ? : 'text-danger') }}">Password</label>
                        <span class="text-danger pull-right"><i
                                    class="glyphicon glyphicon-asterisk"></i> Required</span>

                        {!! Form::input('password', 'password', null, ['class' => 'form-control', 'placeholder'
                        => 'Enter Password']) !!}

                        @if($errors->has('password'))
                            <label class="validation-error-label">{{ $errors->first('password') }}</label>
                        @endif

                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group {{ (!$errors->has('password_confirmation') ? : 'has-error') }}">

                        <label for="password_confirmation"
                               class="{{ (!$errors->has('password_confirmation') ? : 'text-danger') }}">Password</label>
                        <span class="text-danger pull-right"><i
                                    class="glyphicon glyphicon-asterisk"></i> Required</span>

                        {!! Form::input('password', 'password_confirmation', null, ['class' => 'form-control',
                        'placeholder' => 'Retype password']) !!}

                        @if($errors->has('password_confirmation'))
                            <label class="validation-error-label">{{ $errors->first('password_confirmation') }}</label>
                        @endif

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

@section('additional-js-code')
    <script>
        $('.select-search').select2();    //to activate select drop down with search functionality...
    </script>

    <script src="{{ URL::asset('assets/custom/js/custom-checkboxes-radios.js') }}"></script>
@endsection