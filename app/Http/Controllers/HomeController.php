<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        if($user->hasRole('admin'))
            return redirect()->action('Admin\AdminController@dashboard');
        if($user->hasRole('teacher'))
            return redirect()->action('teacherController@dashboard');
        if($user->hasRole('student'))
            return redirect()->action('student@dashboard');
    }
}
