<?php

namespace Modules\Base\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;


class BaseController extends Controller{

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(){
        # parent::__construct();
        if (empty(App::getLocale())){
            request()->session()->put('locale', config('app.fallback_locale'));
        }
    }

    /**
     * @param Request $request
     * @param $key
     * @return RedirectResponse
     */
    public function changeLocale(Request $request, $key){
        $request->session()->put('locale', $key);
        return redirect()->back();
    }
}
