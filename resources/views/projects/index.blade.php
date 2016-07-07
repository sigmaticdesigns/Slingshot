@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="campaigns">
            <div class="campaigns__filtre campaigns__filtre--listing">
                <div class="campaigns__wrap">
                    <a href="" class="campaigns__filtre-item campaigns__filtre-item--active"  data-value="popular">What's Popular</a>
                    {{--<a href="" class="campaigns__filtre-item" data-value="recommended">Recommended for you</a>--}}
                    <a href="" class="campaigns__filtre-item" data-value="trending">Trending</a>
                    <a href="" class="campaigns__filtre-item" data-value="ending">Ending soon</a>
                </div>
                <div class="campaigns__type">
                    <a href="" class="campaigns__filtre-item campaigns__filtre-item--type" data-value="profit">Profit</a>
                    <a href="" class="campaigns__filtre-item campaigns__filtre-item--type" data-value="non_profit">Non profit</a>
                </div>
                <a href="{!! route('projects.index') !!}" class="campaigns__filtre-item campaigns__filtre-item--see-all">See all</a>
            </div>

            <div data-content="projects-list" data-ref="projects">
                @include('projects.list')
            </div>
        </div>
        <div class="campaigns-sidebar">
            <div class="campaign-search">
                <form action="{!! route('projects.index') !!}" method="get" data-no-ajax="true">
                    {!! Form::text('search', Illuminate\Support\Facades\Input::get('search'), ['class' => "campaign-search__field", 'placeholder' => "Search campaign"]) !!}
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
@stop