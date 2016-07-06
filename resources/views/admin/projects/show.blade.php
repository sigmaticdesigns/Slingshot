@extends('admin::layouts.master')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            Show Project
            <div class="panel-nav pull-right" style="margin-top: -7px;">
                <a href="{!! route('admin.projects.edit', $project->id) !!}" class="btn btn-default">Edit</a>
                <a href="{!! route('admin.projects.index') !!}" class="btn btn-default">Back</a>
            </div>
        </div>
        <table class="table table-stripped table-bordered">
            <tr>
                <td><b>ID</b></td>
                <td>{!! $project->id !!}</td>
            </tr>

            @if ($project->image)
            <tr>
                <td><b>Image</b></td>
                <td>
                    <img src="{!! $project->image->path !!}" alt="" width="256" height="187">
                </td>
            </tr>
            @endif

			
            <tr>
                <td><b>Name</b></td>
                <td><a href="{!! route('projects.show', $project->id) !!}">{!! $project->name !!}</a></td>
            </tr>			
            <tr>
                <td><b>User</b></td>
                <td><a href="{!! route('admin.users.show', $project->user->id) !!}">{!! $project->user->name !!}</a></td>
            </tr>			
            <tr>
                <td><b>Status</b></td>
                <td>{!! $project->status !!}</td>
            </tr>			
            <tr>
                <td><b>Category</b></td>
                <td>{!! $project->category->name !!}</td>
            </tr>			
            {{--<tr>--}}
                {{--<td><b>Country_id</b></td>--}}
                {{--<td>{!! $project->country_id !!}</td>--}}
            {{--</tr>			--}}
            <tr>
                <td><b>Funding goal</b></td>
                <td>${!! $project->budget !!}</td>
            </tr>
            <tr>
                <td><b>Pledged</b></td>
                <td>${!! $project->purse !!}</td>
            </tr>
            <tr>
                <td><b>Short Description</b></td>
                <td>{!! $project->description !!}</td>
            </tr>
            <tr>
                <td><b>Full Description</b></td>
                <td>{!! $project->body !!}</td>
            </tr>
            <tr>
                <td><b>Deadline</b></td>
                <td>{!! $project->deadline !!}</td>
            </tr>
            <tr>
                <td><b>Deadline for getting 50%</b></td>
                <td>{!! $project->half_deadline !!}</td>
            </tr>

            <tr>
                <td><b>Created At</b></td>
                <td>{!! $project->created_at !!}</td>
            </tr>
            <tr>
                <td><b>Payments</b></td>
                <td>
                    <table class="table table-stripped table-bordered">
                    @foreach($backers as $payment)
                        <tr>
                            <td><a href="{!! route('admin.users.show', $payment->user->id) !!}">{!! $payment->user->name !!}</a></td>
                            <td>${!! $payment->amount !!}</td>
                            <td>{!! $payment->currentStatus !!}</td>
                        </tr>
                    @endforeach
                    </table>

                </td>
            </tr>
        </table>
    </div>
@stop