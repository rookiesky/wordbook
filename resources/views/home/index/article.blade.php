@extends('layouts.common')
@section('content')
    @include('layouts.nav')
    <div class="container-fluid mt-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">首页</a></li>
                <li class="breadcrumb-item"><a href="/list/{{ Hashids::encode($book->sort->id) }}">{{ $book->sort->name }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $book->title }}</li>
            </ol>
        </nav>
        <div class="card border-0">
            <div class="card-body bg-white article">
                {!! $book->content !!}
            </div>
        </div>
    </div>
    <div class="footer text-center p-4 bg-white mt-4 text-secondary">
        警告：以上栏目涉及成人内容，未满21岁者或栏目内容触犯当地法律者，请即离开。
    </div>
@stop