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
    <script>
        console.log(document.location.toString().split('//')[1].split('/')[1]);
        @if(!isset($resetpassword))
        function browserRedirect() {
            var sUserAgent = navigator.userAgent.toLowerCase();
            var bIsIpad = sUserAgent.match(/ipad/i) == "ipad";
            var bIsIphoneOs = sUserAgent.match(/iphone os/i) == "iphone os";
            var bIsMidp = sUserAgent.match(/midp/i) == "midp";
            var bIsUc7 = sUserAgent.match(/rv:1.2.3.4/i) == "rv:1.2.3.4";
            var bIsUc = sUserAgent.match(/ucweb/i) == "ucweb";
            var bIsAndroid = sUserAgent.match(/android/i) == "android";
            var bIsCE = sUserAgent.match(/windows ce/i) == "windows ce";
            var bIsWM = sUserAgent.match(/windows mobile/i) == "windows mobile";
            if (bIsIpad || bIsIphoneOs || bIsMidp || bIsUc7 || bIsUc || bIsAndroid || bIsCE || bIsWM) {
                return true;
            } else {
                return false;
            }
        }
        if(browserRedirect() == true){

            window.location.href = '/mobile';

        }
        @endif
    </script>
</head>
<body>
@yield('content')
@if(\Illuminate\Support\Facades\Cache::has('SYSTEM_CACHE')){!! Cache('SYSTEM_CACHE')->statistical !!} @endif"
</body>
</html>
