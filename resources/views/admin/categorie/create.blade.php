@extends('layouts.admin.admin')

@section('content')
    <div class="row">
        <div class="col-md-10">
            <nav aria-label="breadcrumb col-md-6" style="width: 50%">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{route('admin.categories')}}">Categories</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Creation</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Ajouter une Categorie</h6>
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
                    <form class="user" action="{{route('admin.categories.store')}}" method="POST"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="designation">Designation <span class="text-danger">*</span></label>
                                    <input type="text" name="designation" required
                                           value="{{old('designation')}}"
                                           class="form-control form-control-user @error('designation') is-invalid @enderror"
                                           placeholder="Designation">
                                    @error('designation')
                                    <span class="invalid-feedback" role="alert">
                                       <strong>{{ $message }}</strong>
                                     </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="NbrPlaceMax"> Places Maximum <span
                                            class="text-danger">*</span></label>
                                    <input type="number" min="1" name="NbrPlaceMax"
                                           value="{{old('NbrPlaceMax')}}"
                                           class="form-control form-control-user @error('NbrPlaceMax') is-invalid @enderror"
                                           placeholder="Places Maximum ">
                                    @error('NbrPlaceMax')
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
                                    <label for="image">Image </label>
                                    <input type="file" name="image"
                                           value="{{old('image')}}"
                                           class="form-control @error('image') is-invalid @enderror"
                                           placeholder="Image">
                                    @error('image')
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
