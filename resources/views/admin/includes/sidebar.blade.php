<div class="main-menu menu-fixed menu-light menu-accordion    menu-shadow " data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class=" nav-item"><a href="{{route('admin.dashboard')}}"><i class="fas fa-2x mr-1 fa-home"></i><span
                        class="menu-title" data-i18n="nav.dash.main">Dashboard</span></a>
            </li>
            <li class=" nav-item"><a href="#"><i class="fas  mr-1 fa-money-check-alt"></i><span class="menu-title"
                                                                                                data-i18n="nav.page_layouts.main">Mission</span><span
                        class="badge badge badge-pill badge-danger float-right mr-2">
                        {{Illuminate\Support\Facades\DB::table('offre_details')->join('offres', 'offre_details.offre_id', '=', 'offres.id')->where('date_rdv',date('yy-m-d'))->where('status',0)->count()}}
                    </span></a>
                <ul class="menu-content">
                    <li><a class="menu-item" href="{{route('admin.offreDetail')}}"
                           data-i18n="nav.page_layouts.1_column">Voir
                            les reservation</a>
                    </li>
                </ul>
            </li>
            <li class=" nav-item"><a href="#"><i class="fas  mr-1 fa-border-none"></i><span class="menu-title"
                                                                                            data-i18n="nav.page_layouts.main">Categories</span><span
                        class="badge badge badge-pill badge-danger float-right mr-2">{{\App\Models\Categorie::count()}}</span></a>
                <ul class="menu-content">
                    <li><a class="menu-item" href="{{route('admin.categories')}}" data-i18n="nav.page_layouts.1_column">Tout
                            les categorie</a>
                    </li>
                    <li><a class="menu-item" href="{{route('admin.categories.create')}}"
                           data-i18n="nav.page_layouts.2_columns">Ajouter une categorie</a>
                    </li>
                </ul>
            </li>
            <li class=" nav-item"><a href="#"><i class="fas  mr-1 fa-handshake"></i><span class="menu-title"
                                                                                          data-i18n="nav.navbars.main">Offres</span>
                    <span
                        class="badge badge badge-pill badge-primary float-right mr-2">{{\App\Models\Offre::where('active',1)->count()}}</span></a>
                <ul class="menu-content">
                    <li><a class="menu-item" href="{{route('admin.offres')}}" data-i18n="nav.navbars.nav_light">Tout les
                            offres</a>
                    </li>
                    <li><a class="menu-item" href="{{route('admin.offres.create')}}" data-i18n="nav.navbars.nav_dark">Crée
                            une offre</a>
                    </li>
                </ul>
            </li>
            <li class=" nav-item"><a href="#"><i class="fas mr-1 fa-user-tie"></i><span class="menu-title"
                                                                                        data-i18n="nav.navbars.main">Chauffeur</span>
                    <span
                        class="badge badge badge-pill badge-primary float-right mr-2">{{\App\Models\Chauffeur::where('active',1)->count()}}</span></a>
                <ul class="menu-content">
                    <li><a class="menu-item" href="{{route('admin.chauffeur')}}" data-i18n="nav.navbars.nav_light">Tout
                            les
                            Chauffeur</a>
                    </li>
                    <li><a class="menu-item" href="{{route('admin.chauffeur.demande')}}"
                           data-i18n="nav.navbars.nav_light">Tout
                            les
                            demande <span
                                class="badge badge badge-pill badge-warning float-right mr-2">{{\App\Models\Chauffeur::where('active',0)->count()}}</span></a>
                    </li>
                    <li><a class="menu-item" href="{{route('admin.chauffeur.create')}}"
                           data-i18n="nav.navbars.nav_dark">Ajouter
                            une chauffeur</a>
                    </li>
                </ul>
            </li>

            <li class=" nav-item"><a href="#"><i class="fas  mr-1 fa-car"></i><span class="menu-title"
                                                                                    data-i18n="nav.navbars.main">Véhicule</span>
                    <span
                        class="badge badge badge-pill badge-warning float-right mr-2">{{\App\Models\Vehicule::activeCauff()->count()}}</span></a>
                <ul class="menu-content">
                    <li><a class="menu-item" href="{{route('admin.vehicule')}}" data-i18n="nav.navbars.nav_light">Tout
                            les
                            Véhicules</a>
                    </li>
                    <li><a class="menu-item" href="{{route('admin.vehicule.create')}}" data-i18n="nav.navbars.nav_dark">Ajouter
                            une Véhicule</a>
                    </li>
                </ul>
            </li>
            {{-- vehicule--}}
        </ul>
    </div>
</div>
