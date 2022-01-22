<?php

namespace Modules\Post\Controllers;

use App\AppHelpers\Helper;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Modules\Base\Models\Status;
use Modules\Company\Models\Company;
use Modules\Position\Models\Position;
use Modules\Post\Models\Post;
use Modules\Post\Models\PostCategory;
use Modules\Post\Models\TopSetting;
use Modules\Post\Requests\PostRequest;
use Modules\Tag\Models\Tag;
use Modules\User\Models\User;

class PostController extends Controller{

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(){
        # parent::__construct();
    }

    /**
     * @param Request $request
     * @return Factory|View
     */
    public function index(Request $request){
        $filter    = $request->all();
        $statuses  = Status::getStatuses();
        $authors   = User::query()->orderBy("name")->pluck('name', 'id')->toArray();
        $data      = Post::filter($filter)->orderBy("created_at", "DESC")->paginate(20);
        $companies = Company::getArray();
        $positions = Position::getArray();

        return view("Post::backend.post.index", compact("data", "filter", "statuses", "authors", "companies", "positions"));
    }

    /**
     * @param Request $request
     * @return Factory|View
     */
    public function getCreate(Request $request){
        $statuses   = Status::getStatuses();
        $categories = PostCategory::getArray();
        $tags       = Tag::getTagArray();
        $companies  = Company::getArray();
        $positions  = Position::getArray();
        $work_type  = Post::getWorkTypes();

        return view("Post::backend.post.create", compact("statuses", "categories", "tags", "companies", "positions", "work_type"));
    }

    /**
     * @param PostRequest $request
     *
     * @return RedirectResponse
     */
    public function postCreate(PostRequest $request){
        $data = $request->all();
        unset($data['tags']);
        unset($data['image']);
        $data['position_ids'] = json_encode($data['position_ids']);
        $tag_ids              = Tag::createTags($request->tags ?? []);
        $data['slug']         = Helper::slug($request->title);
        $post                 = Post::query()->create($data);
        if($request->hasFile('image')){
            $image       = $request->image;
            $post->image = Helper::storageFile($image, time() . '_' . $image->getClientOriginalName(), 'Post/' . $post->id);
        }
        $post->save();
        $post->tags()->sync($tag_ids);
        $request->session()->flash('success', trans('Created successfully.'));

        return redirect()->route('get.post.list');
    }

    /**
     * @param $id
     * @return Factory|View
     */
    public function getUpdate($id){
        $data       = Post::query()->find($id);
        $statuses   = Status::getStatuses();
        $categories = PostCategory::getArray();
        $tags       = Tag::getTagArray();
        $companies  = Company::getArray();
        $positions  = Position::getArray();
        $work_type  = Post::getWorkTypes();

        return view("Post::backend.post.update", compact("data", "statuses", "categories", "tags", "companies", "positions", "work_type"));
    }

    /**
     * @param PostRequest $request
     * @param $id
     *
     * @return string
     */
    public function postUpdate(PostRequest $request, $id){
        $data = $request->all();
        unset($data['tags']);
        $data['position_ids'] = json_encode($data['position_ids']);
        $tag_ids              = Tag::createTags($request->tags ?? []);
        $post                 = Post::query()->find($id);
        if($request->hasFile('image')){
            $image = $request->image;
            if(file_exists($post->image)){
                unlink($post->image);
            }
            $data['image'] = Helper::storageFile($image, time() . '_' . $image->getClientOriginalName(), 'Post/' . $post->id);
        }
        $data['slug'] = Helper::slug($request->title);
        $post->update($data);
        $post->tags()->sync($tag_ids);
        $request->session()->flash('success', trans('Updated successfully.'));

        return redirect()->route('get.post.list');
    }

    /**
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     */
    public function delete(Request $request, $id){
        $post = Post::query()->find($id);
        $post->tags()->sync([]);
        $post->delete();
        $request->session()->flash('success', trans('Deleted successfully.'));

        return back();
    }


    /**
     * @return false|string
     */
    public function updatePositionDropdown(){
        $data = Position::query()->where('status', Status::STATUS_ACTIVE)->orderBy('name')->get();

        $array = [];
        foreach($data as $item){
            $array[] = ['id' => $item->id, 'text' => $item->name];
        }

        return json_encode($array);
    }

