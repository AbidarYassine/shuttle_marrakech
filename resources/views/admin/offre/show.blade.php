@extends('layouts.admin.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-10">
            <nav aria-label="breadcrumb col-md-6" style="width: 50%">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{route('admin.offres')}}">Offres</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Modification</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Modifier L'offre</h6>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            <li><a data-action="close"><i class="ft-x"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 offset-md-3">
                        <img style="height: 300px; width: 400px;" src="{{$offre->imageVehicule}}" alt="image véhicule">
                        <h1>{{$offre->infovehicule}}</h1>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <p class=" balck font-size-large"><b>Offre Info</b></p>
                        <div class="table-responsive">
                            <table class="table text-center" id="dataTable2" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Depart</th>
                                        <th>L'arrive</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @isset($offre)
                                    <tr>
                                        <td>{{$offre->id}}</td>
                                        <td>{{$offre->depart}}</td>
                                        <td>{{$offre->arriver}}</td>
                                    </tr>
                                    @endisset
                                </tbody>
                            </table>
                        </div>

                    </div>
                    <div class="row">
                        <p class=" balck font-size-large"><b>Categorie & Paiement</b></p>
                        <div class="table-responsive">
                            <table class="table text-center" id="dataTable2" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Categorie Choisit</th>
                                        <th>Nombre de place</th>
                                        <th>Paiement</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @isset($offre)
                                    <tr>
                                        <td>{{$offre->categorie->designation}}</td>
                                        <td>{{$offre->categorie->NbrPlaceMax}}</td>
                                        <td>{{$offre->offretype->offreType}}</td>
                                    </tr>
                                    @endisset
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <p class=" balck font-size-large"><b>Prix</b></p>
                        <div class="table-responsive">
                            <table class="table  text-center" id="dataTable2" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Prix Transfert(DH)s</th>
                                        <th>Prix Aller Retour (DH)</th>
                                        <th>Paiement (DH)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @isset($offre)
                                    <tr>
                                        <td>{{$offre->prixOffre->transfert_simple}}</td>
                                        <td>{{$offre->prixOffre->Transfert_aller_retour}}</td>
                                        <td>{{$offre->prixOffre->mise_à_disposition}}</td>
                                    </tr>
                                    @endisset
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
