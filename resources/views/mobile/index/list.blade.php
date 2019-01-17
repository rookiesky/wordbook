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
                <div class="left"><a href="#" class="link icon-only backbt" @click="closeview" style="display: none" ><i class="f7-icons">reply_fill</i></a></div>
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

                <div class="card" style="margin:0;border-radius: unset;">
        <div class="card-content card-content-padding">
            <div class="list">
                <ul>
                    <li v-for="item in books.data">
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
                <div class="card" style="margin:0;border-radius: unset;margin-top:1em;">
        <div class="card-content card-content-padding">
            <div class="row">
                <div class="col-33"><button class="col button button-fill" @click="upPage">上一页</button></div>
                <div class="col-33">
                    <div class="item-input-wrap input-dropdown-wrap">
                        <select v-model="books.current_page" @change="chossePage" placeholder="Please choose..." style="line-height: 3.5em;">
                            <option v-for="(item,index) in books.last_page" :value="item" >第@{{ item }}页</option>
                        </select>
                    </div>
                </div>
                <div class="col-33"><button class="col button button-fill" @click="nextPage">下一页</button></div>
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
            hash_id:"",
            book:{}
        },
        created:function () {
            var _self = this;
            _self.hash_id = window.location.pathname.split("/").pop();
            if(_self.hash_id != ''){
                $.getJSON('/api/list',{hash:_self.hash_id},function (data) {
                    _self.books = data.data
                });
            }
        },
        methods:{
            btview:function(hash){
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
            },
            nextPage:function () {
                var page = this.books.current_page + 1;
                if(page > this.books.last_page){
                    alert('已经是最后一页');
                    return false;
                }
                this.getApi(page);
            },
            upPage:function () {
                var page = this.books.current_page - 1;
                if(page < 1){
                    alert('已经是第一页');
                    return false;
                }
                this.getApi(page);
            },
            chossePage:function(){
                if(this.books.current_page < 1){
                    alert('已经是第一页');
                    return false;
                }
                if(this.books.current_page > this.books.last_page){
                    alert('已经是最后一页');
                    return false;
                }
                this.getApi(this.books.current_page);
            },
            getApi:function (page) {
                var _self = this;
                $.getJSON('/api/list',{hash:_self.hash_id,page:page},function (data) {
                    _self.books = data.data
                });
            }
        }
    });
</script>

@if(\Illuminate\Support\Facades\Cache::has('SYSTEM_CACHE')){!! Cache('SYSTEM_CACHE')->statistical !!} @endif"
</body>
</html>