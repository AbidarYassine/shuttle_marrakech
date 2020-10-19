@extends('layouts.site.site')
@section('style')

    <style>
        .titre {
            width: 100%;
            height: 80px;
            padding-top: 28px;
            margin-top: 10px;
        }

        .titre1 {
            width: 100%;
            height: 650px;
            padding-top: 28px;
            margin-top: 10px;
        }

        .ecomDiv {
            width: 100%;
            height: 400px;
            background: linear-gradient(to bottom, #ff9800, #fff176);
            /*linear-gradient(to bottom, #ff9800, #fff176);*/
        }

        .circle {
            height: 100px;
            width: 100px;
            border-radius: 50px;
            background-color: white;
        }


        .back {
            /* background-image: url('https://mdbootstrap.com/img/Photos/Others/architecture.jpg'); */
            /* imagebac */
            background-image: url("{{asset('images/bg-white.png')}}");
            background-attachment: fixed;
            background-size: 100% 300px;
            opacity: 1;
            min-height: 300px;
            background-repeat: no-repeat;
        }

        @media (max-width: 765px) {
            .ecomDiv {
                height: 780px;
            }
        }
    </style>
    {{-- <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>--}}
    <link href="{{asset('assets/admin/vendors/css/forms/toggle/switchery.min.css')}}" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans+Condensed:ital,wght@0,300;0,700;1,300&family=Source+Sans+Pro:ital,wght@0,200;0,300;0,400;0,600;0,900;1,200;1,300;1,400;1,600;1,700&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: 'Open Sans Condensed', sans-serif;
            font-family: 'Source Sans Pro', sans-serif;
        }

        @media (max-width: 800px) {
            .reserveDiv {
                height: 850px;
            }

            .titrreserve {
                margin-bottom: 20px;
            }
        }

        @media (max-width: 830px) {
            .titrreserve {
                margin-bottom: 20px;
            }
        }

        @media (max-width: 320px) {
            #marr {
                display: none;
            }

        }
    </style>
