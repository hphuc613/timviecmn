<?php

use Modules\Setting\Models\Setting;

$setting = Setting::query()->pluck('value', 'key');
?>

<footer id="footer">
    <div class="container clearfix py-5">
        <div class="text-center">
            <div class="logo">
                <img src="{{ asset($setting[\Modules\Setting\Models\WebsiteConfig::WEBSITE_LOGO] ?? NULL) }}"
                     width="100px"
                     alt="Timviectoanquoc">
            </div>
            <div class="text-white">
                <i class="fas fa-phone"></i>
                {{ trans('Phone for Recruiment') }}:
                <span>
                    <a href="tel:{{ $setting[\Modules\Setting\Models\WebsiteConfig::WEBSITE_PHONE_FOR_RECRUIMENT] ?? NULL }}">
                        {{ $setting[\Modules\Setting\Models\WebsiteConfig::WEBSITE_PHONE_FOR_RECRUIMENT] ?? NULL }}
                    </a>
                </span>
            </div>
            <div class="text-white">
                <i class="fas fa-phone"></i>
                {{ trans('Phone for Applicant') }}:
                <span>
                    <a href="tel:{{ $setting[\Modules\Setting\Models\WebsiteConfig::WEBSITE_PHONE_FOR_APPLICANT] ?? NULL }}">
                        {{ $setting[\Modules\Setting\Models\WebsiteConfig::WEBSITE_PHONE_FOR_APPLICANT] ?? NULL }}
                    </a>
                </span>
            </div>
            <div class="text-white">
                <i class="far fa-envelope"></i>
                Email:
                <span>
                    <a href="mailto:{{ $setting[\Modules\Setting\Models\WebsiteConfig::WEBSITE_EMAIL] ?? NULL }}">
                        {{ $setting[\Modules\Setting\Models\WebsiteConfig::WEBSITE_EMAIL] ?? NULL }}
                    </a>
                </span>
            </div>

            <div class="text-white">
                <i class="fas fa-map-marked-alt"></i>
                {{ trans('Address') }}:
                <span>
                    <a href="mailto:{{ $setting[\Modules\Setting\Models\WebsiteConfig::WEBSITE_ADDRESS] ?? NULL }}">
                        {{ $setting[\Modules\Setting\Models\WebsiteConfig::WEBSITE_ADDRESS] ?? NULL }}
                    </a>
                </span>
            </div>
        </div>
    </div>
</footer>
