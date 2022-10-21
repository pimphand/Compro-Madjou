<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title')</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet" />
        <!-- End fonts -->

        <!-- core:css -->
        <link rel="stylesheet" href="/template/assets/vendors/core/core.css" />
        <!-- endinject -->

        <!-- Plugin css for this page -->
        <link rel="stylesheet" href="/template/assets/vendors/flatpickr/flatpickr.min.css" />
        <!-- End plugin css for this page -->

        <!-- inject:css -->
        <link rel="stylesheet" href="/template/assets/fonts/feather-font/css/iconfont.css" />
        <link rel="stylesheet" href="/template/assets/vendors/flag-icon-css/css/flag-icon.min.css" />
        <!-- endinject -->

        <!-- Layout styles -->
        <link rel="stylesheet" href="/template/assets/css/demo1/style.css" />
        <!-- End layout styles -->

        <link rel="shortcut icon" href="/template/assets/images/favicon.png" />
        <style>
            .size-18{
          width: 14px;
          height: 14px;
          }
          
        </style>
    </head>
    <body class="font-sans antialiased">
        <div class="main-wrapper">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        <!-- core:js -->
    <script src="template/assets/vendors/core/core.js"></script>
    <!-- endinject -->

    <!-- Plugin js for this page -->
    <script src="/template/assets/vendors/flatpickr/flatpickr.min.js"></script>
    <script src="/template/assets/vendors/apexcharts/apexcharts.min.js"></script>
    <!-- End plugin js for this page -->

    <!-- inject:js -->
    <script src="/template/assets/vendors/feather-icons/feather.min.js"></script>
    <script src="/template/assets/js/template.js"></script>
    <!-- endinject -->

    <!-- Custom js for this page -->
    <script src="/template/assets/js/dashboard-light.js"></script>
    <!-- End custom js for this page -->

    <!-- Plugin js for this page -->
  <script src="/template/assets/vendors/datatables.net/jquery.dataTables.js"></script>
  <script src="/template/assets/vendors/datatables.net-bs5/dataTables.bootstrap5.js"></script>
	<!-- End plugin js for this page -->

    <script src="js/addTag.js"></script>
    <script src="js/jquery.js"></script>

    <script>
        feather.replace()
      </script>
    </body>
</html>
