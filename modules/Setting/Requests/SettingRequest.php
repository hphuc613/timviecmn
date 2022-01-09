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
            WebsiteConfig::WEBSITE_EMAIL                => 'email',
            WebsiteConfig::WEBSITE_PHONE_FOR_RECRUIMENT => 'digits:10',
            WebsiteConfig::WEBSITE_PHONE_FOR_APPLICANT  => 'digits:10',
        ];
    }

    public function messages(){
        return [
            'email'  => ':attribute' . trans(' must be the email.'),
            'digits' => ':attribute' . trans(' must be 10 digits.'),
        ];
    }

    public function attributes(){
        return [
            WebsiteConfig::WEBSITE_EMAIL                => trans('Email'),
            WebsiteConfig::WEBSITE_PHONE_FOR_RECRUIMENT => trans('Phone'),
            WebsiteConfig::WEBSITE_PHONE_FOR_APPLICANT  => trans('Phone'),
        ];
    }
}
