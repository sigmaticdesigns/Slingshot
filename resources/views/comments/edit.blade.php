@extends('layouts.master')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            Edit Comment
            <div class="panel-nav pull-right" style="margin-top: -7px;">
                <a href="{!! route('comments.index') !!}" class="btn btn-default">Back</a>
            </div>
        </div>
        <div class="panel-body">
            @include('comments.form', ['model' => $comment])
        </div>
    </div>

@stop