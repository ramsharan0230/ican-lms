@section('additional-theme-js')
    <script type="text/javascript" src="{{ URL::asset('assets/js/plugins/forms/selects/select2.min.js') }}"></script>
    {{--<script type="text/javascript" src="{{ URL::asset('assets/custom/ckeditor/ckeditor.js') }}"></script>--}}
    <script type="text/javascript" src="{{ URL::asset('assets/custom/ckeditor/ckeditor.js') }}"></script>
@endsection

<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title"><i class="icon-gear position-left"></i> Credit Hour Settings </h5>
    </div>

    <div class="panel-body">
        <div class="row">
            <fieldset class="text-semibold">


                <div class="form-group col-md-4 {{ (!$errors->has('name') ? : 'has-error') }}">

                    <label for="lesson_name"
                           class="control-label col-md-2 {{ (!$errors->has('name') ? : 'text-danger') }}">Credit
                        <span class="text-danger pull-right"><i
                                    class="glyphicon glyphicon-asterisk"></i> Required</span></label>

                    <div class="col-md-10">
                        {!! Form::number('credit', Request::old('credit'), ['class' => 'form-control', 'placeholder' => 'Enter Credit']) !!}
                        @if($errors->has('credit'))
                            <label class="validation-error-label">{{ $errors->first('credit') }}</label>
                        @endif

                    </div>
                </div>
                <div class="col-md-1 center">
                <h1> =</h1>
                </div>

                <div class="form-group col-md-4 {{ $errors->has('credit_hour_break') ? ' has-error' : '' }}">
                     <label for="credit_hour_break"
                           class="control-label col-md-2 {{ (!$errors->has('credit_hour_break') ? : 'text-danger') }}"> Hour
                        <span class="text-danger pull-right"><i
                                    class="glyphicon glyphicon-asterisk"></i> Required</span></label>
                    <div class="col-md-10">
                        {{ Form::number('credit_hour_break', Request::old('credit_hour_break'), ['class' => 'form-control', 'placeholder' => 'Enter hour per credit here']) }}
                    </div>

                    @if($errors->has('credit_hour_break'))
                        <span class="help-block">{{ $errors->first('credit_hour_break') }}</span>
                    @endif
                </div>

            </fieldset>
        </div>

        <div class="text-right">
            <button type="submit" class="btn btn-primary btn-lg">Save <i
                        class="icon-arrow-right14 position-right"></i></button>
        </div>
    </div>
</div>
