@extends('user.layouts.master')

@section('content')
  <div class="panel panel-default">
	<div class="panel-heading">
		My Projects
		<div class="panel-nav pull-right" style="margin-top: -7px;">
			<a href="{!! route('user.projects.create') !!}" class="btn btn-default">Add New</a>
		</div>
	</div>
	<table class="table table-stripped table-bordered">
		<thead>
			<th class="text-center">#</th>
			<th>Name</th>
			<th>Category_id</th>
			<th>Budget</th>
			<th>Description</th>
			<th>Body</th>
			<th>File_id</th>
			<th>Deadline</th>
			<th>Half_deadline</th>

			<th>Created At</th>
			<th class="text-center">Action</th>
		</thead>
		<tbody>
			@foreach ($projects as $project)
				<tr>
					<td class="text-center">{!! $no !!}</td>
					<td>{!! $project->name !!}</td>
					<td>{!! $project->category_id !!}</td>
					<td>{!! $project->budget !!}</td>
					<td>{!! $project->description !!}</td>
					<td>{!! $project->body !!}</td>
					<td>{!! $project->file_id !!}</td>
					<td>{!! $project->deadline !!}</td>
					<td>{!! $project->half_deadline !!}</td>
		
					<td>{!! $project->created_at !!}</td>
					<td class="text-center">
						<div class="btn-group">
							{!! Form::open(['method' => 'DELETE', 'route' => ['user.projects.destroy', $project->id]]) !!}
							<a href="{!! route('user.projects.show', $project->id) !!}" class="btn btn-sm btn-default" title="View" data-toggle="tooltip"><i class="glyphicon glyphicon-eye-open"></i></a>
							<a href="{!! route('user.projects.edit', $project->id) !!}" class="btn btn-sm btn-default" title="Edit" data-toggle="tooltip"><i class="glyphicon glyphicon-edit"></i></a>
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
		<div class="text-center">{!! $projects !!}</div>
	</div>
</div>
@stop