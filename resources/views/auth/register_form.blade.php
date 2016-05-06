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

    {!! Form::open(['files' => true, 'url' => url('/auth/register')]) !!}

	<div class="form-group">
	    {!! Form::label('name', 'Name:', ['class' => 'col-md-2 control-label']) !!}
	    <div class="col-sm-9">
	        {!! Form::text('name', null, ['class' => 'form-control']) !!}
	    </div>
	</div>

	<div class="form-group">
	    {!! Form::label('email', 'Email:', ['class' => 'col-md-2 control-label']) !!}
	    <div class="col-sm-9">
	        {!! Form::email('email', null, ['class' => 'form-control']) !!}
	    </div>
	</div>

	<div class="form-group">
	    {!! Form::label('password', 'Password:', ['class' => 'col-md-2 control-label']) !!}
	    <div class="col-sm-9">
	        {!! Form::password('password', ['class' => 'form-control']) !!}
	    </div>
	</div>
    <div class="form-group">
	    {!! Form::label('password_confirmation', 'Confirm Password:', ['class' => 'col-md-2 control-label']) !!}
	    <div class="col-sm-9">
	        {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
	    </div>
	</div>

    <div class="form-group">
        <label class="col-md-2 control-label"></label>
        <div class="col-sm-9">
            {!! Form::submit('Sign Up', ['class' => 'btn btn-primary']) !!}
        </div>
    </div>
    {!! Form::close() !!}
</div>