@extends($layout)

@section('content-header')
	<h1>
		{!! $title or 'All Users' !!} ({!! $users->count() !!})
		&middot;
		<small>{!! link_to_route('admin.users.create', 'Add New') !!}</small>
	</h1>
@stop

@section('content')

	@if(isset($search))
		@include('admin::users.search-form')
	@endif

	<table class="table" data-content="users">
		<thead>
			<th>No</th>
			<th>Name</th>
			<th>Email</th>
			<th>Created At</th>
			<th class="text-center">Action</th>
		</thead>
		<tbody>
			@foreach ($users as $user)
			<tr data-id="{{ $user->id }}">
				<td>{!! $no !!}</td>
				<td>{!! $user->name !!}</td>
				<td>{!! $user->email !!}</td>
				<td>{!! $user->created_at !!}</td>
				<td class="text-center">
					<a href="{!! route('admin.users.show', $user->id) !!}">View</a>
					&middot;
                    <a href="{!! route('admin.users.edit', $user->id) !!}">Edit</a>
					&middot;
					@include('admin::partials.modal', ['data' => $user, 'name' => 'users'])

					&middot;
					<a href="javascript:void(0)"
					   class="btn btn-danger btn-sm ban" {{ \App\User::STATUS_ACTIVE == $user->status ? '' : 'style=display:none' }}
					   data-action="set-status" data-status="{!! \App\User::STATUS_BANNED !!}">
						<span class="glyphicon glyphicon-ban-circle"></span>&nbsp;Ban</a>

					<a href="javascript:void(0)"
					   class="btn btn-success btn-sm unban" {{ \App\User::STATUS_BANNED == $user->status ? '' : 'style=display:none' }}
					   data-action="set-status" data-status="{!! \App\User::STATUS_ACTIVE !!}">
						<span class="glyphicon glyphicon-ok-circle"></span>&nbsp;Unban</a>


				</td>
			</tr>
			<?php $no++ ;?>
			@endforeach
		</tbody>
	</table>

	<div class="text-center">
		{!! pagination_links($users) !!}
	</div>
@stop
