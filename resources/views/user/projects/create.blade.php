@extends('layouts.master')

@section('title', 'Create Project' )

@section('content')

    <div class="form-block" data-content="project-form">
        <h1 class="form-block__title">Create project</h1>
            @include('user.projects.form')
    </div>

@stop