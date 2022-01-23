<?php

namespace Modules\Frontend\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApplyRequest extends FormRequest{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(){
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(){
        return [
            'name'        => 'required',
            'birthday'    => 'required|dateFormatCustom:d-m-Y',
            'email'       => 'nullable|email',
            'phone'       => 'digits:10|required',
            'address'     => 'required',
            'position_id' => 'required',
            'file'        => 'nullable|mimes:pdf',
        ];
    }

    /**
     * @return array
     */
    public function messages(){
        return [
            'required'         => ':attribute' . trans(' cannot be empty'),
            'email'            => ':attribute' . trans(' must be the email.'),
            'validate_unique'  => ':attribute' . trans(' was exist.'),
            'digits'           => ':attribute' . trans(' must be 10 digits.'),
            'dateFormatCustom' => ':attribute' . trans(' must be format day-month-year.'),
            'mimes'            => ':attribute' .
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
