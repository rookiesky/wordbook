<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Admin\SortController;
use App\Http\Controllers\Admin\SystemController;
use Illuminate\Http\Request;

class HomeController extends Controller
{


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        (new SystemController())->getCache();
        (new SortController())->getCache();
        return view(self::HOME_VIEW_PREFIX . '.index.index');
    }

    public function article()
    {
        return view(self::HOME_VIEW_PREFIX . '.index.article');
    }
}
