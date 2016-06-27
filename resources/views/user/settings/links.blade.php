@extends('layouts.master')

@section('content')


    <div class="form-block">
        <h1 class="form-block__title">Outside Links</h1>


            {!! Form::model(Auth::user(), ['method' => 'POST', 'files' => true, 'url' => url('user/settings/links'), 'class' => 'fields-group']) !!}

                {!! Form::text('link', null, ['class' => 'fields-group__field', 'placeholder' => 'Outside Link']) !!}
                <div class="fields-group__error">
                    {!! Form::label('link', ' ') !!}
                </div>

                    {!! Form::submit('Save', ['class' => 'btn btn--form-submit']) !!}


            {!! Form::close() !!}

    </div>
@stop