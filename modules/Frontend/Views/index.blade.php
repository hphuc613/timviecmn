@extends("Base::frontend.master")

@section("content")
    <section id="slider" class="index-page slider-element force-full-screen full-screen">
        <div class="force-full-screen full-screen dark"
             style="background-image: url({{ asset('storage/upload/Frontend/landing1.jpg?_t=1639898986') }}); background-repeat: no-repeat; background-size: cover; background-position: 50% 0;">
            <div class="container clearfix">
                <div class="slider-caption slider-caption-center">
                    <h2 data-animate="fadeInDown" class="text-capitalize mb-5">Welcome to TimviecMN</h2>
                    <div class="d-none d-sm-block mb-3" data-animate="fadeInUp" data-delay="400">
                        Việc làm Miền Nam tự hào 1 năm làm cầu nối cho hơn 1 lượt tuyển dụng và tìm việc thành công
                    </div>
                    <div class="search d-none d-sm-block mb-3">
                        <form action="list.html" method="get">
                            <div data-animate="fadeInUp" data-delay="800" class="search-group">
                                <div class="input-group mb-3">
                                    <button class="input-group-text border-end-0 d-block">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <input type="text" name="name" class="border-start-0 form-control"
                                           placeholder="Tìm việc cho tương lai của bạn...">
                                    <button class="input-group-text d-block search-btn" type="submit">Tìm</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
