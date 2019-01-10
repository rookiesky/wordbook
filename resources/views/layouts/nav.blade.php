<nav class="navbar navbar-expand-lg navbar-light navbar-laravel">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
        <a class="navbar-brand" href="/">{{ Cache('SYSTEM_CACHE')->title }}</a>
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item active">
                <a class="nav-link" href="/">首页 <span class="sr-only">(current)</span></a>
            </li>
            @if(!empty(Cache('SORT_CACHE')))
                @foreach(Cache('SORT_CACHE') as $item)
                    <li class="nav-item">
                        <a class="nav-link" href="/list/{{ Hashids::encode($item->id) }}">{{ $item->name }}</a>
                    </li>
                @endforeach
            @endif

        </ul>
        <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
    </div>
</nav>