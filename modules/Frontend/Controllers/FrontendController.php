<?php

namespace Modules\Frontend\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Modules\Base\Models\Status;
use Modules\Career\Models\Career;
use Modules\ContactRecruitment\Models\ContactRecruitment;
use Modules\Frontend\Models\Frontend;
use Modules\Frontend\Requests\RecruitmentRequest;
use Modules\Position\Models\Position;
use Modules\Post\Models\Post;

class FrontendController extends Controller {

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
        return view("Frontend::index");
    }

    /**
     * @return string
     */
    public function getRecruit() {
        $careers = Career::getArray(Status::STATUS_ACTIVE);
        return view('Frontend::_form_recruit', compact('careers'))->render();
    }

    /**
     * @param RecruitmentRequest $request
     * @return RedirectResponse
     */
    public function postRecruit(RecruitmentRequest $request) {
        $data = new ContactRecruitment();
        $data->create($request->all());
        $request->session()->flash('success', 'Đã gửi thành c');

        return redirect()->back();
    }

    /**
     * @param Request $request
     * @return Factory|View
     */
    public function newsListing(Request $request) {
        $filter    = $request->all();
        $data      = Post::filter($filter)->orderBy('created_at', 'desc')->paginate(5);
        $careers   = Career::query()->where('status', Status::STATUS_ACTIVE)->get();
        $positions = Position::query()->where('status', Status::STATUS_ACTIVE)->get();
        return view('Frontend::listing', compact('data', 'careers', 'positions', 'filter'));
    }

    /**
     * @param Request $request
     * @param $id
     * @param $slug
     * @return Factory|View
     */
    public function newsDetail(Request $request, $id, $slug) {
        $data = Post::query()->where('id', $id)->where('slug', $slug)->first();
        return view('Frontend::detail', compact('data'));
    }
}
