<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Taxis à marrakech: Le taxi reste le moyen de transport à la demande le plus flexible pour le voyageur - Il peut être réservé à l'avance via une centrale ou hélé dans la rue, à une station, ... Combien coute un taxi pour l'aéroport ? Commenr réserver à l'avance ? - Information sur les taxis à maroc.">
    <meta name="keywords" content="shuttlemarrakech taxi Réservation ,maroc, reservation en ligne,reserver une vhiecule, web app,reserver une taxi, navite
   navite center, ville, aeroport center ville,aeropot vers essaouira,aeropot ssaouira,aeropt rachidia,aeroport de marrakech vers essaouira">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/site/css/bootstrap-4.4.1.min.css')}}" id="bootstrap-css">
    <link href="{{asset('assets/admin/css/app.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/site/css/jquery.mCustomScrollbar.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/site/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/site/css/app.css')}}">
    <link rel="stylesheet" href="{{asset('assets/site/css/orange.css')}}">
    <link rel="stylesheet" href="{{asset('assets/site/css/flexslider.css')}}">
    <link rel="stylesheet" href="{{asset('assets/site/css/owl.carousel.css')}}">
    <link rel="stylesheet" href="{{asset('assets/site/css/owl.theme.css')}}">
    <link rel="stylesheet" href="{{asset('assets/site/css/chercheOffre.css')}}">
    <link href="{{asset('assets/admin/vendors/css/forms/icheck/icheck.css')}}" rel="stylesheet">
    <link href="{{asset('assets/admin/vendors/css/forms/icheck/custom.css')}}" rel="stylesheet">
    <link href="{{asset('assets/admin/vendors/css/forms/toggle/bootstrap-switch.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/vendors/css/extensions/datedropper.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/vendors/css/extensions/timedropper.min.css')}}">
    <link href="{{asset('assets/admin/vendors/css/forms/toggle/bootstrap-switch.css')}}" rel="stylesheet">
    <link href="{{asset('assets/admin/vendors/css/forms/toggle/switchery.css')}}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/vendors/css/forms/spinner/jquery.bootstrap-touchspin.css')}}">
    <link href="{{asset('assets/admin/css/plugins/forms/switch.css')}}" rel="stylesheet">

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link href="{{asset('assets/admin/css/vendors.css')}}" rel="stylesheet">
    <!-- END VENDOR CSS-->
    <!-- BEGIN MODERN CSS-->
    <link href="{{asset('assets/admin/css/app.css')}}" rel="stylesheet">
    <link href="{{asset('assets/admin/css/core/menu/menu-types/vertical-menu.css')}}" rel="stylesheet">
    <!-- END MODERN CSS-->
    <!-- BEGIN Page Level CSS-->
    <link href="{{asset('assets/admin/css/core/menu/menu-types/vertical-menu.css')}}" rel="stylesheet">
    <link href="{{asset('assets/admin/css/core/colors/palette-gradient.css')}}" rel="stylesheet">
    <link href="{{asset('assets/admin/css/core/colors/palette-gradient.css')}}" rel="stylesheet">
    <link href="{{asset('assets/admin/vendors/css/tables/datatable/datatables.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/admin/fonts/simple-line-icons/style.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/admin/css/app.css')}}" rel="stylesheet">
    <link href="{{asset('assets/admin/css/bootstrap-extended.css')}}" rel="stylesheet">
    <link href="{{asset('assets/admin/css/pages/chat-application.css')}}" rel="stylesheet">
    <link href="{{asset('assets/admin/css/plugins/animate/animate.css')}}" rel="stylesheet">
    <link href="{{asset('assets/admin/css/plugins/ui/jqueryui.css')}}" rel="stylesheet">
    <link href="{{asset('assets/admin/css/bootstrap-extended.css')}}" rel="stylesheet">
    <link href="{{asset('assets/admin/css/pages/chat-application.css')}}" rel="stylesheet">
    <link href="{{asset('assets/admin/css/plugins/animate/animate.css')}}" rel="stylesheet">
    <link href="{{asset('assets/admin/css/plugins/ui/jqueryui.css')}}" rel="stylesheet">
    <link href="{{asset('assets/admin/css/plugins/ui/jqueryui.css')}}" rel="stylesheet">
    <link href="{{asset('assets/admin/vendors/css/forms/selects/selectivity-full.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/admin/css/plugins/forms/selectivity/selectivity.css')}}" rel="stylesheet">
    <link href="{{asset('assets/site/css/service.css')}}" rel="stylesheet">
    <link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css">
    <style>
        #infoTel {
            margin-top: 6px;
        }
    </style>
    @yield('style')
</head>

<body id="car-homepage">

<div class="wrapper">
    @include('site.includes.headertop')
    @include('site.includes.header')
    @include('site.includes.sidenav')
    @yield('content')
</div>
@include('sweetalert::alert')

