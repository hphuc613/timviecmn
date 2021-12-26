<?php

namespace Modules\Applicant\Controllers;

use App\AppHelpers\Helper;
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
use Modules\Post\Models\Post;

class ApplicantController extends Controller {

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
        $statuses = Status::getStatuses();
        $data     = Applicant::filter($filter)->orderBy("created_at", "DESC")->paginate(20);

        return view("Applicant::backend.applicant.index", compact("data", "statuses"));
    }


    /**
     * @param Request $request
     *
     * @return Factory|View
     */
    public function getCreate() {
        $statuses  = Status::getStatuses();
        $positions = Position::getArray(Status::STATUS_ACTIVE);
        $posts     = Post::query()->where('status', Status::STATUS_ACTIVE)->pluck('title', 'id')->toArray();

        return view("Applicant::backend.applicant.create", compact("statuses", "positions", "posts"));
    }

    /**
     * @param ApplicantRequest $request
     *
     * @return RedirectResponse
     */
    public function postCreate(ApplicantRequest $request) {
        $data             = $request->all();
        $data['birthday'] = formatDate(strtotime($request->birthday), 'Y-m-d');
        if ($request->has('file')) {
            $file         = $request->file;
            $file_name    = Helper::slug($request->name) . '-' . $request->phone . '-' . formatDate(time(), 'd-m-y-H-i-s') . '.' . $file->getClientOriginalExtension();
            $data['file'] = Helper::storageFile($file, $file_name, 'CV File');
        }
        Applicant::query()->create($data);
        $request->session()->flash('success', trans('Created successfully.'));

        return back();
    }

    /**
     * @param Request $request
     * @param $id
     *
     * @return Factory|View
     */
    public function getUpdate($id) {
        $statuses  = Status::getStatuses();
        $data      = Applicant::query()->find($id);
        $positions = Position::getArray(Status::STATUS_ACTIVE);
        $post      = Post::query()->find($data->post_id);
        $posts     = Post::query()->where('status', Status::STATUS_ACTIVE)->pluck('title', 'id')->toArray();

        return view("Applicant::backend.applicant.update", compact("data", "statuses", "positions", "post", "posts"));
    }

    /**
     * @param ApplicantRequest $request
     * @param $id
     *
     * @return RedirectResponse
     */
    public function postUpdate(ApplicantRequest $request, $id) {
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
    public function delete(Request $request, $id) {
        Applicant::query()->find($id)->delete();
        $request->session()->flash('success', trans('Deleted successfully.'));

        return back();
    }
}
