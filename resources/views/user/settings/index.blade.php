@extends('layouts.master')

@section('title', 'User Profile & Settings' )

@section('content')

    <div class="profile">
        <div class="profile__container">
            <h1 class="profile__title">Profile &amp; Settings</h1>

            <div class="profile__wrap">
                <div class="profile__image">
                    <div class="profile__image-box">
                        <img src="{{ \App\User::find(Auth::user()->id)->image() }}" width="258" height="258" alt="My profile image">
                    </div>
                    <a href="{{ url('user/settings/avatar') }}" class="btn btn--profile">Edit image</a>
                </div>

                <div class="profile__edit">
                    <ul class="profile__info">
                        <li class="profile__info-item profile__info-item--name">{!! Auth::user()->name !!}</li>
                        {{--<li class="profile__info-item">Country</li>--}}
                        {{--<li class="profile__info-item">City</li>--}}
                        {{--<li class="profile__info-item">Postal code</li>--}}
                        <li class="profile__info-item">{!! Auth::user()->email !!}</li>
                        {{--<li class="profile__info-item">Laguage - English</li>--}}
                    </ul>
                    <a href="{{ url('user/settings/about-me') }}" class="btn btn--profile">Edit profile</a>
                </div>

                <div class="profile__social">
                    <div class="profile__social-title">Social connections</div>
                    <a href="" class="btn btn--link-fb">Connect with Facebook</a>
                    <a href="" class="btn btn--link-in">Connect with Linkedin</a>
                </div>

                <div class="profile__password">
                    <a href="{{ url('user/settings/change-password') }}" class="btn btn--profile">Change password</a>
                </div>
            </div>

            <div class="profile__story">
                <div class="profile__story-title">Your story</div>
                <p class="profile__story-cont">
                    {!! Auth::user()->about !!}
                </p>
            </div>

            <div class="profile__links">
                <div class="profile__links-title">Outside links</div>
                <ul>
                    @foreach($user->links as $link)
                    <li class="profile__links-item"><a href="{{ $link }}" target="_blank">{{ $link }}</a></li>
                    @endforeach
                </ul>
                <a href="{{ url('user/settings/links') }}" class="btn btn--profile">Add custom link</a>
            </div>
        </div>
    </div>
@stop