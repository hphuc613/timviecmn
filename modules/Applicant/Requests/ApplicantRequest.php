<?php

namespace Modules\Applicant\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApplicantRequest extends FormRequest{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(){
        return TRUE;
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
                    'name'            => 'required|validate_unique:applicants',
                    'slug'            => 'validate_unique:applicants',
                    'email'           => 'required',
                    'phone'           => 'required',
                    'birthday'        => 'required',
                    'address'         => 'required',
                    'expected_salary' => 'required',
                    'start_date'      => 'required',
                    'status'          => 'required',
                ];
                break;
            case "update":
                return [
                    'name'            => 'required|validate_unique:applicants,' . $this->id,
                    'slug'            => 'validate_unique:applicants,' . $this->id,
                    'email'           => 'required',
                    'phone'           => 'required',
                    'birthday'        => 'required',
                    'address'         => 'required',
                    'expected_salary' => 'required',
                    'start_date'      => 'required',
                    'status'          => 'required',
                ];
                break;
        }
    }

    public function messages(){
        return [
            'required'        => ':attribute' . trans(' can not be empty.'),
            'validate_unique' => ':attribute' . trans(' was exist.'),
        ];
    }

    public function attributes(){
        return [
            'name'            => trans('Name'),
            'slug'            => trans('Slug'),
            'email'           => trans('Email'),
            'phone'           => trans('Phone'),
            'birthday'        => trans('Birthday'),
            'address'         => trans('Address'),
            'expected_salary' => trans('Expected Salary'),
            'start_date'      => trans('Start Date'),
            'status'          => trans('Status'),
        ];
    }
}
