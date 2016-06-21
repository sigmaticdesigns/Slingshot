@extends('layouts.master')

@section('title', $project->name )

@section('content')

    <div class="project" data-content="project">
        <div class="project__container">
            <div class="project__header">
                <div class="project-video">
                    @if ($project->files->first())
                        <img src="{!! $project->files->first()->path !!}" alt="">
                    @endif
                </div>
                <div class="project-card">
                    <h1 class="project-card__title">{!! $project->name !!}</h1>
                    <div class="project-card__owner">by {!! $project->user->name !!}</div>
                    <div class="campaign-card__status">
                        <div class="campaign-card__container">
                            <div class="campaign-card__sum">${!! $project->budget !!}</div>
                            <div class="campaign-card__percent">{!! $project->progress() !!}%</div>
                        </div>
                        <div class="campaign-card__bar">
                            <div class="campaign-card__bar-scale" style="width: {!! $project->progress() !!}%"></div>
                        </div>
                        <div class="campaign-card__container">
                            <div class="campaign-card__location">Berlin, DE</div>
                            <div class="campaign-card__timer">{!! $project->daysLeft() !!} days left</div>
                        </div>
                    </div>
                    <div class="project-card__wrap">
                        <a href="#" class="btn btn--back" id="btn-back">Back this project</a>
                        <div class="project-card__remind">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="xMidYMid" width="11" height="11" viewBox="0 0 11 11" class="project-card__remind-star">
                                <path d="M10.522,3.749 L7.492,3.447 C7.301,3.429 7.136,3.301 7.058,3.109 L5.973,0.341 C5.799,-0.116 5.183,-0.116 5.009,0.341 L3.933,3.109 C3.863,3.301 3.690,3.429 3.499,3.447 L0.469,3.749 C0.018,3.794 -0.165,4.388 0.174,4.708 L2.457,6.819 C2.605,6.956 2.665,7.157 2.622,7.357 L1.936,10.318 C1.832,10.784 2.309,11.167 2.709,10.921 L5.235,9.358 C5.400,9.258 5.600,9.258 5.765,9.358 L8.291,10.921 C8.690,11.167 9.168,10.793 9.064,10.318 L8.386,7.357 C8.343,7.157 8.404,6.956 8.551,6.819 L10.835,4.708 C11.164,4.388 10.973,3.794 10.522,3.749 Z" class="cls-1"/>
                            </svg>
                            <span>Remind me</span>
                        </div>
                        <div class="project-card__social">
                            <a href="" class="project-card__social-btn project-card__social-btn--fb">Facebook</a>
                            <a href="" class="project-card__social-btn project-card__social-btn--tw">Twitter</a>
                            <a href="" class="project-card__social-btn project-card__social-btn--google">Google plus</a>
                            <a href="" class="project-card__social-btn project-card__social-btn--in">Linkedin</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="project__main-cont">
                <div class="tabs">
                    <div class="tabs__nav">
                        <a href="#" class="tabs__nav-item tabs__nav-item--active" data-value="story">Story</a>
                        <a href="#" class="tabs__nav-item" data-value="comments">Comments<span class="comments-num">({!! $comments->count() !!})</span></a>
                        <a href="#" class="tabs__nav-item" data-value="backers">Backers<span class="backers-num">({!! $backers->count() !!})</span></a>
                    </div>


                    <div class="tab tab--story" data-content="story" style="display:block;">
                        <div class="story">
                            {!! $project->body !!}
                            <a href="#" class="btn btn--story" id="btn-back">Back this project</a>
                        </div>
                    </div>


                    {{--Comments--}}
                    <div class="tab tab--comments" data-content="comments" style="display:none;">
                        <div class="comments">
                            <div class="comments__num"><span class="comments-num">{!! $comments->count() !!}</span> Comments</div>

                            @if (Auth::check() && \App\User::find(Auth::user()->id)->backer($project->id))
                                {!! Form::open(['route' => 'comments.store', 'id' => 'form-comment', 'class' => 'comments__form', 'data-callback' => 'commentResponse']) !!}
                                    {!! Form::hidden('project_id', $project->id) !!}
                                    <div class="comments__img">
                                        <img src="{{ \App\User::find(Auth::user()->id)->avatar() }}" height="47" width="47" alt="Author image">
                                    </div>
                                    <textarea name="message" id="comment" cols="30" rows="10" placeholder="Add a comment..." class="comments__field"></textarea>
                                    {!! Form::submit('add', ['class' => 'btn btn--pledge']) !!}
                                {!! Form::close() !!}
                            @else
                                <div class="comments__no-contrib" style="display:block;">You must Contribute to this campaign to post a comment.</div>
                            @endif

                            @include('comments.index')

                        </div>
                    </div>

                    {{--Backers--}}
                    <div class="tab tab--backers" data-content="backers" style="display:none;">
                        <div class="backers">
                            @foreach($backers as $backer)
                            <div class="backers__item">
                                <div class="backers__item-block">
                                    <div class="backers__img">
                                        <img src="{!! $backer->user->avatar() !!}" width="40" height="40" alt="Backer image">
                                    </div>
                                    <div class="backers__name">{!! $backer->user->name !!}</div>
                                    <div class="backers__time">{!! $backer->created_at !!}</div>
                                </div>
                                <div class="backers__item-block">
                                    {{--<div class="backers__country">Country</div>--}}
                                    {{--<div class="backers__city">City</div>--}}
                                </div>
                                <div class="backers__item-block">
                                    <div class="backers__summ">${!! $backer->amount !!}</div>
                                </div>
                            </div>
                            @endforeach

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>





    <div class="pay" style="display:none;" id="pay-popup">
        <div class="pay__container">
            <div class="pay__title">Pay now</div>
            {!! Form::open(['route' => 'payment']) !!}
                {!! Form::hidden('project_id', $project->id) !!}
                <div class="pay__option-wrap">
                    <input type="radio" name="pay-method" id="paypal" value="paypal" class="pay__option">
                    <label class="pay__option-label pay__option-label--paypal" for="paypal"></label>
                </div>

                <div class="pay__option-wrap">
                    <input type="radio" name="pay-method" id="master" value="credit_card" class="pay__option">
                    <label class="pay__option-label pay__option-label--master" for="master"></label>
                </div>


                <div class="pay__summ">
                    <input type="text" name="amount" id="amount" value="" placeholder="Pledge amount" class="pay__summ-field">
                    {{--<a href="" class="btn btn--pledge">Pledge</a>--}}
                    {!! Form::submit('Pledge', ['class' => 'btn btn--pledge']) !!}
                </div>
            {!! Form::close() !!}
            <span class="pay__close">+</span>
        </div>
    </div>
@stop