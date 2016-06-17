@extends('layouts.master')

@section('title', $page->title )

@section('content')
    <div class="static-page">
        <div class="static-page__banner">
            <h1>
                Mission: To facilitate the sustainable development of micro, small and medium enterprises (MSMEs) in Guyana.
            </h1>
        </div>
        <div class="static-page__content">
            <h2>{!! $page->title !!}</h2>
            {!! $page->body !!}
        </div>
    </div>

    <section class="new-project">
        <div class="new-project__wrap">
            <h1 class="new-project__title">Ready To Promote Your New Project?</h1>
            <p class="new-project__content">The European languages are members of the same family. Their separate existence is a myth.</p>
            <a href="{!! route('projects.index') !!}" class="btn btn--explore">Explore a project</a>
            <a href="{!! route('user.projects.create') !!}" class="btn btn--create-new">Create a project</a>
        </div>
    </section>
@stop