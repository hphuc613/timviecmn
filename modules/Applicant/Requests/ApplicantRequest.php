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
                    'name'        => 'required',
                    'birthday'    => 'required',
                    'email'       => 'required|email',
                    'phone'       => 'digits:10|required',
                    'address'     => 'required',
                    'position_id' => 'required',
                    'file'        => 'required|mimes:pdf',
                ];
                break;
            case "update":
                return [
                    'name'        => 'required',
                    'birthday'    => 'required',
                    'email'       => 'required|email',
                    'phone'       => 'digits:10|required',
                    'address'     => 'required',
                    'position_id' => 'required',
                    'file'        => 'mimes:pdf',
                ];
                break;
        }
    }

    /**
     * @return array
     */
    public function messages(){
        return [
            'required' => ':attribute' . trans(' cannot be empty'),
            'email'    => ':attribute' . trans(' must be the email.'),
            'digits'   => ':attribute' . trans(' must be 10 digits.'),
            'mimes'    => ':attribute' .
                          trans(' must be pdf file.'),
        ];
    }

    /**
     * @return array
     */
    public function attributes(){
        return [
            'birthday'    => trans('Birthday'),
            'position_id' => trans('Position'),
            'file'        => trans('CV file'),
            'name'        => trans('Name'),
            'email'       => trans('Email'),
            'phone'       => trans('Phone'),
            'address'     => trans('Address'),
        ];
    }
}
