@extends("Base::frontend.master")

@section("title", trans('Recruitment News'))

@section("content")
    <section id="page-title" class="page-title-parallax page-title-dark"
             style="background-image: url({{ asset($banner) }}); background-size: cover; padding: 120px 0;"
             data-bottom-top="background-position:0 px 300px;" data-top-bottom="background-position:0px -300px;">
        <div class="container clearfix">
            <h1>{{ trans('Recruitment') }}</h1>
            <span>{{ trans('Your dream job is here') }}</span>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">{{ trans('Recruitment') }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ trans('Listing') }}</li>
            </ol>
        </div>
    </section>

    <section class="container">
        <div id="form-search" class="form-search my-3 my-md-4">
            <h4 class="mb-3">{{ trans('Filter') }}</h4>
            <form action="{{ route('get.frontend.listing') }}" method="get" class="m-0">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <input type="text" name="title" class="form-control" value="{{$filter['title'] ?? NULL}}"
                                   autocomplete="off" placeholder="{{ trans('Job name...') }}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <input type="text" name="company" class="form-control"
                                   value="{{$filter['company'] ?? NULL}}" autocomplete="off"
                                   placeholder="{{ trans('Company name...') }}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <select name="career" id="career" class="form-control select2">
                                <option value="">- {{ trans('Career') }} -</option>
                                @foreach($careers as $career)
                                    @php($selected = $career->slug == ($filter['career'] ?? NULL) ? 'selected' : NULL )
                                    <option value="{{ $career->slug }}" {{ $selected }}>
                                        {{ $career->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    {{--<div class="col-md-3">
                        <div class="form-group">
                            <select name="city" id="city" class="form-control select2 w-100">
                                <option value="">- {{ trans('City') }} -</option>
                                @foreach($cities as $city)
                                    @php($selected = $city->slug == ($filter['city'] ?? NULL) ? 'selected' : NULL )
                                    <option value="{{ $city->slug }}" {{ $selected }}>
                                        {{ $city->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <select name="working_form" id="working_form" class="form-control select2 w-100">
                                <option value="">- {{ trans('Working form') }} -</option>
                                @foreach($work_types as $key => $work_type)
                                    @php($selected = $key == ($filter['working_form'] ?? NULL) ? 'selected' : NULL )
                                    <option value="{{ $key}}" {{ $selected }}>
                                        {{ $work_type }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <select name="position" id="position" class="form-control select2 w-100">
                                <option value="">- {{ trans('Position') }} -</option>
                                @foreach($positions as $position)
                                    @php($selected = $position->slug == ($filter['position'] ?? NULL) ? 'selected' : NULL )
                                    <option value="{{ $position->slug }}" {{ $selected }}>
                                        {{ $position->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>--}}
                    <div class="col-md-3">
                        <button type="submit" class="btn main-bg-color-light rounded-0 w-100">
                            {{ trans('Search') }}
                        </button>
                    </div>
                    <div class="col-md-3">
                        <button type="reset" class="btn btn-outline-secondary rounded-0 w-100 btn-clear">
                            {{ trans('Refresh') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <section id="news-listing" class="news-listing container py-5">
        <div class="row">
            @foreach($data as $item)
                <div class="col-md-4">
                    <div class="news-item">
                        <a href="{{ route('get.frontend.detail', ['id' => $item->id, 'slug' => $item->slug]) }}"
                           class="news-image">
                            <img src="{{ $item->image }}" width="100%" class="me-3" alt="{{ $item->image }}">
                        </a>
                        <div class="news-info">
                            <div class="info">
                                <a href="{{ route('get.frontend.detail', ['id' => $item->id, 'slug' => $item->slug]) }}"
                                   title="{{ $item->title }}">
                                    <h5 class="title text-truncate">{{ $item->title }}</h5>
                                </a>
                                @if($item->is_hot == 1)
                                    <div><span class="is-hot-badges">HOT</span></div>
                                @endif
                                <div><i>{{ formatDate(strtotime($item->created_at), 'd-m-Y H:i') }}</i></div>
                                <div class="mb-2">{{ $item->company->city->name ?? NULL }}</div>
                            </div>
                            <a href="{{ route('get.frontend.listing', ['company' => $item->company->name ?? NULL ]) }}"
                               title="{{ $item->company->name ?? NULL }}">
                                <div class="text-uppercase text-truncate">{{ $item->company->name ?? NULL }}</div>
                            </a>
                        </div>
                    </div>
                    <hr>
                </div>
            @endforeach
        </div>
        {{ $data->withQueryString()->render('vendor/pagination/frontend_news_listing') }}
    </section>
@endsection
