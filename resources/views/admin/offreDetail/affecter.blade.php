@extends('layouts.admin.admin')
@section('title','Affectation')
@section('style')
    <link href="{{asset('assets/admin/css/pages/users.css')}}"
          rel="stylesheet">
@endsection
@section('content')
    <div class="row">
        <div class="col-md-10">
            <nav aria-label="breadcrumb col-md-6" style="width: 50%">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{route('admin.offreDetail')}}">Reservation</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Affectation des chauffeur aux mission</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-2">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Tableaux des offres selectioner</h6>
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
                    <div class="content-body">
                        <section id="social-cards">
                            @isset($chauffeurs)
                                <div class="row mt-2">
                                    @foreach($chauffeurs as $index=>$chauffeur)
                                        <div class="col-xl-4 col-md-6 col-12">
                                            <div class="card profile-card-with-cover">
                                                <div class="card-content">
                                                    <!--<img class="card-img-top img-fluid" src="../../../app-assets/images/carousel/18.jpg" alt="Card cover image">-->
                                                    <div class="card-img-top img-fluid bg-cover height-200"
                                                         style="background: url({{$chauffeur->imageV}}) 0 30%;"></div>
                                                    <div class="card-profile-image">
                                                        <img style="height: 128px; width: 128px"
                                                             src="{{$chauffeur->image}}"
                                                             class="rounded-circle img-border box-shadow-1"
                                                             alt="Image chauffeur">
                                                    </div>
                                                    <div class="profile-card-with-cover-content text-center">
                                                        <div class="profile-details mt-2">
                                                            <ul class="list-inline clearfix mt-2">
                                                                <li class="mr-3">
                                                                    <h2 class="block">
                                                                        {{$chauffeur->nom." ".$chauffeur->prenom}}</h2>
                                                                </li>
                                                                <li class="mr-3">
                                                                    <h2 class="block">
                                                                        <i class="fas fa-phone"></i>
                                                                    </h2> {{$chauffeur->telephone}}
                                                                </li>
                                                                @if($chauffeur->email==null)
                                                                    <li class="mr-3">
                                                                        <i class="fas fa-envelope"></i>
                                                                        <h2 class="block"></h2>Email non enregistre
                                                                    </li>
                                                                @else
                                                                    <li class="mr-3">
                                                                        <i class="fas fa-envelope"></i>
                                                                        <h2 class="block"></h2>{{$chauffeur->email}}
                                                                    </li>
                                                                @endif
                                                                <li class="mr-3 mt-2">

                                                                    <a href="{{route('admin.offreDetail.affecterChauffeur',[$chauffeur->id,$offredetail->offre_id,$offredetail->id])}}"
                                                                       id="affecter"
                                                                       class="btn btn-info"><i
                                                                            class="fas mr-1 fa-car"></i>Affecter
                                                                    </a>

                                                                </li>
                                                            </ul>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endisset
                            @if(count($chauffeurs)==0)
                                <div role="alert" class="alert alert-warning">Aucun chauffeur est disponible
                                    maintenant
                                </div>
                            @endif
                        </section>
                        <!-- // Social cards section end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    {{--    <script src="../../../app-assets/js/scripts/cards/card-social.js" type="text/javascript"></script>--}}
    <script src="{{asset('assets/admin/js/scripts/cards/card-social.js')}}" type="text/javascript"></script>
    <script>
        $(document).ready(function () {

        });
    </script>
@endsection
