<?php

namespace Modules\Page\Controllers;

use App\AppHelpers\Helper;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Modules\Base\Models\Status;
use Modules\Page\Models\Page;
use Modules\Page\Requests\PageRequest;
use Modules\User\Models\User;

class PageController extends Controller{

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
        $authors  = User::query()->orderBy("name")->pluck('name', 'id')->toArray();
        $data     = Page::filter($filter)->orderBy("created_at", "DESC")->paginate(20);

        return view("Page::index", compact("data", "filter", "statuses", 'authors'));
    }

    /**
     * @param Request $request
     * @return Factory|View
     */

    public function getCreate(Request $request){
        $statuses = Status::getStatuses();
        return view("Page::create", compact("statuses"));
    }

    /**
     * @param PageRequest $request
     * @return RedirectResponse
     */
    public function postCreate(PageRequest $request){
        $data         = $request->all();
        $data['slug'] = Helper::slug($request->name);
        unset($data['image']);
        $page = Page::query()->create($data);
        if($request->hasFile('image')){
            $image       = $request->image;
            $page->image = Helper::storageFile($image, time() . '_' . $image->getClientOriginalName(), 'Page/' . $page->id);
        }
        $page->save();

        $request->session()->flash('success', trans('Created successfully.'));

        return redirect()->route('get.page.list');
    }

    /**
     * @param $id
     * @return Application|Factory|View
     */
    public function getUpdate($id){
        $data      = Page::query()->find($id);
        $statuses  = Status::getStatuses();

        return view("Page::update", compact("data", "statuses"));
    }

    /**
     * @param PageRequest $request
     * @param $id
     * @return RedirectResponse
     */

    public function postUpdate(PageRequest $request, $id){
        $data = $request->all();

        $page = Page::query()->find($id);
        if($request->hasFile('image')){
            $image = $request->image;
            if(file_exists($page->image)){
                unlink($page->image);
            }
            $data['image'] = Helper::storageFile($image, time() . '_' . $image->getClientOriginalName(), 'Page/' . $page->id);
        }
        $data['slug'] = Helper::slug($request->name);
        $page->update($data);

        $request->session()->flash('success', trans('Updated successfully.'));

        return redirect()->route('get.page.list');
    }

    /**
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     */

    public function delete(Request $request, $id){
        $page = Page::query()->find($id);
        $page->delete();
        $request->session()->flash('success', trans('Deleted successfully.'));

        return back();
    }
}
