@extends('admin::layouts.master')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            Send New Message
            <div class="panel-nav pull-right" style="margin-top: -7px;">
                <a href="{!! route('admin.messages.index') !!}" class="btn btn-default">Back</a>
            </div>
        </div>
        <div class="panel-body">
            @include('admin.messages.form')
        </div>
    </div>

@stop