    /**
     * @param Request $request
     * @return Factory|View|RedirectResponse
     */
    public function getTopSetting(Request $request){
        if(!$request->ajax()){
            return redirect()->back();
        }

        $top_options = TopSetting::getTopOption();
        $posts       = Post::query();

        $top = TopSetting::query();
        /** Get post top 1 */
        $top1          = clone $top;
        $top1_posts    = $this->getTopPost($top1, TopSetting::TOP_1, $posts);
        $top1_post_ids = $top1_posts['post_ids'];
        $top1_posts    = $top1_posts['posts'];

        /** Get post top 2 */
        $top2       = clone $top;
        $top2_posts = $this->getTopPost($top2, TopSetting::TOP_2, $posts);
        $top2_post_ids = $top2_posts['post_ids'];
        $top2_posts    = $top2_posts['posts'];

        /** Get post top 2 */
        $top3       = clone $top;
        $top3_posts = $this->getTopPost($top3, TopSetting::TOP_3, $posts);
        $top3_post_ids = $top3_posts['post_ids'];
        $top3_posts    = $top3_posts['posts'];

        $posts = $posts->where('status', Status::STATUS_ACTIVE)
                       ->whereNotIn('id', array_merge($top2_post_ids, $top1_post_ids, $top3_post_ids))
                       ->orderBy('title')
                       ->pluck('title', 'id')
                       ->toArray();

        return view('Post::backend.post._top_setting', compact('posts', 'top_options', 'top1_posts', 'top2_posts', 'top3_posts'));
    }

    /**
     * @param $top
     * @param $top_option
     * @param $posts_query
     * @return array
     */
    public function getTopPost($top, $top_option, $posts_query){
        $top      = $top->where('top_option', $top_option)->first();
        $post_ids = [];
        if(!empty($top)){
            $post_ids = json_decode(!empty($top->post_ids) ? $top->post_ids : '[]', 1);
        }
        $top_posts = clone $posts_query;
        $posts     = $top_posts->whereIn('id', $post_ids)->get();

        return compact('posts', 'post_ids');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function postTopSetting(Request $request){
        if(!in_array($request->top_option, TopSetting::TOP_LIST) || !isset($request->post_id) || empty($request->post_id)){
            $request->session()->flash('danger', 'Cannot select Top Option');
        }else{
            $top_setting = TopSetting::query()->where('top_option', $request->top_option)->first();
            $post_id     = [$request->post_id];
            if(empty($top_setting)){
                $top_setting             = new TopSetting();
                $top_setting->top_option = $request->top_option;
                $top_setting->post_ids   = "";
            }
            $post_ids = json_decode(!empty($top_setting->post_ids) ? $top_setting->post_ids : '[]', 1);
            if(!in_array($request->post_id, $post_ids)){
                $top_setting->post_ids = json_encode(array_merge($post_ids, $post_id));
            }
            $top_setting->save();

            $request->session()->flash('danger', 'Added Successfully.');
        }

        return redirect()->route('get.post.top_setting');
    }

    /**
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     */
    public function deletePostTopSetting(Request $request, $top_option){
        $top_setting = TopSetting::query()->where('top_option', $top_option)->first();
        $post_ids    = json_decode(!empty($top_setting->post_ids) ? $top_setting->post_ids : '[]', 1);
        if(($key = array_search($request->post_id, $post_ids)) !== false){
            unset($post_ids[$key]);
        }
        $top_setting->post_ids = json_encode($post_ids);
        $top_setting->save();

        $request->session()->flash('danger', 'Removed Successfully.');

        return redirect()->route('get.post.top_setting');
    }

    /**
     * @param Request $request
     * @param $id
     *
     * @return RedirectResponse
     */
    public function setIsHot(Request $request, $id){
        $data = Post::query()->find($id);
        if(!empty($data)){
            $data->is_hot = !$data->is_hot;
            $data->save();
            $request->session()->flash('success', trans('Update Hot successfully.'));
        }

        return back();
    }
}
