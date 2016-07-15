@extends('layouts.master')

@section('content')



    <div class="form-block">
        <h1 class="form-block__title">Change email</h1>
        {!! Form::open(['method' => 'POST', 'url' => url('user/settings/change-email'), 'class' => 'fields-group']) !!}



        {!! Form::email(
            'email',
            old('email'),
            [
                'placeholder' => 'email@...',
                'class' => 'fields-group__field' . ($errors->first('email') ? ' fields-group__field--invalid' : '')
            ]
        ) !!}
        <div class="fields-group__error">
            {!! Form::label('email', $errors->first('email')) !!}
        </div>

        {!! Form::submit('Change', ['class' => 'btn btn--form-submit']) !!}

        {!! Form::close() !!}
    </div>


@stop