@extends('admin::layouts.master')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            Show Project
            <div class="panel-nav pull-right" style="margin-top: -7px;">
                <a href="{!! route('admin.projects.edit', $project->id) !!}" class="btn btn-default">Edit</a>
                <a href="{!! route('admin.projects.index') !!}" class="btn btn-default">Back</a>
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
                <td><b>User</b></td>
                <td>{!! $project->user->name !!}</td>
            </tr>			
            <tr>
                <td><b>Status</b></td>
                <td>{!! $project->status !!}</td>
            </tr>			
            <tr>
                <td><b>Category</b></td>
                <td>{!! $project->category->name !!}</td>
            </tr>			
            <tr>
                <td><b>Country_id</b></td>
                <td>{!! $project->country_id !!}</td>
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
                <td><b>Created At</b></td>
                <td>{!! $project->created_at !!}</td>
            </tr>
        </table>
    </div>
@stop