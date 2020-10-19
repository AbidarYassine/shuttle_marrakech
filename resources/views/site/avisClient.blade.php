@extends('layouts.site.login')
@section('title','Donner votre Reaction A nous services')
@section('style')

    <link rel="stylesheet" type="{{asset('assets/admin/vendors/css/extensions/raty/jquery.raty.css')}}">
@endsection
@section('content')
    <div class="container mt-3">
        <div class="card">
            <div style="height: 50px;" class="bg-dark text-white card-header">Votre feedback</div>
            <div class="card-body">
                <form action="{{route('client.avis')}}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="hidden" name="idOfffredetail" class="form-control"
                                       value="{{$offredetail->id}}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="hidden" name="iduser" class="form-control" value="{{$user->id}}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <input type="email" disabled class="form-control" value="{{$user->email}}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <input required type="text" placeholder="nom" name="name"
                                       class="form-control @error('name') is-invalid @enderror"
                                       value="{{$user->name}}">
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <textarea required class="form-control @error('avis') is-invalid @enderror"
                                      placeholder="Votre feedback" name="avis" id="avis"
                                      class="col-12" cols="30"></textarea>
                            @error('avis')

                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mt-1">
                        <div class="col-12">
                            <div id="score-rating"></div>
                        </div>
                    </div>
                    <div class="row mt-2 d-flex justify-content-center">
                        <div class="col-md-6">
                            <button class="btn btn-info btn-block">Enregistre</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{asset('assets/admin/vendors/js/extensions/jquery.raty.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/admin/js/scripts/extensions/rating.js')}}" type="text/javascript"></script>
    {{--    <script src="../../../app-assets/js/scripts/extensions/rating.js" type="text/javascript"></script>--}}
@endsection
