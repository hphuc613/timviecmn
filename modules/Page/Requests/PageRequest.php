<?php

namespace Modules\Page\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PageRequest extends FormRequest{
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
        $segment = segmentUrl(2);
        if($segment == 'create'){
            return [
                'name'    => 'required|validate_unique:pages',
                'status'  => 'required',
                'image'   => 'image|mimes:jpeg,png,jpg,gif,svg',
            ];
        }

        return [
            'name'    => 'required|validate_unique:pages,' . $this->id,
            'status'  => 'required',
            'image'   => 'image|mimes:jpeg,png,jpg,gif,svg',
        ];
    }

    public function messages(){
        return [
            'required'         => ':attribute' . trans(' can not be empty.'),
            'validate_unique'  => ':attribute' . trans(' was exist.'),
            'page_id.required' => trans('Please select ') . ':attribute',
            'image'            => ':attribute' . trans(' must be an image.'),
            'mimes'            => ':attribute' .
                trans(' extention must be one of the following: jpeg, png, jpg, gif, svg.'),
        ];
    }

    public function attributes(){
        return [
            'name'    => trans('Name'),
            'status'  => trans('Status'),
            'image'   => trans('Image'),
        ];
    }
}
