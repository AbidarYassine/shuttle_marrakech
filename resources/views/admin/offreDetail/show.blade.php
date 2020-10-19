@extends('layouts.admin.admin')
@section('title','Offre selectioner ce jour')
@section('content')
    <div class="container mt-2">
        <div class="row">
            <div class="col-md-10">
                <nav aria-label="breadcrumb col-md-6" style="width: 50%">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('admin.offreDetail')}}">Offre Demandé</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Offres choisit le
                            <span>{{date('yy-m-d')}}</span></li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow mb-2">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Detail Demande</h6>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                <li><a data-action="close"><i class="ft-x"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 d-flex justify-content-center">
                                <img style="width: 300px; height: 300px;" src="{{$offredetail->vehicule->image}}"
                                     alt="image vehicule">
                                <h1>{{$offredetail->offre->infovehicule}}</h1>
                            </div>
                        </div>
                        <div class="row">
                            <h1 class="col-lg-6 offset-lg-4">Information Offre:</h1>
                            <table class="table table-bordered table-center">
                                <tr>
                                    <th>Id</th>
                                    <td>{{$offredetail->id}}</td>
                                </tr>
                                <tr>
                                    <th>Point de départ</th>
                                    <td>{{$offredetail->offre->depart}}</td>
                                </tr>
                                <tr>
                                    <th>Point D'arrivée</th>
                                    <td>{{$offredetail->offre->arriver}}</td>
                                </tr>
                                <tr>
                                    <th>Catégorie</th>
                                    <td>{{$offredetail->vehicule->categorie->designation}}</td>
                                </tr>
                                <tr>
                                    <th>Nombre de place</th>
                                    <td>{{$offredetail->vehicule->categorie->NbrPlaceMax}}</td>
                                </tr>
                                <tr>
                                    <th>Date</th>
                                    <td>{{$offredetail->date_rdv}}</td>
                                </tr>
                                <tr>
                                    <th>Heure</th>
                                    <td>{{$offredetail->heure}}</td>
                                </tr>
                                <tr>
                                    <th>Service Choisit</th>
                                    <td>{{$offredetail->service}}</td>
                                </tr>
                                @if($offredetail->service=='Soiré')
                                    <th>Prix</th>
                                    <td>{{$offredetail->offre->prixOffre->soiré}}</td>
                                @endif

                                @if($offredetail->offre->prixoffre_id!=0 && $offredetail->service=='Transfert simple')
                                    <tr>
                                        <th>Prix</th>
                                        <td>{{$offredetail->offre->prixOffre->transfert_simple}}</td>
                                    </tr>
                                @endif
                                @if($offredetail->nbrjour!=null)
                                    <tr>
                                        <th>Nombre De Jour</th>
                                        <td>{{$offredetail->nbrjour}}</td>

                                    <tr>
                                        <th>Prix Par Jour</th>
                                        <td>{{$offredetail->offre->prixOffre->mise_à_disposition}}</td>
                                    </tr>
                                    <tr>
                                        <th>Prix Total</th>
                                        <td>{{$offredetail->offre->prixOffre->mise_à_disposition * $offredetail->nbrjour}}
                                        </td>
                                    </tr>
                                @endif
                                @if($offredetail->date_retour!=null)
                                    <tr>
                                        <th>Date Retour</th>
                                        <td>{{$offredetail->date_retour}}</td>
                                    </tr>
                                    <tr>
                                        <th>Heure</th>
                                        <td>{{$offredetail->heure_retour}}</td>
                                    </tr>
                                    <tr>
                                        <th>Prix</th>
                                        <td>{{$offredetail->offre->prixOffre->transfert_aller_retour}}</td>
                                    </tr>
                                @endif
                                <tr>
                                    <th>Demande Depuis</th>
                                    <td>{{\Illuminate\Support\Carbon::parse($offredetail->created_at)->diffForHumans()}}</td>
                                </tr>
                            </table>
                            <h1 class="col-lg-6 offset-lg-4">Information Client:</h1>
                            <table class="table table-bordered table-center">
                                <tr>
                                    <th>Nom</th>
                                    <td>{{$user[0]->name}}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>{{$user[0]->email}}</td>
                                </tr>
                                <tr>
                                    <th>Telephone</th>
                                    <td>{{$user[0]->telephone}}</td>
                                </tr>
                                <tr>
                                    <th>Appele</th>
                                    <td><a class="black font-size-large"
                                           href="tel:+{{$user[0]->telephone}}">{{$user[0]->telephone}}</a>
                                    </td>
                                </tr>
                                <tr>
                                    <th>WhatsApp</th>
                                    <td><a class="black font-size-large"
                                           href="https://api.whatsapp.com/send?phone={{$user[0]->telephone}}">{{$user[0]->telephone}}</a>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
