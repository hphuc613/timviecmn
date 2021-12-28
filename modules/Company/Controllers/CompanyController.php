<?php

namespace Modules\Company\Controllers;

use App\AppHelpers\Excel\Export;
use App\AppHelpers\Helper;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Base\Models\Status;
use Modules\Career\Models\Career;
use Modules\City\Models\City;
use Modules\Company\Models\Company;
use Modules\Company\Requests\CompanyRequest;

class CompanyController extends Controller {

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
        $careers  = Career::getArray();
        $cities   = City::getArray();
        $data     = Company::filter($filter);
        if (isset($request->export)) {
            $query       = clone $data;
            $data_export = [];
            $i           = 1;
            foreach ($query->get() as $key => $company) {
                $data_export[$i]['number']  = $i;
                $data_export[$i]['name']    = $company->name;
                $data_export[$i]['career']  = $company->career->name;
                $data_export[$i]['phone']   = $company->phone;
                $data_export[$i]['email']   = $company->email;
                $data_export[$i]['address'] = $company->address;
                $data_export[$i]['city']    = $company->city->name;
                $data_export[$i]['status']  = $statuses[$company->status];
                $data_export[$i]['remarks'] = $company->remarks;

                $i++;

            }

            $export             = new Export;
            $export->collection = collect($data_export);
            $export->headings   = [
                trans('#'),
                trans('Name'), trans('Career'),
                trans('Phone'), trans('Email'),
                trans('Address'), trans('City'),
                trans('Status'), trans('Remarks')
            ];
            return Excel::download($export, 'cong_ty.xlsx');
        }
        $data = $data->orderBy("created_at", "DESC")->paginate(20);
        return view("Company::backend.company.index",
            compact("data", "statuses", "careers", "cities"));
    }

    /**
     * @return Factory|View
     */
    public function getCreate() {
        $statuses = Status::getStatuses();
        $careers  = Career::getArray(Status::STATUS_ACTIVE);
        $cities   = City::getArray(Status::STATUS_ACTIVE);

        return view("Company::backend.company.create", compact("statuses", "careers", "cities"));
    }

    /**
     * @param CompanyRequest $request
     *
     * @return RedirectResponse
     */
    public function postCreate(CompanyRequest $request) {
        $data = $request->all();
        unset($data['logo']);
        $data['slug'] = Helper::slug($request->name);
        $company      = Company::query()->create($data);
        if ($request->hasFile('logo')) {
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
    public function getUpdate($id) {
        $data     = Company::query()->find($id);
        $statuses = Status::getStatuses();
        $careers  = Career::getArray(Status::STATUS_ACTIVE);
        $cities   = City::getArray(Status::STATUS_ACTIVE);

        return view("Company::backend.company.update", compact("data", "statuses", "careers", "cities"));
    }

    /**
     * @param CompanyRequest $request
     * @param $id
     *
     * @return RedirectResponse
     */
    public function postUpdate(CompanyRequest $request, $id) {
        $data    = $request->all();
        $company = Company::query()->find($id);
        if ($request->hasFile('thumbnail')) {
            $thumbnail = $request->thumbnail;
            if (file_exists($company->thumbnail)) {
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
    public function delete(Request $request, $id) {
        Company::query()->find($id)->delete();
        $request->session()->flash('success', trans('Deleted successfully.'));

        return back();
    }
}
