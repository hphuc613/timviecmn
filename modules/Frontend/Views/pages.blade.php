@extends("Base::frontend.master")

@section("content")
    <section id="page-title" class="page-title-parallax page-title-dark"
             style="background-image: url({{ asset($banner) }}); background-size: cover; padding: 120px 0;"
             data-bottom-top="background-position:0px 300px;" data-top-bottom="background-position:0px -300px;">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h2>{{ $data->name  ?? NULL}}</h2>
                </div>
                <div class="col-md-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $data->name ?? NULL}}</li>
                    </ol>
                </div>
            </div>
        </div>
    </section><!-- #page-title end -->

    <section id="content">
        <div class="content-wrap">
            <div class="container">
                @if(segmentUrl(0) == 'contact-us')
                    <table border="0" cellpadding="22" cellspacing="2">
                        <tbody>
                        <tr>
                            <td>
                                <i class="fas fa-phone"></i>
                                <span style="font-size:18px">{{ trans('Phone for Recruiment') }} </span>
                            </td>
                            <td>
                                <span style="font-size:18px">
                                    <a href="tel:{{ $setting[\Modules\Setting\Models\WebsiteConfig::WEBSITE_PHONE_FOR_RECRUIMENT] ?? NULL }}">
                                        {{ $setting[\Modules\Setting\Models\WebsiteConfig::WEBSITE_PHONE_FOR_RECRUIMENT] ?? NULL }}
                                    </a>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <i class="fas fa-phone"></i>
                                <span style="font-size:18px">{{ trans('Phone for Applicant') }} </span>
                            </td>
                            <td>
                                <span style="font-size:18px">
                                    <a href="tel:{{ $setting[\Modules\Setting\Models\WebsiteConfig::WEBSITE_PHONE_FOR_APPLICANT] ?? NULL }}">
                                        {{ $setting[\Modules\Setting\Models\WebsiteConfig::WEBSITE_PHONE_FOR_APPLICANT] ?? NULL }}
                                    </a>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <i class="far fa-envelope"></i>
                                <span style="font-size:18px">Email</span>
                            </td>
                            <td>
                                <span style="font-size:18px">
                                    <a href="tel:{{ $setting[\Modules\Setting\Models\WebsiteConfig::WEBSITE_EMAIL] ?? NULL }}">
                                        {{ $setting[\Modules\Setting\Models\WebsiteConfig::WEBSITE_EMAIL] ?? NULL }}
                                    </a>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <i class="fas fa-map-marked-alt"></i>
                                <span style="font-size:18px">{{ trans('Address') }}</span>
                            </td>
                            <td>
                                <span style="font-size:18px">
                                    <a href="tel:{{ $setting[\Modules\Setting\Models\WebsiteConfig::WEBSITE_ADDRESS] ?? NULL }}">
                                        {{ $setting[\Modules\Setting\Models\WebsiteConfig::WEBSITE_ADDRESS] ?? NULL }}
                                    </a>
                                </span>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                @else
                    {!! $data->content ?? NULL !!}
                @endif
            </div>
        </div>
    </section><!-- #content end -->
@endsection
