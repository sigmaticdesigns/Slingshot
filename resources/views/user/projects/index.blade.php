@extends('user.layouts.master')

@section('content')
  <div class="panel panel-default">
	<div class="panel-heading">
		<a href="/">Home</a> / My Projects
		<div class="panel-nav pull-right" style="margin-top: -7px;">
			<a href="{!! route('user.projects.create') !!}" class="btn btn-default">Add New</a>
		</div>
	</div>
	<table class="table table-stripped table-bordered">
		<thead>
			<th class="text-center">#</th>
			<th>Name</th>
            <th>Status</th>
			<th>Category</th>
			<th>Budget</th>
			<th>Description</th>
			<th>File</th>
			<th>Deadline</th>

			<th>Created At</th>
			<th class="text-center">Action</th>
		</thead>
		<tbody>
			@foreach ($projects as $project)
				<tr>
					<td class="text-center">{!! $no !!}</td>
					<td>{!! $project->name !!}</td>
                    <td data-type="status">{!! $project->status !!}</td>
					<td>{!! $project->category->name !!}</td>
					<td>{!! $project->budget !!}</td>
					<td>
                        {!! $project->description !!}
                    </td>
					<td>
                        <img src="{!! $project->image->path !!}" alt="" width="256" height="187">
                    </td>
					<td>{!! $project->deadline !!}</td>

					<td>{!! $project->created_at !!}</td>
					<td class="text-center">
						<div class="btn-group">
							{!! Form::open(['method' => 'DELETE', 'route' => ['user.projects.destroy', $project->id], 'data-no-ajax' => true]) !!}
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