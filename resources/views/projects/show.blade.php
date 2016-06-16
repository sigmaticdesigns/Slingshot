@extends('layouts.master')

@section('title', $project->name )

@section('content')

    <div class="project" data-content="project">
        <div class="project__container">
            <div class="project__header">
                <div class="project-video">
                    <img src="{!! $project->files->first()->path !!}" alt="">
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
                        <a href="#" class="btn btn--back">Back this project</a>
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
                        <a href="#" class="tabs__nav-item" data-value="comments">Comments<span class="comments-num">(3)</span></a>
                        <a href="#" class="tabs__nav-item" data-value="backers">Backers<span class="backers-num">(67)</span></a>
                    </div>


                    <div class="tab tab--story" data-content="story" style="display:block;">
                        <div class="story">
                            {!! $project->body !!}
                            <a href="#" class="btn btn--story">Back this project</a>
                        </div>
                    </div>


                    {{--Comments--}}
                    <div class="tab tab--comments" data-content="comments" style="display:none;">
                        <div class="comments">
                            <div class="comments__num"><span class="comments-num">125</span> Comments</div>
                            <div class="comments__no-contrib">You must Contribute to this campaign to post a comment.</div>

                            <form action="/" method="POST" class="comments__form">
                                <div class="comments__img"><img src="img/img-user.jpg" height="47" width="47" alt="Author image"></div>
                                <textarea name="comment" id="comment" cols="30" rows="10" placeholder="Add a comment..." class="comments__field"></textarea>
                            </form>
                            <div class="comments__item">
                                <div class="comments__img"><img src="img/img-user.jpg" height="47" width="47" alt="Author image"></div>
                                <div class="comments__item-cont">
                                    <div class="comments__author">Ekaterna <span class="comments__data">on May 12</span></div>
                                    <div class="comments__text">Joaquin Phoenix was gazed by MTV for luck. A wizard’s job is to vex chumps quickly in fog. Watch "Jeopardy! ",  Alex Trebek's fun TV quiz game. Woven silk pyjamas exchanged for blue quartz. Brawny gods just flocked up to quiz and vex him. Adjusting quiver and bow, Zompyc[1] killed the fox. My faxed joke won a pager in the cable TV quiz show. Amazingly few discotheques provide jukeboxes. My girl wove six dozen plaid jackets before she quit.</div>
                                    <div class="comments__reply">Reply</div>
                                    <form action="/" method="POST" class="comments__form">
                                        <div class="comments__img"><img src="img/img-user.jpg" height="47" width="47" alt="Author image"></div>
                                        <textarea name="comment" id="comment" cols="30" rows="10" placeholder="Add a comment..." class="comments__field"></textarea>
                                    </form>

                                </div>
                            </div>

                            <div class="comments__item comments__item--answer">
                                <div class="comments__img"><img src="img/img-user.jpg" height="47" width="47" alt="Author image"></div>
                                <div class="comments__item-cont">
                                    <div class="comments__author">Ekaterna <span class="comments__label">Starter</span><span class="comments__data"> on May 12</span></div>
                                    <div class="comments__text">Joaquin Phoenix was gazed by MTV for luck. A wizard’s job is to vex chumps quickly in fog. Watch "Jeopardy! ",  Alex Trebek's fun TV quiz game. Woven silk pyjamas exchanged for blue quartz. Brawny gods just flocked up to quiz and vex him. Adjusting quiver and bow, Zompyc[1] killed the fox. My faxed joke won a pager in the cable TV quiz show. Amazingly few discotheques provide jukeboxes. My girl wove six dozen plaid jackets before she quit.</div>
                                </div>
                            </div>

                            <div class="comments__item">
                                <div class="comments__img"><img src="img/img-user.jpg" height="47" width="47" alt="Author image"></div>
                                <div class="comments__item-cont">
                                    <div class="comments__author">Ekaterna <span class="comments__data">May 12</span></div>
                                    <div class="comments__text">Joaquin Phoenix was gazed by MTV for luck. A wizard’s job is to vex chumps quickly in fog. Watch "Jeopardy! ",  Alex Trebek's fun TV quiz game. Woven silk pyjamas exchanged for blue quartz. Brawny gods just flocked up to quiz and vex him. Adjusting quiver and bow, Zompyc[1] killed the fox. My faxed joke won a pager in the cable TV quiz show. Amazingly few discotheques provide jukeboxes. My girl wove six dozen plaid jackets before she quit.</div>
                                </div>
                            </div>

                            <div class="comments__item">
                                <div class="comments__img"><img src="img/img-user.jpg" height="47" width="47" alt="Author image"></div>
                                <div class="comments__item-cont">
                                    <div class="comments__author">Ekaterna <span class="comments__data">May 12</span></div>
                                    <div class="comments__text">Joaquin Phoenix was gazed by MTV for luck. A wizard’s job is to vex chumps quickly in fog. Watch "Jeopardy! ",  Alex Trebek's fun TV quiz game. Woven silk pyjamas exchanged for blue quartz. Brawny gods just flocked up to quiz and vex him. Adjusting quiver and bow, Zompyc[1] killed the fox. My faxed joke won a pager in the cable TV quiz show. Amazingly few discotheques provide jukeboxes. My girl wove six dozen plaid jackets before she quit.</div>
                                </div>
                            </div>

                        </div>
                    </div>

                    {{--Backers--}}
                    <div class="tab tab--backers" data-content="backers" style="display:none;">
                        <div class="backers">
                            <div class="backers__item">
                                <div class="backers__item-block">
                                    <div class="backers__img"><img src="img/img-user.jpg" width="40" height="40" alt="Backer image"></div>
                                    <div class="backers__name">User Name</div>
                                    <div class="backers__time">1 hour ago</div>
                                </div>
                                <div class="backers__item-block">
                                    <div class="backers__country">Country</div>
                                    <div class="backers__city">City</div>
                                </div>
                                <div class="backers__item-block">
                                    <div class="backers__summ">$455</div>
                                </div>
                            </div>

                            <div class="backers__item">
                                <div class="backers__item-block">
                                    <div class="backers__img"><img src="img/img-user.jpg" width="40" height="40" alt="Backer image"></div>
                                    <div class="backers__name">User Name</div>
                                    <div class="backers__time">1 hour ago</div>
                                </div>
                                <div class="backers__item-block">
                                    <div class="backers__country">Country</div>
                                    <div class="backers__city">City</div>
                                </div>
                                <div class="backers__item-block">
                                    <div class="backers__summ">$455</div>
                                </div>
                            </div>

                            <div class="backers__item">
                                <div class="backers__item-block">
                                    <div class="backers__img"><img src="img/img-user.jpg" width="40" height="40" alt="Backer image"></div>
                                    <div class="backers__name">User Name</div>
                                    <div class="backers__time">1 hour ago</div>
                                </div>
                                <div class="backers__item-block">
                                    <div class="backers__country">Country</div>
                                    <div class="backers__city">City</div>
                                </div>
                                <div class="backers__item-block">
                                    <div class="backers__summ">$455</div>
                                </div>
                            </div>

                            <div class="backers__item">
                                <div class="backers__item-block">
                                    <div class="backers__img"><img src="img/img-user.jpg" width="40" height="40" alt="Backer image"></div>
                                    <div class="backers__name">User Name</div>
                                    <div class="backers__time">1 hour ago</div>
                                </div>
                                <div class="backers__item-block">
                                    <div class="backers__country">Country</div>
                                    <div class="backers__city">City</div>
                                </div>
                                <div class="backers__item-block">
                                    <div class="backers__summ">$455</div>
                                </div>
                            </div>

                            <div class="backers__item">
                                <div class="backers__item-block">
                                    <div class="backers__img"><img src="img/img-user.jpg" width="40" height="40" alt="Backer image"></div>
                                    <div class="backers__name">User Name</div>
                                    <div class="backers__time">1 hour ago</div>
                                </div>
                                <div class="backers__item-block">
                                    <div class="backers__country">Country</div>
                                    <div class="backers__city">City</div>
                                </div>
                                <div class="backers__item-block">
                                    <div class="backers__summ">$455</div>
                                </div>
                            </div>

                            <div class="backers__item">
                                <div class="backers__item-block">
                                    <div class="backers__img"><img src="img/img-user.jpg" width="40" height="40" alt="Backer image"></div>
                                    <div class="backers__name">User Name</div>
                                    <div class="backers__time">1 hour ago</div>
                                </div>
                                <div class="backers__item-block">
                                    <div class="backers__country">Country</div>
                                    <div class="backers__city">City</div>
                                </div>
                                <div class="backers__item-block">
                                    <div class="backers__summ">$455</div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@stop