@extends('layouts.admin.admin')
@section('title','Offre selectioner ce jour')
@section('content')
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
                    <h6 class="m-0 font-weight-bold text-primary">Tableaux des offres selectioner</h6>
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
                    <ul class="nav nav-tabs nav-underline no-hover-bg nav-justified">
                        <li class="nav-item">
                            <a class="nav-link active" id="active-tab32" data-toggle="tab" href="#missionDem"
                               aria-controls="active32" aria-expanded="true">Les missions demandé<span
                                    class="badge badge badge-pill ml-1 badge-danger">{{count($offreDetails0)}}</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="link-tab32" data-toggle="tab" href="#missionAffecter"
                               aria-controls="link32" aria-expanded="false">Les messions affecter<span
                                    class="badge badge badge-pill ml-1 badge-info">{{count($offreDetails1)}}</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="link-tab32" data-toggle="tab" href="#missionCours"
                               aria-controls="link32" aria-expanded="false">Les messions en cours<span
                                    class="badge badge badge-pill ml-1 badge-warning">{{count($offreDetails2)}}</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="link-tab32" data-toggle="tab" href="#missionTerminer"
                               aria-controls="link32" aria-expanded="false">Les messions terminé<span
                                    class="badge badge badge-pill ml-1 badge-success">{{count($offreDetails3)}}</span></a>
                        </li>
                    </ul>
                    <div class="tab-content px-1 pt-1">
                        <div role="tabpanel" class="tab-pane active" id="missionDem" aria-labelledby="active-tab32"
                             aria-expanded="true">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Départ</th>
                                        <th>L'arrivéé</th>
                                        <th>Date</th>
                                        <th>heure</th>
                                        <th>Demande depuis</th>
                                        <th>action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @isset($offreDetails0)
                                        @foreach($offreDetails0 as $offreDetail)
                                            <tr>
                                                <td>{{$offreDetail->id}}</td>
                                                <td>{{$offreDetail->offre->depart}}</td>
                                                <td>{{$offreDetail->offre->arriver}}</td>
                                                <td>{{$offreDetail->date_rdv}}</td>
                                                <td>{{$offreDetail->heure}}</td>
                                                <td>{{\Illuminate\Support\
                                             Carbon::parse($offreDetail->created_at)->diffForHumans()}}</td>
                                                <td class="d-flex justify-content-around">
                                                    <a href="{{route('admin.offreDetail.show',$offreDetail->id)}}"
                                                       class="btn btn-success btn-sm"><i class="fas fa-eye"></i></a>
                                                    <a href="{{route('admin.offreDetail.delete',$offreDetail->id)}}"
                                                       class="delete btn btn-danger btn-delete mr-1 btn-sm">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </a>
                                                    @if($offreDetail->offre->prixoffre_id!='0')
                                                        <a data-toggle="modal" data-target="#modalChauff"
                                                           data-id="{{$offreDetail->id}}"
                                                           class="btn text-white btn-warning btn-sm mr-1">Terminé
                                                        </a>
                                                        <a href="{{route('admin.offreDetail.affecter',$offreDetail->id)}}"
                                                           class="btn btn-info mr-1 btn-sm">Affecter un chauffeur
                                                        </a>
                                                    @endif
                                                    @if($offreDetail->offre->prixoffre_id=='0')
                                                        <a class="btn text-white btn-sm btn-info" data-toggle="modal"
                                                           data-id="{{$offreDetail->offre_id}}"
                                                           data-target="#exampleModal"
                                                           class="btn btn-info btn-sm mr-1">Prix
                                                        </a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endisset
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane" id="missionAffecter" role="tabpanel" aria-labelledby="link-tab32"
                             aria-expanded="false">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Depart</th>
                                        <th>L'arrive</th>
                                        <th>Categorie</th>
                                        <th>Date</th>
                                        <th>heure</th>
                                        <th class="delai">Affecter depuis</th>
                                        <th>Chauffeur</th>
                                        <th>Telephone</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @isset($offreDetails1)
                                        @foreach($offreDetails1 as $offreDetail)
                                            <tr>
                                                <td>{{$offreDetail->id}}</td>
                                                <td>{{$offreDetail->offre->depart}}</td>
                                                <td>{{$offreDetail->offre->arriver}}</td>
                                                <td>{{$offreDetail->vehicule->categorie->designation}}</td>
                                                <td>{{$offreDetail->date_rdv}}</td>
                                                <td>{{$offreDetail->heure}}</td>
                                                <input type="hidden" class="delai_dattend" value="{{\Illuminate\Support\
                                             Carbon::parse($offreDetail->updated_at)->diffForHumans()}}">
                                                <td class="delaiPaser">{{\Illuminate\Support\
                                             Carbon::parse($offreDetail->updated_at)->diffForHumans()}}</td>
                                                <td>{{$offreDetail->chauffeur->nom." ".$offreDetail->chauffeur->prenom}}</td>
                                                <td>{{$offreDetail->chauffeur->telephone}}</td>
                                                <td>
                                                    <a href="{{route('admin.offreDetail.affecter',$offreDetail->id)}}"
                                                       class="btn btn-warning btn-sm ">Modifier le chauffeur
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endisset
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane" id="missionCours" role="tabpanel" aria-labelledby="link-tab32"
                             aria-expanded="false">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Depart</th>
                                        <th>L'arrive</th>
                                        <th>Categorie</th>
                                        <th>Date</th>
                                        <th>heure</th>
                                        <th>Chauffeur</th>
                                        <th>Telephone</th>
                                        <th>Commencer depuis</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @isset($offreDetails2)
                                        @foreach($offreDetails2 as $offreDetail)
                                            <tr>
                                                <td>{{$offreDetail->id}}</td>
                                                <td>{{$offreDetail->offre->depart}}</td>
                                                <td>{{$offreDetail->offre->arriver}}</td>
                                                <td>{{$offreDetail->vehicule->categorie->designation}}</td>
                                                <td>{{$offreDetail->date_rdv}}</td>
                                                <td>{{$offreDetail->heure}}</td>
                                                <td>{{$offreDetail->chauffeur->nom." ".$offreDetail->chauffeur->prenom}}</td>
                                                <td>{{$offreDetail->chauffeur->telephone}}</td>
                                                <td>{{\Illuminate\Support\
                                             Carbon::parse($offreDetail->updated_at)->diffForHumans()}}</td>
                                            </tr>
                                        @endforeach
                                    @endisset
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane" id="missionTerminer" role="tabpanel" aria-labelledby="link-tab32"
                             aria-expanded="false">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Depart</th>
                                        <th>L'arrive</th>
                                        <th>Categorie</th>
                                        <th>Date</th>
                                        <th>heure</th>
                                        <th>Terminer depuis</th>
                                        <th>Chauffeur</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @isset($offreDetails3)
                                        @foreach($offreDetails3 as $offreDetail)
                                            <tr>
                                                <td>{{$offreDetail->id}}</td>
                                                <td>{{$offreDetail->offre->depart}}</td>
                                                <td>{{$offreDetail->offre->arriver}}</td>
                                                <td>{{$offreDetail->vehicule->categorie->designation}}</td>
                                                <td>{{$offreDetail->date_rdv}}</td>
                                                <td>{{$offreDetail->heure}}</td>
                                                <td>{{\Illuminate\Support\
                                             Carbon::parse($offreDetail->updated_at)->diffForHumans()}}</td>
                                                @if($offreDetail->chauffeur!=null)
                                                    <td>{{$offreDetail->chauffeur->nom." ".$offreDetail->chauffeur->prenom}}</td>
                                                @endif
                                            </tr>
                                            </tr>
                                        @endforeach
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
    <!-- Button trigger modal -->
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Définit les prix</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('admin.offreDetail.prix')}}" method="get">
                    @csrf
                    <input type="hidden" name="id_offre" id="idoffre">
                    <div class="modal-body">
                        <div class="row mt-1">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="prix_transfert">Transfert</label>
                                    <input type="text" name="prix_transfert" value="{{old('prix_transfert')}}"
                                           class="form-control @error('prix_transfert') is-invalid @enderror"
                                           placeholder="Prix Transfert">
                                    @error('prix_transfert')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="prix_aller_retour">Transfert Aller Retour</label>
                                    <input type="text" name="prix_aller_retour" value="{{old('prix_aller_retour')}}"
                                           class="form-control @error('prix_aller_retour') is-invalid @enderror"
                                           placeholder="Prix Transfert Aller retour">
                                    @error('prix_aller_retour')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="prix_aller_retour">Mise à disposition</label>
                                    <input type="text" name="prix_mise_disposition"
                                           value="{{old('prix_mise_disposition')}}"
                                           class="form-control @error('prix_mise_disposition') is-invalid @enderror"
                                           placeholder="Prix par Jour">
                                    @error('prix_mise_disposition')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="soiré">Soiré</label>
                                    <input type="text" name="soiré" value="{{old('soiré')}}"
                                           class="form-control @error('soiré') is-invalid @enderror"
                                           placeholder="Prix par Jour">
                                    @error('soiré')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning square btn-min-width" data-dismiss="modal">Fermer
                        </button>
                        <button type="submit" class="btn btn-info square btn-min-width">Enregistre</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalChauff" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Affecter Chauffeur</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('admin.offreDetail.terminer')}}" method="get">
                    @csrf
                    <input type="hidden" id="offredetail_id" name="offredetail_id">
                    <div class="modal-body">
                        <select name="chauffeur" id="chauffeur" class="form-control">
                            @foreach($chauffeurs as $chauff)
                                <option value="{{$chauff->id}}">{{$chauff->nom." ".$chauff->prenom}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning square btn-min-width" data-dismiss="modal">Fermer
                        </button>
                        <button type="submit" class="btn btn-info square btn-min-width">Enregistre</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function () {
            $('#exampleModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget) // Button that triggered the modal
                var modal = $(this)
                console.log(button.data('id'));
                modal.find('#idoffre').val(button.data('id'))

            })
            $('#modalChauff').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget) // Button that triggered the modal
                var modal = $(this)
                console.log(button.data('id'));
                modal.find('#offredetail_id').val(button.data('id'));
            })
            $(".table").dataTable();


        });
    </script>
@endsection
