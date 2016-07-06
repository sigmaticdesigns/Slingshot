@extends($layout)

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            User info
            <div class="panel-nav pull-right" style="margin-top: -7px;">
                <a href="{!! redirect()->back()->getTargetUrl() !!}" class="btn btn-default">Back</a>
            </div>
        </div>
        <table class="table table-stripped table-bordered">
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
                            @foreach($user->projects as $project)
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
            <tr>
                <td><b>Send Email Message</b></td>
                <td>
                    <div class="form-horizontal">
                        {!! Form::open(['url' => 'user/send-message']) !!}
                        <div class="form-group">
                            {!! Form::label('subject', 'Subject:', ['class' => 'col-md-2 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::text('subject', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            {!! Form::label('content', 'Content:', ['class' => 'col-md-2 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::textarea('content', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label"></label>
                            <div class="col-sm-9">
                                {!! Form::submit('Send', ['class' => 'btn btn-primary']) !!}
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </td>
            </tr>
        </table>
    </div>
@stop