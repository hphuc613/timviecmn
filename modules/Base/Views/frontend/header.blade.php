<header id="header" class="transparent-header dark full-header no-sticky">
    <div id="header-wrap">
        <div class="container clearfix">
            <div id="primary-menu-trigger"><i class="fas fa-bars"></i></div>
            <div id="logo">
                <a href="{{ route('get.frontend.home') }}" class="standard-logo" data-dark-logo="{{ asset('storage/upload/Frontend/logo.png') }}">
                    <img src="{{ asset('storage/upload/Frontend/logo.png') }}" alt="TimviecMN">
                </a>
                <a href="{{ route('get.frontend.home') }}" class="retina-logo" data-dark-logo="{{ asset('storage/upload/Frontend/logo.png') }}">
                    <img src="{{ asset('storage/upload/Frontend/logo.png') }}" alt="TimviecMN">
                </a>
            </div>
            <nav id="primary-menu">
                <ul>
                    <li><a href="#">Gần bạn</a></li>
                    <li><a href="{{ route('get.frontend.listing') }}">Tin tuyển dụng</a></li>
                    <li><a href="#form-modal" data-url="{{ route('get.frontend.recruit') }}" data-bs-toggle="modal">Đăng tuyển</a></li>
                </ul>
            </nav>
        </div>
    </div>
</header>
