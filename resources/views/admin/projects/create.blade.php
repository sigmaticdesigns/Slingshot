@extends('admin::layouts.master')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            Add New Project
            <div class="panel-nav pull-right" style="margin-top: -7px;">
                <a href="{!! route('admin.projects.index') !!}" class="btn btn-default">Back</a>
            </div>
        </div>
        <div class="panel-body">
            @include('admin.projects.form')
        </div>
    </div>

@stop