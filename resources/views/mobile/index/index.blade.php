@extends('mobile.layouts.app')
@section('content')
    <div class="card" style="margin:0;border-radius: unset;margin-top:0.5em;">
        <div class="card-header">网站公告</div>
        <div class="card-content card-content-padding">@if(\Illuminate\Support\Facades\Cache::has('SYSTEM_CACHE')){{ Cache('SYSTEM_CACHE')->notice }} @endif</div>
    </div>

    <div class="card" style="margin:0;border-radius: unset;margin-top:1em;">
        <div class="card-header">最新文章</div>
        <div class="card-content card-content-padding">
            <div class="list">
                <ul>
                    @foreach($books as $item)
                        <li>
                            <a href="/mobile/article/{{ Hashids::encode($item->id) }}" class="item-link item-content external">
                                <div class="item-media"><i class="f7-icons">circle</i></div>
                                <div class="item-inner">
                                    <div class="item-title">{{ $item->title }}</div>
                                </div>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@stop