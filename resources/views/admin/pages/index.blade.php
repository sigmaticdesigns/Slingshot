@extends('admin::layouts.master')

@section('content')
  <div class="panel panel-default">
	<div class="panel-heading">
		All Pages
		<div class="panel-nav pull-right" style="margin-top: -7px;">
			<a href="{!! route('admin.pages.create') !!}" class="btn btn-default">Add New</a>
		</div>
	</div>
	<table class="table table-stripped table-bordered">
		<thead>
			<th class="text-center">#</th>
			<th>Title</th>
			<th>Slug</th>
			<th>Section</th>

			<th>Created At</th>
			<th class="text-center">Action</th>
		</thead>
		<tbody>
			@foreach ($pages as $page)
				<tr>
					<td class="text-center">{!! $no !!}</td>
					<td>{!! $page->title !!}</td>
					<td>{!! $page->slug !!}</td>
					<td>{!! $page->section !!}</td>
					<td>{!! $page->created_at !!}</td>
					<td class="text-center">
						<div class="btn-group">
							{!! Form::open(['method' => 'DELETE', 'route' => ['admin.pages.destroy', $page->id]]) !!}

							<a href="{!! route('admin.pages.edit', $page->id) !!}" class="btn btn-sm btn-default" title="Edit" data-toggle="tooltip"><i class="glyphicon glyphicon-edit"></i></a>
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
		<div class="text-center">{!! $pages !!}</div>
	</div>
</div>
@stop