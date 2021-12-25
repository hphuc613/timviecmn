@extends("Base::frontend.master")

@section("content")
    <section id="page-title" class="page-title-parallax page-title-dark"
             style="background-image: url({{ asset('storage/upload/Frontend/landing1.jpg') }}); padding: 120px 0;"
             data-bottom-top="background-position:0px 300px;" data-top-bottom="background-position:0px -300px;">

        <div class="container">
            <div class="d-flex justify-content-between">
                <div class="w-50">
                    <h2 class="text-white">{{ $data->title }}</h2>
                </div>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Tin tuyển dụng</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $data->title }}</li>
                </ol>
            </div>
        </div>

    </section><!-- #page-title end -->

    <section id="content">
        <div class="content-wrap">
            <div class="container">
                <div class="row">
                    <div class="col-md-7">
                        <div class="fancy-title title-bottom-border">
                            <h3>{{ $data->title }}</h3>
                        </div>
                        <div class="description mb-5">
                            {!! $data->description !!}
                        </div>
                        <div class="position ps-3 mb-5">
                            <h4>{{ trans('Position') }}</h4>
                            <ul>
                                @foreach($positions as $position)
                                    <li>{{ $position }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="content ps-3">
                            {!! $data->content !!}
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div id="job-apply" class="heading-block highlight-me">
                            <h2>Apply Now</h2>
                            <span>And we'll get back to you within 48 hours.</span>
                        </div>
                        @include('Frontend::_form_apply')
                    </div>
                </div>

            </div>

    </section><!-- #content end -->
@endsection
