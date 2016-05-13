@extends('layouts.master')

@section('title', 'User Settings' )

@section('content')
    Change password<br>
    Change Email<br>
    Change profile picture<br>
    <a href="{{ url('settings/about-me')  }}">About me information</a><br>
@stop