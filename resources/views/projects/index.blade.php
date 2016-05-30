@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="campaigns">
            <div class="campaigns__filtre campaigns__filtre--listing">
                <div class="campaigns__wrap">
                    <a href="" class="campaigns__filtre-item campaigns__filtre-item--active" >What's Popular</a>
                    <a href="" class="campaigns__filtre-item">Recommended for you</a>
                    <a href="" class="campaigns__filtre-item">Trending</a>
                    <a href="" class="campaigns__filtre-item">Ending soon</a>
                </div>
                <a href="" class="campaigns__filtre-item campaigns__filtre-item--see-all">See all</a>
            </div>
            <div class="campaigns__list">

                @foreach($projects as $project)

                <article class="campaign-card">
                    <a href="{!! route('projects.show', $project->id) !!}" class="campaign-card__link"></a>
                    <div class="campaign-card__img"><img src="{!! $project->image->path !!}" alt="" width="256" height="187"></div>
                    <div class="campaign-card__wrap">
                        <div class="campaign-card__category">{!! $project->category->name !!}</div>
                        <h2 class="campaign-card__title"><a href="{!! route('projects.show', $project->id) !!}">{!! $project->name !!}</a></h2>
                        <p class="campaign-card__content">{!! $project->description !!}</p>
                        <div class="campaign-card__status">
                            <div class="campaign-card__container">
                                <div class="campaign-card__sum">${!! $project->budget !!}</div>
                                <div class="campaign-card__percent">45%</div>
                            </div>
                            <div class="campaign-card__bar">
                                <div class="campaign-card__bar-scale"></div>
                            </div>
                            <div class="campaign-card__container">
                                {{--<div class="campaign-card__location">Berlin, DE</div>--}}
                                <div class="campaign-card__timer">25 days left</div>
                            </div>
                        </div>
                    </div>
                </article>

                @endforeach


            </div>
            <div class="paginator">
                <div class="paginator__wrap">
                    <span class="paginator__arrow paginator__arrow--prev paginator__arrow--disabled">&laquo;</span>

                    <a href="" class="paginator__item  paginator__item--current">1</a>
                    <a href="" class="paginator__item">2</a>
                    <a href="" class="paginator__item">3</a>
                    <a href="" class="paginator__item">4</a>
                    <a href="" class="paginator__item">5</a>

                    <a href=""><span class="paginator__arrow paginator__arrow--next">&raquo;</span></a>
                </div>
            </div>
        </div>
        <div class="campaigns-sidebar">
            <div class="campaign-search">
                <input type="text" name="campaign-search" class="campaign-search__field" placeholder="Search campaign">
            </div>
            <div class="campaigns-category">
                <ul class="campaigns-category__list">
                    <li class="campaigns-category__item"><a href="">Art</a></li>
                    <li class="campaigns-category__item campaigns-category__item--active"><a href="">Comics</a></li>
                    <li class="campaigns-category__item"><a href="">Craft</a></li>
                    <li class="campaigns-category__item"><a href="">Dance</a></li>
                    <li class="campaigns-category__item"><a href="">Design</a></li>
                    <li class="campaigns-category__item"><a href="">Fashion</a></li>
                    <li class="campaigns-category__item"><a href="">Film &amp; Video</a></li>
                    <li class="campaigns-category__item"><a href="">Food</a></li>
                    <li class="campaigns-category__item"><a href="">Games</a></li>
                    <li class="campaigns-category__item"><a href="">Journalism</a></li>
                    <li class="campaigns-category__item"><a href="">Music</a></li>
                    <li class="campaigns-category__item"><a href="">Photography</a></li>
                    <li class="campaigns-category__item"><a href="">Publishing</a></li>
                    <li class="campaigns-category__item"><a href="">Technology</a></li>
                    <li class="campaigns-category__item"><a href="">Theater</a></li>
                </ul>
            </div>
        </div>
    </div>
@stop