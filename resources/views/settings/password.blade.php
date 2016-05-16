@extends('layouts.master')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            Change password

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

                {!! Form::open(['method' => 'POST', 'url' => url('settings/change-password')]) !!}

                <div class="form-group">
                    {!! Form::label('old_password', 'Old Password:') !!}
                    {!! Form::password('old_password', ['class'=>'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('password', 'New Password:') !!}
                    {!! Form::password('password', ['class'=>'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('password_confirmation', 'Confirm Password:') !!}
                    {!! Form::password('password_confirmation', ['class'=>'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}
                </div>

                {!! Form::close() !!}
            </div>


        </div>
    </div>
@stop