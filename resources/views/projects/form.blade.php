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
    @if (isset($model))
        {!! Form::model($model, ['files' => true, 'method' => 'PUT', 'route' => ['projects.update', $model->id]]) !!}
    @else
        {!! Form::open(['files' => true, 'route' => 'projects.store']) !!}
    @endif
    
	<div class="form-group">
	    {!! Form::label('name', 'Name:', ['class' => 'col-md-2 control-label']) !!}
	    <div class="col-sm-9">
	        {!! Form::text('name', null, ['class' => 'form-control']) !!}
	    </div>
	</div>

	<div class="form-group">
	    {!! Form::label('category_id', 'Category:', ['class' => 'col-md-2 control-label']) !!}
	    <div class="col-sm-9">
            {!! Form::select('category_id', $categoryList, null, ['class' => 'form-control']) !!}
	    </div>
	</div>

	<div class="form-group">
	    {!! Form::label('budget', 'Budget:', ['class' => 'col-md-2 control-label']) !!}
	    <div class="col-sm-9 input-group">
            <span class="input-group-addon">$</span>
	        {!! Form::text('budget', null, ['class' => 'form-control']) !!}
            <span class="input-group-addon">.00</span>
	    </div>
	</div>

	<div class="form-group">
	    {!! Form::label('description', 'Description:', ['class' => 'col-md-2 control-label']) !!}
	    <div class="col-sm-9">
	        {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
	    </div>
	</div>

	<div class="form-group">
	    {!! Form::label('file_id', 'File Id:', ['class' => 'col-md-2 control-label']) !!}
	    <div class="col-sm-9">
	        {!! Form::text('file_id', null, ['class' => 'form-control']) !!}
	    </div>
	</div>

	<div class="form-group">
	    {!! Form::label('deadline', 'Deadline:', ['class' => 'col-md-2 control-label']) !!}
        <div class="col-sm-9 input-group date" id='datepicker1' data-provide="datepicker">
	        {!! Form::text('deadline', null, ['class' => 'form-control']) !!}
            <span class="input-group-addon">
                <span class="glyphicon glyphicon-calendar"></span>
            </span>
	    </div>
	</div>

	<div class="form-group">
	    {!! Form::label('half_deadline', 'Half Deadline:', ['class' => 'col-md-2 control-label']) !!}
	    <div class="col-sm-9 input-group date" id='datepicker2'>
	        {!! Form::text('half_deadline', null, ['class' => 'form-control']) !!}
            <span class="input-group-addon">
                <span class="glyphicon glyphicon-calendar"></span>
            </span>
	    </div>
	</div>

    <div class="form-group">
        <label class="col-md-2 control-label"></label>
        <div class="col-sm-9">
            {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
        </div>
    </div>
    {!! Form::close() !!}
</div>