@include('site.includes.footer')
<script src="{{asset('assets/admin/vendors/js/vendors.min.js')}}" type="text/javascript"></script>
<script src={{asset("assets/site/js/jquery.flexslider.js")}}></script>
<script src={{asset("assets/site/js/jquery.mCustomScrollbar.concat.min.js")}}></script>
<script src={{asset("assets/site/js/bootstrap-4.4.1.min.js")}}></script>
<script src={{asset("assets/site/js/custom-navigation.js")}}></script>
<script src={{asset("assets/site/js/owl.carousel.min.js")}}></script>
<script src={{asset("assets/site/js/custom-flex.js")}}></script>
<script src={{asset("assets/site/js/custom-owl.js")}}></script>

<script src={{asset("assets/admin/vendors/js/extensions/datedropper.min.js")}} type="text/javascript"></script>
<script src={{asset("assets/admin/vendors/js/extensions/timedropper.min.js")}} type="text/javascript"></script>
<script src={{asset("assets/admin/js/scripts/extensions/date-time-dropper.js")}} type="text/javascript"></script>
<script src={{asset("assets/admin/js/core/app-menu.js")}} type="text/javascript"></script>
<script src={{asset("assets/admin/js/scripts/customizer.js")}} type="text/javascript"></script>
<script src={{asset("assets/admin/js/core/app.js")}} type="text/javascript"></script>

<script src={{asset("assets/admin/vendors/js/forms/tags/form-field.js")}} type="text/javascript"></script>

<script src={{asset("assets/admin/vendors/js/animation/jquery.appear.js")}} type="text/javascript"></script>
<script src={{asset("assets/admin/js/scripts/animation/animation.js")}} type="text/javascript"></script>
<script src={{asset("assets/admin/js/core/libraries/jquery_ui/jquery-ui.min.js")}} type="text/javascript"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src={{asset("assets/admin/vendors/js/forms/spinner/jquery.bootstrap-touchspin.js")}} type="text/javascript"></script>
<script src={{asset("assets/admin/js/scripts/forms/input-groups.js")}} type="text/javascript"></script>
<script src={{asset("assets/admin/vendors/js/extensions/datedropper.min.js")}}></script>
<script src={{asset("assets/admin/vendors/js/extensions/timedropper.min.js")}}></script>
<script src={{asset("assets/admin/js/scripts/extensions/date-time-dropper.js")}}></script>

<script>
    $(document).ready(function() {
        AOS.init({
            duration: 1500,
        })
    });
</script>


@yield('script')
<!-- <script src={{asset('assets/site/js/jquery-3.3.1.min.js')}} type="text/javascript"></script> -->
<script src={{asset("assets/admin/js/core/libraries/jquery_ui/jquery-ui.min.js")}} type="text/javascript"></script>
<script src={{asset("assets/admin/vendors/js/ui/jquery-ui.min.js")}} type="text/javascript"></script>
<script src="{{asset('js/modernizr.custom.js')}}"></script>
<script src={{asset("assets/admin/vendors/js/forms/select/selectivity-full.min.js")}} type="text/javascript"></script>
<script src={{asset("assets/admin/js/scripts/forms/select/form-selectivity.js")}} type="text/javascript"></script>
<script src={{asset("assets/admin/vendors/js/forms/toggle/bootstrap-switch.min.js")}} type="text/javascript"></script>
<script src={{asset("assets/admin/vendors/js/forms/toggle/bootstrap-checkbox.min.js")}} type="text/javascript"></script>
<script src={{asset("assets/admin/vendors/js/forms/toggle/switchery.min.js")}} type="text/javascript"></script>
<script src={{asset("assets/admin/js/scripts/forms/switch.js")}} type="text/javascript"></script>
<script src={{asset("assets/admin/vendors/js/extensions/datedropper.min.js")}}></script>
<script src={{asset("assets/admin/vendors/js/extensions/timedropper.min.js")}}></script>
<script src={{asset("assets/admin/js/scripts/extensions/date-time-dropper.js")}}></script>

<script>
    $(document).ready(function() {
        $.ajax({
            url: "{{route('offre.all')}}",
            method: "get",
            success: function(data) {
                $(".arriver").autocomplete({
                    source: data.arriver,
                });
                $(".depart").autocomplete({
                    source: data.depart
                })
            },
            error: function(err, two, thre) {
                console.log(err, two, thre);
            }
        })
    });
</script>
<script>
    $("#myNavbar1 a").on('click', function() {
        $("html, body").animate({
            scrollTop: $($("#myNavbar1 a").attr('href')).offset().top()
        }, 1500);
    });
    if (window.location.hash) {
        scroll(0, 0);
        setTimeout(function() {
            scroll(0, 0);
        }, 1)
    }
    if (window.location.hash) {
        $("html, body").animate({
            scrollTop: $(window.location.hash).offset().top + "px"
        }, 1000);
    }
</script>
</body>

</html>
