@extends('layouts.master')

@section('title', 'Edit Project' )
@section('content')

    <div class="form-block" data-content="project-form">
        <h1 class="form-block__title">Edit project</h1>
        @include('user.projects.form', ['model' => $project])
    </div>

@stop