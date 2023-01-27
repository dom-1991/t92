<div class="__header position-relative">
    <img src="{{ $post->image }}" alt="" class="w-100 __image">
    <button type="button" class="btn-close position-absolute" data-bs-dismiss="modal" aria-label="Close"></button>
    <div class="hearth rounded position-absolute px-1" data-url="">
        <span class="me-1 __count">{{ $post->reactions_count }}</span>
        <i class="fas fa-heart __icon {{ $post->status == \App\Models\Post::DONE ? 'done' : 'active' }}"></i>
    </div>
</div>
<div class="modal-body">
    <h5 class="mb-0 __name">{{ $post->name }}</h5>
    <i class="__date">Plan tháng {{ $post->month }} năm {{ $post->year }}</i>
    <br>
    <i class="__date">Chi tiêu dự tính: {{ number_format($post->price_estimate) }} đồng</i>
    <br>
    <i class="__date">Chi tiêu thực tế: {{ number_format($post->price) }} đồng</i>
    <div class="__content mt-1">
        {!! $post->body !!}
    </div>
    <form action="{{ route('posts.comment', $post->id) }}" method="post">
        @csrf
        <textarea name="text" class="form-control" id="" rows="3">{{ old('text') }}</textarea>
        <div class="text-end">
            <button class="btn btn-primary mt-2">Gửi</button>
        </div>
    </form>
    <div class="comment">
        @if($post->comments->count())
        <b>New comments:</b><br/>
        @endif
        @foreach ($post->comments as $comment)
            <i class="__date">{{ $comment->text }}</i><br/>
        @endforeach
    </div>
</div>
