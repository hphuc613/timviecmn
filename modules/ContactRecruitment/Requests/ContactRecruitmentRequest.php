<?php

namespace Modules\ContactRecruitment\Requests;

use App\AppHelpers\Helper;
use Illuminate\Foundation\Http\FormRequest;

class ContactRecruitmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(){
        $method = segmentUrl(2);
        switch ($method){
            default:
                return [
                    'name'      => 'required|validate_unique:contact_recruitments',
                    'slug'      => 'validate_unique:contact_recruitments',
                    'email'     => 'required',
                    'phone'     => 'required',
                    'address'   => 'required',
                    'status'    => 'required',
                    'career_id' => 'required',
                ];
                break;
            case "update":
                return [
                    'name'      => 'required|validate_unique:contact_recruitments,' . $this->id,
                    'slug'      => 'validate_unique:contact_recruitments,' . $this->id,
                    'email'     => 'required',
                    'phone'     => 'required',
                    'address'   => 'required',
                    'status'    => 'required',
                    'career_id' => 'required',
                ];
                break;
        }
    }

    public function messages(){
        return [
            'required'           => ':attribute' . trans(' can not be empty.'),
            'career_id.required' => trans('Please select ') . ':attribute',
            'mimes'              => ':attribute' .
                                    trans(' extention must be one of the following: jpeg, png, jpg, gif, svg.'),
            'validate_unique'    => ':attribute' . trans(' was exist.'),
        ];
    }

    public function attributes(){
        return [
            'name'      => trans('Name'),
            'slug'      => trans('Slug'),
            'email'     => trans('Email'),
            'phone'     => trans('Phone'),
            'address'   => trans('Address'),
            'status'    => trans('Status'),
            'career_id' => trans('Career'),
        ];
    }
}
