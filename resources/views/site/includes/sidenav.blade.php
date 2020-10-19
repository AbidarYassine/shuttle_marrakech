<div class="sidenav-content">
    <!-- Sidebar  -->
    <nav id="sidebar" class="sidenav">
        <h2 id="web-name"><span><i class="mr-1 fas fa-car"></i></span>Marrakech<br> shuttle</h2>

        <div id="main-menu">
            <div id="dismiss">
                <button class="btn" id="closebtn">&times;</button>
            </div>
            <div class="list-group panel">
                <a href="{{route('home')}}" class="page-scroll mr-1" id="navbarDropdown" role="button"
                   aria-haspopup="true" aria-expanded="false"></a>

                <!-- end sub-menu -->

                <a class="items-list" href="{{route('home')}}"><span>
                    <i class="fas mr-1 text-warning fa-home"></i></span>Accueil<span>
                    </span></a>

                <!-- end sub-menu -->

                <a class="items-list" href="/#reserve"><span>
                         <i class="fas text-warning mr-1 fa-concierge-bell"></i> </span>Reservation<span>
                            </span></a>
                <a class="items-list" href="/#service"><span>
                          <i class="fas text-warning mr-1 fa-cogs"></i></span>Service<span>
                            </span></a>
                @if(!\Illuminate\Support\Facades\Session::has('id'))
                    <a class="items-list" href="{{route('chauffeur.demande')}}" class="page-scroll mr-1">
                        <span>  <i class="fas text-warning mr-1 fa-user-tie"></i></span>Chauffeur</a>
                @endif
                @if(session()->has('id'))
                    <a class="items-list" href="#pages-links" data-toggle="collapse"><span>
                            <i class="fas text-warning mr-1 fa-user-tie"></i> </span>Chauffeur<span><i
                                class="fa fa-chevron-down arrow"></i></span></a>
                    <div class="collapse sub-menu" id="pages-links">
                        <a class="items-list" href="{{route('chauffeur.espace')}}">
                            <span><i class="fas text-warning mr-1 fa-user-cog"></i></span>Espace Chauffeur</a>
                        <a class="items-list" href="{{route('chauffeur.deconnecter')}}">
                            <span><i class="fas text-warning mr-1 fa-sign-out-alt"></i></span>Déconnecter</a>
                    </div>
                @endif
                <a class="items-list" href="/#contact"><span>
                         <i class="fas text-warning mr-1 fa-envelope-open"></i> </span>Contact<span>
                            </span></a>
            </div>
            <!-- End list-group panel -->
        </div>
        <!-- End main-menu -->
    </nav>
</div>
