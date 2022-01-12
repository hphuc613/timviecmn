<?php

namespace Modules\Setting\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Setting\Models\WebsiteConfig;

class SettingRequest extends FormRequest{

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
        return [
            WebsiteConfig::WEBSITE_EMAIL                => 'required|email',
            WebsiteConfig::WEBSITE_PHONE_FOR_RECRUIMENT => 'required|digits:10',
            WebsiteConfig::WEBSITE_PHONE_FOR_APPLICANT  => 'required|digits:10',
        ];
    }

    public function messages(){
        return [
            'required' => ':attribute' . trans(' cannot be empty.'),
            'email'    => ':attribute' . trans(' must be the email.'),
            'digits'   => ':attribute' . trans(' must be 10 digits.'),
        ];
    }

    public function attributes(){
        return [
            WebsiteConfig::WEBSITE_EMAIL                => trans('Email'),
            WebsiteConfig::WEBSITE_PHONE_FOR_RECRUIMENT => trans('Phone for Recruiment'),
            WebsiteConfig::WEBSITE_PHONE_FOR_APPLICANT  => trans('Phone for Applicant'),
        ];
    }
}
