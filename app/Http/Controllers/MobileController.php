<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Admin\SortController;
use App\Http\Controllers\Admin\SystemController;

class MobileController extends Controller
{
    public function index()
    {
        (new SystemController())->getCache();
        (new SortController())->getCache();
        return view(self::MOBILE_VIEW_PREFIX . '.index.home',compact('books'));
    }

    public function lists()
    {
        return view(self::MOBILE_VIEW_PREFIX . '.index.list');
    }

}