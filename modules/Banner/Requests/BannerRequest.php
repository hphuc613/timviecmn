<?php

namespace Modules\Banner\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BannerRequest extends FormRequest {
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
            'name'   => 'required',
            'status' => 'required',
            'image'  => 'required',
            'page_id'  => 'required',
        ];
    }

    public function messages() {
        return [
            'required'        => ':attribute' . trans(' can not be empty.'),
            'status.required' => trans('Please select ') . ':attribute',
        ];
    }

    public function attributes() {
        return [
            'name'    => trans('Name'),
            'status'  => trans('Status'),
            'image'   => trans('Image'),
            'page_id' => trans('Page'),
        ];
    }
}
