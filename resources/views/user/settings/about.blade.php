@extends('layouts.master')

@section('content')


    <div class="form-block">
        <h1 class="form-block__title">About Me</h1>


            {!! Form::model(Auth::user(), ['method' => 'POST', 'files' => true, 'url' => url('user/settings/update'), 'class' => 'fields-group']) !!}

                {!! Form::textarea('about', null, ['class' => 'fields-group__field fields-group__field--full-desc', 'placeholder' => 'About Me', 'cols' => 30, 'rows' => 20, 'maxlength' => 135,]) !!}
            <div class="fields-group__error">
                {!! Form::label('about', '') !!}
            </div>

                    {!! Form::submit('Save', ['class' => 'btn btn--form-submit']) !!}


            {!! Form::close() !!}

    </div>
@stop