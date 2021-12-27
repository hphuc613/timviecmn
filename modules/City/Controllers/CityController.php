<?php

namespace Modules\City\Controllers;

use App\AppHelpers\Helper;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Modules\Base\Models\Status;
use Modules\City\Models\City;
use Modules\City\Requests\CityRequest;

class CityController extends Controller {

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
        $data     = City::filter($filter)->orderBy("created_at", "DESC")->paginate(20);

        return view("City::backend.city.index", compact("data", "statuses"));
    }

    /**
     * @param Request $request
     *
     * @return Factory|View
     */
    public function getCreate(Request $request) {
        $statuses = Status::getStatuses();

        if (!$request->ajax()) {
            return redirect()->back();
        }

        return view("City::backend.city.form", compact("statuses"));
    }

    /**
     * @param CityRequest $request
     *
     * @return RedirectResponse
     */
    public function postCreate(CityRequest $request) {
        $data         = $request->all();
        $data['slug'] = Helper::slug($request->name);
        City::query()->create($data);
        $request->session()->flash('success', trans('Created successfully.'));

        return back();
    }

    /**
     * @param Request $request
     * @param $id
     *
     * @return Factory|View
     */
    public function getUpdate(Request $request, $id) {
        $statuses = Status::getStatuses();
        $data     = City::query()->find($id);

        if (!$request->ajax()) {
            return redirect()->back();
        }

        return view("City::backend.city.form", compact("data", "statuses"));
    }

    /**
     * @param CityRequest $request
     * @param $id
     *
     * @return RedirectResponse
     */
    public function postUpdate(CityRequest $request, $id) {
        $data         = $request->all();
        $data['slug'] = Helper::slug($request->name);
        City::query()->find($id)->update($data);
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
        City::query()->find($id)->delete();
        $request->session()->flash('success', trans('Deleted successfully.'));

        return back();
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     * @throws GuzzleException
     */
    public function syncApi(Request $request) {
        $client = new Client();
        $res    = $client->request('GET', env('API_PROVINCES_VN') ?? 'https://provinces.open-api.vn/api/');
        $result = $res->getBody()->getContents();

        $array_result = json_decode($result, 1);
        foreach ($array_result as $key => $item) {
            $data['name']       = $item['name'];
            $data['slug']       = Helper::slug($item['name']);
            $data['created_at'] = formatDate(time(), 'y-m-d H:i:s');
            $data['updated_at'] = formatDate(time(), 'y-m-d H:i:s');

            City::query()->updateOrCreate(
                ['name' => $item['name'], 'slug' => Helper::slug($item['name'])]
            );
        }

        $request->session()->flash('success', trans('Sync successfully.'));

        return back();
    }
}
