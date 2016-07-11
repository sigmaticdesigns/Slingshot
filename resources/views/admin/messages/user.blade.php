@extends('admin::layouts.master')

@section('content')
    <div class="panel panel-default">
        <div>
            <ul class="nav nav-tabs">
                <li><a href="{!! route('admin.users.show', $user->id) !!}">User info</a></li>
                <li class="active"><a href="{!! url('messages/user', $user->id) !!}">Messages</a></li>
            </ul>

            <div class="panel-nav pull-right">
                <a href="{!! redirect()->back()->getTargetUrl() !!}" class="btn btn-default">Back</a>
            </div>
        </div>


	@if($messages->count())
        <table class="table table-stripped table-bordered tab-pane fade in active">
            <thead>
                <th>From</th>
                <th>Subject</th>

                <th>Sent At</th>
                <th class="text-center">Action</th>
            </thead>
            <tbody>
                @foreach ($messages as $message)
                    <tr>
                        <td>{!! $message->from->name !!}</td>
                        <td>
                            @if (!$message->is_viewed && $message->to->id == Auth::user()->id)
                                <small class="badge pull-right bg-green">new</small>
                            @endif
                            {!! $message->subject !!}
                        </td>

                        <td>{!! $message->created_at !!}</td>
                        <td class="text-center">
                            <div class="btn-group">
                                {!! Form::open(['method' => 'DELETE', 'route' => ['admin.messages.destroy', $message->id]]) !!}
                                <a href="{!! route('admin.messages.show', $message->id) !!}" class="btn btn-sm btn-default" title="View" data-toggle="tooltip">
                                    <i class="glyphicon glyphicon-eye-open"></i></a>
                                <button type="submit" class="btn btn-sm btn-default" title="Delete" data-toggle="tooltip">
                                    <i class="glyphicon glyphicon-trash"></i></button>
                                {!! Form::close() !!}
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td colspan="3">
                            {!! $message->message !!}
                        </td>
                    </tr>

                @endforeach
            </tbody>
        </table>

        <div class="panel-footer">
            <div class="text-center">{!! $messages !!}</div>
        </div>
    @endif


        <div class="panel-heading">
            Send New Message To <b>{!! $user->name !!}</b>

        </div>
        <div class="panel-body">
            @include('admin.messages.form')
        </div>




</div>
@stop