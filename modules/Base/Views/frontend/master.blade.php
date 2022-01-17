<?php
use Modules\Setting\Models\WebsiteConfig;

$website_settings = WebsiteConfig::getWebsiteConfig();
$favicon = $website_settings[WebsiteConfig::WEBSITE_FAVICON];
$site_title = $website_settings[WebsiteConfig::WEBSITE_TITLE];
?>

<!DOCTYPE html>
@php($locale = App::getLocale())
<html lang="{{ !empty($locale) ? $locale : 'en' }}">
<head>

    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <meta name="author" content="SemiColonWeb"/>
    <meta name="viewport" content="width=device-width, minimum-scale=1"/>
    <!-- Stylesheets
    ============================================= -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Piazzolla:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('assets/frontend/library/css/style.css') }}" type="text/css"/>
    <link rel="stylesheet" href="{{ asset('assets/frontend/library/css/dark.css') }}" type="text/css"/>
    <link rel="stylesheet" href="{{ asset('assets/frontend/library/css/animate.css') }}" type="text/css"/>
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/all.min.css') }}" type="text/css"/>
    <link rel="stylesheet" href="{{ asset('assets/frontend/library/css/magnific-popup.css') }}" type="text/css"/>
    <link rel="stylesheet" href="{{ asset('assets/frontend/library/css/responsive.css') }}" type="text/css"/>
    <link rel="stylesheet" href="{{ asset('assets/plugins/datetimepicker/css/datetimepicker-frontend-custom.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/library/css/magnific-popup.css') }}" type="text/css"/>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>

    <link rel="stylesheet" href="{{ asset('assets/frontend/css/main.css') }}" type="text/css"/>
    <title>
        @if(View::hasSection('title'))
            @yield('title')
        @elseif(!empty($site_title))
            <?= $site_title ?>
        @else
            <?= config('app.name') ?>
        @endif
    </title>
    @if(!empty($favicon))
        <?= '<link rel="icon" type="image/png" sizes="192x192"  href="' . asset($favicon) . '">'; ?>
    @endif

    @stack('css')
</head>

<body class="stretched">
<div id="wrapper" class="clearfix">
    @include('Base::frontend.header')
    @yield('content')
    <div class="modal-group">
        <div class="modal fade modal-ajax" id="form-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-body p-0"></div>
                </div>
            </div>
        </div>
    </div>
    @include('Base::frontend.footer')
</div>
<!-- Go To Top -->
<div id="gotoTop" class="icon-angle-up"><i class="fas fa-angle-up"></i></div>
<script src="{{ asset('assets/frontend/library/js/jquery.js') }}"></script>
<script src="{{ asset('assets/frontend/library/js/plugins.js') }}"></script>
<script src="{{ asset('assets/frontend/library/js/functions.js') }}"></script>
<script src="{{ asset('assets/plugins/datetimepicker/js/datetimepicker.min.js') }}"></script>
<script src="{{ asset('assets/frontend/js/modal.js') }}"></script>
<script src="{{ asset('assets/frontend/js/main.js') }}"></script>
<script src="{{ asset('assets/plugins/jsvalidation/js/jsvalidation.js')}}"></script>
<script src="{{ asset('assets/plugins/toast/toast.js') }}" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@include('Base::frontend.flash_noti')

<script>
    $(document).ready(function () {
        $('.select2').select2();
    })
</script>
@stack('js')
</body>
</html>
