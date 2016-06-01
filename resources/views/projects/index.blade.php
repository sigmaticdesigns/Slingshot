@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="campaigns">
            <div class="campaigns__filtre campaigns__filtre--listing">
                <div class="campaigns__wrap">
                    <a href="" class="campaigns__filtre-item campaigns__filtre-item--active"  data-value="popular">What's Popular</a>
                    <a href="" class="campaigns__filtre-item" data-value="recommended">Recommended for you</a>
                    <a href="" class="campaigns__filtre-item" data-value="trending">Trending</a>
                    <a href="" class="campaigns__filtre-item" data-value="ending">Ending soon</a>
                </div>
                <a href="" class="campaigns__filtre-item campaigns__filtre-item--see-all">See all</a>
            </div>

            <div data-content="projects-list" data-ref="projects">
                @include('projects.list')
            </div>
        </div>
        <div class="campaigns-sidebar">
            <div class="campaign-search">
                <input type="text" name="campaign-search" class="campaign-search__field" placeholder="Search campaign">
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
@stop