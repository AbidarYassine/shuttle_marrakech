<nav class="navbar navbar-expand-xl sticky-top navbar-custom main-navbar p-1" id="mynavbar-1">
    <div class="container cardAnimation" id="cardAnimation">

        <a type="button" data-animation="tada" href="{{route('home')}}"
           class="buttonAnimation navbar-brand py-1 m-0"><span> <i id="iconCar" class="mr-1 fas fa-car"></i><span
                    id="marr">MARRAKECH</span></span>SHUTTLE</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"
                id="sidebarCollapse">
            <i class="fa fa-navicon py-1"></i>
        </button>

        <div class="collapse navbar-collapse" id="myNavbar1">
            <ul class="navbar-nav ml-auto  navbar-search-link">
                <li class="nav-item">
                    <a href="{{route('home')}}" class="page-scroll mr-1" id="navbarDropdown" role="button"
                       aria-haspopup="true" aria-expanded="false">Accueil</a>

                </li>
                <li class="nav-item">
                    <a href="/#reservation" class="page-scroll mr-1">Reservation</a>

                </li>
                <li class="nav-item">
                    <a href="/#vehicule-offre" class="page-scroll mr-1">Véhicules</a>

                </li>
                <li class="nav-item ">
                    <a href="/#service" class="page-scroll mr-1">Service</a>

                </li>
                @if(!\Illuminate\Support\Facades\Session::has('id'))
                    <li class="nav-item ">
                        <a href="{{route('chauffeur.demande')}}" class="page-scroll mr-1">Chauffeur</a>

                    </li>
                @endif
                @if(session()->has('id'))
                    <li class="nav-item dropdown">
                        <a href="#" id="navbarDropdown" class="mr-1" role="button" data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false">Chauffeur
                            <span><i class="fas fa-caret-down ml-1"></i></span>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a href="{{route('chauffeur.espace')}}" class="dropdown-item">Espace Chauffeur</a></li>
                            <li>
                                <a href="{{route('chauffeur.deconnecter')}}" class="dropdown-item">Déconnecter</a>
                            </li>

                        </ul>
                    </li>
                @endif
                <li class="nav-item">
                    <a href="/#contact" class="page-scroll mr-1">Contact
                    </a>
                </li>
                <li class="nav-item">
                </li>
            </ul>
        </div>
        <!-- end navbar collapse -->
    </div>
    <!-- End container -->
</nav>
<!-- end navbar -->
