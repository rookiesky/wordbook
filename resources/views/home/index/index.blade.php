@extends('layouts.common')
@section('content')
    @include('layouts.nav')
    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col-xl-9">
                <div class="card rounded-0">
                    <div class="card-header bg-white">
                        最新文章
                    </div>
                    <div class="card-body list-group pt-0 pb-0 pr-0">
                        @foreach($books as $item)
                        <li class="list-group-item border-right-0 border-left-0">
                            <span class="badge badge-success mr-2">{{ $item->sort->name }}</span><a href="/article/{{ Hashids::encode($item->id) }}" target="_blank" title="{{ $item->title }}">{{ $item->title }}</a> <span class="float-right timeago">{{ $item->created_at->diffForHumans() }}</span>
                        </li>
                        @endforeach
                    </div>
                    <div class="card-footer text-muted">
                        <nav aria-label="...">
                            <ul class="pagination">
                               {{ $books->links() }}
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="col-xl-3">
                <div class="card text-center rounded-0">
                    <div class="card-header bg-white">
                        网站公告
                    </div>
                    <div class="card-body">
                        @if(\Illuminate\Support\Facades\Cache::has('SYSTEM_CACHE')){{ Cache('SYSTEM_CACHE')->notice }} @endif
                    </div>
                </div>
                <div class="card rounded-0 mt-4">
                    <div class="card-header bg-white">
                        最热文章
                    </div>
                    <div class="card-body list-group pt-0 pb-0 pr-0 art-host">
                        @foreach($hots as $item)
                        <li class="list-group-item border-top-0 border-right-0 border-left-0 text-truncate pl-2">
                            <span class="badge badge-danger mr-2">Hot</span><a href="/article/{{ Hashids::encode($item->id) }}" target="_blank" title="{{ $item->title }}">{{ $item->title }}</a>
                        </li>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid mt-4">
        <div class="card rounded-0">
            <div class="card-header bg-white">
                友情链接
            </div>
            <div class="card-body">
                <div class="row links">
                    @foreach($links as $item)
                    <div class="col-xl-1 pr-1 pl-1">
                        <a href="{{ $item->url }}" target="_blank" title="{{ $item->title }}">{{ $item->title }}</a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="footer text-center p-4 bg-white mt-4 text-secondary">
        警告：以上栏目涉及成人内容，未满21岁者或栏目内容触犯当地法律者，请即离开。
    </div>
@stop