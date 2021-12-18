<?php

namespace Modules\Career\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Modules\Base\Models\Status;
use Modules\Career\Models\Career;
use Modules\Career\Requests\CareerRequest;
use Modules\Position\Models\Position;

class CareerController extends Controller{

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(){
        # parent::__construct();
    }

    public function index(Request $request){
        $filter    = $request->all();
        $statuses  = Status::getStatuses();
        $data      = Career::filter($filter)->orderBy("created_at", "DESC")->paginate(20);

        return view("Career::backend.career.index", compact("data", "statuses"));
    }

    /**
     * @param Request $request
     *
     * @return Factory|View
     */
    public function getCreate(Request $request){
        $statuses  = Status::getStatuses();

        if (!$request->ajax()){
            return redirect()->back();
        }

        return view("Career::backend.career.form", compact("statuses"));
    }

    /**
     * @param CareerRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postCreate(CareerRequest $request){
        Career::query()->create($request->all());
        $request->session()->flash('success', trans('Created successfully.'));

        return back();
    }

    /**
     * @param Request $request
     * @param $id
     *
     * @return Factory|View
     */
    public function getUpdate(Request $request, $id){
        $statuses  = Status::getStatuses();
        $data      = Career::query()->find($id);

        if (!$request->ajax()){
            return redirect()->back();
        }

        return view("Career::backend.career.form", compact("data", "statuses"));
    }

    /**
     * @param CareerRequest $request
     * @param $id
     *
     * @return RedirectResponse
     */
    public function postUpdate(CareerRequest $request, $id){
        Career::query()->find($id)->update($request->all());
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
        Career::query()->find($id)->delete();
        $request->session()->flash('success', trans('Deleted successfully.'));

        return back();
    }
}
