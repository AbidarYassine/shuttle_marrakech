<div id="top-bar" class="tb-text-grey">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-6">
                <div id="info">
                    <ul id="infoTel" class="list-unstyled list-inline">
                        <li class="list-inline-item text-white"><span><i class="fab fa-whatsapp"></i></span>
                            <a class="text-white" href="https://api.whatsapp.com/send?phone={{App\Models\Admin::select('phone')->first()->phone}}">+212661216388</a>
                        </li>
                        <li class="list-inline-item text-white"><span> <span><i class="fa fa-envelope-open"></i></span></span>
                            <a class="text-white" href="#">contact@shuttlemarrakech.ma</a>

                        </li>
                    </ul>
                </div><!-- end info -->
            </div><!-- end columns -->
            <div class="col-12 col-md-6">
                <div id="links">
                    <ul class="list-unstyled list-inline">
                        @if(!\Illuminate\Support\Facades\Auth::user())
                        <li class="list-inline-item"><a href="{{route('login')}}" class="text-white"><span><i class="fa fa-lock"></i></span>Connexion</a></li>
                        <li class="list-inline-item"><a href="{{route('register')}}" class="text-white"><span><i class="fa fa-plus"></i></span>Se Connecter</a></li>
                        @else
                        <li class="list-inline-item">
                            <a href="{{ route('logout')}}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                <i class="ft-power"></i>{{Illuminate\Support\Facades\Auth::user()->name}}
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </a>
                        </li>
                        @endif
                        <li class="list-inline-item">
                            <a id="dropdown-flag10" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle nav-link"><i class="flag-icon flag-icon-fr"></i>
                                <span class="selected-language">Français</span><i class="caret"></i></a>
                            <div aria-labelledby="dropdown-flag10" id="navLang" class="dropdown-menu dropdown-menu-right">
                                <a href="#" class="dropdown-item"><i class="flag-icon flag-icon-gb"></i> Anglais</a>
                                <a href="#" class="dropdown-item"><i class="flag-icon flag-icon-es"></i> Espagnol</a>
                            </div>
                        </li>
                    </ul>
                </div><!-- end links -->
            </div><!-- end columns -->
        </div>
    </div><!-- end container -->
</div><!-- end top-bar -->
