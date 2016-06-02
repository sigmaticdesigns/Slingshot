<div class="campaigns__list">

    @if ($projects->count())
        @foreach($projects as $project)


            <article class="campaign-card">
                <a href="{!! route('projects.show', $project->id) !!}" class="campaign-card__link"></a>
                @if ($project->image)
                <div class="campaign-card__img"><img src="{!! $project->image->path !!}" alt="" width="256" height="187"></div>
                @endif
                <div class="campaign-card__wrap">
                    <div class="campaign-card__category">{!! $project->category->name !!}</div>
                    <h2 class="campaign-card__title"><a href="{!! route('projects.show', $project->id) !!}">{!! $project->name !!}</a></h2>
                    <p class="campaign-card__content">{!! $project->description !!}</p>
                    <div class="campaign-card__status">
                        <div class="campaign-card__container">
                            <div class="campaign-card__sum">${!! $project->budget !!}</div>
                            <div class="campaign-card__percent">{!! $project->progress() !!}%</div>
                        </div>
                        <div class="campaign-card__bar">
                            <div class="campaign-card__bar-scale" style="width: {!! $project->progress() !!}%"></div>
                        </div>
                        <div class="campaign-card__container">
                            {{--<div class="campaign-card__location">Berlin, DE</div>--}}
                            <div class="campaign-card__timer">{!! $project->daysLeft() !!} days left</div>
                        </div>
                    </div>
                </div>
            </article>

        @endforeach
    @else
        <div style="font-size: 18px;">Nothing found</div>
    @endif

</div>


@if(isset($showPagination) && $showPagination)

<div class="paginator">
    {!! $projects !!}
</div>
@endif