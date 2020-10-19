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
                    <div class="card-body">
                        <h1 class="text-center">{{$offre->vehicule->marque." ".$offre->vehicule->model}}</h1>
                        <div class="row justify-content-center">
                            <img style="width: 400px;height: 400px;" src="{{$offre->vehicule->image}}"
                                 alt="Image véhicule">
                        </div>
                        <form action="{{route('offre.charge')}}" class="mt-2" method="POST">
                            @csrf
                            <div class="row">
                                <input type="hidden" name="vehicule" value="{{$offre->vehicule->id}}">
                                <input type="hidden" name="service" value="{{$offre->service}}">
                                <input type="hidden" name="offre" value="{{$offre->id}}">

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
                                            <td>{{$offre->depart}}</td>
                                        </tr>
                                        <tr>
                                            <th>Point d'arriver</th>
                                            <td>{{$offre->arriver}}</td>
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

@endsection
