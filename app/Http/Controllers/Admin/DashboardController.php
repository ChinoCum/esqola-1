<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\User as Users;

class DashboardController extends AdminBaseController
{

    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
    }

    public function index() {
        $students = Users::whereHas('roles', function($q){
            $q->where('name', '=', 'Estudiante');}
        )->get()->count();
        $teachers = Users::whereHas('roles', function($q){
            $q->where('name', '=' ,'Maestro');}
        )->get()->count();

        $statistics = (object)array(
            'students' => $students,
            'teachers' => $teachers
        );

        return view('admin.home', ['statistics' => $statistics]);
    }

}
