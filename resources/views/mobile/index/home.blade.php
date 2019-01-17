@include('mobile.layouts.header')
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
                <div class="left"> <a href="#" class="link icon-only backbt" @click="closeview" style="display: none" ><i class="f7-icons">reply_fill</i></a></div>
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
                    <div class="card" style="margin:0;border-radius: unset;margin-top:0.5em;">
                        <div class="card-header">网站公告</div>
                        <div class="card-content card-content-padding">@if(\Illuminate\Support\Facades\Cache::has('SYSTEM_CACHE')){{ Cache('SYSTEM_CACHE')->notice }} @endif</div>
                    </div>

                    <div class="card" style="margin:0;border-radius: unset;margin-top:1em;">
                        <div class="card-header">最新文章</div>
                        <div class="card-content card-content-padding">
                            <div class="list">
                                <ul>
                                        <li v-for="item in books">
                                            <a href="#" @click="btview(item.hash)" class="item-link item-content">
                                                <div class="item-media"><i class="f7-icons">circle</i></div>
                                                <div class="item-inner">
                                                    <div class="item-title">@{{ item.title }}</div>
                                                </div>
                                            </a>
                                        </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    @include('mobile.layouts.footer')

                </div>
            </div>
            <div class="page" style="display: none" data-page="content">
                <div class="page-content">
                    <div class="card" style="margin:0;border-radius: unset;color: rgba(2,0,0,.6);line-height: 27px;font-size: 15px;">
                        <div class="card-header">@{{ book.title }}</div>
                        <div class="card-content card-content-padding" v-html="book.content"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/framework7@3.4.2/js/framework7.min.js" integrity="sha256-gHaD2KoH9eWXATHYXr47H2veWtzzDVV6jKi/WOL56P4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.2.1/dist/jquery.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
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

    var app = new Vue({
        el:"#app",
        data:{
            books:{},
            book:{},
            menus:{},
        },
        created:function () {
            var _self = this;
                $.getJSON('/api/newest',function (data) {
                    _self.books = data.data;
                });
        },
        methods:{
            btview:function(hash){
                //$(".page").eq(1).show().siblings().hide();
                myApp.dialog.progress();
                var _self = this;
                $.getJSON('/api/get-book',{hash:hash},function (data) {
                    _self.book = data.data
                    myApp.dialog.close();
                    $(".backbt").show();
                    $(".page").eq(2).show()
                })
            },
            closeview:function(){
                $(".page").eq(2).hide()
                $(".backbt").hide();
            }
        }
    });
</script>

@if(\Illuminate\Support\Facades\Cache::has('SYSTEM_CACHE')){!! Cache('SYSTEM_CACHE')->statistical !!} @endif"
</body>
</html>