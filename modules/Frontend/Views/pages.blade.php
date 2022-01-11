@extends("Base::frontend.master")

@section("content")
    <section id="page-title" class="page-title-parallax page-title-dark"
             style="background-image: url({{ asset($banner) }}); background-size: cover; padding: 120px 0;"
             data-bottom-top="background-position:0px 300px;" data-top-bottom="background-position:0px -300px;">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h2 class="text-white">{{ $data->name  ?? NULL}}</h2>
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
                {!! $data->content ?? NULL !!}
            </div>
        </div>
    </section><!-- #content end -->
@endsection
