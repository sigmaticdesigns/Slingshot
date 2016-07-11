@extends('admin::layouts.master')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            Show Message
            <div class="panel-nav pull-right" style="margin-top: -7px;">
                <a href="{!! redirect()->back()->getTargetUrl() !!}" class="btn btn-default">Back</a>
            </div>
        </div>
        <table class="table table-stripped table-bordered">
            <tr>
                <td><b>ID</b></td>
                <td>{!! $message->id !!}</td>
            </tr>

			
            <tr>
                <td><b>From</b></td>
                <td>{!! $message->from->name !!}</td>
            </tr>			
            <tr>
                <td><b>To</b></td>
                <td>{!! $message->to->name !!}</td>
            </tr>			
            <tr>
                <td><b>Subject</b></td>
                <td>{!! $message->subject !!}</td>
            </tr>			
            <tr>
                <td><b>Message</b></td>
                <td>{!! $message->message !!}</td>
            </tr>			

            <tr>
                <td><b>Sent At</b></td>
                <td>{!! $message->created_at !!}</td>
            </tr>
        </table>
    </div>
@stop