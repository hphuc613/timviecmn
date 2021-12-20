<?php

namespace Modules\Position\Controllers;

use App\AppHelpers\Helper;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Modules\Base\Models\Status;
use Modules\Position\Models\Position;
use Modules\Position\Requests\PositionRequest;

class PositionController extends Controller{

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
        $data     = Position::filter($filter)->orderBy("created_at", "DESC")->paginate(20);

        return view("Position::backend.position.index", compact("data", "statuses"));
    }

    /**
     * @param Request $request
     *
     * @return Factory|View
     */
    public function getCreate(Request $request){
        $statuses = Status::getStatuses();

        if (!$request->ajax()){
            return redirect()->back();
        }

        return view("Position::backend.position.form", compact("statuses"));
    }

    /**
     * @param PositionRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postCreate(PositionRequest $request){
        $data = $request->all();
        $data['slug'] = Helper::slug($request->name);
        Position::query()->create($data);
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
        $statuses = Status::getStatuses();
        $data     = Position::query()->find($id);
        if (!$request->ajax()){
            return redirect()->back();
        }

        return view("Position::backend.position.form", compact("data", "statuses"));
    }

    /**
     * @param PositionRequest $request
     * @param $id
     *
     * @return RedirectResponse
     */
    public function postUpdate(PositionRequest $request, $id){
        $data = $request->all();
        $data['slug'] = Helper::slug($request->name);
        Position::query()->find($id)->update($data);
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
        Position::query()->find($id)->delete();
        $request->session()->flash('success', trans('Deleted successfully.'));

        return back();
    }
}
