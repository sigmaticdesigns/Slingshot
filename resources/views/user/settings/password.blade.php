@extends('layouts.master')

@section('content')



    <div class="form-block">
        <h1 class="form-block__title">Change password</h1>
        {!! Form::open(['method' => 'POST', 'url' => url('user/settings/change-password'), 'class' => 'fields-group']) !!}



        {!! Form::password('old_password', ['placeholder' => "Old Password", 'class' => 'fields-group__field']) !!}
        <div class="fields-group__error">
            {!! Form::label('old_password', '') !!}
        </div>

        {!! Form::password('password', ['placeholder' => "Password", 'class' => 'fields-group__field']) !!}
        <div class="fields-group__error">
            {!! Form::label('password', '') !!}
        </div>

        {!! Form::password('password_confirmation', ['placeholder' => "Confirm Password", 'class' => 'fields-group__field']) !!}
        <div class="fields-group__error">
            {!! Form::label('password_confirmation', '') !!}
        </div>


        {!! Form::submit('Change', ['class' => 'btn btn--form-submit']) !!}

        {!! Form::close() !!}
    </div>


@stop