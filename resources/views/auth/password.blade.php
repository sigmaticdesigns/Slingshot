@extends('layouts.master')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            Login
            <div class="panel-nav pull-right" style="margin-top: -7px;">
                <a href="{!! url('/auth/register') !!}" class="btn btn-default">Sign Up</a>
            </div>
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

    {!! Form::open(['files' => true, 'url' => url('/password/email'), 'data-no-ajax' => true]) !!}



                <div class="form-group">
                    {!! Form::label('email', 'Email:', ['class' => 'col-md-2 control-label']) !!}
                    <div class="col-sm-9">
                        {!! Form::email('email', old('email'), ['class' => 'form-control']) !!}
                    </div>
                </div>


                <div class="form-group">
                    <label class="col-md-2 control-label"></label>
                    <div class="col-sm-9">
                        {!! Form::submit('Send Password Reset Link', ['class' => 'btn btn-primary']) !!}
                    </div>
                </div>
                {!! Form::close() !!}
            </div>




        </div>
    </div>

@stop