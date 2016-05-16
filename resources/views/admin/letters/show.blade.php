@extends('admin::layouts.master')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            Show Letter
            <div class="panel-nav pull-right" style="margin-top: -7px;">
                <a href="{!! route('admin.letters.edit', $letter->id) !!}" class="btn btn-default">Edit</a>
                <a href="{!! route('admin.letters.index') !!}" class="btn btn-default">Back</a>
            </div>
        </div>
        <table class="table table-stripped table-bordered">
            <tr>
                <td><b>ID</b></td>
                <td>{!! $letter->id !!}</td>
            </tr>

			
            <tr>
                <td><b>Name</b></td>
                <td>{!! $letter->name !!}</td>
            </tr>			
            <tr>
                <td><b>Slug</b></td>
                <td>{!! $letter->slug !!}</td>
            </tr>			
            <tr>
                <td><b>Subject</b></td>
                <td>{!! $letter->subject !!}</td>
            </tr>			
            <tr>
                <td><b>Content</b></td>
                <td>{!! $letter->content !!}</td>
            </tr>

            <tr>
                <td><b>Created At</b></td>
                <td>{!! $letter->created_at !!}</td>
            </tr>
        </table>
    </div>
@stop