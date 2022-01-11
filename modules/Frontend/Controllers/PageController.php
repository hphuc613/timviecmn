<?php

namespace Modules\Frontend\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Modules\Banner\Models\Banner;
use Modules\Base\Controllers\BaseController;
use Modules\Page\Models\Page;

class PageController extends BaseController {

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * @return Factory|View
     */
    public function getContactUsPage() {
        $banner = Banner::getBanner(Banner::LISTING_PAGE);
        $data   = Page::query()->where('page_id', Page::CONTACT_US)->first();
        return view('Frontend::pages', compact('data', 'banner'));
    }

    /**
     * @return Factory|View
     */
    public function getPriceListPage() {
        $banner = Banner::getBanner(Banner::LISTING_PAGE);
        $data   = Page::query()->where('page_id', Page::PRICE_LIST)->first();
        return view('Frontend::pages', compact('data', 'banner'));
    }
}
