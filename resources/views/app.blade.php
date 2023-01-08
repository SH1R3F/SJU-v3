<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="keywords" content="{{ __('Saudi Journalists association') }}" />
    <meta name="description" content="{{ __('Saudi Journalists association') }}">
    <meta name="author" content="sju.org.sa">
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('img/logo.png') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Cairo&family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, shrink-to-fit=no">

    <!-- Vendor CSS -->
    <link rel="stylesheet" href="{{ asset('css/libs/mdb.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/libs/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/fontawesome.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/libs/bootstrap-datetimepicker.css') }}">
    <script src="https://cdn.jsdelivr.net/gh/abublihi/datepicker-hijri@v1.1/build/datepicker-hijri.js"></script>

    <!-- Theme CSS -->
    <link href="{{ asset('/css/main.css') }}" rel="stylesheet" />

    <link href="{{ mix('/css/app.css') }}" rel="stylesheet" />
    <script src="{{ mix('/js/app.js') }}" defer></script>

    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/toastr/toastr.css') }}" />
    @routes
    @inertiaHead

</head>

<body>
    @inertia

    <!-- Core JS -->
    <!-- Vendor -->
    <script src="{{ asset('js/libs/jquery.min.js') }}"></script>
    <script src="{{ asset('js/libs/popper.min.js') }}"></script>
    <script src="{{ asset('js/libs/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/libs/mdb.min.js') }}"></script>
    <script src="{{ asset('js/libs/moment-with-locales.js') }}"></script>
    <script src="{{ asset('js/libs/moment-hijri.js') }}"></script>

    <script src="{{ asset('js/libs/bootstrap-hijri-datetimepicker.js') }}"></script>
    <script src="{{ asset('js/libs/jspdf.min.js') }}"></script>
    <script src="{{ asset('js/libs/dom2img.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/toastr/toastr.js') }}" defer></script>
    <script src="{{ asset('js/main.js') }}"></script>
</body>

</html>
