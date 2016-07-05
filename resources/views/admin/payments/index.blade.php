@extends('admin::layouts.master')

@section('content')
  <div class="panel panel-default">
	<div class="panel-heading">
		All Payments
		<div class="panel-nav pull-right" style="margin-top: -7px;">

		</div>
	</div>
	<table class="table table-stripped table-bordered">
		<thead>
			<th class="text-center">#</th>
			<th>Project_id</th>
			<th>User_id</th>
			<th>Amount</th>
			<th>Method</th>
			<th>Is_paid</th>
			<th>Status</th>

			<th>Created At</th>
			<th class="text-center">Action</th>
		</thead>
		<tbody>
			@foreach ($payments as $payment)
				<tr>
					<td class="text-center">{!! $no !!}</td>
					<td>{!! $payment->project_id !!}</td>
					<td>{!! $payment->user_id !!}</td>
					<td>{!! $payment->amount !!}</td>
					<td>{!! $payment->method !!}</td>
					<td>{!! $payment->is_paid !!}</td>
					<td>{!! $payment->status !!}</td>
		
					<td>{!! $payment->created_at !!}</td>
					<td class="text-center">
						<div class="btn-group">

							<a href="{!! route('admin.payments.show', $payment->id) !!}" class="btn btn-sm btn-default" title="View" data-toggle="tooltip"><i class="glyphicon glyphicon-eye-open"></i></a>



						</div>
					</td>
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