@extends("Base::backend.master")

@section("content")
    <div class="company-module">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h4 class="title">{{ trans('Contact Recruitment') }}</h4>
            </div>
            <div class="col-md-7 align-self-center text-right">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">{{ trans('Home') }}</a></li>
                        <li class="breadcrumb-item"><a href="{{ route("get.contact_recruitment.list") }}">{{ trans('Contact Recruitment') }}</a></li>
                        <li class="breadcrumb-item active">{{ trans('Contact Recruitment Detail') }}</li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="mb-3 d-flex justify-content-end group-btn">
            <a href="{{ route("get.contact_recruitment.list") }}" class="btn btn-cyan">{{ trans("Back") }}</a>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ trans('Contact Recruitment Detail') }}</h4>
                    </div>
                    <div class="card-body" style="min-height: 888px">
                        @include('ContactRecruitment::backend.contact-recruitment.form')
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ trans('Company') }}</h4>
                    </div>
                    <div class="card-body">
                        @include('Company::backend.company._form')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
