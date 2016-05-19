@extends('layouts.master')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            Add New Project
            <div class="panel-nav pull-right" style="margin-top: -7px;">

            </div>
        </div>
        <div class="panel-body">
            @include('projects.form')
        </div>
    </div>

@stop