@endsection
@section('content')
    <div class="ecomDiv">
        <div class="container">
            <center>
                <div class="pt-2">
                    <div class="row">
                        <div class="col-xl-6 col-md-6 col-sm-12 mt-1" data-appear="appear" data-animation="zoomInLeft">
                            <h2 data-aos="fade-down" data-aos-duration="800">Rapide & Sécurisé</h2>
                            <div data-aos="fade-right" class="circle">
                                <i style="margin-top: 25px" class="fas text-info fa-3x fa-tachometer-alt"></i>
                            </div>
                            <p class="text-white font-weight-bold">Votre chauffeur en moins de 15 mn</p>
                        </div>
                        <div class="col-xl-6 col-md-6 col-sm-12 mt-1">
                            <h2 data-aos="fade-down" data-aos-duration="800">Meilleurs prix</h2>
                            <div data-aos="fade-right" class="circle mt-auto">
                                <i style="margin-top: 25px" class="far text-info fa-3x fa-thumbs-up"></i>
                            </div>
                            <p class="text-white font-weight-bold">Tarifs Exceptionnels Tout Direction National</p>
                        </div>
                    </div>
                    <div class="row d-flex">
                        <div class="col-xl-6 col-md-6 col-sm-12 mt-1">
                            <h2 data-aos="fade-up" data-aos-duration="800">Service Taxi</h2>
                            <div data-aos="fade-left" class="circle mt-auto">
                                <i style="margin-top: 25px" class="fas fa-3x text-info fa-car"></i>
                            </div>
                            <p class="text-white font-weight-bold">Commandez ou reservez votre véhicule au départ de
                                Tarifs
                                exceptionnels,
                                véhicules confortables. </p>
                        </div>
                        <div class="col-xl-6 col-md-6 col-sm-12 mt-1">
                            <h2 data-aos="fade-up" data-aos-duration="800">Taxi</h2>
                            <div data-aos="fade-left" class="circle mt-auto">
                                <i style="margin-top: 25px" class="fas fa-3x text-info fa-euro-sign"></i>
                            </div>
                            <p class="text-white font-weight-bold">Trajet sans surprise</p>
                        </div>
                    </div>
                </div>

            </center>
        </div>
    </div>
    <section id="car-offers" class="section-padding black">
        <div class="container">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="page-heading">
                        <h2>Categorie Véhicule</h2>
                        <hr class="heading-line"/>
                        <p style="border-radius: 25px; width: 100%;" class="mt-1 p-2 bg-white text-dark">
                            Nous mettons à votre disposition une large flotte de Véhicules comme neuve ( voitures de
                            luxes , van vip , minibus et autocars ) accompagné par des
                            chauffeurs professionnels ,sourient , bilingues et ponctuels.
                        </p>
                    </div>
                    <!-- end page-heading -->

                    <div class="owl-carousel owl-theme owl-custom-arrow owl-car-offers">
                        @isset($categories)
                            @foreach($categories as $index=>$categorie)
                                <div class="item">
                                    <div class="main-block car-offer-block">
                                        <div class="main-img car-offer-img">
                                            <a href="{{route('offre.categorie',$categorie->slug)}}">
                                                <img style="height: 300px; width: 550px;" src="{{$categorie->image}}"
                                                     class="img-fluid" alt="images Categorie vehicule"/>
                                            </a>
                                        </div>
                                        <!-- end car-offer-img -->

                                        <div class="car-offer-info">
                                            <ul class="list-unstyled">
                                                <li style="height: 40px;">
                                                    <a href="#">
                                                        <h4 style="text-transform: capitalize;">{{($categorie->designation)}}</h4>
                                                    </a><span class="car-offer-price">{{$categorie->NbrPlaceMax}}<span
                                                            class="limit"><span class="divider">|</span>Places</span>
                                        </span>
                                                </li>
                                            </ul>
                                        </div>
                                        <!-- end car-offer-info -->
                                    </div>
                                    <!-- end car-offer-block -->
                                </div>
                        @endforeach
                    @endisset
                    <!-- end item -->
                    </div>

                </div>
                <!-- end columns -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </section>
    <div id="reserve">
        <div class="page-heading">
            <h2>Reservation</h2>
            <hr class="heading-line"/>

            <p style="border-radius: 30px; width: 75%;" class="mt-1 bg-white text-dark p-2">
                Une simple click et <span class="text-warning">20 minutes avant votre départ</span> , <b>“Marrakech
                    shuttle ”</b> s'engage à vous assurez un service de hautes qualités de navettes et transport tout
                direction au Maroc 24h/24h et 7j/7j .
                (van , minibus ,autocar) et des voitures VIP (4x4 et voitures berlines Luxe) Accompagné par des
                chauffeurs de qualité Morale et intellectuelle , qui donnerons un charme de stabilité et Sécurité durant
                le trajet .
                La propreté et l’entretien de nos véhicules est indispensable.
            </p>
        </div>
    </div>
    <div class="titre1 reserveDiv" style="background-color:black">
        <span class="text-white d-flex justify-content-center titrreserve font-weight-bold">Réservez votre chauffeur en deux minutes</span>
        <section class="basic-selectivity mt-lg-2">
            <div class="container">
                <form action="{{route('offre.valider2')}}" method="get">
                    @csrf
                    <div id="reservation" class="row">
                        <div class="col-xl-4 col-md-4 col-sm-12">
                            <fieldset class="form-group">
                                <select name="depart" required
                                        class="single-select-box selectivity-input @error('depart') is-invalid @enderror"
                                        id="single-select-box" data-placeholder="Distination inconu">
                                    <option value="1">---Choisit Départ---</option>
                                    @foreach($tabDepart as $tabDep)
                                        <option value="{{$tabDep}}">{{$tabDep}}</option>
                                    @endforeach
                                </select>
                                @error('depart')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </fieldset>
                        </div>
                        <div class="col-xl-4 col-md-4 col-sm-12">

                            <fieldset class="form-group">
                                <select type="text" name="arriver" required value="{{old('arriver')}}"
                                        class="single-select-box selectivity-input @error('arriver') is-invalid @enderror"
                                        id="single-select-box" placeholder="Arrivée">
                                    @foreach($tabArriver as $index=>$arrv)
                                        <option
                                            value="{{$arrv}}">{{$arrv}}</option>
                                    @endforeach
                                </select>
                                @error('arriver')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </fieldset>
                        </div>
                        <div class="col-xl-4 col-md-4 col-sm-12">
                            <fieldset class="form-group">
                                <select
                                    class=" categorie_v form-control  @error('id') is-invalid @enderror"
                                    id="single-select-box" name="id">
                                    <option>---Choisit Catégorie---</option>
                                    @isset($categories)
                                        @foreach($categories as $categorie)
                                            <option
                                                value="{{$categorie->id}}">{{$categorie->designation." ".$categorie->NbrPlaceMax." Places (max)"}}</option>
                                        @endforeach
                                    @endisset
                                </select>
                                @error('id')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </fieldset>
                        </div>
                    </div>
                    <div class="row d-flex justify-content-center">
                        <div class="col-md-6">
                            <div class="form-group">
                                <select style="display: none" name="vehicule" id="vehicule"
                                        class="form-control">
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <select name="service_choisit" style="display: none" class="form-control"
                                        id="service_ch">
                                    <option value="">---service---</option>
                                    <option value="Transfert_aller_retour">Transfert aller retour</option>
                                    <option value="transfert_simple">Transfert Simple</option>
                                    <option value="mise_à_disposition">Mise à disposition</option>
                                    <option value="soiré">Soiré</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div id="retour_div" style="width: 60%;margin: auto;display: none" class="row mt-lg-2">
                        <div class="col-xl-6 col-md-6 col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label class="text-white">Date Retour</label>
                                <input type="text" placeholder="Date Retour" required
                                       class="form-control lock input-sm @error('date_retour') is-invalid @enderror"
                                       name="date_ret" value="{{date('m/d/yy')}}">
                                @error('date_retour')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-xl-6 col-md-6 col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label class="text-white" for="heure">Heur Retour</label>
                                <input required type="time" name="heurer" value="00:00"
                                       placeholder="Heure Retour"
                                       class="form-control input-sm @error('heurer') is-invalid @enderror">
                                @error('heurer')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div id="mise_adisp_div" style="width: 80%;margin: auto;display: none" class="row">
                        <div class="col-12">
                            <div class="form-group justify-content-around">
                                <label class="text-white">Nombre Jour</label>
                                <input min="1" value="1" type="number" required
                                       class="form-control lock input-sm @error('nbrjour') is-invalid @enderror"
                                       name="nbrjour" value="{{old('nbrjour')}}">
                                @error('date_rdv')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div style="width: 80%;margin: auto" class="row mt-lg-1">
                        <div class="col-xl-4 col-md-4 col-sm-12">
                            <fieldset class="form-group">
                                <input type="text" name="name"
                                       value="{{\Illuminate\Support\Facades\Auth::user()->name ?? old('name')}}"
                                       required class="form-control input-lg @error('name') is-invalid @enderror"
                                       placeholder="Nom">
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                     <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </fieldset>
                        </div>
                        <div class="col-xl-4 col-md-4 col-sm-12">
                            <fieldset class="form-group position-relative has-icon-left">
                                <input type="email" name="email"
                                       value="{{\Illuminate\Support\Facades\Auth::user()->email ?? old('email')}}"
                                       required class="form-control input-lg @error('email') is-invalid @enderror"
                                       id="iconLeft" placeholder="Email">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                                <div class="form-control-position">
                                    <i class="fas fa-envelope-square"></i>
                                </div>
                            </fieldset>
                        </div>
                        <div class="col-xl-4 col-md-4 col-sm-12">
                            <fieldset class="form-group position-relative has-icon-left">
                                <input type="text" name="telephone"
                                       value="{{\Illuminate\Support\Facades\Auth::user()->telephone ?? old('telephone')}}"
                                       required
                                       class="form-control input-lg @error('telephone') is-invalid @enderror"
                                       id="iconLeft" placeholder="Telephone">
                                @error('telephone')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                                <div class="form-control-position">
                                    <i class="fas fa-phone"></i>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                    <div style="width: 60%;margin: auto" class="row mt-lg-2">
                        <div class="col-xl-6 col-md-6 col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label class="text-white">Date Départ</label>
                                <input type="text" placeholder="Date Départ" required
                                       class="form-control lock input-lg @error('date_rdv') is-invalid @enderror"
                                       name="date_rdv" value="{{old('date_rdv')}}">
                                @error('date_rdv')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-xl-6 col-md-6 col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label class="text-white" for="heure">Heur Départ</label>
                                <input required type="time" name="heure" value="{{old('heure')}}"
                                       placeholder="Heure Départ"
                                       class="form-control input-lg @error('heure') is-invalid @enderror" id="time12">
                                @error('heure')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row d-flex justify-content-center mt-lg-3">
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-warning btn-block">Envoyer</button>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>
    <div id="fixe" class="back  d-flex justify-content-center">
        <div class="row">
            <div class="container">
                <div class="col-12 text-center">
                    <h2 class="mt-4 font-weight-bold text-center black"> Marrakech shuttle
                        Bienvenue au Maroc</h2>
                    <p class="text-warning font-weight-bold mt-3 font-size-large">
                        Grâce à nos chauffeurs responsables qui admirent leur travail , en respectent leurs horaires ,
                        Nous mettons à votre services des prestations de haut qualité ,
                        tout direction au niveau national et à n’importe quelle moment dans les 24h<br>
                    </p>
                    <h2 class="black font-weight-bold font-size-large">Bienvenue</h2>
                </div>
            </div>
        </div>
    </div>
    <div id="vehicule-offre">
        <section class="cardAnimation mt-2">
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="page-heading">
                        <h2>Nos Véhicules </h2>
                        <hr class="heading-line"/>
                    </div>
                </div>
                <div class="row match-height">
                    <div class="owl-carousel owl-theme owl-custom-arrow owl-car-offers">
                        @isset($vehicules)
                            @foreach($vehicules as $index=>$vehicule)
                                <div class="item">
                                    <div class="main-block car-offer-block">
                                        <div class="main-img car-offer-img">
                                            <a data-id="{{$vehicule->id}}" data-toggle="modal"
                                               data-place="{{$vehicule->categorie->NbrPlaceMax}}"
                                               data-target="#exampleModalCenter">
                                                <img style="height: 300px; width: 550px;" src="{{$vehicule->image}}"
                                                     class="img-fluid" alt="images Categorie vehicule"/>
                                            </a>
                                        </div>
                                        <!-- end car-offer-img -->
                                        <div class="car-offer-info">
                                            <ul class="list-unstyled">
                                                <li style="height: 40px;">
                                                    <a href="#">
                                                        <h4 style="text-transform: capitalize;">{{ucfirst($vehicule->marque." ".$vehicule->model)}}</h4>
                                                    </a><span
                                                        class="car-offer-price">{{$vehicule->categorie->NbrPlaceMax}}<span
                                                            class="limit"><span class="divider">|</span>Places</span>
                                    </span>
                                                </li>
                                            </ul>
                                        </div>
                                        <!-- end car-offer-info -->
                                    </div>
                                    <!-- end car-offer-block -->
                                </div>
                        @endforeach
                    @endisset
                    <!-- end item -->
                    </div>
                </div>
            </div>
        </section>
    </div>

    <div class="titre mt-lg-3 bg-warning">
        <div class="text-center font-weight-bold text-white">
            A propos
        </div>
    </div>
    <div class="black d-flex justify-content-center">
        <div class="row">
            <div class="container">
                <div class="col-12 text-center">
                    <h2 class="mt-4 black font-weight-bold text-center"> Marrakech shuttle
                        Bienvenue au Maroc</h2>
                    <p class="black font-size-large mt-3">
                        Heureux de mettre à votre Disposition une large Gamme de véhicules, et vous facilitez les
                        services de Navettes et transports durant votre séjour.

                        Grace à notre Expérience en services de transport touristique et en Transport de personnel au
                        niveau National , nous avons le plaisir de vous accueillir résident ou touriste, de votre
                        arrivée a votre départ au Maroc 24/24H et 7/7j .

                        Avec notre flottes de véhicules
                        <mark>(van, minibus et Bus) des voitures de Luxe (Mercedes, Range Rover et Bentley),</mark>
                        et nos chauffeurs professionnel bilingue sont à votre entière disposition, pour vous assurez les
                        services de navettes et transferts que ça soit : Aéroport, Golf, centre ville , shopping et
                        transport tout direction sur le territoire National , et a n’importe quel heur .

                        La ponctualité est le résultat de notre expérience.
                    </p>
                </div>
            </div>
        </div>
    </div>
    {{--// begin contact --}}

    {{-- end contact--}}
    <div id="service" class="titre mt-lg-3 bg-dark">
        <div class="text-center font-weight-bold text-white">
            Nos Services
        </div>
    </div>
    <section id="serviceDiv" class="col-12 d-flex  justify-content-center">

        <section id="best-features" class="banner-padding lightgrey-features">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 col-lg-3 col-sm-12">
                        <div class="b-feature-block">
                            <span><i class="fa fa-car"></i></span>
                            <h3>Location de
                                Voiture</h3>
                            <p class="text-center mt-2">De grandes offres pour les locations de voitures,
                                journaliers, en semaine, ou de longue durée.
                                Trouver les meilleurs tarifs en ligne, pour votre prochaine Location de Voiture.
                                Réservez maintenant à de tarifs bas et économisez!</p>
                        </div>
                        <!-- end b-feature-block -->
                    </div>
                    <!-- end columns -->

                    <div class="col-md-3 col-lg-3 col-sm-12">
                        <div class="b-feature-block">
                            <span><i class="fa fa-user-tie"></i></span>
                            <h3>Chauffeur Privé</h3>
                            <p>Service de chauffeur privé pour accueil VIP
                                Accueil VIP
                                Discrétion et confidentialité garanties
                                Grand confort
                                Prise en charge de vos clients
                                Véhicules haut de gamme</p>
                        </div>
                        <!-- end b-feature-block -->
                    </div>
                    <div class="col-md-3 col-lg-3 col-sm-12">
                        <div class="b-feature-block">
                            <span><i class="fa fa-car"></i></span>
                            <h3>Service Taxi
                            </h3>
                            <p class="text-center mt-2">Nos Chauffeurs se déplacent pour venir vous chercher ou vous
                                conduire à destination.
                                (Tout direction au niveaux du maroc)
                                Nos chauffeurs professionnels se déplacent pour votre plus grand confort,
                                quelle que soit votre destination.!</p>
                        </div>
                        <!-- end b-feature-block -->
                    </div>
                    <!-- end columns -->

                    <div class="col-md-3 col-lg-3 col-sm-12">
                        <div class="b-feature-block">
                            <span><i class="fa fa-calendar-check"></i></span>
                            <h3>Transport D'événements
                            </h3>
                            <p>
                                Vous organiser un événement professionnel ? Votre agence suttleMarrrakech Seine s’occupe
                                de vos transports notamment dans tout es villes du maroc.
                            </p>
                        </div>
                        <!-- end b-feature-block -->
                    </div>
                    <!-- end columns -->
                    <!-- end columns -->
                    <!-- end columns -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </section>
    </section>
    {{-- end section service --}}
    <div id="contact" class="titre bg-warning">
        <div class="text-center font-weight-bold text-white">
            Ecrivez nous votre Message!
        </div>
    </div>
    <section id="contactDiv">
        <div class="container">
            <center>
                <h1 class="pt-3">Nous nous engageons à vous répondre rapidement</h1>
            </center>
            <form class="mt-lg-5" action="{{route('contact')}}" method="POST">
                @csrf
                <div class="row mt-1">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" required placeholder="Nom Prenom" name="nom"
                                   class="form-control @error('nom') is-invalid @enderror">
                            @error('nom')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="email" name="email" required name="Email" placeholder="Email"
                                   class="form-control @error('email') is-invalid @enderror">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row mt-1">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" required placeholder="Telephone" name="telephone"
                                   class="form-control @error('telephone') is-invalid @enderror">
                            @error('telephone')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" name="prestation" required placeholder="Type Prestation"
                                   class="form-control @error('prestation') is-invalid @enderror">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row mt-1">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" placeholder="Date de prestations" required
                                   class="form-control lock  @error('date_prestation') is-invalid @enderror"
                                   name="date_prestation" value="{{old('date_prestation')}}">
                            @error('date_prestation')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="number" min="1" id="nombre_persone" name="nombre_persone" required
                                   placeholder="Nombre De Personnes"
                                   class="form-control @error('nombre_persone') is-invalid @enderror">
                            @error('nombre_persone')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <textarea required name="subject" placeholder="Message"
                                      class="form-control col-md-12 @error('nom') is-invalid @enderror" id="subject"
                                      rows="10"></textarea>
                            @error('subject')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row d-flex justify-content-center">
                    <div class="col-md6">
                        <button type="submit" class="btn btn-glow btn-block btn-outline-info mb-2">Envoyer</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <!-- Button trigger modal -->


    <!-- Modal -->
    @include('site.includes.modalReservation')
@endsection
@section('script')
    <script>
        /* modal reservation */

        $(document).ready(function () {
            $(document).on('blur', '#date_depart', function () {
                var date = $("#date_depart").val();
                alert(date)
                $.ajax({
                    url: "{{route('home.getdata')}}",
                    method: "get",
                    data: {'date': date},
                    success: function (data) {
                        console.log(data);
                        $("#date_retour").val(data.data);
                    },
                    error: function (one, two, three) {
                        // console.log(one, two, three);
                    }
                });
            })

            $(document).on('change', '#service_ch', function () {
                selectVal = $("#service_ch").val();
                if (selectVal == "Transfert_aller_retour") {
                    $("#retour_div").show();
                    $("#mise_adisp_div").hide();
                } else if (selectVal == "mise_à_disposition") {
                    $("#mise_adisp_div").show();
                    $("#retour_div").hide();
                } else {
                    $("#retour_div").hide();
                    $("#mise_adisp_div").hide();
                }

            });

            $(document).on('change', '.categorie_v', function () {
                var id_cate = $(".categorie_v").val();
                $.ajax({
                    url: "{{route('home.getVehicule')}}",
                    method: "get",
                    data: {
                        "id_cate": id_cate,
                    },
                    success: function (data) {
                        $("#vehicule option").remove();
                        $("#vehicule").show();
                        $("#service_ch").show();
                        data.vehicule.forEach(function (item, index) {
                            var op = $("<option>" + item.marque + " " + item.model + "</option>")
                            $("#vehicule").append(op);
                            op.attr('value', item.id);
                        });
                    },
                    error: function (one, two, three) {
                        console.log(one, two, three);
                    }
                });
            });
            $('#exampleModalCenter').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget) // Button that triggered the modal
                var modal = $(this)

                modal.find('#aller_retour').text(button.data('aller_routeur'));
                modal.find('#transfert').text(button.data('transfert'));
                modal.find('#mise').text(button.data('mise'));
                modal.find('#vehicule').val(button.data('id'));
                modal.find('#soire').text(button.data('soire'));
                var nombre_place = button.data('place');
                $("#nombre_persone").val(nombre_place);
                if (nombre_place >= 17) {
                    $("#form_reservation").hide();
                    $("#form_contact").show();
                } else {
                    $("#form_reservation").show();
                    $("#form_contact").hide();
                }
                modal.find('#nbrPlace').val(button.data('place'));
                var id_ve = button.data('id');
                $.ajax({
                    url: "{{route('offre.destination')}}",
                    method: "get",
                    data: {
                        "id_ve": id_ve,
                    },
                    success: function (data) {
                        $('#destination option').remove();
                        $("#destination").append('<option value="-3">---Destination---</option>');
                        data.offres.forEach(function (item, index) {
                            var op = $("<option>" + item.depart + " " + item.arriver + "</option>")
                            $("#destination").append(op);
                            op.attr('value', item.id);
                        });
                        $("#destination").append('<option value="-2">Autre</option>');
                    },
                    error: function (one, two, three) {
                        // console.log(one, two, three);
                    }
                });

            })
            $(document).on('change', '#destination', function (e) {
                e.preventDefault();
                var auterDestination = $("#destination").val();
                var vehicule = $(".vehicule").val();
                console.log(vehicule);
                if (auterDestination == "-3") {
                    $("#btn_valider").hide();
                    $("#ve_prix").hide();
                } else {
                    $("#btn_valider").show();
                    $("#ve_prix").show();
                }
                if (auterDestination == '-2') {
                    $("#form_reservation").append('<input type="hidden" value="1" id="autre_dest" name="autre_dest">');
                    $("#btn_valider").show();
                    $("#divDest").show();
                    $("#ve_prix").hide();
                } else {
                    $("#autre_dest").remove();
                    $("#btn_valider").show();
                    $("#divDest").hide();
                    $.ajax({
                        url: "{{route('home.getPrix')}}",
                        method: "get",
                        data: {
                            "auterDestination": auterDestination,
                            'vehicule': vehicule
                        },
                        success: function (data) {
                            if (data.status) {
                                $("#aller_retour").text(data.prix.transfert_aller_retour);
                                $("#transfert").text(data.prix.transfert_simple);
                                $("#mise").text(data.prix.mise_à_disposition);
                                $("#soire").text(data.prix.soiré);
                                $("#ve_prix").show();
                            }

                        },
                        error: function (one, two, three) {
                            console.log(one, two, three);
                        }
                    });
                }

            })
            $('.servType').change(function (e) {
                if ($(".nbrJourRadio").is(":checked")) {
                    $("#nbrjour").show();
                } else {
                    $("#nbrjour").hide();
                }
                if ($(".transfertAllerRe").is(":checked")) {
                    $("#dateRetour").show();
                    $("#form_reservation").append('<input type="hidden" value="1" id="id_date_retour" name="id_date_retour">');
                } else {
                    $("#id_date_retour").remove();
                    $("#dateRetour").hide();
                }

            });


            $(document).on('change', '#service_chois', function (e) {
                e.preventDefault();
                selectVal = $("#service_chois").val();
                if (selectVal == "Transfert_aller_retour") {
                    $("#retour_div").show();
                    $("#mise_adisp_div").hide();
                } else if (selectVal == "mise_à_disposition") {
                    $("#mise_adisp_div").show();
                    $("#retour_div").hide();
                } else {
                    $("#retour_div").hide();
                    $("#mise_adisp_div").hide();
                }

            });
            $(document).on('change', '#service_choi', function (e) {
                e.preventDefault();

                selectVal = $("#service_choi").val();
                if (selectVal == "Transfert_aller_retour") {
                    $("#retour_divh").show();
                    $("#mise_adisp_divh").hide();
                } else if (selectVal == "mise_à_disposition") {
                    $("#mise_adisp_divh").show();
                    $("#retour_divh").hide();
                } else {
                    $("#retour_divh").hide();
                    $("#mise_adisp_divh").hide();
                }

            });

        })
        ;

    </script>
    {{--    <script src="{{asset('/assets/site/js/reservation.js')}}}" type="text/javascript"></script>--}}
    {{--    <script src={{asset("assets/admin/js/scripts/extensions/date-time-dropper.js")}}></script>--}}
@endsection
