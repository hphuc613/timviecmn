<?php

use Modules\Setting\Models\Setting;

$setting = Setting::query()->pluck('value', 'key');
?>

<footer id="footer">
    <div class="container clearfix py-5">
        <div class="text-center">
            <div class="logo mb-3">
                <img src="{{ asset($setting[\Modules\Setting\Models\WebsiteConfig::WEBSITE_LOGO] ?? NULL) }}" width="100px" alt="Timviectoanquoc">
            </div>
            <div class="text-white">
                <i class="fas fa-building" aria-hidden="true"></i>
                {{ trans('Company') }}:
                <span>{{ $setting[\Modules\Setting\Models\WebsiteConfig::WEBSITE_COMPANY_NAME] ?? NULL }}</span>
            </div>
            <div class="text-white">
                <i class="fas fa-map-marked-alt" aria-hidden="true"></i>
                {{ trans('Address') }}:
                <span>{{ $setting[\Modules\Setting\Models\WebsiteConfig::WEBSITE_ADDRESS] ?? NULL }}</span>
            </div>
            <div class="text-white">
                <i class="far fa-envelope" aria-hidden="true"></i>
                Email:
                <span>
                    <a href="mailto:{{ $setting[\Modules\Setting\Models\WebsiteConfig::WEBSITE_EMAIL] ?? NULL }}">
                        {{ $setting[\Modules\Setting\Models\WebsiteConfig::WEBSITE_EMAIL] ?? NULL }}
                    </a>
                </span>
            </div>
            <div class="text-white">
                <i class="fas fa-phone" aria-hidden="true"></i>
                {{ trans('Phone for Recruiment') }}:
                <span>
                    <a href="tel:{{ $setting[\Modules\Setting\Models\WebsiteConfig::WEBSITE_PHONE_FOR_RECRUIMENT] ?? NULL }}">
                        {{ $setting[\Modules\Setting\Models\WebsiteConfig::WEBSITE_PHONE_FOR_RECRUIMENT] ?? NULL }}
                    </a>
                </span>
            </div>
            <div class="text-white">
                <i class="fas fa-phone" aria-hidden="true"></i>
                {{ trans('Phone for Applicant') }}:
                <span>
                    <a href="tel:{{ $setting[\Modules\Setting\Models\WebsiteConfig::WEBSITE_PHONE_FOR_APPLICANT] ?? NULL }}">
                        {{ $setting[\Modules\Setting\Models\WebsiteConfig::WEBSITE_PHONE_FOR_APPLICANT] ?? NULL }}
                    </a>
                </span>
            </div>
        </div>
    </div>
</footer>
