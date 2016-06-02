@extends('layouts.master')

@section('content')

    <div class="form-block">
        <h1 class="form-block__title">Forgot your password?</h1>
        {!! Form::open(['files' => true, 'url' => url('/password/email'), 'data-no-ajax' => true, 'class' => 'fields-group']) !!}
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

        {!! Form::submit('Send Password Reset Link', ['class' => 'btn btn--form-submit']) !!}
        {!! Form::close() !!}
    </div>

@stop