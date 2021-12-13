<?php

namespace Modules\Applicant\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Modules\Applicant\Models\Applicant;
use Modules\Applicant\Requests\ApplicantRequest;
use Modules\Base\Models\Status;
use Modules\Career\Models\Career;
use Modules\Position\Models\Position;

class ApplicantController extends Controller{

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
        $data     = Applicant::filter($filter)->orderBy("created_at", "DESC")->paginate(20);

        return view("Applicant::backend.applicant.index", compact("data", "statuses"));
    }


    /**
     * @param Request $request
     *
     * @return Factory|View
     */
    public function getCreate(){
        $statuses = Status::getStatuses();

        return view("Applicant::backend.applicant.create", compact("statuses"));
    }

    /**
     * @param ApplicantRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postCreate(ApplicantRequest $request){
        Applicant::query()->create($request->all());
        $request->session()->flash('success', trans('Created successfully.'));

        return back();
    }

    /**
     * @param Request $request
     * @param $id
     *
     * @return Factory|View
     */
    public function getUpdate($id){
        $statuses  = Status::getStatuses();
        $data      = Applicant::query()->find($id);

        return view("Applicant::backend.applicant.update", compact("data", "statuses"));
    }

    /**
     * @param ApplicantRequest $request
     * @param $id
     *
     * @return RedirectResponse
     */
    public function postUpdate(ApplicantRequest $request, $id){
        Applicant::query()->find($id)->update($request->all());
        $request->session()->flash('success', trans('Updated successfully.'));

        return back();
    }

    /**
     * @param Request $request
     * @param $id
     *
     * @return RedirectResponse
     */
    public function delete(Request $request, $id){
        Applicant::query()->find($id)->delete();
        $request->session()->flash('success', trans('Deleted successfully.'));

        return back();
    }
}
