<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
     aria-hidden="true">
    <div class="modal-dialog bg-dark" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h5 class="modal-title font-weight-bold text-warning" id="exampleModalLongTitle">Reservation</h5>
            </div>
            <form id="form_reservation" action="{{route('offre.valider')}}" method="get">
                @csrf
                <input class="form-control vehicule" type="hidden" id="vehicule" name="vehicule">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <input required placeholder="Votre Nom" name="name"
                                       value="{{ \Illuminate\Support\Facades\Auth::user()->name ?? old('name')}}"
                                       class="form-control @error('name') is-invalid @enderror" type="text">
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                         <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>
                        </div>
                        <input class="form-control" type="hidden" id="nbrPlace">
                        <div class="col-12">
                            <div class="form-group">
                                <input required placeholder="Telephone"
                                       value="{{\Illuminate\Support\Facades\Auth::user()->telephone ?? old('telephone')}}"
                                       name="telephone"
                                       class="form-control @error('telephone') is-invalid @enderror" type="text">
                                @error('telephone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <input required
                                       value="{{ \Illuminate\Support\Facades\Auth::user()->email ?? old('email')}}"
                                       placeholder="Email" name="email"
                                       class="form-control @error('email') is-invalid @enderror" type="email">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <input required type="date" id="date_depart" value="{{old('date_rdv')}}"
                                       class="form-control lock  @error('date_rdv') is-invalid @enderror"
                                       placeholder="Date Départ" name="date_rdv">
                                @error('date_rdv')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <input required type="time" value="{{old('heure')}}" name="heure"
                                       class="form-control @error('heure') is-invalid @enderror" id="time12">
                                @error('heure')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                @isset($requestFind)
                                    @if($requestFind["depart"]!='0' and $requestFind["arriver"]!='0')
                                        @if(!$statusForAutre)
                                            <label for="">Trajet</label>
                                            <input id="departF" disabled type="text" class="form-control"
                                                   value="{{$requestFind["depart"]}}">
                                            <div class="form-group mt-1">
                                                <input disabled id="arriverF" type="text" class="form-control"
                                                       value="{{$requestFind["arriver"]}}">
                                            </div>
                                            <div class="form-group">
                                                <input id="dest" type="hidden" name="destination">
                                            </div>
                                        @endif
                                    @endif
                                    @if($requestFind["depart"]=='0' or $requestFind["arriver"]=='0' )
                                        <Label>Choisit Destination</Label>
                                        <select name="destination" value="{{old('destination')}}" id="destination"
                                                class="form-control">
                                        </select>
                                    @endif
                                @else
                                    <Label>Choisit Destination</Label>
                                    <select name="destination" value="{{old('destination')}}" id="destination"
                                            class="form-control">
                                    </select>
                                @endisset
                            </div>
                        </div>
                        <div style="display: none" class="col-12" id="divDest">
                            <div class="col-12">
                                <div class="form-group">
                                    <input type="text" value="{{old('departA')}}"
                                           class="form-control  @error('departA') is-invalid @enderror"
                                           placeholder="Point de Départ" name="departA">
                                    @error('departA')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <input type="text" value="{{old('arriverA')}}"
                                           class="form-control   @error('arriverA') is-invalid @enderror"
                                           placeholder="Point D'arrivée" name="arriverA">
                                    @error('arriverA')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <select name="service_choisit" class="form-control" id="service_choi">
                                        <option value="">---service---</option>
                                        <option value="Transfert_aller_retour">Transfert aller retour</option>
                                        <option value="transfert_simple">Transfert Simple</option>
                                        <option value="mise_à_disposition">Mise à disposition</option>
                                        <option value="soiré">Soiré</option>
                                    </select>
                                </div>
                            </div>
                            <div id="retour_divh" style="display: none">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Date Retour </label>
                                        <input type="date" placeholder="Date Retour" required
                                               class="form-control lock input-sm @error('date_retour') is-invalid @enderror"
                                               name="date_ret" value="{{date('yy-m-d')}}">
                                        @error('date_retour')
                                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Heure Retour</label>
                                        <input  required type="time" name="heurer" value="00:00"
                                               placeholder="Heure Retour"
                                               class="form-control input-sm @error('heurer') is-invalid @enderror">
                                            @error('heurer')
                                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div id="mise_adisp_divh" style="display: none" class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label >Nombre Jour</label>
                                        <input min="1" value="1" type="number" required
                                               class="form-control lock input-sm @error('nbrjour') is-invalid @enderror"
                                               name="nbrjour" value="{{old('nbrjour')}}">
                                        @error('date_rdv')
                                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        @isset($statusForAutre)
                            @if($statusForAutre and $requestFind["depart"]!='0' and $requestFind["arriver"]!='0'  )
                                <input type="hidden" name="destination" value="-2">
                                <div class="col-12" id="divDest">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <input type="text" value="{{$requestFind["depart"]}}"
                                                   class="form-control  @error('departA') is-invalid @enderror"
                                                   placeholder="Point de Départ" name="departA">
                                            @error('departA')
                                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <input type="text" value="{{$requestFind["arriver"]}}"
                                                   class="form-control   @error('arriverA') is-invalid @enderror"
                                                   placeholder="Point D'arrivée" name="arriverA">
                                            @error('arriverA')
                                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <select name="service_choisit" class="form-control" id="service_chois">
                                                <option value="">---service---</option>
                                                <option value="Transfert_aller_retour">Transfert aller retour</option>
                                                <option value="transfert_simple">Transfert Simple</option>
                                                <option value="mise_à_disposition">Mise à disposition</option>
                                                <option value="soiré">Soiré</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div id="retour_div" style="display: none">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Date Retour </label>
                                                <input type="date" placeholder="Date Retour" required
                                                       class="form-control lock input-sm @error('date_retour') is-invalid @enderror"
                                                       name="date_ret" value="{{date('yy-m-d')}}">
                                                @error('date_retour')
                                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Heure Retour</label>
                                                <input  required type="time" name="heurer" value="00:00"
                                                        placeholder="Heure Retour"
                                                        class="form-control input-sm @error('heurer') is-invalid @enderror">
                                                @error('heurer')
                                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div id="mise_adisp_div" style="display: none" class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label >Nombre Jour</label>
                                                <input min="1" value="1" type="number" required
                                                       class="form-control lock input-sm @error('nbrjour') is-invalid @enderror"
                                                       name="nbrjour" value="{{old('nbrjour')}}">
                                                @error('date_rdv')
                                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endisset
                        <div style="display: none" id="ve_prix">
                            <div class="col-12">
                                <div class="form-group">
                                    <input type="radio" name="type" value="transfert_simple"
                                           class="switchery servType @error('type') is-invalid @enderror" checked/>
                                    <label for="switchery" class="font-medium-2 black">Prix Transfert:<span
                                            id="transfert"></span><span> DH</span></label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <input type="radio" name="type" value="Transfert_aller_retour"
                                           class="switchery servType transfertAllerRe @error('type') is-invalid @enderror"/>
                                    <label for="switchery" class="font-medium-2 black ">Prix Aller retour:<span
                                            id="aller_retour"></span><span> DH</span></label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <input type="radio" name="type" value="mise_à_disposition"
                                           class="switchery servType nbrJourRadio @error('type') is-invalid @enderror"/>
                                    <label for="switchery" class="font-medium-2 black">Prix mise à disposition
                                        (Par
                                        Jour):<span id="mise"></span><span> DH</span></label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <input type="radio" name="type" value="soiré"
                                           class="switchery servType @error('type') is-invalid @enderror"/>
                                    <label for="switchery" class="font-medium-2 black">Prix soiré(de 22:00
                                        à 03:00
                                        ):<span id="soire"></span><span> DH</span></label>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group ml-1">
                                <div id="nbrjour" style="width: 80%; display: none;" class="form-group">
                                    <fieldset>
                                        <div class="input-group">
                                            <input type="text"
                                                   class="touchspin-color input-lg @error('nombre_de_jour') is-invalid @enderror"
                                                   value="1" placeholder="Nombre de Jour" name="nombre_de_jour"
                                                   data-bts-button-down-class="btn btn-warning"
                                                   data-bts-button-up-class="btn btn-warning"/>
                                        </div>
                                    </fieldset>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group ml-1">
                                <div style="display: none;" id="dateRetour">
                                    <label for="date_retour">Date Retour</label>
                                    <input type="date"
                                           id="date_retour"
                                           class="form-control @error('date_retour') is-invalid @enderror"
                                           name="date_retour">
                                    @error('date_retour')
                                    <span class="invalid-feedback" role="alert">
                                         <strong>{{ $message }}</strong>
                                       </span>
                                    @enderror
                                    <div class="form-group mt-1">
                                        <input type="time" value="{{old('heure_retour')}}" name="heure_retour"
                                               class="form-control" id="time12">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 text-center">
                            <h1 class="font-weight-bold black">Contacter Nous</h1>
                        </div>
                        <div class="col-12 text-center">
                            <span><i class="fab  fa-2x fa-whatsapp"></i></span>
                            <a class="black font-size-large"
                               href="https://api.whatsapp.com/send?phone={{App\Models\Admin::select('phone')->first()->phone}}">+212661216388</a>
                        </div>
                        <div class="col-12 text-center">
                            <span><i class="fas fa-2x fa-phone"></i></span>
                            <a class="black font-size-large"
                               href="tel:+{{App\Models\Admin::select('phone')->first()->phone}}">+212661216388</a>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-dark">
                    <button style="text-transform: capitalize;" type="button"
                            class="btn btn-warning square btn-min-width mr-1 mb-1" data-dismiss="modal">Fermer
                    </button>
                    <button id="btn_valider" style="text-transform: capitalize;" type="submit"
                            class="btn btn-info square btn-min-width mr-1 mb-1">Valider
                    </button>
                </div>
            </form>
            <form id="form_contact" style="display: none" action="{{route('contact')}}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="col-12">
                        <h2 class="text-center black font-family-italic">Prix A partir de 30 DH Par Personne</h2>
                    </div>
                    <div class="col-12 text-center">
                        <h1 class="font-weight-bold black">Contacter Nous</h1>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <input type="text" required placeholder="Nom" name="nom"
                                       class="form-control @error('nom') is-invalid @enderror">
                                @error('nom')
                                <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <input type="email" name="email" required name="Email" placeholder="Email"
                                       class="form-control @error('email') is-invalid @enderror">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                            <textarea required name="subject" placeholder="Message"
                                      class="form-control col-md-12 @error('nom') is-invalid @enderror" id="subject"
                                      rows="10"></textarea>
                                @error('subject')
                                <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 text-center">
                            <span><i class="fab  fa-2x fa-whatsapp"></i></span>
                            <a class="black font-size-large"
                               href="https://api.whatsapp.com/send?phone={{App\Models\Admin::select('phone')->first()->phone}}">+212661216388</a>
                        </div>
                        <div class="col-12 text-center">
                            <span><i class="fas fa-2x fa-phone"></i></span>
                            <a class="black font-size-large"
                               href="tel:+{{App\Models\Admin::select('phone')->first()->phone}}">+212661216388</a>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-dark">
                    <button style="text-transform: capitalize;" type="button"
                            class="btn btn-warning square btn-min-width mr-1 mb-1" data-dismiss="modal">Fermer
                    </button>
                    <button style="text-transform: capitalize;" type="submit"
                            class="btn btn-info square btn-min-width mr-1 mb-1">Valider
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
