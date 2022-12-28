@extends('layouts.app')
@section('body')
    <div class="container-fluid mt-3">
        <div class="d-flex flex-wrap">
            @foreach ($posts as $post)
                <div class="avatar" data-image="{{ $post->image }}" data-url="{{ route('posts.show', $post->id) }}">
                    <div class="rounded h-100 overflow-hidden position-relative">
                        <img src="{{ $post->image }}" alt="" class="h-100 __image">
                        <div class="hearth rounded position-absolute" data-url="{{ $post->is_action ? '' : route('posts.reaction', $post->id) }}">
                            <i class="fas fa-heart __icon {{ $post->is_action ? 'active' : '' }}"></i>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    @include('posts.modal')
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('.avatar').click(function () {
                let url = $(this).data('url')
                $('#post-modal .__image').attr('src', $(this).data('image'))
                $('#post-modal .__name').text('')
                $('#post-modal .__date').text('')
                $('#post-modal .__count').text('')
                $('#post-modal .__content').html('')
                $.ajax({
                    method: 'get',
                    url: url,
                    success: function (response) {
                        let data = response.data
                        $('#post-modal .__name').text(data.name ?? 'Người lạ')
                        $('#post-modal .__date').text(data.date)
                        $('#post-modal .__count').text(data.count)
                        $('#post-modal .__content').html(data.body)
                    }
                })
                $('#post-modal').modal('show');
            })

            $('.hearth').click(function (e) {
                e.stopPropagation();
                let url = $(this).data('url')
                if (url) {
                    $.ajax({
                        method: 'post',
                        url: url
                    })
                    $(this).find('.__icon').addClass('active')
                }
            })
        });
    </script>
@endpush
