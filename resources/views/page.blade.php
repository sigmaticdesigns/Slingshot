@extends('layouts.master')

@section('title', $page->title )

@section('content')
    <h1>{!! $page->title !!}</h1>
    <div>{!! $page->body !!}</div>
@stop