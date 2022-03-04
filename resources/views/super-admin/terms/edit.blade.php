@extends('master-layouts.app-master-layouts.app-master-layout-super-admin')

@section('page-header')
    <div class="panel page-header page-header-xs border-bottom-teal">

        <div class="page-header-content">
            <div class="page-title">
                <h6>
                    <span class="text-semibold">Add Term</span>

                    <span class="pull-right custom-breadcrumb">

                     <ul class="breadcrumb">
                         <li><a href="{{ route('super-admin-dashboard') }}"><i class="icon-home2 position-left"></i> Home</a></li>
                         <li><a href="{{ route('terms.index') }}">Terms</a></li>
                         <li class="active">Add Terms</li>
                     </ul>
                </span>
                </h6>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="content">
        <!-- 2 columns form -->
        {{--add user form starts--}}
        {!! Form::open(['route'=>['terms.update', $term->id]]) !!}
        <input name="_method" type="hidden" value="PUT">
        <div class="panel panel-flat">
            <div class="panel-body">
                <div class="row">
                    <fieldset class="text-semibold">
                        <legend>Terms Form</legend>
                        <div class="col-md-4">
                            <div class="form-group {{ (!$errors->has('title') ? : 'has-error') }}">
                                <label for="title"
                                       class="{{ (!$errors->has('title') ? : 'text-danger') }}">Title </label> <span
                                        class="text-danger pull-right"><i
                                            class="glyphicon glyphicon-asterisk"></i> Required</span>

                                {!! Form::text('title', $term->title, ['class' => 'form-control', 'placeholder' => 'Enter
                                Title', 'id' => 'title', 'required' => 'required']) !!}

                                @if($errors->has('title'))
                                    <label class="validation-error-label">{{ $errors->first('title') }}</label>
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
                                {!! Form::textarea('description', $term->description, ['class' => 'form-control', 'rows' => 15, 'required' => 'required']) !!}
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
    {!! Form::close() !!}
    {{--add user form ends--}}
    <!-- /2 columns form -->
    </div>
@section('additional-js-code')
    <script src="{{URL::asset('/assets/js/unisharp/laravel-ckeditor/ckeditor.js')}}"></script>
    <script src="{{URL::asset('/assets/js/unisharp/laravel-ckeditor/adapters/jquery.js')}}"></script>

    <script>
        $('textarea').ckeditor();
        // $('.textarea').ckeditor(); // if class is prefered.
    </script>
@endsection
@endsection
