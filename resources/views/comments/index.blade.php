@extends('layouts.master')

@section('content')
  <div class="panel panel-default">
	<div class="panel-heading">
		All Comments
		<div class="panel-nav pull-right" style="margin-top: -7px;">
			<a href="{!! route('comments.create') !!}" class="btn btn-default">Add New</a>
		</div>
	</div>
	<table class="table table-stripped table-bordered">
		<thead>
			<th class="text-center">#</th>
			<th>User_id</th>
			<th>Project_id</th>
			<th>Message</th>
			<th>Parent_id</th>

			<th>Created At</th>
			<th class="text-center">Action</th>
		</thead>
		<tbody>
			@foreach ($comments as $comment)
				<tr>
					<td class="text-center">{!! $no !!}</td>
					<td>{!! $comment->user_id !!}</td>
					<td>{!! $comment->project_id !!}</td>
					<td>{!! $comment->message !!}</td>
					<td>{!! $comment->parent_id !!}</td>
		
					<td>{!! $comment->created_at !!}</td>
					<td class="text-center">
						<div class="btn-group">
							{!! Form::open(['method' => 'DELETE', 'route' => ['comments.destroy', $comment->id]]) !!}
							<a href="{!! route('comments.show', $comment->id) !!}" class="btn btn-sm btn-default" title="View" data-toggle="tooltip"><i class="glyphicon glyphicon-eye-open"></i></a>
							<a href="{!! route('comments.edit', $comment->id) !!}" class="btn btn-sm btn-default" title="Edit" data-toggle="tooltip"><i class="glyphicon glyphicon-edit"></i></a>
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
		<div class="text-center">{!! $comments !!}</div>
	</div>
</div>
@stop