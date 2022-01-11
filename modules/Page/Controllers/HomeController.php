<?php

namespace Modules\Page\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Modules\Page\Models\Home;
use Modules\Page\Requests\BannerRequest;

class HomeController extends Controller {

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
     * @return Application|Factory|View
     */
    public function index(Request $request) {
        $data = Home::getWebsiteConfig();
        return view("Page::home.index", compact("data"));
    }

    /**
     * @param Request $request
     * @return RedirectResponse|string
     */
    public function updateHome(Request $request) {
        $section = segmentUrl(2);
        $post    = $request->post();
        $data    = Home::getWebsiteConfig();
        if ($post) {
            unset($post['_token']);
            foreach ($post as $key => $value) {
                $data = Home::query()->where('key', $key)->first();
                if (!empty($data)) {
                    $data->update(['value' => $value]);
                } else {
                    $data        = new Home();
                    $data->key   = $key;
                    $data->value = $value;
                    $data->save();
                }
            }

            $request->session()->flash('success', 'Updated successfully.');

            return redirect()->back();
        }
        if (!$request->ajax()) {
            return redirect()->back();
        }

        return view("Page::home.form-$section", compact("data"))->render();
    }

    /**
     * @param Request $request
     * @return RedirectResponse|string
     */
    public function updateProduct(Request $request) {
        $post = $request->post();
        $data = Home::query()->where('key', Home::PRODUCT)->first();
        if ($post) {
            $value = json_encode($post['product']);
            unset($post['_token']);
            if (!empty($data)) {
                $data->update(['value' => $value]);
            } else {
                $data        = new Home();
                $data->key   = Home::PRODUCT;
                $data->value = $value;
                $data->save();
            }

            $request->session()->flash('success', 'Updated successfully.');
            return redirect()->back();
        }

        if (!$request->ajax()) {
            return redirect()->back();
        }
        $product = json_decode($data->value,1);
        return view("Page::home.form-product",compact('product'))->render();
    }
}
