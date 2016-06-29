@extends('layouts.master')

@section('title', $page->title )

@section('content')
    {!! $page->body !!}

    <section class="new-project">
        <div class="new-project__wrap">
            <h1 class="new-project__title">Ready To Promote Your New Project?</h1>
            <p class="new-project__content">The European languages are members of the same family. Their separate existence is a myth.</p>
            <a href="{!! route('projects.index') !!}" class="btn btn--explore">Explore a project</a>
            <a href="{!! route('user.projects.create') !!}" class="btn btn--create-new">Create a project</a>
        </div>
    </section>
@stop