<section class="flexslider-container" id="flexslider-container-3">
    <div class="flexslider slider" id="slider-3">
        <ul class="slides">

            <li class="item-1 back-size"
                style="background:            linear-gradient(rgba(0,0,0,0.3),rgba(0,0,0,0.3)),url({{asset('assets/images/site/prin.jpg')}}) 50% 65%; background-size:cover; height:115%;">
            </li>
            <!-- end item-1 -->

            <li class="item-2 back-size"
                style="background:linear-gradient(rgba(0,0,0,0.3),rgba(0,0,0,0.3)),url({{asset('assets/images/site/prin.jpg')}}) 50% 65%; background-size:cover; height:115%;">
            </li>
            <!-- end item-2 -->

        </ul>
    </div>
    <div class="search-tabs mb-lg-5 cardAnimation" id="search-tabs-3">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <p style="color: #fff" class="font-weight-bold text-center text-bold-900 font-size-large">
                    Marrakech shuttle
                </p>
                <p class="text-white font-weight-bold text-center  text-bold-700 font-size-large">
                    s’engage à vous assurez un service de hautes qualités de navettes et transport tout direction au
                    Maroc 24h/24h et 7j/7j .
                    (van , minibus ,autocar) et des voitures VIP (4x4 et voitures berline de luxe) </p>
            </div>
            <div class="row">
                <div id="chercher_offre" class="col-md-12 mb-lg-5">
                    <form action="{{route('offre.cherche')}}" method="get" class="mt-1">
                        <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}"/>
                        @csrf
                        <div class="row d-flex justify-content-around mt-lg-2">
                            <div class="col-md-4 col-xl-3 col-lg-3 col-sm-12">
                                <div class="form-group mb-3">
                                    <select name="depart" required
                                            class="single-select-box selectivity-input @error('depart') is-invalid @enderror"
                                            id="single-select-box" data-placeholder="Distination inconu">
                                        <option value="0">Point De Départ</option>
                                        @foreach($tabDepart as $tabDep)
                                            <option value="{{$tabDep}}">{{$tabDep}}</option>
                                        @endforeach
                                        @error('depart')
                                        <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                  </span>
                                        @enderror
                                    </select>

                                </div>
                            </div>
                            <div class="col-md-4 col-xl-3 col-lg-3 col-sm-12">
                                <div class="form-group mb-3">
                                    <select name="arriver" required
                                            class="single-select-box selectivity-input @error('arriver') is-invalid @enderror"
                                            id="single-select-box" data-placeholder="Distination inconu">
                                        <option value="0">Point D’arrivée</option>
                                        @foreach($tabArriver as $index=>$arrv)
                                            <option value="{{$arrv}}">{{$arrv}}</option>
                                        @endforeach
                                        @error('depart')
                                        <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                  </span>
                                        @enderror
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4  col-xl-3 col-lg-3 col-sm-12">
                                <div class="form-group mb-3">
                                    <input type="number" min="1" required name="nbrMax"
                                           @isset($request) value="{{$request["nbrMax"]}}"
                                           @endisset class="form-control input-lg" placeholder="Nombre de place">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4  offset-md-4 col-sm-12">
                                <div class="form-group mb-3">
                                    <button style="text-transform: capitalize" type="sybmit"
                                            class="btn btn-warning  btn-block square btn-min-width mr-1 mb-1">Chercher
                                        des offres
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>

        </div>
    </div>
</section>
