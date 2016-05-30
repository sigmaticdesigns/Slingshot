@extends('layouts.master')

@section('content')

    <div class="form-block">
        <h1 class="form-block__title">Create project</h1>
            @include('user.projects.form')
    </div>

@stop