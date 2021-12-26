@extends("Base::frontend.master")

@section("content")
    <section id="page-title" class="page-title-parallax page-title-dark"
             style="background-image: url({{ asset($banner) }}); background-size: cover; padding: 120px 0;"
             data-bottom-top="background-position:0px 300px;" data-top-bottom="background-position:0px -300px;">
        <div class="container clearfix">
            <h1>Tin tuyển dụng</h1>
            <span>Các công việc mơ ước của bạn đều ở đây</span>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Tin tuyển dụng</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tìm kiếm</li>
            </ol>
        </div>
    </section>

    <section id="news-listing" class="news-listing">
        <div class="content-wrap">
            <div class="container clearfix">
                <div class="row">
                    <div class="col-md-3">
                        <div class="sidebar-widgets-wrap">
                            <div class="widget clearfix">
                                <h4>Bộ lọc</h4>
                                <div id="form-search">
                                    <form action="{{ route('get.frontend.listing') }}" method="get">
                                        <div class="header-title" data-bs-toggle="collapse"
                                             data-bs-target="#search-more"
                                             aria-expanded="false" aria-controls="search-more">
                                            <div class="form-group">
                                                <input type="text" name="title" class="form-control" autocomplete="off"
                                                       placeholder="Tên công việc bạn muốn ứng tuyển...">
                                            </div>
                                        </div>
                                        <div id="search-more" class="collapse">
                                            <div class="form-group">
                                                <input type="text" name="company" class="form-control"
                                                       placeholder="Công ty...">
                                            </div>
                                            <div class="form-group">
                                                <select name="career" id="career" class="form-control select2">
                                                    <option value="">- Ngành nghề  -</option>
                                                    @foreach($careers as $career)
                                                        <option value="{{ $career->slug }}" @if($career->slug == ($filter['career'] ?? null)) selected @endif>
                                                            {{ $career->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <select name="city" id="city" class="form-control select2">
                                                    <option value="">Thành phố</option>
                                                    <option value="1">Cần Thơ</option>
                                                    <option value="2">Hồ Chí Minh</option>
                                                    <option value="3">Hà Nội</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <select name="working_style" id="working_style"
                                                        class="form-control select2">
                                                    <option value="">Hình thức làm việc</option>
                                                    <option value="1">Toàn thời gian</option>
                                                    <option value="2">Bán thời gian</option>
                                                    <option value="3">Thực tập</option>
                                                    <option value="4">Remote - Làm từ xa</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <select name="position" id="position" class="form-control select2">
                                                    <option value="">- Vị trí - Chức vụ  -</option>
                                                    @foreach($positions as $position)
                                                        <option value="{{ $position->slug }}" @if($position->slug == ($filter['position'] ?? null)) selected @endif>
                                                                    {{ $position->name }}
                                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <select name="salary" id="salary" class="form-control select2">
                                                    <option value="">Mức lương</option>
                                                    <option value="1">Dưới 100 triệu</option>
                                                    <option value="1">100 - 500 triệu</option>
                                                    <option value="1">Trên 500 triệu</option>
                                                </select>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn main-bg-color-light w-100 rounded-0">Tìm</button>
                                    </form>
                                </div>
                                <div class="widget d-none d-md-block">
                                    <h4>Upcoming Events</h4>
                                    <div id="post-list-footer">
                                        <div class="spost clearfix">
                                            <div class="entry-image">
                                                <a href="#" class="nobg"><img src="images/logo.png" alt=""></a>
                                            </div>
                                            <div class="entry-c">
                                                <div class="entry-title">
                                                    <h4><a href="#">Lorem ipsum dolor sit amet, consectetur</a></h4>
                                                </div>
                                                <ul class="entry-meta">
                                                    <li>10th July 2014</li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="spost clearfix">
                                            <div class="entry-image">
                                                <a href="#" class="nobg"><img src="images/logo.png" alt=""></a>
                                            </div>
                                            <div class="entry-c">
                                                <div class="entry-title">
                                                    <h4><a href="#">Lorem ipsum dolor sit amet, consectetur</a></h4>
                                                </div>
                                                <ul class="entry-meta">
                                                    <li>10th July 2014</li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="spost clearfix">
                                            <div class="entry-image">
                                                <a href="#" class="nobg"><img src="images/logo.png" alt=""></a>
                                            </div>
                                            <div class="entry-c">
                                                <div class="entry-title">
                                                    <h4><a href="#">Lorem ipsum dolor sit amet, consectetur</a></h4>
                                                </div>
                                                <ul class="entry-meta">
                                                    <li>10th July 2014</li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="spost clearfix">
                                            <div class="entry-image">
                                                <a href="#" class="nobg"><img src="images/logo.png" alt=""></a>
                                            </div>
                                            <div class="entry-c">
                                                <div class="entry-title">
                                                    <h4><a href="#">Lorem ipsum dolor sit amet, consectetur</a></h4>
                                                </div>
                                                <ul class="entry-meta">
                                                    <li>10th July 2014</li>
                                                </ul>
                                            </div>
                                        </div>
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
                                                <img src="{{ $item->image }}" width="100%"
                                                     alt="">
                                            </a>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <div class="title">
                                                <a href="{{ route('get.frontend.detail', ['id' => $item->id, 'slug' => $item->slug]) }}"><h2>{{ $item->title }}</h2></a>
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
