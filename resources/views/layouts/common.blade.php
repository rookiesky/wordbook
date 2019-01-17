<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@if(isset($book) && $book != '') {{ $book->title }}-- @endif @if(isset($sort) && $sort != '') {{ $sort->name }} -- @endif @if(\Illuminate\Support\Facades\Cache::has('SYSTEM_CACHE')){{ Cache('SYSTEM_CACHE')->title }} @else 文章系统 @endif</title>
    <meta name="keywords" content="@if(\Illuminate\Support\Facades\Cache::has('SYSTEM_CACHE')){{ Cache('SYSTEM_CACHE')->keyword }} @else 文章系统 @endif">
    <meta name="description" content="@if(\Illuminate\Support\Facades\Cache::has('SYSTEM_CACHE')){{ Cache('SYSTEM_CACHE')->description }} @else 文章系统 @endif">
    <meta name="robots" content="all">
    <meta name="googlebot" content="all">
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="/css/public.css?v0.1238932" rel="stylesheet">
    @yield('style')
</head>
<body>
@yield('content')
@if(\Illuminate\Support\Facades\Cache::has('SYSTEM_CACHE')){!! Cache('SYSTEM_CACHE')->statistical !!} @endif"
</body>
</html>
