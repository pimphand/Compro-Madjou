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
	<link rel="stylesheet" href="template/assets/vendors/core/core.css">
	<!-- endinject -->

	<!-- Plugin css for this page -->
	<link rel="stylesheet" href="template/assets/vendors/select2/select2.min.css">
	<link rel="stylesheet" href="template/assets/vendors/jquery-tags-input/jquery.tagsinput.min.css">
	<link rel="stylesheet" href="template/assets/vendors/dropzone/dropzone.min.css">
	<link rel="stylesheet" href="template/assets/vendors/dropify/dist/dropify.min.css">
	<link rel="stylesheet" href="template/assets/vendors/pickr/themes/classic.min.css">
	<link rel="stylesheet" href="template/assets/vendors/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="template/assets/vendors/flatpickr/flatpickr.min.css">
	<!-- End plugin css for this page -->

	<!-- inject:css -->
	<link rel="stylesheet" href="template/assets/fonts/feather-font/css/iconfont.css">
	<link rel="stylesheet" href="template/assets/vendors/flag-icon-css/css/flag-icon.min.css">
	<!-- endinject -->

  <!-- Layout styles -->  
	<link rel="stylesheet" href="template/assets/css/demo1/style.css">
  <!-- End layout styles -->

  <link rel="shortcut icon" href="template/assets/images/favicon.png" />
    </head>
    <body>
        <div class="font-sans text-gray-900 antialiased">
            {{ $slot }}
        </div>

        <!-- core:js -->
    <script src="/template/assets/vendors/core/core.js"></script>
    <!-- endinject -->

    <!-- Plugin js for this page -->
	<script src="/template/assets/vendors/jquery-validation/jquery.validate.min.js"></script>
	<script src="/template/assets/vendors/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>
	<script src="/template/assets/vendors/select2/select2.min.js"></script>
	<script src="/template/assets/vendors/typeahead.js/typeahead.bundle.min.js"></script>
	<script src="/template/assets/vendors/jquery-tags-input/jquery.tagsinput.min.js"></script>
	<!-- End plugin js for this page -->

	<!-- inject:js -->
	<script src="/template/assets/vendors/feather-icons/feather.min.js"></script>
	<script src="/template/assets/js/template.js"></script>
	<!-- endinject -->

	<!-- Custom js for this page -->
	<script src="/template/assets/js/form-validation.js"></script>
	<script src="/template/assets/js/bootstrap-maxlength.js"></script>
	<script src="/template/assets/js/inputmask.js"></script>
	<script src="/template/assets/js/select2.js"></script>
	<script src="/template/assets/js/typeahead.js"></script>
	<script src="/template/assets/js/tags-input.js"></script>
	<script src="/template/assets/js/dropzone.js"></script>
	<script src="/template/assets/js/dropify.js"></script>
	<script src="/template/assets/js/pickr.js"></script>
	<script src="/template/assets/js/flatpickr.js"></script>
	<!-- End custom js for this page -->
    

    </body>
</html>
