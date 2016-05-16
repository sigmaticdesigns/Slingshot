@extends('layouts.master')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            {!! $user->name !!} Profile

        </div>
        <table class="table table-stripped table-bordered">
            <tr>
                <td><b>ID</b></td>
                <td>{!! $user->id !!}</td>
            </tr>

            @if ($user->avatar)
                <tr>
                    <td><b>Avatar</b></td>
                    <td><img src="/img/avatar/{!! $user->avatar !!}"></td>
                </tr>
            @endif


            <tr>
                <td><b>Name</b></td>
                <td>{!! $user->name !!}</td>
            </tr>
            <tr>
                <td><b>About Me</b></td>
                <td>{!! $user->about !!}</td>
            </tr>

            <tr>
                <td><b>Created At</b></td>
                <td>{!! $user->created_at !!}</td>
            </tr>
        </table>
    </div>
@stop