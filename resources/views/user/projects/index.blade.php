@extends('layouts.master')

@section('title', 'My projects' )

@section('content')
    <div class="my-projects">
        <div class="my-projects__container">
            <div class="my-projects__title">My projects</div>
            <a href="{!! route('user.projects.create') !!}" class="btn btn--add-project">Add new</a>
            <table class="my-projects__list">
                <thead>
                <tr class="my-projects__list-head">
                    <th>#</th>
                    <th>Project title</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Budget</th>
                    <th>Short Description</th>
                    <th>Created At</th>
                    <th>Deadline At</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($projects as $project)
                    <tr class="my-projects__item">
                        <td>{!! $no !!}</td>
                        <td>{!! $project->name !!}</td>
                        <td>{!! $project->category->name !!}</td>
                        <td>{!! $project->status !!}</td>
                        <th>${!! $project->budget !!}</th>
                        <td>
                            {!! $project->description !!}
                        </td>
                        <td>{!! $project->created_at !!}</td>
                        <td>{!! $project->deadline !!}</td>
                        <td>
                            {!! Form::open(['method' => 'DELETE', 'route' => ['user.projects.destroy', $project->id], 'data-no-ajax' => true]) !!}
                            <a href="{!! route('user.projects.show', $project->id) !!}" class="btn btn--preview">Preview</a>
                            <a href="{!! route('user.projects.edit', $project->id) !!}" class="btn btn--edit">Edit</a>
                            <button type="submit" class="btn btn--delete" title="Delete">Delete</button>
                            {!! Form::close() !!}
                        </td>
                    </tr>
                <?php $no++; ?>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>

@stop