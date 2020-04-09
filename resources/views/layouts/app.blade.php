<!doctype html>
<html lang="en">
<head>
    <title>{{env('APP_NAME')}} | Home</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="description" content="Oculux Bootstrap 4x admin is super flexible, powerful, clean &amp; modern responsive admin dashboard with unlimited possibilities.">
    <meta name="keywords" content="admin template, Oculux admin template, dashboard template, flat admin template, responsive admin template, web app, Light Dark version">
    <meta name="author" content="GetBootstrap, design by: puffintheme.com">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <!-- VENDOR CSS -->
    <link rel="stylesheet" href="{{asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/animate-css/vivify.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/c3/c3.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/vendor/parsleyjs/css/parsley.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/toastr/toastr.min.css')}}">
    <!-- MAIN CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/site.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">

</head>
<body class="light_version theme-indigo font-krub">
<!-- Page Loader -->

<div id="wrapper">
    @include('includes.top-navbar')



    @include('includes.sidebar')


    <div id="main-content">
        <div class="container-fluid">
            @yield('content')
        </div>
    </div>
</div>
<!-- Javascript -->
<script src="{{asset('assets/bundles/libscripts.bundle.js')}}"></script>
<script src="{{asset('assets/bundles/vendorscripts.bundle.js')}}"></script>
<script src="{{asset('assets/bundles/c3.bundle.js')}}"></script>
<script src="{{asset('assets/bundles/mainscripts.bundle.js')}}"></script>
<script src="{{asset('assets/js/index.js')}}"></script>
<script src="{{asset('assets/vendor/toastr/toastr.js')}}"></script>
<script src="{{asset('assets/vendor/parsleyjs/js/parsley.min.js')}}"></script>
<script src="{{asset('assets/vendor/parsleyjs/js/pt-br.js')}}"></script>
<?php if (session('message')) {
    $msg = json_encode(Session::get('message'));
}
?>
@if(session()->has('message'))
    <script>
        let sess = '<?php echo $msg; ?>';

        toastr[JSON.parse(sess).type.toLowerCase()](JSON.parse(sess).msg, '', {
            positionClass: 'toast-top-full-width'
        });

    </script>
@endif
@yield('scripts')

</body>
</html>
