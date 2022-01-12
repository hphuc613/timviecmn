<?php

use Illuminate\Support\Facades\DB;
use Modules\Setting\Models\WebsiteConfig;

$settings = DB::table('settings')->where('key', WebsiteConfig::WEBSITE_LOGO)->first();
$logo     = $settings->value ?? '';
?>
<header id="header" class="transparent-header full-header">
    <div id="header-wrap">
        <div class="container clearfix">
            <div id="primary-menu-trigger"><i class="fas fa-bars" aria-hidden="true"></i></div>
            @if(!empty($logo))
                <div id="logo">
                    <a href="{{ route('get.frontend.home') }}" class="standard-logo"
                       data-dark-logo="{{ asset($logo) }}">
                        <img src="{{ asset($logo) }}" alt="Tim Viec Toan Quoc">
                    </a>
                    <a href="{{ route('get.frontend.home') }}" class="retina-logo" data-dark-logo="{{ asset($logo) }}">
                        <img src="{{ asset($logo) }}" alt="Tim Viec Toan Quoc">
                    </a>
                </div>
            @endif
            <nav id="primary-menu">
                <ul>
                    <li><a href="{{ route('get.frontend.listing') }}">Tin tuyển dụng</a></li>
                    <li><a href="{{ route('get.frontend.contact_us') }}">{{ trans('Contact Us') }}</a></li>
                    @foreach(\Modules\Page\Models\Page::getListActive() as $item)
                        <li>
                            <a href="{{ route('get.frontend.page', $item->slug) }}">{{ trans('Price List') }}</a>
                        </li>
                    @endforeach
                    <li><a href="#form-modal" data-url="{{ route('get.frontend.recruit') }}" data-bs-toggle="modal">Đăng
                            tuyển</a></li>
                </ul>
            </nav>
        </div>
    </div>
</header>
