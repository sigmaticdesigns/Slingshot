@extends('layouts.master')

@section('title', $project->name )

@section('content')

    <div class="project" data-content="project">
        <div class="project__container">
            <div class="project__header">
                <div class="project-video">
                    @if ($project->video)
                        @if ('youtube' == $project->video['type'])
                            <iframe width="560" height="315" src="https://www.youtube.com/embed/{!! $project->video['id'] !!}?rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>
                        @endif
                        @if ('vimeo' == $project->video['type'])
                                <iframe src="https://player.vimeo.com/video/{!! $project->video['id'] !!}?title=0&byline=0&portrait=0" width="560" height="315" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                        @endif
                    @else
                        @if ($project->files->first())
                            <img src="{!! $project->files->first()->path !!}" alt="">
                        @endif
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
            {!! Form::open(['route' => 'payment', 'class' => 'fields-group fields-group--pay']) !!}
                {!! Form::hidden('project_id', $project->id) !!}

                <input type="radio" name="pay-method" id="paypal" value="paypal" class="fields-group__pay-option" checked>
                <label class="fields-group__pay-label fields-group__pay-label--paypal" for="paypal"></label>



                <input type="radio" name="pay-method" id="master" value="credit_card" class="fields-group__pay-option">
                <label class="fields-group__pay-label fields-group__pay-label--master" for="master"></label>



                <div class="fields-group__card">
                    <input type="text" name="firstname" id="firstname" value="" placeholder="First Name" class="fields-group__field">
                    <div class="fields-group__error">
                        <label for="firstname"></label>
                    </div>

                    <input type="text" name="lastname" id="lastname" value="" placeholder="Last Name" class="fields-group__field">
                    <div class="fields-group__error">
                        <label for="lastname"></label>
                    </div>

                    <input type="text" name="cardnumber" id="cardnumber" value="" placeholder="Card number" class="fields-group__field">
                    <div class="fields-group__error">
                        <label for="cardnumber"></label>
                    </div>

                    <div class="fields-group__card-wrap">
                        <div class="fields-group__select-wrap fields-group__select-wrap--card">
                            <select name="expire-month" class="fields-group__select" id="expire-month">
                                <option disabled selected>Month</option>
                                <option value="1">01</option>
                                <option value="2">02</option>
                                <option value="3">03</option>
                                <option value="4">04</option>
                                <option value="5">05</option>
                                <option value="6">06</option>
                                <option value="7">07</option>
                                <option value="8">08</option>
                                <option value="9">09</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                            </select>
                            <div class="fields-group__error">
                                <label for="expire-month"></label>
                            </div>
                        </div>

                        <div class="fields-group__select-wrap fields-group__select-wrap--card">
                            <select name="expire-year" class="fields-group__select" id="expire-year">
                                <option disabled selected>Year</option>
                                <option value="2016">2016</option>
                                <option value="2017">2017</option>
                                <option value="2018">2018</option>
                                <option value="2019">2019</option>
                                <option value="2020">2020</option>
                                <option value="2021">2021</option>
                                <option value="2022">2022</option>
                                <option value="2023">2023</option>
                                <option value="2024">2024</option>
                                <option value="2025">2025</option>
                                <option value="2026">2026</option>
                                <option value="2026">2026</option>
                            </select>
                            <div class="fields-group__error">
                                <label for="expire-year"></label>
                            </div>
                        </div>
                    </div>

                    <div class="fields-group__cvn-wrap">
                        <input type="text" name="cvn" id="cvn" value="" placeholder="CVN" maxlength="4" class="fields-group__field fields-group__field--cvn">
                        <div class="fields-group__tip-btn">?
                            <div class="fields-group__tip">The 3 or 4 digit number om the back of a Visa, Discover and MasterCard or in the front of an American Express card</div>
                        </div>
                        <div class="fields-group__error">
                            <label for="cvn"></label>
                        </div>
                    </div>
                </div>


                <div class="fields-group__summ">
                    <div class="fields-group__summ-wrap">
                        <input type="text" name="amount" id="summ" value="" placeholder="Pledge amount" class="fields-group__field fields-group__field--summ">
                        <div class="fields-group__error">
                            <label for="summ"></label>
                        </div>
                    </div>
                    {!! Form::submit('Pledge', ['class' => 'btn btn--pledge']) !!}
                </div>
            {!! Form::close() !!}
            <span class="pay__close">+</span>
        </div>
    </div>
@stop