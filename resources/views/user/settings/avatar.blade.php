@extends('layouts.master')

@section('content')

    <div class="form-block">
        <h1 class="form-block__title">Change profile picture</h1>

            {!! Form::model(Auth::user(), ['method' => 'POST', 'files' => true, 'url' => url('user/settings/update'), 'class' => 'fields-group']) !!}

                    {{--@if (Auth::user()->avatar)--}}
                        {{--<div class="profile__image-box">--}}
                            {{--<img src="{{ \App\User::find(Auth::user()->id)->image() }}" width="258" height="258" alt="My profile image">--}}
                        {{--</div>--}}
                    {{--@endif--}}




                <label class="fields-group__upload">
                    <span class="btn btn--upload">Upload Profile Picture</span>
                    {!! Form::file('avatar', ['id' => 'avatar']) !!}
                </label>
                <div class="fields-group__error">
                    {!! Form::label('avatar', '') !!}
                </div>

                <div class="fields-group__img-box" style="width: 258px;">
                    <span class="fields-group__img-close">+</span>
                </div>




                {!! Form::submit('Update', ['class' => 'btn btn--form-submit']) !!}


            {!! Form::close() !!}
    </div>
@stop