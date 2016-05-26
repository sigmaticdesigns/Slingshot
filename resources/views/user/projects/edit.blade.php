@extends('user.layouts.master')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            Edit Project
            <div class="panel-nav pull-right" style="margin-top: -7px;">
                <a href="{!! route('user.projects.index') !!}" class="btn btn-default">Back</a>
            </div>
        </div>
        <div class="panel-body">
            @include('user.projects.form', ['model' => $project])
        </div>
    </div>

@stop