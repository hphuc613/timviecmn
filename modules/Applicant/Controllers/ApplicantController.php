<?php

namespace Modules\Applicant\Controllers;

use App\AppHelpers\Excel\Export;
use App\AppHelpers\Excel\Import;
use App\AppHelpers\Helper;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Applicant\Models\Applicant;
use Modules\Applicant\Requests\ApplicantImportRequest;
use Modules\Applicant\Requests\ApplicantRequest;
use Modules\Base\Models\Status;
use Modules\Position\Models\Position;
use Modules\Post\Models\Post;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ApplicantController extends Controller{

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
        $statuses = Applicant::getStatuses();
        $data     = Applicant::filter($filter);
        if(isset($request->export)){
            $query       = clone $data;
            $data_export = [];
            $i           = 1;
            foreach($query->get() as $key => $item){
                $data_export[$i]['number']     = $i;
                $data_export[$i]['name']       = $item->name;
                $data_export[$i]['phone']      = $item->phone;
                $data_export[$i]['email']      = $item->email;
                $data_export[$i]['address']    = $item->address;
                $data_export[$i]['birthday']   = formatDate(strtotime($item->birthday), 'd-m-Y');
                $data_export[$i]['post']       = $item->post->title ?? NULL;
                $data_export[$i]['position']   = $item->position->name ?? NULL;
                $data_export[$i]['status']     = $statuses[$item->status];
                $data_export[$i]['experience'] = $item->experience;

                $i++;
            }

            $export             = new Export;
            $export->collection = collect($data_export);
            $export->headings   = [
                trans('#'),
                trans('Name'), trans('Phone'), trans('Email'), trans('Address'), trans('Birthday'),
                trans('Post'), trans('Position'), trans('Status'), trans('Experience')
            ];
            return Excel::download($export, 'ung_vien.xlsx');
        }
        $data = $data->orderBy("created_at", "DESC")->paginate(20);

        return view("Applicant::backend.applicant.index", compact("data", "statuses"));
    }


    /**
     * @param Request $request
     *
     * @return Factory|View
     */
    public function getCreate(){
        $statuses  = Applicant::getStatuses();
        $positions = Position::getArray(Status::STATUS_ACTIVE);
        $posts     = Post::query()->where('status', Status::STATUS_ACTIVE)->pluck('title', 'id')->toArray();

        return view("Applicant::backend.applicant.create", compact("statuses", "positions", "posts"));
    }

    /**
     * @param ApplicantRequest $request
     *
     * @return RedirectResponse
     */
    public function postCreate(ApplicantRequest $request){
        $data             = $request->all();
        $data['birthday'] = formatDate(strtotime($request->birthday), 'Y-m-d');
        if($request->has('file')){
            $file         = $request->file;
            $file_name    = Helper::slug($request->name) . '-' . $request->phone . '-' . formatDate(time(), 'd-m-y-H-i-s') . '.' . $file->getClientOriginalExtension();
            $data['file'] = Helper::storageFile($file, $file_name, 'CV File');
        }
        Applicant::query()->create($data);
        $request->session()->flash('success', trans('Created successfully.'));

        return back();
    }

    /**
     * @param Request $request
     * @param $id
     *
     * @return Factory|View
     */
    public function getUpdate($id){
        $statuses  = Applicant::getStatuses();
        $data      = Applicant::query()->find($id);
        $positions = Position::getArray(Status::STATUS_ACTIVE);
        $post      = Post::query()->find($data->post_id);
        $posts     = Post::query()->where('status', Status::STATUS_ACTIVE)->pluck('title', 'id')->toArray();

        return view("Applicant::backend.applicant.update", compact("data", "statuses", "positions", "post", "posts"));
    }

    /**
     * @param ApplicantRequest $request
     * @param $id
     *
     * @return RedirectResponse
     */
    public function postUpdate(ApplicantRequest $request, $id){
        $data             = $request->all();
        $data['birthday'] = formatDate(strtotime($request->birthday), 'Y-m-d');
        Applicant::query()->find($id)->update($data);
        $request->session()->flash('success', trans('Updated successfully.'));

        return back();
    }

    /**
     * @param Request $request
     * @param $id
     *
     * @return RedirectResponse
     */
    public function delete(Request $request, $id){
        Applicant::query()->find($id)->delete();
        $request->session()->flash('success', trans('Deleted successfully.'));

        return back();
    }

    /**
     * @param Request $request
     * @param $id
     *
     * @return RedirectResponse
     */
    public function getUpdateStatus(Request $request, $id){
        $data = Applicant::query()->find($id);
        if(!empty($data)){
            $data->status = $request->status;
            $data->save();
            $request->session()->flash('success', trans('Update Status successfully.'));
        }

        return back();
    }

    /**
     * @param Request $request
     * @return RedirectResponse|string
     */
    public function getImport(Request $request){
        if(!$request->ajax()){
            return redirect()->back();
        }
        return view('Applicant::backend.applicant._import_form')->render();
    }

    /**
     * @param ApplicantImportRequest $request
     * @return RedirectResponse|BinaryFileResponse
     */
    public function postImport(ApplicantImportRequest $request){
        if($request->has('file')){
            $file = $request->file;
            /** Get array data*/
            $array = Excel::toArray(new Import, $file);
            $array = reset($array);

            /** Get header*/
            $header = ["#", "name", "phone", "email", "address", "birthday", "post_id", "position_id", "experience"];

            /** Get data*/
            unset($array[0]);
            $clients = $array;


            $error_data = [];
            $i          = 1;
            foreach($clients as $key => $applicant){
                $data                = array_combine($header, $applicant);
                $data['birthday']    = formatDate(strtotime($data['birthday']), 'Y-m-d');
                $data['post_id']     = Post::query()
                                           ->where('slug', Helper::slug($data['post_id']))
                                           ->first()->id ?? NULL;
                $data['position_id'] = Position::query()
                                               ->where('slug', Helper::slug($data['position_id']))
                                               ->first()->id ?? NULL;

                $rule      = new ApplicantRequest();
                $validator = Validator::make($data, [
                    'name'        => 'required',
                    'birthday'    => 'required',
                    'email'       => 'required|email',
                    'phone'       => 'digits:10|required',
                    'address'     => 'required',
                    'position_id' => 'required'
                ], $rule->messages(), $rule->attributes());
                $messages  = $validator->getMessageBag()->toArray();
                if(!empty($messages)){
                    $data["#"] = $i;
                    $i++;
                    $data['error_messages'] = '';
                    foreach($messages as $message){
                        $data['error_messages'] .= implode(" ", $message) . " ";
                    }
                    $error_data[] = $data;
                    continue;
                }else{
                    unset($data["#"]); // leave column number
                    $member = new Applicant($data);
                    $member->save();
                }
            }

            if(!empty($error_data)){
                array_push($header, 'error_messages');
                $export             = new Export;
                $export->collection = collect($error_data);
                $export->headings   = $header;
                $request->session()->flash('success', trans('There are some record insert fail.'));
                return Excel::download($export, 'fail_import.xlsx');
            }
        }
        $request->session()->flash('success', trans('Import successfully.'));

        return redirect()->back();
    }
}
