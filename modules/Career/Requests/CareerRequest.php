<?php

namespace Modules\Career\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CareerRequest extends FormRequest{

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
                    'name'        => 'required|validate_unique:careers',
                    'slug'        => 'validate_unique:careers',
                    'status'      => 'required',
                ];
                break;
            case "update":
                return [
                    'name'        => 'required|validate_unique:careers,' . $this->id,
                    'slug'        => 'validate_unique:careers,' . $this->id,
                    'status'      => 'required',
                ];
                break;
        }
    }

    public function messages(){
        return [
            'required'             => ':attribute' . trans(' can not be empty.'),
            'validate_unique'      => ':attribute' . trans(' was exist.'),
        ];
    }

    public function attributes(){
        return [
            'name'        => trans('Name'),
            'slug'        => trans('Slug'),
            'status'      => trans('Status'),
        ];
    }
}
