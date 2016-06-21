<div class="comments__item">
    <div class="comments__img">
        <img src="{{ $comment->author->avatar() }}" height="47" width="47" alt="Author image">
    </div>
    <div class="comments__item-cont">
        <div class="comments__author">{{ $comment->author->name }} <span class="comments__data">{{ $comment->created_at }}</span></div>
        <div class="comments__text">{{ $comment->message }}</div>
    </div>
</div>