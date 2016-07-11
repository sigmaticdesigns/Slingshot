@extends('layouts.master')

@section('content')


    <div class="form-block">
        <h1 class="form-block__title">Send Message to Admin</h1>


        {!! Form::model(Auth::user(), ['method' => 'POST', 'files' => true, 'route' => 'user.messages.store', 'class' => 'fields-group']) !!}
        {!! Form::hidden('to_user_id', null) !!}


        {!! Form::text('subject', null, ['placeholder' => "Subject", 'class' => 'fields-group__field']) !!}
        <div class="fields-group__error">
            {!! Form::label('subject', '') !!}
        </div>

        {!! Form::textarea('message', null, ['class' => 'fields-group__field fields-group__field--full-desc', 'placeholder' => 'Message', 'cols' => 30, 'rows' => 20]) !!}
        <div class="fields-group__error">
            {!! Form::label('message', '') !!}
        </div>

        {!! Form::submit('Send', ['class' => 'btn btn--form-submit']) !!}


        {!! Form::close() !!}

    </div>
@stop