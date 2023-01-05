<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Chúc mừng năm mới 2023</title>
    <meta name="robots" content="noindex" />
    <meta name="keywords" content="t92, t92.app, plan cho tuong lai, lap ke hoach, nam moi, tabu, manh, tabu&manh">
    <meta name="description" content="Plan tabu&manh">
    <meta name="author" content="Tabu">
    <link rel="canonical" href="{{ route('homepage') }}">
    <meta property="og:title" content="Plan for the feature">
    <meta property="og:description" content="Plan tabu&manh">
    <meta property="og:url" content="{{ route('homepage') }}">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Tabu&Manh">
    <meta property="og:image" content="{{ asset('image/favicon.png') }}">
    <meta property="og:image:secure_url" content="{{ asset('image/favicon.png') }}">
    <meta property="og:image:height" content="300">
    <meta property="og:image:width" content="300">
    <meta name="twitter:title" content="Plan for the feature">
    <meta name="twitter:description" content="Plan tabu&manh">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="robots" content="noodp">
    <link rel="shortcut icon" href="{{ asset('image/favicon.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous">
    <link href="{{ mix('css/all.css') }}" rel="stylesheet">
    @stack('css')
</head>
<body class="font-sans antialiased">
@include('components.header')
@yield('body')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
@stack('scripts')
</body>
</html>
