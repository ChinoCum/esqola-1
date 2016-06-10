<?php

namespace App\Http\Controllers\Admin;

use App\errors as Log;
use App\Http\Requests;
use Auth;

class SystemController extends AdminBaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
    }


    public function log() {
        $logs = Log::orderBy('ID','DESC')->get();
        return view('Admin.System.log', ['logs'=>$logs]);
    }

    public function LogDescription($id) {
        $log = Log::find($id);
        return view('Admin.System.SingleLog', ['log'=>$log]);
    }

}
