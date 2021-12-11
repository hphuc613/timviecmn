@extends("Base::backend.master")

@section("content")
    <div class="company-module">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h4 class="title">{{ trans('Company') }}</h4>
            </div>
            <div class="col-md-7 align-self-center text-right">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">{{ trans('Home') }}</a></li>
                        <li class="breadcrumb-item"><a href="{{ route("get.company.list") }}">{{ trans('Company') }}</a></li>
                        <li class="breadcrumb-item active">{{ trans('Update Company') }}</li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="mb-3 d-flex justify-content-end group-btn">
            <a href="{{ route("get.company.list") }}" class="btn btn-cyan">{{ trans("Back") }}</a>
        </div>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{ trans('Update Company') }}</h4>
            </div>
            <div class="card-body">
                @include('Company::backend.company._form')
            </div>
        </div>
    </div>
@endsection
