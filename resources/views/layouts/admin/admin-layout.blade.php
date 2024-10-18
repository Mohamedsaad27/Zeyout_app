<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Zyout Egypt</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('uploads/zyout1-01.png') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/dashboard/styles.min.css') }}" />
    <head>
        <!-- Add Font Awesome CDN here -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    </head>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">

        <!-- Sidebar Start -->
        @include('layouts.admin.partials.sidebar')
        <!--  Sidebar End -->

        <!--  Main wrapper -->
        <div class="body-wrapper">
            <!--  Header Start -->
            @include('layouts.admin.partials.navbar')
            <!--  Header End -->

            {{-- Start Content --}}
            <div class="container-fluid">
                @yield('content')
            </div>
            {{-- End Content --}}

        </div>
    </div>
    <script src="{{ asset('assets/libs/dashboard/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/dashboard/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/dashboard/sidebarmenu.js') }}"></script>
    <script src="{{ asset('assets/js/dashboard/app.min.js') }}"></script>
    <script src="{{ asset('assets/libs/dashboard/js/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/libs/dashboard/js/simplebar.js') }}"></script>
    <script src="{{ asset('assets/js/dashboard/dashboard.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js"></script>
    @stack('scripts')
</body>

</html>
