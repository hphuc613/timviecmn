<?php

namespace Modules\Frontend\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RecruitmentRequest extends FormRequest {
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'name'      => 'required',
            'career_id' => 'required',
            'email'     => 'required',
            'phone'     => 'required',
            'address'   => 'required',
        ];
    }

    public function messages() {
        return [
            'required' => ':attribute' . trans(' cannot be empty')
        ];
    }

    public function attributes() {
        return [
            'name'      => trans('Name'),
            'career_id' => trans('Career'),
            'email'     => trans('Email'),
            'phone'     => trans('Phone'),
            'address'   => trans('Address'),
        ];
    }
}
