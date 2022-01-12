@extends("Base::backend.master")

@section("content")
    <div id="setting-module">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h4 class="title">{{ trans('Website Config') }}</h4>
            </div>
            <div class="col-md-7 align-self-center text-right">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">{{ trans('Home') }}</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('get.setting.list') }}">{{ trans('Setting') }}</a>
                        </li>
                        <li class="breadcrumb-item active">{{ trans('Website Config') }}</li>
                    </ol>
                </div>
            </div>
        </div>

        <div id="head-page" class="mb-3 d-flex justify-content-end group-btn">
            <a href="{{ route('get.setting.list') }}" class="btn btn-info">{{ trans('Go Back') }}</a>
        </div>
    </div>

    <div id="user" class="card">
        <div class="card-body">
            <form action="{{ route('post.setting.websiteConfig') }}" method="post" id="website-config-form"
                  enctype=multipart/form-data>
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label for="name">{{ trans('Logo') }}</label>
                            </div>
                            <div class="col-md-8">
                                <div class="input-group">
                                    <input type="file" id="logo" class="dropify"
                                           name="{{\Modules\Setting\Models\WebsiteConfig::WEBSITE_LOGO}}"
                                           data-default-file="{{ asset($website_config[\Modules\Setting\Models\WebsiteConfig::WEBSITE_LOGO] ?? NULL) }}"/>
                                </div>
                                <span class="text-success">Size: 100x100</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label for="name">{{ trans('Favicon') }}</label>
                            </div>
                            <div class="col-md-8">
                                <div class="input-group">
                                    <input type="file" id="favicon" class="dropify"
                                           name="{{\Modules\Setting\Models\WebsiteConfig::WEBSITE_FAVICON}}"
                                           data-default-file="{{ asset($website_config[\Modules\Setting\Models\WebsiteConfig::WEBSITE_FAVICON] ?? NULL) }}"/>
                                </div>
                                <span class="text-success">Size: 100x100</span>
                            </div>
                        </div>
                        <div class="form-group row align-items-start">
                            <div class="col-md-4">
                                <label for="WEBSITE_PHONE_FOR_RECRUIMENT">{{ trans('Phone for Recruiment') }}</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="WEBSITE_PHONE_FOR_RECRUIMENT"
                                       name="{{ \Modules\Setting\Models\WebsiteConfig::WEBSITE_PHONE_FOR_RECRUIMENT }}"
                                       value="{{ $website_config[\Modules\Setting\Models\WebsiteConfig::WEBSITE_PHONE_FOR_RECRUIMENT]  ?? NULL }}">
                            </div>
                        </div>
                        <div class="form-group row align-items-start">
                            <div class="col-md-4">
                                <label for="WEBSITE_PHONE_FOR_APPLICANT">{{ trans('Phone for Applicant') }}</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="WEBSITE_PHONE_FOR_APPLICANT"
                                       name="{{ \Modules\Setting\Models\WebsiteConfig::WEBSITE_PHONE_FOR_APPLICANT }}"
                                       value="{{ $website_config[\Modules\Setting\Models\WebsiteConfig::WEBSITE_PHONE_FOR_APPLICANT]  ?? NULL }}">
                            </div>
                        </div>
                        <div class="form-group row align-items-start">
                            <div class="col-md-4">
                                <label for="WEBSITE_EMAIL">{{ trans('Email') }}</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="WEBSITE_EMAIL"
                                       name="{{ \Modules\Setting\Models\WebsiteConfig::WEBSITE_EMAIL }}"
                                       value="{{ $website_config[\Modules\Setting\Models\WebsiteConfig::WEBSITE_EMAIL]  ?? NULL }}">
                            </div>
                        </div>
                        <div class="form-group row align-items-start">
                            <div class="col-md-4">
                                <label for="WEBSITE_ADDRESS">{{ trans('Address') }}</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="WEBSITE_ADDRESS"
                                       name="{{ \Modules\Setting\Models\WebsiteConfig::WEBSITE_ADDRESS }}"
                                       value="{{ $website_config[\Modules\Setting\Models\WebsiteConfig::WEBSITE_ADDRESS]  ?? NULL }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6"></div>
                </div>
                <div class="input-group mt-5 d-flex justify-content-between">
                    <div class="mb-3">
                        <button type="submit" class="btn btn-info mr-2">{{ trans('Save') }}</button>
                        <button type="reset" class="btn btn-default">{{ trans('Reset') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('js')
    {!! JsValidator::formRequest('Modules\Setting\Requests\SettingRequest','#website-config-form') !!}

    <script !src="">
        $(document).ready(function () {
            $('.dropify').dropify();
        })
    </script>
@endpush
