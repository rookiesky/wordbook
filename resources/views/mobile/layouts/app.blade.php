<!DOCTYPE html>
<html>
<head>
    <!-- Required meta tags-->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no, minimal-ui">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Your app title -->
    <title>@if(\Illuminate\Support\Facades\Cache::has('SYSTEM_CACHE')){{ Cache('SYSTEM_CACHE')->title }} @else 文章系统 @endif</title>
    <!-- Path to Framework7 iOS CSS theme styles-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/framework7-icons@0.9.1/css/framework7-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/framework7@3.4.2/css/framework7.min.css" integrity="sha256-aphTxMH03jZWTVggWEwfgBUT0FRW4kK6jBnc/HHSqwM=" crossorigin="anonymous">
</head>
<body>
<div class="views" id="app">
    <div class="panel panel-right panel-cover" style="">
        <div class="page">
            <div class="page-content">
                <div class="block-title">菜单导航</div>
                <div class="list links-list">
                    <ul>
                        <li><a href="/mobile/" class="external panel-close">首页</a></li>
                        @if(!empty(Cache('SORT_CACHE')))
                            @foreach(Cache('SORT_CACHE') as $item)
                                <li>
                                    <a href="/mobile/list/{{ Hashids::encode($item->id) }}" class="external panel-close">{{ $item->name }}</a>
                                </li>
                            @endforeach
                        @endif
                        <li><a href="#" class="panel-close">关闭导航</a></li>
                    </ul>
                </div>

            </div>
        </div>
    </div>
    <div class="view view-main">
        <div class="navbar">
            <div class="navbar-inner">
                <div class="left"></div>
                <div class="title">@if(\Illuminate\Support\Facades\Cache::has('SYSTEM_CACHE')){{ Cache('SYSTEM_CACHE')->title }} @else 文章系统 @endif</div>
                <div class="right">
                    <a href="#" class="link icon-only panel-open" data-panel="right">
                        <i class="f7-icons ">data_fill</i>
                    </a>
                </div>
            </div>
        </div>
        <div class="pages">
            <div class="page" data-page="home">
                <div class="page-content">





                    <div class="card" style="margin:0;border-radius: unset;margin-top:1em;">
                        <div class="card-content card-content-padding">
                            警告：以上栏目涉及成人内容，未满21岁者或栏目内容触犯当地法律者，请即离开。
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/framework7@3.4.2/js/framework7.min.js" integrity="sha256-gHaD2KoH9eWXATHYXr47H2veWtzzDVV6jKi/WOL56P4=" crossorigin="anonymous"></script>
<script>
    var myApp = new Framework7({
        name:'book',
        lazy: {
            threshold: 50,
            sequential: false,
        },
    });

    var $$ = Dom7;

    var panelRight = myApp.panel.right;
    panelRight.on('open', function () {

    });
</script>
@yield('script')

@if(\Illuminate\Support\Facades\Cache::has('SYSTEM_CACHE')){!! Cache('SYSTEM_CACHE')->statistical !!} @endif"
</body>
</html>