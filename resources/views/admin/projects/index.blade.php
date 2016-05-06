@extends('admin::layouts.master')

@section('content')
  <div class="panel panel-default">
	<div class="panel-heading">
		All Projects
		<div class="panel-nav pull-right" style="margin-top: -7px;">
			{{--<a href="{!! route('admin.projects.create') !!}" class="btn btn-default">Add New</a>--}}
		</div>
	</div>
	<table class="table table-stripped table-bordered">
		<thead>
			<th class="text-center">#</th>
			<th>Name</th>
			<th>User</th>
			<th>Status</th>
			<th>Category</th>
			<th>Country</th>
			<th>Budget</th>

			<th>Created At</th>
			<th class="text-center">Action</th>
		</thead>
		<tbody>
			@foreach ($projects as $project)
				<tr>
					<td class="text-center">{!! $no !!}</td>
					<td>{!! $project->name !!}</td>
					<td>{!! $project->user->name !!}</td>
					<td>{!! $project->status !!}</td>
					<td>{!! $project->category->name !!}</td>
					<td>{!! $project->country_id !!}</td>
					<td>{!! $project->budget !!}</td>

					<td>{!! $project->created_at !!}</td>
					<td class="text-center">
						<div class="btn-group">
							{!! Form::open(['method' => 'DELETE', 'route' => ['admin.projects.destroy', $project->id]]) !!}
							<a href="{!! route('admin.projects.show', $project->id) !!}" class="btn btn-sm btn-default" title="View" data-toggle="tooltip"><i class="glyphicon glyphicon-eye-open"></i></a>
							<a href="{!! route('admin.projects.edit', $project->id) !!}" class="btn btn-sm btn-default" title="Edit" data-toggle="tooltip"><i class="glyphicon glyphicon-edit"></i></a>
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