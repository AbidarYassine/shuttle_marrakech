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
                            <h2>Offres {{$categorie->designation}} </h2>
                            <hr class="heading-line"/>
                        @else
                            <h2>les offres Trouvée </h2>
                            <hr class="heading-line"/>
                        @endisset
                    </div>
                </div>
                <div class="row match-height">
                    @isset($vehicules)
                        @if(count($vehicules)>0)
                            @foreach($vehicules as $vehicule)
                                <div class="col-xl-4 col-md-6 col-sm-12 mt-2">
                                    <div style="width: 100%; height: 100%" class="card" data-appear="appear">
                                        <div class="card-conten">
                                            <a data-id="{{$vehicule->id}}" data-toggle="modal"
                                               data-place="{{$vehicule->categorie->NbrPlaceMax}}"
                                               data-target="#exampleModalCenter">
                                                <img style="height: 250px" class="card-img-top  img-fluid"
                                                     src="{{$vehicule->image}}" alt="image véhicule">
                                            </a>
                                            <div class="card-body text-center">
                                                <h4 class="font-weight-lighter text-center text-warning">{{$vehicule->marque." ".$vehicule->model}}</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    @endisset
                </div>
                <div class="row d-flex justify-content-center">
                    {{$vehicules->links()}}
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
                $("#dest").val('-2');
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

        });


    </script>

@endsection
