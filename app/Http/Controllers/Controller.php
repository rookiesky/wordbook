<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    const ADMIN_VIEW_PREFIX = 'admin';
    const ADMIN_PREFIX = 'wp-book';
    const HOME_VIEW_PREFIX = 'home';
    const MOBILE_VIEW_PREFIX = 'mobile';
}
