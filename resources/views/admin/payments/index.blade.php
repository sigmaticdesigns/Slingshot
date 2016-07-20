@extends('admin::layouts.master')

@section('content')
  <div class="panel panel-default">
	<div class="panel-heading">
		All Payments
		<div class="panel-nav pull-right" style="margin-top: -7px;">
            <a href="{!! route('admin.payments.index', ['status' => 'active']) !!}" class="btn btn-default">Show Active</a>
            <a href="{!! route('admin.payments.index', ['group' => 'user_id']) !!}" class="btn btn-default">Group By User</a>
		</div>
	</div>
	<table class="table table-stripped table-bordered">
		<thead>
			<th class="text-center">#</th>
            @if ($showProject)
			<th>Project</th>
            @endif
			<th>User</th>
			<th>Amount</th>
			<th>Method</th>
			<th>Status</th>

			<th>Created At</th>
			{{--<th class="text-center">Action</th>--}}
		</thead>
		<tbody>
			@foreach ($payments as $payment)
				<tr>
					<td class="text-center">{!! $no !!}</td>
                    @if ($showProject)
					<td><a href="{!! route('admin.projects.show', $payment->project->id) !!}">{!! $payment->project->name !!}</a></td>
                    @endif
					<td><a href="{!! route('admin.users.show', $payment->user->id) !!}">{!! $payment->user->name !!}</a></td>
					<td>{!! $payment->amount !!}</td>
					<td>{!! $payment->methodName !!}</td>
					<td>{!! $payment->currentStatus !!}</td>
		
					<td>{!! $payment->created_at !!}</td>
					{{--<td class="text-center">--}}
						{{--<div class="btn-group">--}}

							{{--<a href="{!! route('admin.payments.show', $payment->id) !!}" class="btn btn-sm btn-default" title="View" data-toggle="tooltip"><i class="glyphicon glyphicon-eye-open"></i></a>--}}



						{{--</div>--}}
					{{--</td>--}}
				</tr>
				<?php $no++; ?>
			@endforeach
		</tbody>
	</table>
	<div class="panel-footer">
		<div class="text-center">{!! $payments !!}</div>
	</div>
</div>
@stop