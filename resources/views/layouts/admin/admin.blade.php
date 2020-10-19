<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description"
          content="Taxis à paris: Le taxi reste le moyen de transport à la demande le plus flexible pour le voyageur - Il peut être réservé à l'avance via une centrale ou hélé dans la rue, à une station, ... Combien coute un taxi pour l'aéroport ? Commenr réserver à l'avance ? - Information sur les taxis à maroc.">
    <meta name="keywords"
          content="taxi Réservation ,maroc, reservation en ligne,reserver une vhiecule, web app,reserver une taxi, navite
   navite center, ville, aeroport center ville,aeropot vers essaouira,aeropot ssaouira,aeropt rachidia"
    >
    <meta name="author" content="PIXINVENT">
    <title>@yield('title')</title>

    <link rel="apple-touch-icon" href="{{asset('assets/admin/images/ico/apple-icon-120.png')}}">
    <link rel="apple-touch-icon" href="{{asset('assets/admin/images/ico/favicon.ico')}}">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Quicksand:300,400,500,700"
        rel="stylesheet">
    <link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css"
          rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css"
          integrity="sha256-2XFplPlrFClt0bIdPgpz8H7ojnk10H69xRqd9+uTShA=" crossorigin="anonymous"/>
    <!-- BEGIN VENDOR CSS-->
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
    <link href="{{asset('assets/admin/vendors/css/tables/datatable/datatables.min.css')}}"
          rel="stylesheet">
    <link href="{{asset('assets/admin/vendors/css/forms/toggle/bootstrap-switch.css')}}"
          rel="stylesheet">
    <link href="{{asset('assets/admin/vendors/css/forms/toggle/switchery.css')}}"
          rel="stylesheet">
    <link href="{{asset('assets/admin/css/plugins/forms/switch.css')}}"
          rel="stylesheet">

    <link href="{{asset('assets/admin/css/style.css')}}"
          rel="stylesheet">
    @yield('style')
</head>
<body class="vertical-layout vertical-menu 2-columns   menu-expanded fixed-navbar"
      data-open="click" data-menu="vertical-menu" data-col="2-columns">

@include('admin.includes.navbar')

@include('admin.includes.sidebar')
<!--  content-->
<div class="app-content content">
    <div class="content-wrapper">
        @yield('content')
    </div>
</div>
@include('sweetalert::alert')
<!-- ////////////////////////////////////////////////////////////////////////////-->
@include('admin.includes.footer')
<!-- BEGIN VENDOR JS-->
<script src="{{asset('assets/admin/vendors/js/vendors.min.js')}}" type="text/javascript"></script>
<!-- BEGIN VENDOR JS-->
<script src="{{asset('assets/admin/vendors/js/tables/datatable/datatables.min.js')}}"
        type="text/javascript"></script>
<script src="{{asset('assets/admin/vendors/js/tables/datatable/dataTables.buttons.min.js')}}"
        type="text/javascript"></script>

<script src="{{asset('assets/admin/vendors/js/forms/toggle/bootstrap-switch.min.js')}}"
        type="text/javascript"></script>
<script src="{{asset('assets/admin/vendors/js/forms/toggle/bootstrap-checkbox.min.js')}}"
        type="text/javascript"></script>
<script src="{{asset('assets/admin/vendors/js/forms/toggle/switchery.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/admin/js/scripts/forms/switch.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/admin/vendors/js/forms/select/select2.full.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/admin/js/scripts/forms/select/form-select2.js')}}" type="text/javascript"></script>

<!-- BEGIN PAGE VENDOR JS-->
<script src="{{asset('assets/admin/vendors/js/charts/chart.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/admin/vendors/js/charts/echarts/echarts.js')}}" type="text/javascript"></script>

<script src="{{asset('assets/admin/vendors/js/extensions/datedropper.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/admin/vendors/js/extensions/timedropper.min.js')}}" type="text/javascript"></script>

<script src="{{asset('assets/admin/vendors/js/forms/icheck/icheck.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/admin/js/scripts/pages/chat-application.js')}}" type="text/javascript"></script>
<!-- END PAGE VENDOR JS-->
<!-- BEGIN MODERN JS-->
<script src="{{asset('assets/admin/js/core/app-menu.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/admin/js/core/app.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/admin/js/scripts/customizer.js')}}" type="text/javascript"></script>
<!-- END MODERN JS-->
<!-- BEGIN PAGE LEVEL JS-->
<script src="{{asset('assets/admin/js/scripts/pages/dashboard-crypto.js')}}" type="text/javascript"></script>


<script src="{{asset('assets/admin/js/scripts/tables/datatables/datatable-basic.js')}}"
        type="text/javascript"></script>
<script src="{{asset('assets/admin/js/scripts/extensions/date-time-dropper.js')}}" type="text/javascript"></script>
<!-- END PAGE LEVEL JS-->

<script src="{{asset('assets/admin/js/scripts/forms/checkbox-radio.js')}}" type="text/javascript"></script>


<script src="{{asset('assets/admin/vendors/js/forms/repeater/jquery.repeater.min.js')}}"
        type="text/javascript"></script>

<script src="{{asset('assets/admin/js/scripts/forms/form-repeater.js')}}" type="text/javascript"></script>


<script src="{{asset('assets/admin/js/scripts/modal/components-modal.js')}}" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/js/all.min.js"
        integrity="sha256-HkXXtFRaflZ7gjmpjGQBENGnq8NIno4SDNq/3DbkMgo=" crossorigin="anonymous"></script>
<!-- END MODERN JS-->
<!-- BEGIN PAGE LEVEL JS-->

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="https://js.pusher.com/6.0/pusher.min.js"></script>
<script>
    Pusher.logToConsole = true;

    var pusher = new Pusher('056ad552633d263c5450', {
        cluster: 'mt1'
    });
</script>
@yield('script')

<!-- END PAGE LEVEL JS-->
</body>
</html>
