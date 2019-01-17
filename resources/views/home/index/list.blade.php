@extends('layouts.common')
@section('content')
    @include('layouts.nav')
    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col-xl-9">
                <div class="card rounded-0">
                    <div class="card-header bg-white">
                        {{ $sort->name }}-最新章节
                    </div>
                    <div class="card-body list-group pt-0 pb-0 pr-0">
                        @foreach($sort->booksPaginate() as $item)
                            <li class="list-group-item border-right-0 border-left-0">
                                <span class="badge badge-primary mr-2">{{ $item->view }}</span> <a href="/article/{{ Hashids::encode($item->id) }}" target="_blank" title="{{ $item->title }}">{{ $item->title }}</a> <span class="float-right timeago">{{ $item->created_at->diffForHumans() }}</span>
                            </li>
                        @endforeach
                    </div>
                    <div class="card-footer text-muted">
                        <nav aria-label="...">
                            <ul class="pagination">
                                {{ $sort->booksPaginate()->links() }}
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

            </div>
        </div>
    </div>

    <div class="footer text-center p-4 bg-white mt-4 text-secondary">
        警告：以上栏目涉及成人内容，未满21岁者或栏目内容触犯当地法律者，请即离开。
    </div>
@stop