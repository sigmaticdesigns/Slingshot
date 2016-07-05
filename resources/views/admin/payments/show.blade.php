@extends('admin::layouts.master')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            Show Payment
            <div class="panel-nav pull-right" style="margin-top: -7px;">
                <a href="{!! route('admin.payments.edit', $payment->id) !!}" class="btn btn-default">Edit</a>
                <a href="{!! route('admin.payments.index') !!}" class="btn btn-default">Back</a>
            </div>
        </div>
        <table class="table table-stripped table-bordered">
            <tr>
                <td><b>ID</b></td>
                <td>{!! $payment->id !!}</td>
            </tr>

			
            <tr>
                <td><b>Project_id</b></td>
                <td>{!! $payment->project_id !!}</td>
            </tr>			
            <tr>
                <td><b>User_id</b></td>
                <td>{!! $payment->user_id !!}</td>
            </tr>			
            <tr>
                <td><b>Amount</b></td>
                <td>{!! $payment->amount !!}</td>
            </tr>			
            <tr>
                <td><b>Method</b></td>
                <td>{!! $payment->method !!}</td>
            </tr>			
            <tr>
                <td><b>Is_paid</b></td>
                <td>{!! $payment->is_paid !!}</td>
            </tr>			
            <tr>
                <td><b>Status</b></td>
                <td>{!! $payment->status !!}</td>
            </tr>

            <tr>
                <td><b>Created At</b></td>
                <td>{!! $payment->created_at !!}</td>
            </tr>
        </table>
    </div>
@stop