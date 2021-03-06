<?php

namespace Modules\Company\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest{

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
                    'name'      => 'required|validate_unique:companies',
                    'slug'      => 'validate_unique:companies',
                    'email'     => 'required',
                    'phone'     => 'required',
                    'address'   => 'required',
                    'status'    => 'required',
                    'career_id' => 'required',
                    'city_id'   => 'required',
                    'logo'      => 'image|mimes:jpeg,png,jpg,gif,svg',
                ];
                break;
            case "update":
                return [
                    'name'      => 'required|validate_unique:companies,' . $this->id,
                    'slug'      => 'validate_unique:companies,' . $this->id,
                    'email'     => 'required',
                    'phone'     => 'required',
                    'address'   => 'required',
                    'status'    => 'required',
                    'career_id' => 'required',
                    'city_id'   => 'required',
                    'logo'      => 'image|mimes:jpeg,png,jpg,gif,svg',
                ];
                break;
        }
    }

    public function messages(){
        return [
            'required'           => ':attribute' . trans(' can not be empty.'),
            'career_id.required' => trans('Please select ') . ':attribute',
            'city_id.required'   => trans('Please select ') . ':attribute',
            'logo'               => ':attribute' . trans(' must be an image.'),
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
            'city_id'   => trans('City'),
            'logo'      => trans('Logo')
        ];
    }
}
