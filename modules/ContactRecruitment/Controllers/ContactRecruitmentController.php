<?php

namespace Modules\ContactRecruitment\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Modules\Base\Models\Status;
use Modules\Career\Models\Career;
use Modules\City\Models\City;
use Modules\Company\Models\Company;
use Modules\ContactRecruitment\Models\ContactRecruitment;

class ContactRecruitmentController extends Controller {

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct() {
        # parent::__construct();
    }

    public function index(Request $request) {
        $filter   = $request->all();
        $statuses = ContactRecruitment::getStatuses();
        $careers  = Career::getArray();
        $data     = ContactRecruitment::filter($filter)->orderBy("created_at", "DESC")->paginate(20);

        return view("ContactRecruitment::backend.contact-recruitment.index",
            compact("data", "statuses", "careers"));
    }

    /**
     * @param Request $request
     * @param $id
     *
     * @return Factory|View
     */
    public function getView(Request $request, $id) {
        $cr_data     = ContactRecruitment::query()->find($id);
        $statuses    = Status::getStatuses();
        $cr_statuses = ContactRecruitment::getStatuses();
        $careers     = Career::getArray(Status::STATUS_ACTIVE);
        $cities      = City::getArray(Status::STATUS_ACTIVE);
        $data        = Company::query()
                              ->where([
                                  'phone' => $cr_data->phone,
                                  'email' => $cr_data->email,
                                  'deleted_at' => NULL
                              ])->first();

        return view("ContactRecruitment::backend.contact-recruitment.view", compact("cr_data", "cr_statuses", "statuses", "careers", "cities", "data"));
    }

    /**
     * @param Request $request
     * @param $id
     *
     * @return Factory|View
     */
    public function getUpdate(Request $request, $id) {
        $cr_data     = ContactRecruitment::query()->find($id);
        $cr_statuses = ContactRecruitment::getStatuses();

        if (!$request->ajax()) {
            return redirect()->back();
        }

        return view("ContactRecruitment::backend.contact-recruitment.form",
            compact("cr_data", "cr_statuses"));
    }

    /**
     * @param Request $request
     * @param $id
     *
     * @return RedirectResponse
     */
    public function postUpdate(Request $request, $id) {
        ContactRecruitment::query()->find($id)->update($request->all());
        $request->session()->flash('success', trans('Updated successfully.'));

        return back();
    }

    /**
     * @param Request $request
     * @param $id
     *
     * @return RedirectResponse
     */
    public function delete(Request $request, $id) {
        ContactRecruitment::query()->find($id)->delete();
        $request->session()->flash('success', trans('Deleted successfully.'));

        return back();
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param $id
     *
     * @return RedirectResponse
     */
    public function getUpdateStatus(Request $request, $id) {
        $data = ContactRecruitment::query()->find($id);
        $data->status = $request->status;
        $data->save();
        $request->session()->flash('success', trans('Update Status successfully.'));

        return back();
    }
}
