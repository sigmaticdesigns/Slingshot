@extends('layouts.master')

@section('content')


    <div class="form-block">
        <h1 class="form-block__title">Sign up</h1>
        {!! Form::open(['files' => true, 'url' => url('/auth/register'), 'data-no-ajax' => true, 'class' => 'fields-group']) !!}


            {!! Form::text(
                'name',
                null,
                [
                    'placeholder' => 'Name',
                    'class' => 'fields-group__field' . ($errors->first('name') ? ' fields-group__field--invalid' : '')
                ]
            ) !!}


            <div class="fields-group__error">
                @if($errors->first('name'))
                    {!! Form::label('name', $errors->first('name'), ['style' => 'display:block']) !!}
                @endif
            </div>

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

            {{--<input type="checkbox" id="news-sign" name="news-sign" class="fields-group__checkbox" checked>--}}
            {{--<label for="news-sign" class="fields-group__label">Sign me up for the weekly newsletter</label>--}}


            {!! Form::submit('Create an account', ['class' => 'btn btn--form-submit']) !!}
            {!! Form::close() !!}

        <div class="form-block__sign-policy">By signing up you agree to our <a href="" class="form-block__link">terms of use</a> and <a href="" class="form-block__link">privacy policy</a>.</div>
        <div class="form-block__footer">Already have an account? <a href="{{ url ('/auth/login') }}" class="form-block__link">Log In!</a></div>
    </div>




@stop