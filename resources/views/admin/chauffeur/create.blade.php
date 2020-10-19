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
                    <form class="user" action="{{route('admin.chauffeur.store')}}" method="POST"
                          enctype="multipart/form-data"
                    >
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nom">Nom <span class="text-danger">*</span></label>
                                    <input type="text" name="nom" required
                                           value="{{old('nom')}}"
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
                                           value="{{old('prenom')}}"
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
                                           value="{{old('address')}}"
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
                                    <label for="image">Telephone <span
                                            class="text-danger">*</span> </label>
                                    <input type="text" name="telephone"
                                           value="{{old('telephone')}}"
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
                                    <select name="id" value="---"
                                            class="form-control form-control-user @error('id') is-invalid @enderror"
                                    >
                                        <option value="0">---</option>
                                        @foreach($categories as  $categorie)
                                            <option value="{{$categorie->id}}">{{$categorie->designation}}</option>
                                        @endforeach
                                    </select>
                                    @error('id')
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
                                           value="{{old('numeroPermi')}}"
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
                        <p class="lead">Autorisation au chaffeur d'acceder a l'espace chauffeur</p>
                        <hr>
                        <div class="row mt-1" id="info_user">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Email Chauffeur</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                           value="{{old('email')}}" name="email">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                           <strong>{{ $message }}</strong>
                                      </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password">Mot de pass</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                           name="password">
                                    @error('password')
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
@endsection
@section('script')
    <script>
        $(document).ready(function () {


        })
    </script>
@endsection
