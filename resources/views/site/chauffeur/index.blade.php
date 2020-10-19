@extends('layouts.site.login')
@section('title','Espace chauffeur')
@section('style')
@endsection
@section('content')
    <div class="container mt-2">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow mb-2">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Vous mission le {{date('yy-m-d')}}</h6>
                        <br>
                        <h1 class="text-center lead font-weight-bold text-warning">L'orsque vous commencer ou vous
                            terminer merci de le mentioner en cliquant sur le button
                            "J'ai commencer ou j'ai terminer" pour montrer votre disponibilité ansi pour vous afecter
                            d'autre mission.</h1>
                    </div>
                    <input type="hidden" id="chuffeur_id" value="{{session()->get('id')}}">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div id="alert_message" class="col-md-12 text-center text-white"
                                     style="display: none;height: 40px"
                                     role="alert"
                                     class="alert">
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>Depart</th>
                                    <th>L'arrive</th>
                                    <th>Heure RDV</th>
                                    @isset($user)
                                        <th>Nom Client</th>
                                        <th>Telephone</th>
                                        <th>Email</th>
                                    @endisset
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @isset($offredetail)
                                    @foreach($offredetail as $offred)
                                        <input type="hidden" id="id_detail" value="{{$offred->id}}">
                                        <tr>
                                            <td>{{$offred->offre->depart}}</td>
                                            <td>{{$offred->offre->arriver}}</td>
                                            <td>{{$offred->heure}}</td>
                                            @isset($user)
                                                <td>{{$user->name}}</td>
                                                <td>{{$user->telephone}}</td>
                                                <td>{{$user->email}}</td>
                                            @endisset
                                            <td class="d-flex justify-content-center">
                                                @if($offred->status==1)
                                                    <button id="btn_commencer" class="btn btn-sm btn-info mr-1">J'ai
                                                        Commencer
                                                    </button>
                                                @endif
                                                <button @if($offred->status!=2) disabled @endif  id="btn_terminer"
                                                        class="btn btn-sm btn-success">J'ai
                                                    Terminer
                                                </button>
                                            </td>
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
@endsection
@section('script')
    <script>
        $(document).ready(function () {
            $(document).on('click', '#btn_commencer', function (e) {
                idDetailOffre = $("#id_detail").val();
                e.preventDefault();
                $.ajax({
                    url: "{{route('chauffeur.commence')}}",
                    method: "get",
                    data: {
                        idDetailOffre
                    },
                    success: function (data) {
                        if (data.status) {
                            $("#alert_message").show('slow');
                            $("#alert_message").addClass('alert-success');
                            $("#alert_message").text(data.msg);
                            setTimeout(function () {// wait for 5 secs(2)
                                location.reload(); // then reload the page.(3)
                            }, 2100);
                        } else {
                            $("#alert_message").show('slow');
                            $("#alert_message").addClass('alert-danger');
                            $("#alert_message").text(data.msg);
                            // $("#btn_commencer").show();
                        }


                    },
                    error: function (error, two, thre) {
                        console.log(error, two, thre);
                    }

                })
            });
            $(document).on('click', '#btn_terminer', function (e) {
                idDetailOffre = $("#id_detail").val();
                chuffeurId = $("#chuffeur_id").val();
                e.preventDefault();
                $.ajax({
                    url: "{{route('chauffeur.terminer')}}",
                    method: "get",
                    data: {
                        idDetailOffre,
                        chuffeurId
                    },
                    success: function (data) {
                        if (data.status) {
                            $("#alert_message").show('slow');
                            $("#alert_message").addClass('alert-success');
                            $("#alert_message").text(data.msg);
                            setTimeout(function () {// wait for 5 secs(2)
                                location.reload(); // then reload the page.(3)
                            }, 2100);
                        } else {
                            $("#alert_message").show('slow');
                            $("#alert_message").addClass('alert-danger');
                            $("#alert_message").text(data.msg);
                        }
                    },
                    error: function (error, two, thre) {
                        console.log(error, two, thre);
                    }

                })
            })
        });
    </script>
@endsection


