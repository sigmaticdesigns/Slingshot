@extends('layouts.master')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            About Me

        </div>
        <div class="panel-body">



            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="form-horizontal">

                {!! Form::model(Auth::user(), ['method' => 'POST', 'files' => true, 'url' => url('settings/update')]) !!}
                <div class="form-group">
                    {!! Form::label('about', 'About Me:') !!}
                    {!! Form::textarea('about', null, ['class' => 'form-control', 'id' => 'ckeditor']) !!}
                    {!! $errors->first('about', '<div class="text-danger">:message</div>') !!}
                </div>
                <div class="form-group">
                    {!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}
                </div>

                {!! Form::close() !!}
            </div>


        </div>
    </div>
@stop