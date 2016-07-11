@extends($layout)

@section('content')
    <div class="panel panel-default">
        <div>
            <ul class="nav nav-tabs">
                <li class="active"><a href="#user-info">User info</a></li>
                <li><a href="{!! url('messages/user', $user->id) !!}">Messages</a></li>
            </ul>

            <div class="panel-nav pull-right">
                <a href="{!! redirect()->back()->getTargetUrl() !!}" class="btn btn-default">Back</a>
            </div>
        </div>


            <table id="user-info" class="table table-stripped table-bordered tab-pane fade in active">
                <tr>
                    <td><b>ID</b></td>
                    <td>{!! $user->id !!}</td>
                </tr>


                <tr>
                    <td><b>Name</b></td>
                    <td>{!! $user->name !!}</td>
                </tr>
                <tr>
                    <td><b>Email</b></td>
                    <td>{!! $user->email !!}</td>
                </tr>

                <tr>
                    <td><b>Registered At</b></td>
                    <td>{!! $user->created_at !!}</td>
                </tr>
                <tr>
                    <td><b>Payments</b></td>
                    <td>
                        @if($user->payments)
                        <table class="table table-stripped table-bordered">
                            @foreach($user->payments as $payment)
                                <tr>
                                    <td><a href="{!! route('admin.projects.show', $payment->project->id) !!}">{!! $payment->project->name !!}</a></td>
                                    <td>${!! $payment->amount !!}</td>
                                    <td>{!! $payment->currentStatus !!}</td>
                                </tr>
                            @endforeach
                        </table>
                        @else
                            No Payments
                        @endif

                    </td>
                </tr>
                <tr>
                    <td><b>Projects</b></td>
                    <td>
                        @if($user->projects)
                            <table class="table table-stripped table-bordered">
                                @foreach($user->projects()->latest()->get() as $project)
                                    <tr>
                                        <td><a href="{!! route('admin.projects.show', $project->id) !!}">{!! $project->name !!}</a></td>
                                        <td>{!! $project->status !!}</td>
                                        <td>${!! $project->purse !!}</td>
                                    </tr>
                                @endforeach
                            </table>
                        @else
                            No Projects
                        @endif

                    </td>
                </tr>
            </table>

    </div>
@stop