@extends('admin::layouts.master')

@section('content')
  <div class="panel panel-default">
	<div class="panel-heading">
		All Messages
		<div class="panel-nav pull-right" style="margin-top: -7px;">

		</div>
	</div>
	<table class="table table-stripped table-bordered">
		<thead>
			<th class="text-center">#</th>
			<th>From</th>
			<th>To</th>
			<th>Subject</th>

			<th>Created At</th>
			<th class="text-center">Action</th>
		</thead>
		<tbody>
			@foreach ($messages as $message)
				<tr>
					<td class="text-center">{!! $no !!}</td>
					<td>{!! $message->from->name !!}</td>
					<td>{!! link_to_action('Admin\MessagesController@user', $message->to->name, ['id' => $message->to->id]) !!}</td>
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
							<a href="{!! route('admin.messages.show', $message->id) !!}" class="btn btn-sm btn-default" title="View" data-toggle="tooltip"><i class="glyphicon glyphicon-eye-open"></i></a>
							<button type="submit" class="btn btn-sm btn-default" title="Delete" data-toggle="tooltip"><i class="glyphicon glyphicon-trash"></i></button>
							{!! Form::close() !!}
						</div>
					</td>
				</tr>
				<?php $no++; ?>
			@endforeach
		</tbody>
	</table>
	<div class="panel-footer">
		<div class="text-center">{!! $messages !!}</div>
	</div>
</div>
@stop