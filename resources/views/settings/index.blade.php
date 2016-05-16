@extends('layouts.master')

@section('title', 'User Settings' )

@section('content')
    <a href="{{ url('settings/change-password')  }}">Change password</a><br>
    Change Email<br>
    <a href="{{ url('settings/avatar')  }}">Change profile picture</a><br>
    <a href="{{ url('settings/about-me')  }}">About me information</a><br>
@stop