@extends("Base::frontend.master")

@section("content")
    <section id="page-title" class="page-title-parallax page-title-dark"
             style="background-image: url({{ asset($banner) }}); background-size: cover; padding: 120px 0;"
             data-bottom-top="background-position:0px 300px;" data-top-bottom="background-position:0px -300px;">
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
                            <input type="text" name="title" class="form-control" autocomplete="off" placeholder="{{ trans('Job name...') }}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <input type="text" name="company" class="form-control" placeholder="{{ trans('Company name...') }}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <select name="career" id="career" class="form-control select2 w-100">
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
                    <div class="col-md-3">
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
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn main-bg-color-light rounded-0">
                            {{ trans('Search') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <section id="news-listing" class="news-listing">
        <div class="content-wrap">
            <div class="container clearfix">
                <div class="row">
                    <div class="col-md-3">
                        <div class="sidebar-widgets-wrap">
                            <div class="widget clearfix">
                                <div class="widget d-none d-md-block">
                                    <h4>{{ trans('New Recruitment') }}</h4>
                                    <div id="post-list-footer" class="new-post-list">
                                        @foreach($new_posts as $post)
                                            <div class="spost clearfix">
                                                <div class="entry-image">
                                                    <a href="{{ route('get.frontend.detail', ['id' => $post->id, 'slug' => $post->slug]) }}">
                                                        <img src="{{ $post->image }}" width="100%" alt="">
                                                    </a>
                                                </div>
                                                <div class="entry-c">
                                                    <div class="entry-title">
                                                        <h4>
                                                            <a class="" href="{{ route('get.frontend.detail', ['id' => $post->id, 'slug' => $post->slug]) }}">
                                                                {{ $post->title }}
                                                                @if($post->is_hot == 1)
                                                                    <span class="is-hot-badges"></span>
                                                                @endif
                                                            </a>
                                                        </h4>
                                                    </div>
                                                    <ul class="entry-meta">
                                                        <li>{{ formatDate(strtotime($post->created_at), 'd/m/Y H:i') }}</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="news">
                            <div class="listing">
                                @foreach($data as $item)
                                    <div class="news-item my-4">
                                        <div class="flex-shrink-0 image">
                                            <a href="{{ route('get.frontend.detail', ['id' => $item->id, 'slug' => $item->slug]) }}">
                                                <img src="{{ $item->image }}" width="100%" alt="">
                                            </a>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <div class="title">
                                                <a href="{{ route('get.frontend.detail', ['id' => $item->id, 'slug' => $item->slug]) }}">
                                                    <h2 class="">
                                                        {{ $item->title }}
                                                        @if($item->is_hot == 1)
                                                            <span class="is-hot-badges"></span>
                                                        @endif
                                                    </h2>
                                                </a>
                                            </div>
                                            <div class="time">{{ formatDate(strtotime($item->created_at), 'd/m/Y H:i') }}</div>
                                            <div class="description mb-3">
                                                {{ $item->description }}
                                            </div>
                                            <div class="time float-end text-uppercase">{{ $item->company->name ?? NULL }}</div>
                                        </div>
                                    </div>
                                    <hr>
                                @endforeach
                            </div>
                            {{ $data->withQueryString()->render('vendor/pagination/frontend_news_listing') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
