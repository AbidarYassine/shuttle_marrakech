@extends('layouts.site.login')
@section('style')

<link rel="stylesheet" type="text/css" href="{{asset('css/multi-form.css')}}">


@endsection
@section('content')
<div class="container mt-2">
    <center>
        <div class="page-heading">
            <h2>Detail offre</h2>
            <hr class="heading-line" />
        </div>
    </center>
    <section>
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
        </div>
    </section>
    <section id="content-types">
        <section id="cardAnimation" class="cardAnimation">
            <div class="row match-height">

                <div class="col-xl-6 col-md-12 col-sm-12">
                    <div class="card" data-appear="appear" data-animation="fadeInLeft">
                        <div class="card-content">
                            <img style="height:200px" class="card-img-top img-fluid" src="{{$offre->imageVehicule}}" alt="Card image cap">
                            <div class="card-body">
                                <p class="text-center black font-weight-bold">{{$offre->infovehicule}}</p>
                                <h1 class="lead text-dark text-center">
                                    Categorie
                                    Véhicule:{{$offre->categorie->designation}}
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-md-12 col-sm-12">
                    <div style="height: 100%" class="card" data-appear="appear" data-animation="fadeInRight">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table style="background-color: white" class="table table-borderless text-dark">
                                    <tr>
                                        <th>Départ :</th>
                                        <td class="font-weight-bold">
                                            <select name="" id="">
                                                @foreach($tabDepart as $deaprt)
                                                <option value="{{$deaprt}}">{{$deaprt}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Arriver :</th>
                                        <td class="font-weight-bold">
                                            <select name="" id="">
                                                @foreach($tabArriver as $arriver)
                                                <option value="{{$arriver}}">{{$arriver}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Nombre de persone (max):</th>
                                        <td class="font-weight-bold">{{$offre->categorie->NbrPlaceMax}}</td>
                                    </tr>

                                    @if($offre->Categorie->NbrPlaceMax >=17)
                                    <tr>
                                        <th>Prix:</th>
                                        <td><span class="black font-weight-bold">A partit de 30 DH</span><br> <span class="black">pour plus d'informations n'hésitez pas à nous contacter</span></td>
                                    </tr>
                                    <tr>
                                        <th>Contacter Nous:</th>
                                        <td><a class="text-info" href="tel:+{{App\Models\Admin::select('phone')->first()->phone}}"><i class=" fa fa-mobile-alt mr-1"></i>{{App\Models\Admin::select('phone')->first()->phone}}</a></td>
                                    </tr>
                                    @endif
                                </table>
                            </div>
                            @if($offre->Categorie->NbrPlaceMax < 17) <div class="card-footer">
                                <button id="btn_selectionner" href="#section_paiement" class="btn btn-outline-warning btn-block mt-3">Sélectionner
                                </button>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
</div>
</section>
<section style="display: none" id="section_paiement">
    <div class="container">
        <div class="card">
            <div style="height: 50px;" class="card-header text-white bg-dark mb-1">Validation
                et Paiement
            </div>
            <div class="card-body">
                <form id="payment-form" action="{{route('offre.valider')}}" method="get">
                    @csrf
                    <div class="tab">
                        <fieldset class="form-group floating-label-form-group">
                            <input type="text" maxlength="200" type="text" required="required" class="form-control @error('name') id-invalid @enderror" id="name" name="name" value="{{\Illuminate\Support\Facades\Auth::user()->name ?? old('name')}}" placeholder="Nom d'utilisation">
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </fieldset>
                        <fieldset class="form-group floating-label-form-group">
                            <input type="email" maxlength="200" type="email" required="required" class="form-control @error('email') is-invalid @enderror" id="email" value="{{\Illuminate\Support\Facades\Auth::user()->email ?? old('email')}}" name="email" placeholder=" Email Address">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </fieldset>
                        <fieldset class="form-group floating-label-form-group mb-1">
                            <input type="text" name="telephone" required="required" class="form-control @error('telephone') is-invalid @enderror" placeholder="Telephone">
                            @error('telephone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </fieldset>
                    </div>
                    <div class="tab">
                        <div class="table-responsive">
                            <table style="background-color: white" class="table table-center table-secondary text-dark table-borderless">
                                <tr>
                                    <th>Depart :</th>
                                    <td class="font-weight-bold">{{$offre->depart}}</td>
                                </tr>
                                <tr>
                                    <th>Arriver :</th>
                                    <td class="font-weight-bold">{{$offre->arriver}}</td>
                                </tr>
                                <tr>
                                    <th>Nombre de persone (max) :</th>
                                    <td class="font-weight-bold">{{$offre->categorie->NbrPlaceMax}}</td>
                                </tr>
                                <tr>
                                    <th class="font-weight-bold">Type :</th>
                                    <td class="font-weight-bold">{{$offre->offretype->offreType}}</td>
                                </tr>
                                <tr>
                                    <th>Véhicule Choisit</th>
                                    <td class="font-weight-bold" id="veicule_choisit">{{$offre->infovehicule}}</td>
                                </tr>

                            </table>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6 col-lg-6 col-sm-12">
                                <div class="form-group">
                                    <label for="">Date Départ</label>
                                    <input type="text" class="form-control" name="date_rdv" id="lock">
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6 col-sm-12">
                                <div class="form-group">
                                    <label for="time12">Heure Départ</label>
                                    <input required type="time" name="heure" class="form-control @error('heure') is-invalid @enderror" id="time12">
                                </div>
                            </div>
                        </div>
                        <input type="hidden" id="id_offre" value="{{$offre->id}}">
                        <div class="row">
                            <h1 class="col-12 text-center black font-weight-bold">Choisit le service qui vous convient en cliquant sur l'image</h1>
                        </div>
                        <div class="row">
                            <div class="owl-carousel owl-theme owl-custom-arrow owl-car-offers">
                                @foreach($offresSimArrDepart as $index=>$offresimilaire)
                                <div class="item">
                                    <div class="main-block car-offer-block">
                                        <div style="width: 100%; height: 100%" class="card" data-appear="appear">
                                            <div class="card-content">
                                                <a data-toggle="modal" data-vehicule="{{$offresimilaire->infovehicule}}" data-soire="{{$offresimilaire->prixOffre->soiré}}" data-mise="{{$offresimilaire->prixOffre->mise_à_disposition}}" data-aller_routeur="{{$offresimilaire->prixOffre->Transfert_aller_retour}}" data-transfert="{{$offresimilaire->prixOffre->transfert_simple}}" data-id="{{$offresimilaire->id}}" data-target="#exampleModalCenter">
                                                    <img style="height: 250px" class="card-img-top  img-fluid" src="{{$offresimilaire->imageVehicule}}" alt="image véhicule">
                                                </a>
                                                <center>
                                                    <h3 classs="text-center black">{{$offresimilaire->infovehicule}}</h3>
                                                </center>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header bg-dark">
                                            <h5 class="modal-title  text-white" id="exampleModalLongTitle">Choisit Le service qui Vous Convient</h5>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <input type="radio" data-id="{{$offresimilaire->id}}" name="type" value="transfert_simple" class="switchery servType @error('type') is-invalid @enderror" checked />
                                                <label for="switchery" class="font-medium-2 black">Prix Transfert:<span id="transfert"></span><span> DH</span>
                                            </div>
                                            <div class="form-group">
                                                <input type="radio" data-id="{{$offresimilaire->id}}" name="type" value="Transfert_aller_retour" class="switchery servType transfertAllerRe @error('type') is-invalid @enderror" />
                                                <label for="switchery" class="font-medium-2 black ">Prix Aller retour:<span id="aller_retour"></span><span> DH</span>
                                            </div>
                                            <div class="form-group">
                                                <input type="radio" data-id="{{$offresimilaire->id}}" name="type" value="mise_à_disposition" class="switchery servType nbrJourRadio @error('type') is-invalid @enderror" />
                                                <label for="switchery" class="font-medium-2 black">Prix mise à disposition (Par Jour):<span id="mise"></span><span> DH</span>
                                            </div>
                                            <div class="form-group">
                                                <input type="radio" data-id="{{$offresimilaire->id}}" name="type" value="soiré" class="switchery servType @error('type') is-invalid @enderror" />
                                                <label for="switchery" class="font-medium-2 black">Prix soiré (de 22:00 à 03:00 ):<span id="soire"></span><span> DH</span>
                                            </div>
                                            <input type="hidden" id="vehicule" name="vehicule">

                                            <div class="form-group">
                                                <div id="nbrjour" style="width: 80%; display: none;" class="form-group">

                                                    <fieldset>
                                                        <div class="input-group">
                                                            <input type="text" class="touchspin-color input-lg @error('nombre_de_jour') is-invalid @enderror" value="1" placeholder="Nombre de Jour" name="nombre_de_jour" data-bts-button-down-class="btn btn-warning" data-bts-button-up-class="btn btn-warning" />
                                                        </div>
                                                    </fieldset>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div style="display: none;" id="dateRetour">
                                                    <label for="">Date Retour</label>
                                                    <input type="datetime-local" value="{{date('d/m/yy')}}" id="date_retour" class="form-control @error('date_retour') is-invalid @enderror" name="date_retour">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button id="btnenreg" type="button" class="btn btn-warning" data-dismiss="modal">Enregistre</button>
                                            <button type="button" data-dismiss="modal" class="btn btn-outline-dark">Fermer</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button id="afficehInfo" class="btn btn-outline-dark float-right mt-2">Valider
                            <span style="display: none" id="spiner" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        </button>
                    </div>
                    <div style="overflow:auto;">
                        <div style="float:right; margin-top: 5px;">
                            <button type="button" class="previous text-white mr-1 mt-1 btn btn-warning">
                                precedent
                            </button>
                            <button type="button" class="next btn mt-1 btn-outline-warning">Suivant</button>
                        </div>
                    </div>
                    <!-- Circles which indicates the steps of the form: -->
                    <div style="text-align:center;margin-top:10px;">
                        <span class="step">1</span>
                        <span class="step">2</span>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
</section>
<section id="car-offers" class="section-padding">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-12 col-lg-12 col-xl-12">
                <div class="page-heading">
                    <h2>Offres Similaire</h2>
                    <hr class="heading-line" />
                </div>
                <!-- end page-heading -->
                <div class="owl-carousel owl-theme owl-custom-arrow owl-car-offers">
                    @foreach($offres as $offresimilaire)
                    <div class="item">
                        <div class="main-block car-offer-block">
                            <div style="width: 100%; height: 100%" class="card" data-appear="appear">
                                <div class="card-conten">
                                    <img style="height: 250px" class="card-img-top  img-fluid" src="{{$offresimilaire->imageVehicule}}" alt="image véhicule">
                                    <div class="card-body">
                                        <h4 class="font-weight-lighter text-center text-warning">{{$offresimilaire->infovehicule}}</h4>
                                        <h2 class="text-center font-weight-bold">{{ucfirst($offresimilaire->depart." Vers ".ucfirst($offresimilaire->arriver))}}</h2>
                                        <a href="{{route('offre.detail',$offresimilaire->slug)}}" style="border-radius: 20px;" data-animation="tada" class="btn btn-large buttonAnimation  btn-block btn-outline-warning mt-2 mr-1 mb-1">
                                            Voir
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
</div>
<!-- Button trigger modal -->


<!-- Modal -->

@endsection

@section('script')

{{--<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.min.js"></script>--}}

@endsection
