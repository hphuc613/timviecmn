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
                    <div class="content ps-3">
                        {!! $data->content !!}
                    </div>
                </div>
                <div class="col-md-5">

                    <div id="job-apply" class="heading-block highlight-me">
                        <h2>Apply Now</h2>
                        <span>And we'll get back to you within 48 hours.</span>
                    </div>

                    <div class="contact-widget">

                        <div class="contact-form-result"></div>

                        <form action="#" id="template-jobform" name="template-jobform" method="post" role="form">
                            <div class="form-process"></div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Tên <small>*</small></label>
                                        <input type="text" id="name" name="name" class="form-control required"/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="birthday">Ngày tháng năm sinh <small>*</small></label>
                                        <input type="text" name="birthday" id="birthday" class="form-control required"/>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="email">Email <small>*</small></label>
                                        <input type="email" id="email" name="email" class="required email form-control"/>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="phone">Số điện thoại <small>*</small></label>
                                        <input type="email" id="phone" name="phone" class="required phone form-control"/>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="position">Vị trí <small>*</small></label>
                                        <select name="position" id="position"
                                                tabindex="9"
                                                class="form-control select2">
                                            <option value="">-- Select Position --</option>
                                            <option value="Senior Python Developer">Senior Python Developer</option>
                                            <option value="Design Analyst">Design Analyst</option>
                                            <option value="Head of UX and Design">Head of UX and Design</option>
                                            <option value="Web &amp; Visual Designer (Marketing)">Web &amp; Visual
                                                Designer
                                                (Marketing)
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="file">CV file</label>
                                        <input type="file" name="file" id="file" class="form-control"/>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="experience">Kinh nghiệm</label>
                                        <textarea name="experience" id="experience"rows="6" class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <button class="button button-3d button-large btn-block nomargin"
                                            name="template-jobform-apply" type="submit" value="apply">Ứng Tuyển
                                    </button>
                                </div>
                            </div>
                        </form>

                    </div>

                </div>
            </div>

        </div>

    </section><!-- #content end -->
@endsection
