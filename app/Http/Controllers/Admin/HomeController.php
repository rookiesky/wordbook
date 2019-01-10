<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Sort;

class HomeController extends Controller
{
    public function index()
    {
        $sort = Sort::orderBy('order')->get();
        return view(self::ADMIN_VIEW_PREFIX . '.home.index',compact('sort'));
    }
}