<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $post->name }}</title>
    <meta name="description" content="Lời chúc năm mới">
    <meta name="robots" content="noindex" />
    <link rel="icon" type="image/x-icon" href="{{ asset('image/favicon.png') }}">
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous">
    <link href="{{ mix('css/all.css') }}" rel="stylesheet">
    @stack('css')
</head>
<body class="font-sans antialiased">
<div class="post-modal container">
    <div class="__header position-relative">
        <img src="{{ $post->image }}" alt="" class="w-100 __image">
        <div class="hearth rounded position-absolute px-1" data-url="">
            <span class="me-1 __count">{{ $post->reactions_count }}</span>
            <i class="fas fa-heart __icon active"></i>
        </div>
    </div>
    <div class="modal-body">
        <h5 class="mb-0 __name">{{ $post->name }}</h5>
        <i class="__date">{{ $post->created_at->format('d/m/Y') }}</i>
        <div class="__content mt-1">
            {!! $post->body !!}
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>
