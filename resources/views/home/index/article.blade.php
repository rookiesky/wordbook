@extends('layouts.common')
@section('content')
    <nav class="navbar navbar-expand-lg navbar-light navbar-laravel">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
            <a class="navbar-brand" href="#">Hidden brand</a>
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="#">Disabled</a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </nav>
    <div class="container-fluid mt-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">首页</a></li>
                <li class="breadcrumb-item"><a href="#">分类</a></li>
                <li class="breadcrumb-item active" aria-current="page">这里是内容</li>
            </ol>
        </nav>
        <div class="card border-0">
            <div class="card-header bg-white text-center border-bottom-0">
                <h5>这里是内容</h5>
            </div>
            <div class="card-body bg-white article pt-0">
                <p>很多人问带路姬，到底什么是 SEO？SEO 很重要吗？不会 SEO 怎么办？要请人帮忙操作 SEO 吗？ 要去上课学吗？

                SEO 是什么呢？WordPress SEO 是什么呢？

                SEO 是 Search Engine Optimization 的缩写，也就是「搜寻引擎排名优化」。

                网路上充斥著各种 SEO 的教学文章、线上与线下的课程，号称要教你技巧，让你的网站可以在 Google 排名越排越前面。

                带路姬也上过一些课程，买了一些书，认真的学了一些基础，这些教学不外乎是教你写文章时要注意哪些事？网站以外，有没有要注意哪些事？零零总总，其实细节是真的蛮多的，课程都要好几千、书都厚厚的一大本…

                你只是业馀的部落客或网站站长，你没这麽多时间慢慢研究啊…
                我知道！我知道！我大部分的客户都这样跟我说… 他们真的超级忙，没这麽多时间去慢慢研究 SEO …

                那怎麽办？

                不懂 SEO 真的没关系，带路姬教你 SEO 懒人法
                </p>
            </div>
        </div>
    </div>
    <div class="footer text-center p-4 bg-white mt-4 text-secondary">
        警告：以上栏目涉及成人内容，未满21岁者或栏目内容触犯当地法律者，请即离开。
    </div>
@stop