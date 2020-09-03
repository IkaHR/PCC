<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>@yield('title') | {{ config('app.name', 'Laravel') }}</title>

    <!-- Favicon-->
    <link rel="icon" href="{{ asset('images/user-img-background.jpg') }}" type="image/x-icon">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="{{ asset('plugins/bootstrap/css/bootstrap.css') }}" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="{{ asset('plugins/node-waves/waves.css') }}" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="{{ asset('plugins/animate-css/animate.css') }}" rel="stylesheet" />

    <!-- JQuery DataTable Css -->
    <link href="{{ asset('plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}" rel="stylesheet">

    <!-- Bootstrap Select Css -->
    <link href="{{ asset('plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="{{ asset('css/themes/all-themes.css') }}" rel="stylesheet" />
</head>

<body class="theme-green">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->

    @yield('content')

    <!-- Jquery Core Js -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>

    <!-- Bootstrap Core Js -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.js') }}"></script>

    <!-- Select Plugin Js -->
    <script src="{{ asset('plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="{{ asset('plugins/jquery-slimscroll/jquery.slimscroll.js') }}"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="{{ asset('plugins/node-waves/waves.js') }}"></script>

    <!-- Jquery DataTable Plugin Js -->
    <script src="{{ asset('plugins/jquery-datatable/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js') }}"></script>
    <script src="{{ asset('plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-datatable/extensions/export/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-datatable/extensions/export/jszip.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-datatable/extensions/export/pdfmake.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-datatable/extensions/export/vfs_fonts.js') }}"></script>
    <script src="{{ asset('plugins/jquery-datatable/extensions/export/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-datatable/extensions/export/buttons.print.min.js') }}"></script>

    <!-- Bootstrap Notify Plugin Js -->
    <script src="{{ asset('plugins/bootstrap-notify/bootstrap-notify.js') }}"></script>

    <!-- Jquery CountTo Plugin Js -->
    <script src={{ asset('plugins/jquery-countto/jquery.countTo.js') }}></script>

    <!-- Custom Js -->
    <script src="{{ asset('js/admin.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>

    <!-- Inputmask -->
    <script src="{{ asset('plugins/jquery-inputmask/jquery.inputmask.bundle.js') }}"></script>
    <script>
        //biaya per unit
        $("#input_mask_currency_unit").inputmask('decimal', {
            alias: 'numeric',
            groupSeparator: ',',
            autoGroup: true,
            radixPoint: ".",
            digitsOptional: true,
            allowMinus: false,
            prefix: 'Rp ',
            placeholder: '',
            removeMaskOnSubmit:true
        });

        //biaya perawatan
        $("#input_mask_currency_perawatan").inputmask('decimal', {
            alias: 'numeric',
            groupSeparator: ',',
            autoGroup: true,
            radixPoint: ".",
            digitsOptional: true,
            allowMinus: false,
            prefix: 'Rp ',
            placeholder: '',
            removeMaskOnSubmit:true
        });

        //jumlah unit
        $("#input_mask_unit_number").inputmask({
            alias: 'numeric',
            radixPoint: ".",
            digitsOptional: true,
            allowMinus: false,
            suffix: ' unit',
            placeholder: '',
            removeMaskOnSubmit:true
        });

        //umur ekonomis dalam tahun
        $("#input_mask_economic_age").inputmask('decimal',{
            alias: 'numeric',
            radixPoint: ".",
            digitsOptional: true,
            allowMinus: false,
            suffix: ' tahun',
            placeholder: '',
            removeMaskOnSubmit:true
        });

        //nomor frekuensi
        $("#input_mask_frq").inputmask({
            alias: 'numeric',
            allowMinus: false,
            suffix: ' kali',
            placeholder: '',
            removeMaskOnSubmit:true
        });

        //nomor telp
        $("#input_mask_phone").inputmask({ mask: ['+99 9999-9999-999', '+99 9999-9999-9999', ],
            keepStatic: true
        });
    </script>

</body>
</html>

