@extends('layouts.master')

@section('content')

    <section class="promo">
        <div class="promo__slider">
            <div class="promo__slide promo__slide--slide1"></div>
            <div class="promo__slide promo__slide--slide2"></div>
            <div class="promo__slide promo__slide--slide3"></div>
            <div class="promo__slide promo__slide--slide4"></div>
            <div class="promo__slide promo__slide--slide5"></div>
        </div>
        <div class="promo__wrap">
            <h1 class="promo__title">Thousands of inspiring projects</h1>
            <p class="promo__content">Ready To Promote Your New Business? The European languages are members
                of the same family. Their separate existence is a myth.</p>
            <a href="" class="promo__btn btn">Take a look</a>
        </div>
    </section>
    <div class="container">
        <div class="campaigns">
            <div class="campaigns__filtre">
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
                    <a href="" class="campaign-card__link"></a>
                    <div class="campaign-card__img"><img src="{!! $project->image->path !!}" alt="" width="256" height="187"></div>
                    <div class="campaign-card__wrap">
                        <div class="campaign-card__category">{!! $project->category->name !!}</div>
                        <h2 class="campaign-card__title"><a href="">{!! $project->name !!}</a></h2>
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
                                <div class="campaign-card__location">Berlin, DE</div>
                                <div class="campaign-card__timer">25 days left</div>
                            </div>
                        </div>
                    </div>
                </article>

                @endforeach




            </div>
        </div>
        <div class="campaigns-sidebar">
            <div class="campaign-search">
                <input type="text" name="campaign-search" class="campaign-search__field" placeholder="Search campaign">
            </div>
            <div class="campaigns-category">
                <ul class="campaigns-category__list">
                    @foreach($categoryList as $category)
                    <li class="campaigns-category__item"><a href="/category/{!! $category->slug !!}">{!! $category->name !!}</a></li>
                    @endforeach
                    {{--<li class="campaigns-category__item campaigns-category__item--active"><a href="">Comics</a></li>--}}
                </ul>
            </div>
        </div>
    </div>
    <section class="new-project">
        <div class="new-project__wrap">
            <h1 class="new-project__title">Ready To Promote Your New Project?</h1>
            <p class="new-project__content">The European languages are members of the same family. Their separate existence is a myth.</p>
            <a href="" class="new-project__btn new-project__btn--explore btn">Explore a project</a>
            <a href="" class="new-project__btn new-project__btn--create btn">Create a project</a>
        </div>
    </section>


@stop