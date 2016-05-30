	@if (isset($model))
		{!! Form::model($model, ['files' => true, 'method' => 'PUT', 'route' => ['user.projects.update', $model->id], 'class' => 'fields-group']) !!}
	@else
		{!! Form::open(['files' => true, 'route' => 'user.projects.store', 'class' => 'fields-group']) !!}
	@endif

	<div class="fields-group__img-box">
		<label class="fields-group__upload">
			<span class="btn btn--upload">Upload project image</span>
			<input type="file">
		</label>
	</div>

	{!! Form::text('name', null, ['class' => 'fields-group__field', 'placeholder' => 'Project name']) !!}
	<div class="fields-group__error">
		{!! Form::label('name', '') !!}
	</div>

	<div class="fields-group__text-wrap">
		{!! Form::textarea('description', null, ['class' => 'fields-group__field fields-group__field--short-desc', 'placeholder' => 'Short description', 'cols' => 30, 'rows' => 10, 'maxlength' => 135]) !!}
		<div class="fields-group__symbols">
			<span class="fields-group__counter">33</span>/135
		</div>
		<div class="fields-group__error">
			{!! Form::label('description', '') !!}
		</div>
	</div>

	<label for="project-category" class="fields-group__label fields-group__label--select">Category</label>
	<div class="fields-group__select-wrap">
		<select name="project-category" class="fields-group__select" id="project-category">
			<option value="Art" class="fields-group__option" selected>Art</option>
			<option value="Comics" class="fields-group__option">Comics</option>
			<option value="Craft" class="fields-group__option">Craft</optiComicson>
			<option value="Dance" class="fields-group__option">Dance</option>
			<option value="Design" class="fields-group__option">Design</option>
			<option value="Fashion" class="fields-group__option">Fashion</optiComicson>
			<option value="Film&amp;Video" class="fields-group__option">Film &amp; Video</option>
			<option value="Food" class="fields-group__option">Food</option>
			<option value="Games" class="fields-group__option">Games</optiComicson>
			<option value="Journalism" class="fields-group__option">Journalism</option>
			<option value="Music" class="fields-group__option">Music</option>
			<option value="Photography" class="fields-group__option">Photography</optiComicson>
			<option value="Publishing" class="fields-group__option">Publishing</option>
			<option value="Technology" class="fields-group__option">Technology</option>
			<option value="Theater" class="fields-group__option">Theater</option>
		</select>
	</div>

	<input type="text" class="fields-group__field fields-group__field--date" id="start-date" name="start-date" placeholder="Project start date">
	<div class="fields-group__error">
		<label for="start-date">Invalid date</label>
	</div>

	<input type="text" class="fields-group__field" id="goal" name="goal" placeholder="Funding goal">
	<div class="fields-group__error">
		<label for="goal">Invalid sum</label>
	</div>

	<div class="fields-group__video-box">
		<label class="fields-group__upload">
			<span class="btn btn--upload">Upload project video</span>
			<input type="file">
		</label>
	</div>

	<textarea class="fields-group__field fields-group__field--full-desc" name="full-desc" id="full-desc" cols="30" rows="10" placeholder="Project full description"></textarea>

	<button type="submit" class="btn btn--form-submit">Create project</button>
{!! Form::close() !!}







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
			{!! Form::model($model, ['files' => true, 'method' => 'PUT', 'route' => ['user.projects.update', $model->id]]) !!}
		@else
			{!! Form::open(['files' => true, 'route' => 'user.projects.store']) !!}
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
			{!! Form::label('description', 'Short Description:', ['class' => 'col-md-2 control-label']) !!}
			<div class="col-sm-9">
				{!! Form::textarea('description', null, ['class' => 'form-control']) !!}
			</div>
		</div>

		{{--<div class="form-group">--}}
		{{--{!! Form::label('body', 'Full Description:', ['class' => 'col-md-2 control-label']) !!}--}}
		{{--<div class="col-sm-9">--}}
		{{--{!! Form::textarea('body', null, ['class' => 'form-control']) !!}--}}
		{{--</div>--}}
		{{--</div>--}}

		<div class="form-group">
			{!! Form::label('file', 'Campaign image:', ['class' => 'col-md-2 control-label']) !!}
			<div class="col-sm-9">
				{!! Form::file('file') !!}
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
			{!! Form::label('half_deadline', 'Deadline for getting 50%:', ['class' => 'col-md-2 control-label']) !!}
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
