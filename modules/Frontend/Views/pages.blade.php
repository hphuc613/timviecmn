@extends("Base::frontend.master")
@push('css')
    <style>
        .contact-us table tr td{
            font-size: 18px;
        }
    </style>
@endpush
@section("content")
    <section id="page-title" class="page-title-parallax page-title-dark"
             style="background-image: url({{ asset($banner) }}); background-size: cover; padding: 120px 0;"
             data-bottom-top="background-position:0px 300px;" data-top-bottom="background-position:0px -300px;">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h1>{{ (segmentUrl(0) == 'contact-us') ? trans('Contact Us') : $data->name}}</h1>
                </div>
                <div class="col-md-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active"
                            aria-current="page">{{ (segmentUrl(0) == 'contact-us') ? trans('Contact Us') : $data->name }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </section><!-- #page-title end -->

    <section id="content">
        <div class="content-wrap">
            <div class="container">
                @if(segmentUrl(0) == 'contact-us')
                    <div class="contact-us">
                        <table border="0" cellpadding="22" cellspacing="2">
                            <tbody>
                            <tr>
                                <td>
                                    <i class="fas fa-building" aria-hidden="true"></i>
                                    {{ trans('Company') }}:
                                </td>
                                <td>
                                    {{ $setting[\Modules\Setting\Models\WebsiteConfig::WEBSITE_COMPANY_NAME] ?? NULL }}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <i class="fas fa-map-marked-alt"></i>
                                    {{ trans('Address') }}
                                </td>
                                <td>
                                    {{ $setting[\Modules\Setting\Models\WebsiteConfig::WEBSITE_ADDRESS] ?? NULL }}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <i class="far fa-envelope"></i>
                                    {{ trans('Email') }}
                                </td>
                                <td>
                                    <a href="mailto:{{ $setting[\Modules\Setting\Models\WebsiteConfig::WEBSITE_EMAIL] ?? NULL }}">
                                        {{ $setting[\Modules\Setting\Models\WebsiteConfig::WEBSITE_EMAIL] ?? NULL }}
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <i class="fas fa-phone" aria-hidden="true"></i>
                                    {{ trans('Phone for Recruiment') }}
                                </td>
                                <td>
                                    <a href="tel:{{ $setting[\Modules\Setting\Models\WebsiteConfig::WEBSITE_PHONE_FOR_RECRUIMENT] ?? NULL }}">
                                        {{ $setting[\Modules\Setting\Models\WebsiteConfig::WEBSITE_PHONE_FOR_RECRUIMENT] ?? NULL }}
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <i class="fas fa-phone" aria-hidden="true"></i>
                                    {{ trans('Phone for Applicant') }}
                                </td>
                                <td>
                                    <a href="tel:{{ $setting[\Modules\Setting\Models\WebsiteConfig::WEBSITE_PHONE_FOR_APPLICANT] ?? NULL }}">
                                        {{ $setting[\Modules\Setting\Models\WebsiteConfig::WEBSITE_PHONE_FOR_APPLICANT] ?? NULL }}
                                    </a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="page-section">
                        {!! $data->content ?? NULL !!}
                    </div>
                @endif
            </div>
        </div>
    </section><!-- #content end -->
@endsection
