@extends('admin::layouts.master')

@section('content-header')
    <h1>
        Settings
    </h1>
    @stop

    @section('content')

            <!-- Nav tabs -->
    <ul class="nav nav-tabs">
        <li class="active"><a href="#home" data-toggle="tab">Home Page</a></li>
        <li><a href="#logo" data-toggle="tab">Logo</a></li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <div class="tab-pane active" id="home">
            <h3></h3>
            {!! Form::open(['files' => true]) !!}
            <div class="form-group">
                {!! Form::label('index.title', 'Title:') !!}
                {!! Form::text('index.title', option('index.title'), ['class' => 'form-control']) !!}
                {!! $errors->first('index.title', '<div class="text-danger">:message</div>') !!}
            </div>
            <div class="form-group">
                {!! Form::label('index.content', 'Content:') !!}
                {!! Form::textarea('index.content', option('index.content'), ['class' => 'form-control', 'rows' => 3]) !!}
                {!! $errors->first('index.content', '<div class="text-danger">:message</div>') !!}
            </div>
            <div class="form-group">
                {!! Form::label('index.link', 'Link:') !!}
                {!! Form::text('index.link', option('index.link'), ['class' => 'form-control']) !!}
                {!! $errors->first('index.link', '<div class="text-danger">:message</div>') !!}
            </div>
            <div class="form-group">
                {!! Form::label('index.images', 'Images:') !!}
                <br>
                {!! Form::label('image', 'Upload image:') !!}
                {!! Form::file('image') !!}
                <br>
                @if($slider)
                    <table>
                    @foreach($slider as $img)
                        <tr><td>
                                <img src="{!! $img !!}" height="150">
                            </td>
                            <td>&nbsp;
                                <a href="javascript:void(null);" onclick="$(this).parents('tr').remove();" class="btn btn-sm btn-danger" title="Edit" data-toggle="tooltip"><i class="glyphicon glyphicon-trash"></i></a>
                                {!! Form::hidden('index.slider[]', $img) !!}
                            </td>
                        </tr>
                        <tr><td>&nbsp;</td><td></td></tr>
                    @endforeach
                    </table>
                @endif

            </div>
            <div class="form-group">
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
            </div>
            {!! Form::close() !!}
        </div>

        <div class="tab-pane" id="logo">
            <h3></h3>
            {!! Form::open() !!}
            <div class="form-group">
                {!! Form::label('site.logo.first', 'Site Logo (first part):') !!}
                {!! Form::text('site.logo.first', option('site.logo.first'), ['class' => 'form-control']) !!}
                {!! $errors->first('site.logo.first', '<div class="text-danger">:message</div>') !!}
            </div>
            <div class="form-group">
                {!! Form::label('site.logo.second', 'Site Logo (second part):') !!}
                {!! Form::text('site.logo.second', option('site.logo.second'), ['class' => 'form-control']) !!}
                {!! $errors->first('site.logo.second', '<div class="text-danger">:message</div>') !!}
            </div>
            <div class="form-group">
                {!! Form::label('logo', 'Upload image:') !!}
                {!! Form::file('logo') !!}
                {!! $errors->first('logo', '<div class="text-danger">:message</div>') !!}
            </div>
            <div class="form-group">
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
            </div>
            {!! Form::close() !!}
        </div>

    </div>

@stop
