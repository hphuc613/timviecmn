<?php

namespace Modules\Frontend\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Modules\Banner\Models\Banner;
use Modules\Base\Controllers\BaseController;
use Modules\Page\Models\Page;
use Modules\Setting\Models\Setting;
use never;

class PageController extends BaseController{

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(){
        parent::__construct();
    }

    /**
     * @return Factory|View
     */
    public function getContactUsPage(){
        $banner  = Banner::getBanner(Banner::LISTING_PAGE);
        $setting = Setting::query()->pluck('value', 'key');
        return view('Frontend::pages', compact('banner', 'setting'));
    }

    /**
     * @param $slug
     * @return Factory|View|never
     */
    public function getPage($slug){
        $data = Page::query()->where('slug', $slug)->first();

        if(!empty($data)){
            $banner = Banner::getBanner(Banner::LISTING_PAGE);
            return view('Frontend::pages', compact('data', 'banner'));
        }

        return abort(404);
    }
}
