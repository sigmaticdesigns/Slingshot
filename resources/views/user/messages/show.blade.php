@extends('layouts.master')

@section('title', 'Messages')

@section('content')
    <div class="static-page">
        <div class="static-page__banner">

        </div>
        <div class="static-page__content">

            <h2>{!! $message->subject !!}</h2>
            <p>
            {!! $message->message !!}
            </p>

            <a href="{!! route('user.messages.create') !!}" class="btn btn--add-project">Reply</a>
        </div>
    </div>

@stop