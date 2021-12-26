<?php

namespace Modules\Frontend\Controllers;

use App\AppHelpers\Helper;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Modules\Banner\Models\Banner;
use Modules\Applicant\Models\Applicant;
use Modules\Base\Models\Status;
use Modules\Career\Models\Career;
use Modules\ContactRecruitment\Models\ContactRecruitment;
use Modules\Frontend\Requests\ApplyRequest;
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
        $banner = Banner::getBanner(Banner::HOME_PAGE);
        return view("Frontend::index", compact("banner"));
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
        $request->session()->flash('success', trans('Sent successfully'));

        return redirect()->back();
    }

    /**
     * @param Request $request
     * @return Factory|View
     */
    public function newsListing(Request $request) {
        $filter    = $request->all();
        $banner    = Banner::getBanner(Banner::LISTING_PAGE);
        $data      = Post::filter($filter)->orderBy('created_at', 'desc')->paginate(5);
        $careers   = Career::query()->where('status', Status::STATUS_ACTIVE)->get();
        $positions = Position::query()->where('status', Status::STATUS_ACTIVE)->get();
        return view('Frontend::listing', compact('data', 'careers', 'positions', 'filter', 'banner'));
    }

    /**
     * @param Request $request
     * @param $id
     * @param $slug
     * @return Factory|View
     */
    public function newsDetail(Request $request, $id, $slug) {
        $data         = Post::query()->where('id', $id)->where('slug', $slug)->first();
        $position_ids = json_decode(!empty($data->position_ids) ? $data->position_ids : "[]", 1);
        $positions    = [];
        if (!empty($position_ids)) {
            $position_query = Position::query()->whereIn('id', $position_ids)
                                      ->where('status', Status::STATUS_ACTIVE)
                                      ->orderBy("name")
                                      ->get();

            foreach ($position_query as $key => $item) {
                $positions[$item->id . '-' . $item->slug] = $item->name;
            }
        }
        $banner = Banner::getBanner(Banner::DETAIL_PAGE);
        return view('Frontend::detail', compact('data', 'positions', 'banner'));
    }


    /**
     * @param ApplyRequest $request
     * @param $id
     * @param $slug
     * @return RedirectResponse
     */
    public function postApplyJob(ApplyRequest $request, $id, $slug) {
        $post          = Post::query()->where(['id' => $id, 'slug' => $slug])->first();
        $position_data = explode("-", $request->position_id);
        $position_id   = $position_data[0];
        unset($position_data[0]);
        $position_slug = implode('-', $position_data);
        $position      = Position::query()->where(['id' => $position_id, 'slug' => $position_slug])->first();

        if (!empty($post) && !empty($position)) {
            $data                = $request->all();
            $data['post_id']     = $post->id;
            $data['position_id'] = $position->id;
            $data['birthday'] = formatDate(strtotime($request->birthday), 'Y-m-d');
            if ($request->has('file')) {
                $file         = $request->file;
                $file_name    = Helper::slug($request->name) . '-' . $request->phone . '-' . formatDate(time(), 'd-m-y-H-i-s') . '.' . $file->getClientOriginalExtension();
                $data['file'] = Helper::storageFile($file, $file_name, 'CV File');
            }

            Applicant::query()->create($data);
            $request->session()->flash('success', trans('Successfully applied'));
        } else {
            $request->session()->flash('danger', trans('The Recruitment Post cannot be found or something went wrong.'));
        }

        return redirect()->back();
    }
}
