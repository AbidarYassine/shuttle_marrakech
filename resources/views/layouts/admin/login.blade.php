<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@yield('title')</title>

    <!-- Custom fonts for this template-->
    <link href="{{asset('assets/admin/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{asset('assets/admin/css/vendors.css')}}"
          rel="stylesheet">
    <!-- END VENDOR CSS-->
    <!-- BEGIN MODERN CSS-->
    <link href="{{asset('assets/admin/css/app.css')}}"
          rel="stylesheet">
    <!-- END MODERN CSS-->
    <!-- BEGIN Page Level CSS-->
    <link href="{{asset('assets/admin/css/core/menu/menu-types/vertical-menu.css')}}"
          rel="stylesheet">
    <link href="{{asset('assets/admin/css/core/colors/palette-gradient.css')}}"
          rel="stylesheet">
    <link href="{{asset('assets/admin/css/pages/login-register.css')}}"
          rel="stylesheet">

    <link href="{{asset('assets/admin/css/style.css')}}"
          rel="stylesheet">

</head>
<body class="vertical-layout vertical-menu 1-column   menu-expanded blank-page blank-page"
      data-open="click" data-menu="vertical-menu" data-col="1-column">


    @yield('content')


<script src="{{asset('assets/admin/vendors/js/vendors.min.js')}}"></script>
<script src="{{asset('assets/admin/js/core/app-menu.js')}}"></script>
<script src="{{asset('assets/admin/js/core/app.js')}}"></script>
<script src="{{asset('assets/admin/js/scripts/customizer.js')}}"></script>
<script src="{{asset('assets/admin/js/scripts/forms/form-login-register.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/js/all.min.js" integrity="sha256-HkXXtFRaflZ7gjmpjGQBENGn

</body>
</html>
