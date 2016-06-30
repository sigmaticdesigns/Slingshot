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
        {!! Form::model($model, ['files' => true, 'method' => 'PUT', 'route' => ['admin.letters.update', $model->id]]) !!}
    @else
        {!! Form::open(['files' => true, 'route' => 'admin.letters.store']) !!}
    @endif
    
	<div class="form-group">
	    {!! Form::label('name', 'Name:', ['class' => 'col-md-2 control-label']) !!}
	    <div class="col-sm-9">
	        {!! Form::text('name', null, ['class' => 'form-control']) !!}
	    </div>
	</div>

	<div class="form-group">
	    {!! Form::label('slug', 'Slug:', ['class' => 'col-md-2 control-label']) !!}
	    <div class="col-sm-9">
            @if (isset($model) && $model->id < 5)
                {{ $model->slug }}
            @else

	        {!! Form::text('slug', null, ['class' => 'form-control']) !!}
            @endif
	    </div>
	</div>

	<div class="form-group">
	    {!! Form::label('subject', 'Subject:', ['class' => 'col-md-2 control-label']) !!}
	    <div class="col-sm-9">
	        {!! Form::text('subject', null, ['class' => 'form-control']) !!}
	    </div>
	</div>

	<div class="form-group">
	    {!! Form::label('content', 'Content:', ['class' => 'col-md-2 control-label']) !!}
	    <div class="col-sm-9">
	        {!! Form::textarea('content', null, ['class' => 'form-control', 'id' => 'ckeditor']) !!}
	    </div>
	</div>

    <div class="form-group">
        <label class="col-md-2 control-label"></label>
        <div class="col-sm-9">
            {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
        </div>
    </div>
    {!! Form::close() !!}


        <div class="form-group">
            <div class="col-sm-9">
                You can use this variable:<br>
                {name} - User Name<br>
                {email} - User Email<br>
                {login_link} - Link to Login page<br>
                {email_verify_link} - Link to email verification<br>
            </div>
        </div>

</div>


@section('script')

    {!! script('vendor/ckeditor/ckeditor.js') !!}
    {!! script('vendor/ckfinder/ckfinder.js') !!}

    <script type="text/javascript">
        var prefix = '{!! asset(option("ckfinder.prefix")) !!}';
        CKEDITOR.editorConfig = function( config ) {
            config.filebrowserBrowseUrl = prefix + '/vendor/ckfinder/ckfinder.html';
            config.filebrowserImageBrowseUrl = prefix + '/vendor/ckfinder/ckfinder.html?type=Images';
            config.filebrowserFlashBrowseUrl = prefix + '/vendor/ckfinder/ckfinder.html?type=Flash';
            config.filebrowserUploadUrl = prefix + '/vendor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files';
            config.filebrowserImageUploadUrl = prefix + '/vendor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images';
            config.filebrowserFlashUploadUrl = prefix + '/vendor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash';
        };

        var editor = CKEDITOR.replace( 'ckeditor' );
        CKFinder.setupCKEditor( editor, prefix + '/vendor/ckfinder/') ;
    </script>
@stop
