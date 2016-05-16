@extends('admin::layouts.master')

@section('content')
  <div class="panel panel-default">
	<div class="panel-heading">
		All Letters
		<div class="panel-nav pull-right" style="margin-top: -7px;">
			<a href="{!! route('admin.letters.create') !!}" class="btn btn-default">Add New</a>
		</div>
	</div>
	<table class="table table-stripped table-bordered">
		<thead>
			<th class="text-center">#</th>
			<th>Name</th>
			<th>Slug</th>
			<th>Subject</th>

			<th>Created At</th>
			<th class="text-center">Action</th>
		</thead>
		<tbody>
			@foreach ($letters as $letter)
				<tr>
					<td class="text-center">{!! $no !!}</td>
					<td>{!! $letter->name !!}</td>
					<td>{!! $letter->slug !!}</td>
					<td>{!! $letter->subject !!}</td>

					<td>{!! $letter->created_at !!}</td>
					<td class="text-center">
						<div class="btn-group">
							{!! Form::open(['method' => 'DELETE', 'route' => ['admin.letters.destroy', $letter->id]]) !!}
							<a href="{!! route('admin.letters.show', $letter->id) !!}" class="btn btn-sm btn-default" title="View" data-toggle="tooltip"><i class="glyphicon glyphicon-eye-open"></i></a>
							<a href="{!! route('admin.letters.edit', $letter->id) !!}" class="btn btn-sm btn-default" title="Edit" data-toggle="tooltip"><i class="glyphicon glyphicon-edit"></i></a>
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
		<div class="text-center">{!! $letters !!}</div>
	</div>
</div>
@stop