<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>


    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{asset('template/assets/vendors/prismjs/themes/prism.css')}}">
    <!-- End plugin css for this page -->


    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap"
        rel="stylesheet" />
    <!-- End fonts -->

    <!-- core:css -->
    <link rel="stylesheet" href="{{asset('template/assets/vendors/core/core.css')}}" />
    <!-- endinject -->

    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{asset('template/assets/vendors/flatpickr/flatpickr.min.css')}}" />
    <!-- End plugin css for this page -->

    <!-- inject:css -->
    <link rel="stylesheet" href="{{asset('template/assets/fonts/feather-font/css/iconfont.css')}}" />
    <link rel="stylesheet" href="{{asset('template/assets/vendors/flag-icon-css/css/flag-icon.min.css')}}" />
    <!-- endinject -->

    <!-- Layout styles -->
    <link rel="stylesheet" href="{{asset('template/assets/css/demo1/style.css')}}" />
    <!-- End layout styles -->

    <link rel="shortcut icon" href="{{asset('template/madjou2.png')}}" />

    <link rel="stylesheet" href="{{asset('template/assets/vendors/datatables.net-bs5/dataTables.bootstrap5.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <style>
        .size-18 {
            width: 14px;
            height: 14px;
        }
    </style>
</head>

<body>
    <div class="main-wrapper" id="app">

        <!-- partial:../../partials/_sidebar.html -->
        @include('layouts.navigation')

        <div class="page-wrapper">

            <!-- partial:../../partials/_navbar.html -->
            @include('layouts.topbar')
            <!-- partial -->

            <div class="page-content">
                @yield('content')


            </div>

            <!-- partial:../../partials/_footer.html -->
            @include('layouts.footer')
            <!-- partial -->

        </div>


    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

    <!-- core:js -->
    <script src="{{asset('template/assets/vendors/core/core.js')}}"></script>
    <!-- endinject -->

    <script src="{{asset('template/assets/vendors/prismjs/prism.js')}}"></script>

    <!-- Plugin js for this page -->
    <script src="{{asset('template/assets/vendors/flatpickr/flatpickr.min.js')}}"></script>
    <script src="{{asset('template/assets/vendors/apexcharts/apexcharts.min.js')}}"></script>
    <!-- End plugin js for this page -->

    <!-- inject:js -->
    <script src="{{asset('template/assets/vendors/feather-icons/feather.min.js')}}"></script>
    <script src="{{asset('template/assets/js/template.js')}}"></script>
    <!-- endinject -->

    <!-- Custom js for this page -->
    <script src="{{asset('template/assets/js/dashboard-light.js')}}"></script>
    <!-- End custom js for this page -->

    <!-- Plugin js for this page -->
    <script src="{{asset('template/assets/vendors/datatables.net/jquery.dataTables.js')}}"></script>
    <script src="{{asset('template/assets/vendors/datatables.net-bs5/dataTables.bootstrap5.js')}}"></script>
    <!-- End plugin js for this page -->

    {{-- sweet alert --}}
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- end sweet alert --}}

    <script src="{{asset('template/assets/vendors/feather-icons/feather.min.js')}}"></script>
    {{-- <script src="{{asset('template/assets/js/template.js')}}"></script> --}}

    <script src="https://cdn.ckeditor.com/ckeditor5/35.3.2/classic/ckeditor.js"></script>
    

    @stack('js')

    <script>
        feather.replace()
    </script>

    <script>
        $('.modal-form #btn-save').on('click', function () {
            var form = $('#modalFormData')[0];
            var formData = new FormData(form);
            $.ajax({
                url: form.action,
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function (data) {
                if (data.success == true) {
                        // sweetalert
                        $('.modal-form').modal('hide');
                        Swal.fire({
                            title: 'Berhasil',
                            // text: data.message,
                            icon: 'success',
                            confirmButtonText: 'Ok'
                        }).then((result) => {
                            if (result.value) {
                                // show data
                            }
                        });
                        if(showData){
                            showData.ajax.reload();
                        }else{
                            setInterval(() => {
                                location.reload();
                            }, 2000);
                        }

                    }else{
                        $.each(data.errors, function (key, value) {
                            //   show errors
                            console.log(key);
                            $('#' + key).addClass('is-invalid');
                            $('#' +'error-' + key ).html(value);
                            // hide error
                            $('#' + key).on('keyup', function () {
                                $('#' + key).removeClass('is-invalid');
                                $('#' +'error-' + key ).html('');
                            });
                        });
                    }
                }
            });
        })
    </script>

</body>

</html>