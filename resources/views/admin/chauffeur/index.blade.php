@extends('layouts.admin.admin')
@section('title','chauffeur')
@section('content')
<div class="row">
    <div class="col-md-10">
        <nav aria-label="breadcrumb col-md-6" style="width: 50%">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Chauffeurs</li>
            </ol>
        </nav>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card shadow mb-2">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Tableaux des chauffeurs</h6>
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
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Prenom</th>
                                <th>Telephone</th>
                                <th>Adresse</th>
                                <th>Email</th>
                                <th>Etat</th>
                                <th>Numero Permi</th>
                                <th>Type de permi</th>
                                <th>Type de vhiecule</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @isset($chauffeurs)
                            @foreach($chauffeurs as $chauffeur)
                            <tr>
                                <td>{{$chauffeur->nom}}</td>
                                <td>{{$chauffeur->prenom}}</td>
                                <td>{{$chauffeur->telephone}}</td>
                                <td>{{$chauffeur->address}}</td>
                                 <td>{{$chauffeur->email}}</td>
                                <td>{{$chauffeur->active}}</td>

                                <td>{{$chauffeur->numeroPermi}}</td>
                                <td>{{$chauffeur->typePermi}}</td>
                                <td>{{(isset($chauffeur->categorie->designation)? $chauffeur->categorie->designation:"Aucun Categorie choisit")}}</td>
                                <td class="d-flex justify-content-around">
                                    <a href="{{route('admin.chauffeur.edit',$chauffeur->slug)}}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                    <a href="{{route('admin.chauffeur.delete',$chauffeur->slug)}}" class="delete-confirm btn btn-danger ml-1 btn-sm delete-confirm">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
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
@endsection
@section('script')
<script>
    $(document).ready(function() {
        $("#dataTable").dataTable();
        $('.delete-confirm').on('click', function(event) {
            event.preventDefault();
            const url = $(this).attr('href');
            if (confirm('Vous Voulez Vraiment supprimer le chauffeur ?')) {
                window.location.href = url;
            }
        })
    });
</script>
@endsection
