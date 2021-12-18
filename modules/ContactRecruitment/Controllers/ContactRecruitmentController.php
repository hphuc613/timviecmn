<?php

namespace Modules\ContactRecruitment\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Modules\Base\Models\Status;
use Modules\Career\Models\Career;
use Modules\Company\Models\Company;
use Modules\ContactRecruitment\Models\ContactRecruitment;

class ContactRecruitmentController extends Controller{

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(){
        # parent::__construct();
    }

    public function index(Request $request){
        $filter   = $request->all();
        $statuses = Status::getStatuses();
        $careers  = Career::getArray();
        $data     = ContactRecruitment::filter($filter)->orderBy("created_at", "DESC")->paginate(20);

        return view("ContactRecruitment::backend.contact-recruitment.index", compact("data", "statuses", "careers"));
    }

    /**
     * @param Request $request
     * @param $id
     *
     * @return RedirectResponse
     */
    public function delete(Request $request, $id){
        $data = Company::query()->find($id)->delete();
        $data->delete();
        $request->session()->flash('success', trans('Deleted successfully.'));

        return back();
    }
}
