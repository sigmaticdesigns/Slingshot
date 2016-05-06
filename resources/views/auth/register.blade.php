@extends('layouts.master')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            Sing Up
            <div class="panel-nav pull-right" style="margin-top: -7px;">
                <a href="{!! url('/') !!}" class="btn btn-default">Back</a>
            </div>
        </div>
        <div class="panel-body">
            @include('auth.register_form')
        </div>
    </div>

@stop