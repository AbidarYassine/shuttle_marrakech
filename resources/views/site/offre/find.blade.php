@extends('layouts.site.login')

@section('content')

    <div class="container">
        <section class="cardAnimation mt-2">
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
                <div class="row d-flex justify-content-center">
                    <div class="page-heading">
                        @isset($status)
                            <h2>Tout les offres </h2>
                            <hr class="heading-line"/>
                        @else
                            <h2>les offres Trouvée </h2>
                            <hr class="heading-line"/>
                        @endisset
                    </div>
                </div>
                <div class="row match-height">
                    @isset($offres)
                        @if(count($offres)>0)
                            @foreach($offres as $offre)
                                <div class="col-xl-4 col-md-6 col-sm-12 mt-2 mb-1">
                                    <div style="width: 100%; height: 100%" class="card" data-appear="appear">
                                        <div class="card-conten">
                                            <a data-id="{{$offre->vehicule->id}}" data-toggle="modal"
                                               data-place="{{$offre->vehicule->categorie->NbrPlaceMax}}"
                                               data-target="#exampleModalCenter">
                                                <img style="height: 250px" class="card-img-top  img-fluid"
                                                     src="{{$offre->vehicule->image}}" alt="image véhicule">
                                            </a>
                                            <div class="card-body text-center">
                                                <h4 class="font-weight-lighter text-center text-warning">{{$offre->vehicule->marque." ".$offre->vehicule->model}}</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="col-md-12 col-xl-12 col-sm-12">
                                <div class="card">

                                    <div class="card-body">
                                        <h1 class="lead">Vous pouvez faire votre reservation <a href="/fr/#reservation">ici</a>
                                        </h1>
                                        <div class="row">
                                            <div id="chercher_offre" class="col-md-12 mb-lg-5">
                                                <form action="{{route('offre.cherche')}}" method="get" class="mt-1">
                                                    <input type="hidden" name="_token" id="csrf-token"
                                                           value="{{ Session::token() }}"/>
                                                    @csrf
                                                    <div class="row d-flex justify-content-around mt-lg-2">
                                                        <div class="col-md-4 col-xl-3 col-lg-3 col-sm-12">
                                                            <div class="form-group mb-3">
                                                                <select name="depart" required
                                                                        class="single-select-box selectivity-input @error('depart') is-invalid @enderror"
                                                                        id="single-select-box"
                                                                        data-placeholder="Distination inconu">
                                                                    <option value="0">Point De Départ</option>
                                                                    @foreach($tabDepart as $tabDep)
                                                                        <option
                                                                            @if($request['depart']==$tabDep) selected
                                                                            @endif value="{{$tabDep}}">{{$tabDep}}</option>
                                                                    @endforeach
                                                                    @error('depart')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                     </span>
                                                                    @enderror
                                                                </select>

                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 col-xl-3 col-lg-3 col-sm-12">
                                                            <div class="form-group mb-3">
                                                                <select name="arriver" required
                                                                        class="single-select-box selectivity-input @error('arriver') is-invalid @enderror"
                                                                        id="single-select-box"
                                                                        data-placeholder="Distination inconu">
                                                                    <option value="0">Point D’arrivée</option>
                                                                    @foreach($tabArriver as $index=>$arrv)
                                                                        <option
                                                                            @if($request['arriver']==$arrv) selected
                                                                            @endif  value="{{$arrv}}">{{$arrv}}</option>
                                                                    @endforeach
                                                                    @error('depart')
                                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                  </span>
                                                                    @enderror
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4  col-xl-3 col-lg-3 col-sm-12">
                                                            <div class="form-group mb-3">
                                                                <input type="number" min="1" required name="nbrMax"
                                                                       @isset($request) value="{{$request["nbrMax"]}}"
                                                                       @endisset class="form-control input-lg"
                                                                       placeholder="Nombre de place">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-4  offset-md-4 col-sm-12">
                                                            <div class="form-group mb-3">
                                                                <button style="text-transform: capitalize" type="sybmit"
                                                                        class="btn btn-warning  btn-block square btn-min-width mr-1 mb-1">
                                                                    Chercher
                                                                    des offres
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endisset
                </div>
            </div>
        </section>
    </div>

    @include('site.includes.modalReservation')
@endsection
@section('script')
    <script>
        /* modal reservation */

        $(document).ready(function () {

            $(document).on('blur', '#date_depart', function () {
                var date = $("#date_depart").val();
                var vehicule = $("#vehicule").val();
                var depr = $("#departF").val();
                var arriverF = $("#arriverF").val();
                $.ajax({
                    url: "{{route('home.getdata')}}",
                    method: "get",
                    data: {date, vehicule, depr, arriverF},
                    success: function (data) {
                        console.log(data.data);
                        $("#date_retour").val(data.data);
                    },
                    error: function (one, two, three) {
                        // console.log(one, two, three);
                    }
                });
            });

            $(document).on('change', '#destination', function (e) {
                e.preventDefault();
                var auterDestination = $("#destination").val();
                var vehicule = $("#vehicule").val();
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
                            $("#aller_retour").text(data.prix.transfert_aller_retour);
                            $("#transfert").text(data.prix.transfert_simple);
                            $("#mise").text(data.prix.mise_à_disposition);
                            $("#soire").text(data.prix.soiré);
                            $("#ve_prix").show();
                            console.log(data.prix.mise_à_disposition);
                        },
                        error: function (one, two, three) {
                            console.log(one, two, three);
                        }
                    });
                }

            })
            $('#exampleModalCenter').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget) // Button that triggered the modal
                var modal = $(this)

                modal.find('#aller_retour').text(button.data('aller_routeur'));
                modal.find('#transfert').text(button.data('transfert'));
                modal.find('#mise').text(button.data('mise'));
                modal.find('#vehicule').val(button.data('id'));
                modal.find('#soire').text(button.data('soire'));
                var nombre_place = button.data('place');
                if (nombre_place >= 17) {
                    $("#form_reservation").hide();
                    $("#form_contact").show();
                } else {
                    $("#form_reservation").show();
                    $("#form_contact").hide();
                }
                var vehicule = $("#vehicule").val();
                var depr = $("#departF").val();
                var arriverF = $("#arriverF").val();
                $.ajax({
                    url: "{{route('home.getdata')}}",
                    method: "get",
                    data: {vehicule, depr, arriverF},
                    success: function (data) {
                        console.log(data);
                        $("#dest").val(data.offre.id);
                        $("#aller_retour").text(data.prixOffre.transfert_aller_retour);
                        $("#transfert").text(data.prixOffre.transfert_simple);
                        $("#mise").text(data.prixOffre.mise_à_disposition);
                        $("#soire").text(data.prixOffre.soiré);
                        $("#ve_prix").show();
                    },
                    error: function (one, two, three) {
                        // console.log(one, two, three);
                    }
                });
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

        });


    </script>
@endsection
