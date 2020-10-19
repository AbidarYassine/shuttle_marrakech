@extends('layouts.admin.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-10">
            <nav aria-label="breadcrumb col-md-6" style="width: 50%">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{route('admin.vehicule')}}">Véhicules</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Creation</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-2">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Ajouter une Véhicule</h6>
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
                    <form action="{{route('admin.vehicule.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="matricule">Matricule <span class="text-danger">*</span></label>
                                    <input type="text" name="matricule" value="{{old('matricule')}}" class="form-control  @error('matricule') is-invalid @enderror">
                                    @error('matricule')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="model">Model <span class="text-danger">*</span></label>
                                    <input type="text" min="1" name="model" value="{{old('model')}}" class="form-control @error('model') is-invalid @enderror">
                                    @error('model')
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
                                    <label for="nombre_place">Choisit Categorie <span class="text-danger">*</span></label>
                                    <select name="categorie_id" id="categorie_id" class="form-control">
                                        <option value="0">---Choisit une Categorie---</option>
                                        @foreach($categories as $categorie)
                                        <option value="{{$categorie->id}}">{{$categorie->designation}}</option>
                                        @endforeach
                                    </select>
                                    @error('categorie_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nombre_valise">Nombre Valise <span class="text-danger">*</span></label>
                                    <input type="number" min="1" name="nombre_valise" value="{{old('nombre_valise')}}" class="form-control @error('nombre_valise') is-invalid @enderror">
                                    @error('nombre_valise')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        Prix
                        <hr>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="chauffeur_id">Choisi un chauffeur <span class="text-danger">*</span></label>
                                    <select name="chauffeur_id" value="---" class="form-control @error('chauffeur_id') is-invalid @enderror">
                                        <option value="0">---</option>
                                        @foreach($chauffeurs as $chauffeur)
                                        <option value="{{$chauffeur->id}}">{{$chauffeur->nom." ".$chauffeur->prenom}}</option>
                                        @endforeach
                                    </select>
                                    @error('chauffeur_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="marque">Marque </label>
                                    <input type="text" name="marque" value="{{old('marque')}}" class="form-control @error('marque') is-invalid @enderror">
                                    @error('marque')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <input required type="file" class="form-control @error('image') is-invalid @enderror" placeholder="choisit des images" name="image">
                                @error('image.*')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row float-right">
                            <button type="submit" class="btn btn-success">Enregistre</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $(document).ready(function() {

    });
</script>
@endsection
