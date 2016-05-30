@extends('layouts.master')

@section('content')
    <div class="form-block">
        <h1 class="form-block__title">Log in</h1>
        {!! Form::open(['files' => true, 'url' => url('/auth/login'), 'data-no-ajax' => true, 'class' => 'fields-group']) !!}

            {!! Form::email(
                'email',
                null,
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


            {!! Form::password('password', ['placeholder' => "Password", 'class' => 'fields-group__field' . ($errors->first('password') ? ' fields-group__field--invalid' : '')]) !!}

            <div class="fields-group__error">
                @if($errors->first('password'))
                    {!! Form::label('password', $errors->first('password'), ['style' => 'display:block']) !!}
                @endif
            </div>


            {!! Form::submit('LOG IN', ['class' => 'btn btn--form-submit']) !!}
            <div class="fields-group__wrap">
                <div class="fields-group__input-wrap">
                    {!! Form::checkbox('remember', 1, null, ['class' => 'fields-group__checkbox']) !!}
                    {!! Form::label('remember', 'Remember Me:', ['class' => 'fields-group__label']) !!}
                </div>
                <a href="{!! url('/password/email') !!}" class="fields-group__link">Forgot your password?</a>
            </div>
        {!! Form::close() !!}
        <div class="form-block__footer">New to Sling-Shot? <a href="{!! url('/auth/register') !!}" class="form-block__link">Sign up!</a></div>
    </div>


@stop