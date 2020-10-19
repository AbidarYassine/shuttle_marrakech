@extends('layouts.site.login')
@section('style')

@section('content')
    <div class="container mt-2">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div style="height: 50px;" class="card-header bg-dark text-white">
                        Validation
                    </div>
                    @if($offre->distination->prixoffre_id!=0)
                        <input id="prix_mise" type="hidden"
                               value="{{$offre->distination->prixOffre->mise_à_disposition}}">
                    @endif
                    <div class="card-body">
                        <h1 class="text-center">{{$offre->infovehicule}}</h1>
                        <div class="row justify-content-center">
                            <img style="width: 400px;height: 400px;" src="{{$offre->image}}" alt="Image véhicule">
                        </div>
                        <form action="{{route('offre.charge')}}" class="mt-2" method="POST">
                            @csrf
                            <div class="row">
                                <input type="hidden" name="vehicule" value="{{$offre->id}}">
                                <input type="hidden" name="service" value="{{$offre->service}}">
                                <input type="hidden" name="offre" value="{{$offre->distination->id}}">

                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <th>Nom</th>
                                            <td>
                                                <input type="text" class="form-control"
                                                       value="{{$offre->user->name}}"
                                                       name="name">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Email</th>
                                            <td>
                                                <input type="text" class="form-control"
                                                       value="{{$offre->user->email}}"
                                                       name="email">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Telephone</th>
                                            <td>
                                                <input type="text" class="form-control"
                                                       value="{{$offre->user->telephone}}" name="telephone">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Point de Départ</th>
                                            <td>{{$offre->distination->depart}}</td>
                                        </tr>
                                        <tr>
                                            <th>Point d'arriver</th>
                                            <td>{{$offre->distination->arriver}}</td>
                                        </tr>
                                        <tr>
                                            <th>
                                                Date Départ
                                            </th>
                                            <td>
                                                <input type="text" class="form-control lock"
                                                       value="{{$offre->date}}"
                                                       name="date_rdv">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Heure Départ</th>
                                            <td>
                                                <input required type="time" value="{{$offre->heure}}" name="heure"
                                                       class="form-control" id="time12">
                                            </td>
                                        </tr>

                                        <tr>
                                            <th> Service Choisit</th>
                                            <td>
                                                <input type="text" disabled class="form-control"
                                                       value="{{ucfirst(str_replace('_',' ',$offre->service))}}">
                                            </td>
                                        </tr>
                                        @if($offre->service=='transfert_simple' && $offre->distination->prixoffre_id!=0 )
                                            <tr>
                                                <th>Prix (DH)</th>
                                                <td>
                                                    <input disabled class="form-control" type="text"
                                                           value="{{$offre->distination->prixOffre->transfert_simple}}">
                                                    <input class="form-control" type="hidden" name="prix"
                                                           value="{{$offre->distination->prixOffre->transfert_simple}}">
                                                </td>
                                            </tr>
                                        @endif
                                        @isset($offre->date_ret)
                                            @if($offre->date_ret!=null && $offre->service=='Transfert_aller_retour' )
                                                <tr>
                                                    <th>Date Retour</th>
                                                    <td><input type="date" value="{{$offre->date_ret}}"
                                                               class="form-control" name="date_ret"></td>
                                                </tr>
                                                <tr>
                                                    <th>Heure Retour</th>
                                                    <td><input type="time"
                                                               value="{{$offre->heure_retour}}"
                                                               class="form-control" name="heure_retour"></td>
                                                </tr>
                                                @if($offre->distination->prixoffre_id!=0 )
                                                    <tr>
                                                        <th>Prix (DH)</th>
                                                        <td>
                                                            <input disabled class="form-control" type="text"
                                                                   value="{{$offre->distination->prixOffre->transfert_aller_retour}}">
                                                            <input class="form-control" name="prix" type="hidden"
                                                                   value="{{$offre->distination->prixOffre->transfert_aller_retour}}">
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endif
                                        @endisset
                                        @if($offre->nbrjour!=null  && $offre->service=='mise_à_disposition' )
                                            <tr>
                                                <th>Nombre de Jour</th>
                                                <td>
                                                    <fieldset>
                                                        <div class="input-group">
                                                            <input value="{{$offre->nbrjour}}" id="nbrjour"
                                                                   type="text"
                                                                   min="1" class="touchspin-color input-lg"
                                                                   placeholder="Nombre de Jour" name="nbrjour"
                                                                   data-bts-button-down-class="btn btn-warning"
                                                                   data-bts-button-up-class="btn btn-warning"/>
                                                        </div>
                                                    </fieldset>
                                                </td>
                                            </tr>
                                            @if($offre->distination->prixoffre_id!=0 )
                                                <tr>
                                                    <th>Prix Par Jour</th>
                                                    <td>{{$offre->distination->prixOffre->mise_à_disposition." DH"}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Prix Total (DH)</th>
                                                    <td>
                                                        <input type="text" class="form-control prixTotal" name="prix"
                                                               disabled
                                                               value="{{$offre->distination->prixOffre->mise_à_disposition * $offre->nbrjour}}">
                                                        <input type="hidden" class="form-control prixTotal" name="prix"

                                                               value="{{$offre->distination->prixOffre->mise_à_disposition * $offre->nbrjour}}">
                                                    </td>

                                                </tr>
                                            @endif
                                        @endif
                                        @if($offre->service=='soiré' && $offre->distination->prixoffre_id!=0)
                                            <tr>
                                                <th>Prix (DH)</th>
                                                <td>
                                                    <input disabled class="form-control" type="text"
                                                           value="{{$offre->distination->prixOffre->soiré}}">
                                                    <input class="form-control" type="hidden" name="prix"
                                                           value="{{$offre->distination->prixOffre->soiré}}">
                                                </td>
                                            </tr>
                                        @endif
                                    </table>
                                </div>
                            </div>
                            <button style="text-transform: capitalize;" type="submit"
                                    class="float-right btn btn-warning  btn-info square btn-min-width">
                                Envoyer
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function () {
            $(document).on('change', '#nbrjour', function (e) {
                e.preventDefault();
                $(".prixTotal").val($("#nbrjour").val() * $("#prix_mise").val());
            })


        });
    </script>

@endsection
