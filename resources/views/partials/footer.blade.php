<div class="footer">
    <div>
        @foreach(\App\Page::menu() as $page)
            <a href="{{ url($page->slug) }}">{!! $page->title !!}</a><br>
        @endforeach
    </div>
</div>