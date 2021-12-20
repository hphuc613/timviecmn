<?php

namespace Modules\Company\Controllers;

use App\AppHelpers\Helper;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Modules\Base\Models\Status;
use Modules\Career\Models\Career;
use Modules\Company\Models\Company;
use Modules\Company\Requests\CompanyRequest;

class CompanyController extends Controller{

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
        $careers  = Career::getArray();
        $data     = Company::filter($filter)->orderBy("created_at", "DESC")->paginate(20);

        return view("Company::backend.company.index", compact("data", "statuses", "careers"));
    }

    /**
     * @return Factory|View
     */
    public function getCreate(){
        $statuses = Status::getStatuses();
        $careers  = Career::getArray(Status::STATUS_ACTIVE);

        return view("Company::backend.company.create", compact("statuses", "careers"));
    }

    /**
     * @param CompanyRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postCreate(CompanyRequest $request){
        $data = $request->all();
        unset($data['logo']);
        $data['slug'] = Helper::slug($request->name);
        $company = Company::query()->create($data);
        if ($request->hasFile('logo')){
            $logo          = $request->logo;
            $company->logo = Helper::storageFile($logo,
                time() . '_' . $logo->getClientOriginalName(), 'Company/' . $company->id);
        }
        $company->save();
        $request->session()->flash('success', trans('Created successfully.'));

        return redirect()->route('get.company.list');
    }

    /**
     * @param $id
     *
     * @return Factory|View
     */
    public function getUpdate($id){
        $data     = Company::query()->find($id);
        $statuses = Status::getStatuses();
        $careers  = Career::getArray(Status::STATUS_ACTIVE);

        return view("Company::backend.company.update", compact("data", "statuses", "careers"));
    }

    /**
     * @param CompanyRequest $request
     * @param $id
     *
     * @return RedirectResponse
     */
    public function postUpdate(CompanyRequest $request, $id){
        $data    = $request->all();
        $company = Company::query()->find($id);
        if ($request->hasFile('thumbnail')){
            $thumbnail = $request->thumbnail;
            if (file_exists($company->thumbnail)){
                unlink($company->thumbnail);
            }
            $thumbnail_name    = time() . '_' . $thumbnail->getClientOriginalName();
            $upload_address    = 'Company/' . $company->id . '-' . $company->name;
            $data['thumbnail'] = Helper::storageFile($thumbnail, $thumbnail_name, $upload_address);
        }
        $data['slug'] = Helper::slug($request->name);
        $company->update($data);
        $request->session()->flash('success', trans('Updated successfully.'));

        return redirect()->route('get.company.update', $company->id);
    }

    /**
     * @param Request $request
     * @param $id
     *
     * @return RedirectResponse
     */
    public function delete(Request $request, $id){
        $data = Company::query()->find($id)->delete();
        $data->delete();
        $request->session()->flash('success', trans('Deleted successfully.'));

        return back();
    }
}
