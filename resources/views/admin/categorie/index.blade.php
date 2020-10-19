@extends('layouts.admin.admin')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10">
                <nav aria-label="breadcrumb col-md-6" style="width: 50%">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Categories</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow mb-2">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Tableaux de categorie</h6>
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
                            <table class="table table-bordered" id="dataTable" width="100%"
                                   cellspacing="0">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Designation</th>
                                    <th>Maximum de place</th>
                                    <th>Image</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @isset($categories)
                                    @foreach($categories as $categorie)
                                        <tr>
                                            <td>{{$categorie->id}}</td>
                                            <td>{{$categorie->designation}}</td>
                                            <td>{{$categorie->NbrPlaceMax." "." Voyageur"}}</td>
                                            <td>
                                                <img style="width: 120px;height: 80px"
                                                     src="{{$categorie->image}}"
                                                >
                                            </td>
                                            <td class="d-flex justify-content-around">
                                                <a href="{{route('admin.categories.edit',$categorie->slug)}}"
                                                   class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                                <a href="{{route('admin.categories.delete',$categorie->slug)}}"
                                                   class="btn btn-danger btn-sm delete-confirm">
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
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function () {
            $("#dataTable").dataTable();
            $('.delete-confirm').on('click', function (event) {
                event.preventDefault();
                const url = $(this).attr('href');
                if (confirm('Vous Voulez Vraiment supprimer la categorie ?')) {
                    window.location.href = url;
                }
            })
        });
    </script>
@endsection
