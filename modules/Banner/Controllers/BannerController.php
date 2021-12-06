<?php

namespace Modules\Banner\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Modules\Banner\Models\Banner;
use Modules\Banner\Requests\BannerRequest;
use Modules\Base\Models\Status;

class BannerController extends Controller {

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct() {
        # parent::__construct();
    }

    /**
     * @param Request $request
     * @return Factory|View
     */
    public function index(Request $request) {
        $data = Banner::query()->orderBy("name")->paginate(20);

        return view("Banner::index", compact("data"));
    }


    /**
     * @param Request $request
     * @return RedirectResponse|string
     */
    public function getCreate(Request $request) {
        $statuses = Status::getStatuses();
        $page_list = Banner::getPageList();

        if (!$request->ajax()) {
            return redirect()->back();
        }

        return view('Banner::form', compact('statuses', 'page_list'))->render();
    }

    /**
     * @param BannerRequest $request
     * @return RedirectResponse
     */
    public function postCreate(BannerRequest $request) {
        $data = new Banner();
        $data->create($request->all());
        $request->session()->flash('success', trans('Created successfully.'));

        return redirect()->back();
    }

    /**
     * @param $id
     * @return string
     */
    public function getUpdate($id) {
        $data = Banner::find($id);
        $statuses = Status::getStatuses();
        $page_list = Banner::getPageList();

        return view('Banner::form', compact('statuses', 'page_list', 'data'))->render();
    }

    /**
     * @param BannerRequest $request
     * @param $id
     * @return RedirectResponse
     */
    public function postUpdate(BannerRequest $request, $id) {
        $data = Banner::find($id);
        $data->update($request->all());
        $request->session()->flash('success', trans('Updated successfully.'));

        return redirect()->back();
    }

    /**
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     */
    public function delete(Request $request, $id) {
        $data = Banner::find($id);
        $data->delete();
        $request->session()->flash('success', trans('Deleted successfully.'));

        return redirect()->back();

    }
}
