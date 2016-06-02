@extends('layouts.master')

@section('content')

    <div class="form-block">
        <h1 class="form-block__title">Change profile picture</h1>

            {!! Form::model(Auth::user(), ['method' => 'POST', 'files' => true, 'url' => url('user/settings/update'), 'class' => 'fields-group']) !!}

                    @if (Auth::user()->avatar)
                        <img src="/img/avatar/{{ Auth::user()->avatar }}">
                    @endif

                <div class="fields-group__img-box">
                    <label class="fields-group__upload">
                        <span class="btn btn--upload">Upload Profile Picture</span>
                        {!! Form::file('avatar') !!}
                    </label>
                </div>
                <div class="fields-group__error">
                    {!! Form::label('avatar', '') !!}
                </div>


                {!! Form::submit('Update', ['class' => 'btn btn--form-submit']) !!}


            {!! Form::close() !!}
    </div>
@stop