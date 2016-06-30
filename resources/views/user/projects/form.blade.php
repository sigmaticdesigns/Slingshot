	@if (isset($model))
		{!! Form::model($model, ['files' => true, 'method' => 'PUT', 'route' => ['user.projects.update', $model->id], 'class' => 'fields-group']) !!}
	@else
		{!! Form::open(['files' => true, 'route' => 'user.projects.store', 'class' => 'fields-group']) !!}
	@endif



    <label class="fields-group__upload">
        <span class="btn btn--upload">Upload project image</span>
        {!! Form::file('file', ['id' => 'file']) !!}
    </label>
    <div class="fields-group__error">
        {!! Form::label('file', '') !!}
    </div>

    <div class="fields-group__img-box" style="width: 256px;height: 187px;">
        <span class="fields-group__img-close">+</span>
    </div>


    {!! Form::url('video', null, ['class' => 'fields-group__field', 'placeholder' => 'Project video(youtube, vimeo)']) !!}
    <div class="fields-group__error">
        {!! Form::label('video', '') !!}
    </div>


	{!! Form::text('name', null, ['class' => 'fields-group__field', 'placeholder' => 'Project name']) !!}
	<div class="fields-group__error">
		{!! Form::label('name', '') !!}
	</div>

	<div class="fields-group__text-wrap">
		{!! Form::textarea('description', null, ['class' => 'fields-group__field fields-group__field--short-desc', 'placeholder' => 'Short description', 'cols' => 30, 'rows' => 10, 'maxlength' => 135, 'id' => 'description']) !!}
		<div class="fields-group__symbols">
			<span class="fields-group__counter">33</span>/135
		</div>
	</div>
    <div class="fields-group__error">
        {!! Form::label('description', '') !!}
    </div>


	<div class="fields-group__select-wrap">
		{!! Form::select('category_id', $categoryList, null, ['class' => 'fields-group__select', 'placeholder' => 'Choose project category']) !!}
	</div>
	<div class="fields-group__error">
		{!! Form::label('category_id', '') !!}
	</div>

	@if (!isset($model))

		{!! Form::text('deadline', null, ['class' => 'fields-group__field fields-group__field--date', 'placeholder' => "Project deadline date", 'data-pmu-format' => 'm/d/Y']) !!}
		<div class="fields-group__error">
			{!! Form::label('deadline', '') !!}
		</div>

		{!! Form::text('half_deadline', null, ['class' => 'fields-group__field fields-group__field--date', 'placeholder' => "Deadline for getting 50%", 'data-pmu-format' => 'm/d/Y']) !!}
		<div class="fields-group__error">
			{!! Form::label('half_deadline', '') !!}
		</div>

		{!! Form::text('budget', null, ['class' => 'fields-group__field', 'placeholder' => "Funding goal"]) !!}
		<div class="fields-group__error">
			{!! Form::label('budget', '') !!}
		</div>

	@endif


	{!! Form::textarea('body', null, ['class' => 'fields-group__field fields-group__field--full-desc', 'cols' => "30", 'rows' => "10", 'placeholder' => "Project full description", 'id' => 'wysiwyg']) !!}
	<div class="fields-group__error">
		{!! Form::label('body', '') !!}
	</div>

    @if (isset($model))
        {!! Form::submit('Update project', ['class' => 'btn btn--form-submit']) !!}
    @else
        {!! Form::submit('Create project', ['class' => 'btn btn--form-submit']) !!}
    @endif
{!! Form::close() !!}


    @section('script')
        {!! HTML::script('vendor/ckeditor/ckeditor.js') !!}
    @stop
