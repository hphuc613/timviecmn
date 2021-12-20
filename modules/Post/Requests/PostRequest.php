<?php

namespace Modules\Post\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest {
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
            'title'       => 'required',
            'status'      => 'required',
//            'cate_id'     => 'required',
            'company_id'  => 'required',
            'position_id' => 'required',
            'image'       => 'image|mimes:jpeg,png,jpg,gif,svg',
        ];
    }

    /**
     * @return array
     */
    public function messages() {
        return [
            'required'         => ':attribute' . trans(' can not be empty.'),
            'cate_id.required' => trans('Please select ') . ':attribute',
            'image'            => ':attribute' . trans(' must be an image.'),
            'mimes'            => ':attribute' .
                trans(' extention must be one of the following: jpeg, png, jpg, gif, svg.'),
        ];
    }

    /**
     * @return array
     */
    public function attributes() {
        return [
            'title'       => trans('Title'),
            'status'      => trans('Status'),
//            'cate_id'     => trans('Category'),
            'company_id'  => trans('Company'),
            'position_id' => trans('required'),
            'image'       => trans('Image')
        ];
    }
}
