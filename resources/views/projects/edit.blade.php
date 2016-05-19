@extends('layouts.master')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            Edit Project
            <div class="panel-nav pull-right" style="margin-top: -7px;">
                <a href="{!! route('projects.index') !!}" class="btn btn-default">Back</a>
            </div>
        </div>
        <div class="panel-body">
            @include('projects.form', ['model' => $project])
        </div>
    </div>

@stop