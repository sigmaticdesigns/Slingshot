@extends('user.layouts.master')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            Show Project
            <div class="panel-nav pull-right" style="margin-top: -7px;">
                <a href="{!! route('user.projects.edit', $project->id) !!}" class="btn btn-default">Edit</a>
                <a href="{!! route('user.projects.index') !!}" class="btn btn-default">Back</a>
            </div>
        </div>
        <table class="table table-stripped table-bordered">
            <tr>
                <td><b>ID</b></td>
                <td>{!! $project->id !!}</td>
            </tr>

			
            <tr>
                <td><b>Name</b></td>
                <td>{!! $project->name !!}</td>
            </tr>			
            <tr>
                <td><b>Category</b></td>
                <td>{!! $project->category->name !!}</td>
            </tr>
            <tr>
                <td><b>image</b></td>
                <td>
                    <img src="{!! $project->image->path !!}" alt="" width="256" height="187">
                </td>
            </tr>
            <tr>
                <td><b>Budget</b></td>
                <td>{!! $project->budget !!}</td>
            </tr>			
            <tr>
                <td><b>Description</b></td>
                <td>{!! $project->description !!}</td>
            </tr>			
            <tr>
                <td><b>Body</b></td>
                <td>{!! $project->body !!}</td>
            </tr>			
            <tr>
                <td><b>File_id</b></td>
                <td>{!! $project->file_id !!}</td>
            </tr>			
            <tr>
                <td><b>Deadline</b></td>
                <td>{!! $project->deadline !!}</td>
            </tr>
            <tr>
                <td><b>Deadline for getting 50%</b></td>
                <td>{!! $project->half_deadline !!}</td>
            </tr>

            <tr>
                <td><b>Created At</b></td>
                <td>{!! $project->created_at !!}</td>
            </tr>
        </table>
    </div>
@stop