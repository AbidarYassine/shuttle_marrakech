@extends('layouts.admin.admin')

@section('content')
<div class="row">
    <div class="col-md-10">
        <nav aria-label="breadcrumb col-md-6" style="width: 50%">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Véhicule</li>
            </ol>
        </nav>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card shadow mb-2">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Tableaux des Véhicules</h6>
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
                                <th>Id</th>
                                <th>matricule</th>
                                <th>model</th>
                                <th> marque</th>
                                <th>Image</th>
                                <th>Nom chauffeur</th>
                                <th>Prenom chauffeur</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @isset($vehicules)
                            @foreach($vehicules as $vehicule)
                            <tr>
                                <td>{{$vehicule->id}}</td>
                                <td>{{$vehicule->matricule}}</td>
                                <td>{{$vehicule->model}}</td>
                                <td>{{$vehicule->marque}}</td>
                                <td><img style="width: 100px; height: 100px;" src="{{$vehicule->image}}" alt="image vehicule"></td>
                                <td>{{$vehicule->chauffeur->nom}}</td>
                                <td>{{$vehicule->chauffeur->prenom}}</td>
                                <td class="d-flex justify-content-around">
                                    <a href="{{route('admin.vehicule.edit',$vehicule->id)}}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                    <a href="{{route('admin.vehicule.delete',$vehicule->id)}}" class="btn btn-danger btn-sm delete-confirm">
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
            if (confirm('Vous Voulez Vraiment supprimer véhicule ?')) {
                window.location.href = url;
            }
        })
    });
</script>
@endsection
