@extends('layouts.admin.admin')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10">
                <nav aria-label="breadcrumb col-md-6" style="width: 50%">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('admin.offres')}}">Offres</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Creation</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow mb-2">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Ajouter une offre</h6>
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
                        <form action="{{route('admin.offres.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="depart">Depart <span class="text-danger">*</span></label>
                                        <input type="text" name="depart" required value="{{old('depart')}}"
                                               class="form-control  @error('depart') is-invalid @enderror"
                                               placeholder="Depart">
                                        @error('depart')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="arriver">Arriver <span class="text-danger">*</span></label>
                                        <input type="text" min="1" name="arriver" required value="{{old('arriver')}}"
                                               class="form-control @error('arriver') is-invalid @enderror"
                                               placeholder="Arriver">
                                        @error('arriver')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <select name="vehicule" class="form-control" id="vehicule">
                                        @foreach($vehicules as $ve)
                                            <option value="{{$ve->id}}">{{$ve->marque." ".$ve->model}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
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
