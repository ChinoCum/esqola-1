<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Auth;
use DaveJamesMiller\Breadcrumbs\Facade as BC;
use View;

class AdminBaseController extends Controller
{
    public function __construct()
    {
        $user = Auth::user();
        $bc = BC::generate();
        $breadcrumbs = $bc[count($bc) - 1];

        View::share('user', $user);
        View::share('breadcrumbs', $breadcrumbs);
    }
}
