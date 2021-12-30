<?php

namespace Modules\Dashboard\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Base\Controllers\BaseController;


class DashboardController extends BaseController{

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(){
        parent::__construct();
    }

    public function index(Request $request){
        return view("Dashboard::index");
    }
}
