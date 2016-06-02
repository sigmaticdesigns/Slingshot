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
                    <a href="" class="campaigns__filtre-item campaigns__filtre-item--active" data-value="popular">What's Popular</a>
                    <a href="" class="campaigns__filtre-item" data-value="recommended">Recommended for you</a>
                    <a href="" class="campaigns__filtre-item" data-value="trending">Trending</a>
                    <a href="" class="campaigns__filtre-item" data-value="ending">Ending soon</a>
                </div>
                <a href="{!! route('projects.index') !!}" class="campaigns__filtre-item campaigns__filtre-item--see-all">See all</a>
            </div>
            <div data-content="projects-list">
                @include('projects.list')
            </div>

        </div>
        <div class="campaigns-sidebar">
            <div class="campaign-search">
                <form action="{!! route('projects.index') !!}" method="get" data-no-ajax="true">
                    <input type="text" name="search" class="campaign-search__field" placeholder="Search campaign">
                    <button type="submit" class="campaign-search__btn"></button>
                </form>
            </div>
            <div class="campaigns-category">
                <ul class="campaigns-category__list">
                    @foreach($categoryList as $category)
                    <li class="campaigns-category__item"><a href="/category/{!! $category->slug !!}" data-id="{!! $category->id !!}">{!! $category->name !!}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <section class="new-project">
        <div class="new-project__wrap">
            <h1 class="new-project__title">Ready To Promote Your New Project?</h1>
            <p class="new-project__content">The European languages are members of the same family. Their separate existence is a myth.</p>
            <a href="{!! route('projects.index') !!}" class="btn btn--explore">Explore a project</a>
            <a href="{!! route('user.projects.create') !!}" class="btn btn--create-new">Create a project</a>
        </div>
    </section>


@stop