<?php

namespace Modules\Base\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;


class BaseController extends Controller{

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
     * @param $key
     * @return RedirectResponse
     */
    public function changeLocale(Request $request, $key){
        $request->session()->put('locale', $key);
        return redirect()->back();
    }

    /**
     * @param $items
     * @param int $perPage
     * @param null $page
     * @return LengthAwarePaginator
     */
    public function paginate($items, $perPage = 20, $page = null){
        $page  = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);

        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, [
            'path' => Paginator::resolveCurrentPath()
        ]);
    }
}
