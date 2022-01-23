<?php

namespace Modules\Frontend\Controllers;

use App\AppHelpers\Helper;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Modules\Banner\Models\Banner;
use Modules\Applicant\Models\Applicant;
use Modules\Base\Controllers\BaseController;
use Modules\Base\Models\Status;
use Modules\Career\Models\Career;
use Modules\City\Models\City;
use Modules\ContactRecruitment\Models\ContactRecruitment;
use Modules\Frontend\Requests\ApplyRequest;
use Modules\Frontend\Requests\RecruitmentRequest;
use Modules\Position\Models\Position;
use Modules\Post\Controllers\PostController;
use Modules\Post\Models\Post;
use Illuminate\Support\Facades\App;
use Modules\Post\Models\TopSetting;
use Modules\Setting\Models\WebsiteConfig;

class FrontendController extends BaseController{

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(){
        parent::__construct();
    }

    /**
     * @param Request $request
     * @return Factory|View
     */
    public function index(Request $request){
        $banner         = Banner::getBanner(Banner::HOME_PAGE);
        $website_config = WebsiteConfig::getWebsiteConfig();
        $website_title  = $website_config[WebsiteConfig::WEBSITE_TITLE] ?? "Việc Làm Toàn Quốc";
        $website_slogan = $website_config[WebsiteConfig::WEBSITE_SLOGAN] ?? NULL;


        return view("Frontend::index", compact("banner", "website_title", "website_slogan"));
    }

    /**
     * @return string
     */
    public function getRecruit(){
        $careers = Career::getArray(Status::STATUS_ACTIVE);
        $banner  = Banner::getBanner(Banner::RECRUIT_FORM);
        return view('Frontend::_form_recruit', compact('careers', 'banner'))->render();
    }

    /**
     * @param RecruitmentRequest $request
     * @return RedirectResponse
     */
    public function postRecruit(RecruitmentRequest $request){
        $data = new ContactRecruitment();
        $data->create($request->all());
        $request->session()->flash('success', trans('Sent successfully'));

        return redirect()->back();
    }

    /**
     * @param Request $request
     * @return Factory|View
     */
    public function newsListing(Request $request){
        $filter = $request->all();
        $banner = Banner::getBanner(Banner::LISTING_PAGE);
        $posts  = Post::filter($filter);

        $post_controller = new PostController();
        $top             = TopSetting::query();
        /** Get post top 1 */
        $top1          = clone $top;
        $top1_posts    = $post_controller->getTopPost($top1, TopSetting::TOP_1, $posts);
        $top1_post_ids = $top1_posts['post_ids'];
        $top1_posts    = $top1_posts['posts'];

        /** Get post top 2 */
        $top2          = clone $top;
        $top2_posts    = $post_controller->getTopPost($top2, TopSetting::TOP_2, $posts);
        $top2_post_ids = $top2_posts['post_ids'];
        $top2_posts    = $top2_posts['posts'];

        /** Get post top 3 */
        $top3          = clone $top;
        $top3_posts    = $post_controller->getTopPost($top3, TopSetting::TOP_3, $posts);
        $top3_post_ids = $top3_posts['post_ids'];
        $top3_posts    = $top3_posts['posts'];

        $posts        = $posts->where('status', Status::STATUS_ACTIVE)
                              ->whereNotIn('id', array_merge($top2_post_ids, $top1_post_ids, $top3_post_ids))
                              ->orderBy('created_at', 'desc')
                              ->get();
        $data_collect = $top1_posts->merge($top2_posts)->merge($top3_posts)->merge($posts);
        $data         = $this->paginate($data_collect, 18);


        $new_posts  = Post::query()
                          ->where('status', Status::STATUS_ACTIVE)
                          ->orderBy('created_at', 'desc')
                          ->limit(4)
                          ->get();
        $cities     = City::query()->where('status', Status::STATUS_ACTIVE)->get();
        $careers    = Career::query()->where('status', Status::STATUS_ACTIVE)->get();
        $positions  = Position::query()->where('status', Status::STATUS_ACTIVE)->get();
        $work_types = Post::getWorkTypes();

        $website_config = WebsiteConfig::getWebsiteConfig();
        $website_slogan_recruit = $website_config[WebsiteConfig::WEBSITE_SLOGAN_RECRUIT] ?? NULL;

        return view('Frontend::listing', compact('data', 'careers', 'positions', 'filter', 'banner', 'cities', 'work_types', 'new_posts','website_slogan_recruit'));
    }

    /**
     * @param Request $request
     * @param $id
     * @param $slug
     * @return Factory|View
     */
    public function newsDetail(Request $request, $id, $slug){
        $data         = Post::query()->where('id', $id)->where('slug', $slug)->first();
        $position_ids = json_decode(!empty($data->position_ids) ? $data->position_ids : "[]", 1);
        $positions    = [];
        if(!empty($position_ids)){
            $position_query = Position::query()->whereIn('id', $position_ids)
                                      ->where('status', Status::STATUS_ACTIVE)
                                      ->orderBy("name")
                                      ->get();

            foreach($position_query as $key => $item){
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
    public function postApplyJob(ApplyRequest $request, $id, $slug){
        $post          = Post::query()->where(['id' => $id, 'slug' => $slug])->first();
        $position_data = explode("-", $request->position_id);
        $position_id   = $position_data[0];
        unset($position_data[0]);
        $position_slug = implode('-', $position_data);
        $position      = Position::query()->where(['id' => $position_id, 'slug' => $position_slug])->first();

        if(!empty($post) && !empty($position)){
            $data                = $request->all();
            $data['post_id']     = $post->id;
            $data['position_id'] = $position->id;
            $data['birthday']    = formatDate(strtotime($request->birthday), 'Y-m-d');
            if($request->has('file')){
                $file         = $request->file;
                $file_name    = Helper::slug($request->name) . '-' . $request->phone . '-' . formatDate(time(), 'd-m-y-H-i-s') . '.' . $file->getClientOriginalExtension();
                $data['file'] = Helper::storageFile($file, $file_name, 'CV File');
            }

            Applicant::query()->create($data);
            $request->session()->flash('success', trans('Successfully applied'));
        }else{
            $request->session()
                    ->flash('danger', trans('The Recruitment Post cannot be found or something went wrong.'));
        }

        return redirect()->back();
    }
}
