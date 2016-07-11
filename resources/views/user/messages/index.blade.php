@extends('layouts.master')

@section('title', 'Messages')

@section('content')
    <div class="my-projects">
        <div class="my-projects__container">
            <div class="my-projects__title">My Messages</div>
            <a href="{!! route('user.messages.create') !!}" class="btn btn--add-project">Send Message</a>
            <table class="my-projects__list">
                <thead>
                <tr class="my-projects__list-head">
                    <th>#</th>
                    <th>From</th>
                    <th>To</th>
                    <th>Subject</th>
                    <th>Sent At</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($messages as $message)
                    <tr class="my-projects__item">
                        <td>{!! $no !!}</td>
                        <td>
                            @if ($message->from_user_id == Auth::user()->id)
                                Me
                            @else
                                {!! $message->from->name !!}
                            @endif

                        </td>
                        <td>
                            @if ($message->to_user_id == Auth::user()->id)
                                Me
                            @else
                                {!! $message->to->name !!}
                            @endif
                        </td>
                        <td>{!! $message->subject !!}</td>
                        <td>{!! $message->created_at !!}</td>
                        <td>
                            <a href="{!! route('user.messages.show', $message->id) !!}" class="btn btn--preview">View</a>
                        </td>
                    </tr>
                    <?php $no++; ?>
                @endforeach

                </tbody>
            </table>
            <div class="panel-footer">
                <div class="text-center">{!! $messages !!}</div>
            </div>
        </div>
    </div>

@stop