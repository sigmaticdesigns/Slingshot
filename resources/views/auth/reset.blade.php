@extends('layouts.master')

@section('content')

    <div class="form-block">
        <h1 class="form-block__title">Reset Password</h1>
        {!! Form::open(['files' => true, 'url' => url('/password/reset'), 'data-no-ajax' => true, 'class' => 'fields-group']) !!}

        {!! Form::hidden('token', $token) !!}

        {!! Form::email(
            'email',
            old('email'),
            [
                'placeholder' => 'email@...',
                'class' => 'fields-group__field' . ($errors->first('email') ? ' fields-group__field--invalid' : '')
            ]
        ) !!}


        <div class="fields-group__error">
            @if($errors->first('email'))
                {!! Form::label('email', $errors->first('email'), ['style' => 'display:block']) !!}
            @endif
        </div>


        {!! Form::password('password', ['placeholder' => 'Password', 'class' => 'fields-group__field' . ($errors->first('password') ? ' fields-group__field--invalid' : '')]) !!}
        <div class="fields-group__error">
            @if($errors->first('password'))
                {!! Form::label('password', $errors->first('password'), ['style' => 'display:block']) !!}
            @endif
        </div>


        {!! Form::password('password_confirmation', ['placeholder' => 'Confirm password', 'class' => 'fields-group__field' . ($errors->first('password_confirmation') ? ' fields-group__field--invalid' : '')]) !!}
        <div class="fields-group__error">
            @if($errors->first('password_confirmation'))
                {!! Form::label('password_confirmation', $errors->first('password_confirmation'), ['style' => 'display:block']) !!}
            @endif
        </div>

        {!! Form::submit('Reset Password', ['class' => 'btn btn--form-submit']) !!}
        {!! Form::close() !!}

        <div class="form-block__footer">Already have an account? <a href="{{ url ('/auth/login') }}" class="form-block__link">Log In!</a></div>
    </div>

@stop