@extends('layouts.admin.admin')
@section('title','chauffeur')
@section('content')
    <div class="row">
        <div class="col-md-10">
            <nav aria-label="breadcrumb col-md-6" style="width: 50%">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{route('admin.chauffeur')}}">Chauffeur</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Creation</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Ajouter un chauffeur</h6>
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
                    <div class="row d-flex justify-content-center mb-2">
                        <img class="rounded" style="height: 220px;width: 320px" src="{{$chauffeur->image}}" alt="">
                    </div>
                    <form class="user" action="{{route('admin.chauffeur.update',$chauffeur->slug)}}" method="POST"
                          enctype="multipart/form-data"
                    >
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nom">Nom <span class="text-danger">*</span></label>
                                    <input type="text" name="nom" required
                                           value="{{$chauffeur->nom}}"
                                           class="form-control form-control-user @error('nom') is-invalid @enderror"
                                    >
                                    @error('nom')
                                    <span class="invalid-feedback" role="alert">
                                       <strong>{{ $message }}</strong>
                                     </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="prenom"> Prenom <span
                                            class="text-danger">*</span></label>
                                    <input type="text" min="1" name="prenom" required
                                           value="{{$chauffeur->prenom}}"
                                           class="form-control form-control-user @error('prenom') is-invalid @enderror"
                                    >
                                    @error('prenom')
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
                                    <label for="address">Address <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="address"
                                           value="{{$chauffeur->address}}"
                                           required
                                           class="form-control form-control-user @error('address') is-invalid @enderror"
                                    >
                                    @error('address')
                                    <span class="invalid-feedback" role="alert">
                                           <strong>{{ $message }}</strong>
                                      </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="image">Telephone </label>
                                    <input type="text" name="telephone"
                                           value="{{$chauffeur->telephone}}"
                                           required
                                           class="form-control @error('telephone') is-invalid @enderror"
                                    >
                                    @error('telephone')
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
                                    <label for="categorie_id">Choisi une Categorie <span
                                            class="text-danger">*</span></label>
                                    <select name="categorie_id"
                                            class="form-control form-control-user @error('categorie_id') is-invalid @enderror"
                                    >
                                        @isset($chauffeur->categorie)
                                            <option value="{{$chauffeur->categorie->id}}"
                                                    selected>{{$chauffeur->categorie->designation}}</option>
                                        @endisset
                                        @foreach($categories as  $categorie)
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
                                    <label for="numeroPermi">Numero Permi <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="numeroPermi"
                                           value="{{$chauffeur->numeroPermi}}"
                                           required
                                           class="form-control form-control-user @error('numeroPermi') is-invalid @enderror"
                                    >
                                    @error('numeroPermi')
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
                                    <label for="typePermi">Choisi une Type <span
                                            class="text-danger">*</span></label>
                                    <select name="typePermi" value="---"
                                            class="form-control form-control-user @error('typePermi') is-invalid @enderror"
                                    >
                                        <option value="A">A</option>
                                        <option value="B">B</option>
                                        <option value="C">C</option>
                                        <option value="C">D</option>
                                    </select>
                                    @error('categorie_id')
                                    <span class="invalid-feedback" role="alert">
                                           <strong>{{ $message }}</strong>
                                      </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mt-2">
                                <div class="form-group">
                                    <input type="file" class="form-control @error('image') is-invalid @enderror"
                                           name="image">
                                    @error('image')
                                    <span class="invalid-feedback" role="alert">
                                           <strong>{{ $message }}</strong>
                                      </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Etat</label>
                                <input type="checkbox" id="active" name="active"
                                       @if($chauffeur->active=='Active') checked @endif>
                            </div>
                        </div>
                        <div class="row float-right">
                            <button type="submit" class="btn btn-success">Modifier</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function () {
        })
    </script>
@endsection
