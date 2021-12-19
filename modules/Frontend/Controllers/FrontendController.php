<?php

namespace Modules\Frontend\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Base\Models\Status;
use Modules\Career\Models\Career;
use Modules\ContactRecruitment\Models\ContactRecruitment;
use Modules\Frontend\Models\Frontend;
use Modules\Frontend\Requests\RecruitmentRequest;

class FrontendController extends Controller{

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(){
        # parent::__construct();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request){
        return view("Frontend::index");
    }

    /**
     * @return string
     */
    public function getRecruit(){
        $careers = Career::getArray(Status::STATUS_ACTIVE);
        return view('Frontend::_form_recruit', compact('careers'))->render();
    }

    public function postRecruit(RecruitmentRequest $request){
        $data = new ContactRecruitment();
        $data->create($request->all());
        $request->session()->flash('success', 'Đã gửi thành c');

        return redirect()->back();
    }
}
