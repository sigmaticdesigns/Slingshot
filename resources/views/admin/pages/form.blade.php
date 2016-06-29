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
        {!! Form::model($model, ['files' => true, 'method' => 'PUT', 'route' => ['admin.pages.update', $model->id]]) !!}
    @else
        {!! Form::open(['files' => true, 'route' => 'admin.pages.store']) !!}
    @endif
    
	<div class="form-group">
	    {!! Form::label('title', 'Title:', ['class' => 'col-md-2 control-label']) !!}
	    <div class="col-sm-9">
	        {!! Form::text('title', null, ['class' => 'form-control']) !!}
	    </div>
	</div>

	<div class="form-group">
	    {!! Form::label('slug', 'Slug:', ['class' => 'col-md-2 control-label']) !!}
	    <div class="col-sm-9">
	        {!! Form::text('slug', null, ['class' => 'form-control']) !!}
	    </div>
	</div>

	<div class="form-group">
	    {!! Form::label('section', 'Section:', ['class' => 'col-md-2 control-label']) !!}
	    <div class="col-sm-9">
	        {!! Form::select('section', ['about' => 'About Us', 'help' => 'Help'], null, ['class' => 'form-control']) !!}
	    </div>
	</div>

	<div class="form-group">
	    {!! Form::label('template', 'Template:', ['class' => 'col-md-2 control-label']) !!}
	    <div class="col-sm-9">
            {!! Form::select('template', ['view' => 'Editor', 'html' => 'HTML'], null, ['class' => 'form-control']) !!}
	    </div>
	</div>

	<div class="form-group">
	    {!! Form::label('body', 'Body:', ['class' => 'col-md-2 control-label']) !!}
	    <div class="col-sm-9" id="editorContainer">
	        {!! Form::textarea('body', null, ['class' => 'form-control', 'id' => 'ckeditor']) !!}
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

@section('script')

    {!! script('vendor/ckeditor/ckeditor.js') !!}
    {!! script('vendor/ckfinder/ckfinder.js') !!}

    <script type="text/javascript">
        $(function()
        {
            var prefix = '{!! asset(option("ckfinder.prefix")) !!}';
            CKEDITOR.editorConfig = function( config ) {
                config.filebrowserBrowseUrl = prefix + '/vendor/ckfinder/ckfinder.html';
                config.filebrowserImageBrowseUrl = prefix + '/vendor/ckfinder/ckfinder.html?type=Images';
                config.filebrowserFlashBrowseUrl = prefix + '/vendor/ckfinder/ckfinder.html?type=Flash';
                config.filebrowserUploadUrl = prefix + '/vendor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files';
                config.filebrowserImageUploadUrl = prefix + '/vendor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images';
                config.filebrowserFlashUploadUrl = prefix + '/vendor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash';
            };

            var editor;
            if ('view' == $('select[name=template]').val()) {
                editor = CKEDITOR.replace('ckeditor');
                CKFinder.setupCKEditor( editor, prefix + '/vendor/ckfinder/') ;
            }

            $('select[name=template]').on('change', function (e)
            {
                if ('view' == $(this).val())
                {
                    $("textarea#ckeditor").hide();
                    $("#cke_ckeditor").show();
                    editor = CKEDITOR.replace( 'ckeditor' );
                    CKFinder.setupCKEditor( editor, prefix + '/vendor/ckfinder/') ;
                }
                else
                {
                    $("textarea#ckeditor").show().css('visibility', '');
//                    $("#cke_ckeditor").hide();
                    editor.destroy();
                }

            });

        });

    </script>
@stop
