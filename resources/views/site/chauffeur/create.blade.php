@extends('layouts.site.login')
@section('title','Espace chaufffeur')
@section('style')
<link rel="stylesheet" type="text/css" href="{{asset('css/multi-form.css')}}">
{{-- <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/vendors/css/ui/prism.min.css')}}">--}}
{{-- <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/vendors/css/file-uploaders/dropzone.min.css')}}">--}}
{{-- <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/css/plugins/file-uploaders/dropzone.css')}}">--}}
<link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css" rel="stylesheet">
@endsection
@section('content')
<div class="container mt-3">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <div class="row">
        <div class="col-xl-6 col-lg-12">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <h1 class="text-white text-center font-weight-bold">Vout etes chauffeur <br>rejoindre nous?</h1>
                </div>
                <img style="width: 100%; height: 80%;" src="{{asset('images/chiffre2.png')}}" alt="image augmenter le chiffre">
                <div class="card-body">
                    <div class="page-heading mt-lg-1">
                        <h2 class="page-heading">Augmenter votre chiffre d'affaire en tout transparence</h2>
                        <span class="font-size-large font-weight-bold">Efficace , professionelle et convivial</span>
                    </div>
                    <div class="card-footer">
                        <button data-toggle="modal" data-target="#iconForm" id="btnLoadModal" class="btn btn-outline-success btn-block">J'ai un compte chauffeur
                        </button>
                        <h1 class="mt-2 text-center">Une Question besoin d'info?</h1>
                        <a href="/#contact" class="btn btn-outline-warning btn-block">Contact</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-lg-12">
            <div class="card">
                <h1 class="card-header bg-dark  text-center font-weight-bold text-white">Rejoindre le reseaux
                    national</h1>
                <div class="card-content">
                    <div class="card-body">
                        <form id="form_data_chau" action="{{route('chauffeur.save')}}" method="POST" enctype="multipart/form-data">

                            @csrf
                            <div class="tab">
                                <div class="form-group">
                                    <input type="nom" placeholder="nom" name="nom" class="form-control">
                                </div>
                                <div class="form-group">
                                    <input type="text" placeholder="prenom" name="prenom" class="form-control">
                                </div>
                                <div class="form-group">
                                    <input type="telephone" placeholder="telephone" name="telephone" class="form-control">
                                </div>
                                <div class="form-group">
                                    <input type="email" placeholder="Email" name="email" class="form-control">
                                </div>
                                <div class="form-group">
                                    <input type="text" placeholder="Adresse" name="address" class="form-control">
                                </div>
                                <div class="form-group">
                                    <input type="password" placeholder="mot de passe" name="password" class="form-control">
                                </div>
                                <div class="form-group">
                                    <input type="password" placeholder="Confirmez votre mot de passe" name="password_confirmation" class="form-control">
                                </div>
                            </div>
                            <div class="tab">

                                <div class="form-group">
                                    <label for="categorie_id">Choisi une Categorie <span class="text-danger">*</span></label>
                                    <select name="designation" value="---" class="form-control form-control-user">
                                        <option value="0">---</option>
                                        @foreach($categories as $categorie)
                                        <option value="{{$categorie->designation}}">{{$categorie->designation}}</option>
                                        @endforeach
                                    </select>
                                </div>


                                <div class="form-group">
                                    <label for="numeroPermi">Numero Permi <span class="text-danger">*</span></label>
                                    <input type="text" name="numeroPermi" value="{{old('numeroPermi')}}" required class="form-control form-control-user">
                                </div>


                                <div class="form-group">
                                    <label for="typePermi">Choisi une Type <span class="text-danger">*</span></label>
                                    <select name="typePermi" value="---" class="form-control form-control-user">
                                        <option value="A">A</option>
                                        <option value="B">B</option>
                                        <option value="C">C</option>
                                        <option value="C">D</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <input type="text" placeholder="Matricule de voiture" name="matricule" class="form-control">
                                </div>
                                <div class="form-group">
                                    <input type="text" placeholder="La marque" name="marque" class="form-control">
                                </div>
                                <div class="form-group">
                                    <input type="text" placeholder="Model" name="model" class="form-control">
                                </div>

                                <div class="form-group">
                                    <input type="file" required  class="form-control" name="image">
                                </div>
                                <button type="submit" id="btn_submit" class=" float-right mt-2 btn btn-outline-danger">
                                    <i class="fas fa-paper-plane"></i> Envoyer
                                </button>
                            </div>
                            <div style="overflow:auto;">
                                <div style="float:right; margin-top: 5px;">
                                    <button type="button" class="previous text-white mr-1 mt-1 btn btn-warning">
                                        precedent
                                    </button>
                                    <button id="show_upload" type="button" class="next btn mt-1 btn-outline-warning">Suivant
                                    </button>
                                </div>
                            </div>
                            <!-- Circles which indicates the steps of the form: -->
                            <div style="text-align:center;margin-top:10px;">
                                <span class="step">1</span><i class="fas fa-user-tie mr-1"></i>Vous
                                <span class="step">2</span><i class="fas fa-car mr-1"></i>Votre Véhicule
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal animated swing text-left" id="iconForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel34" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-white bg-dark">
                <h3 class="modal-title text-white" id="myModalLabel34">Connexion</h3>
            </div>
            <div class="row mt-2">
                <div class="col-md-12">
                    <div class="row mr-2 ml-2">
                        <button style="display: none;" type="text" class="btn btn-lg btn-block btn-outline-danger mb-2" id="type_error">
                        </button>
                    </div>
                </div>

            </div>
            <form id="login_chauffeur" method="POST" action="{{route('chauffeur.connexion')}}">
                @csrf
                <div class="modal-body">
                    <label>Email: </label>
                    <div class="form-group position-relative has-icon-left">
                        <input type="text" placeholder="Email Address" required class="form-control input-lg" value="{{old('email')}}" name="email">

                        <div class="form-control-position">
                            <i class="la la-envelope font-medium-5 line-height-1 text-muted icon-align"></i>
                        </div>
                    </div>
                    <label>Mot de passe: </label>
                    <div class="form-group position-relative has-icon-left">
                        <input type="password" placeholder="Mot de passe" name="password" required class="form-control input-lg">
                        <div class="form-control-position">
                        <i class="la la-lock font-medium-5 line-height-1 text-muted icon-align"></i>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-outline-warning" data-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-warning ">Connecter</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('script')
<script src={{asset("assets/site/js/bootstrap-4.4.1.min.js")}}></script>
<!-- <script src={{asset('assets/site/js/jquery-3.3.1.min.js')}} type="text/javascript"></script> -->
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.min.js"></script>
<script type="text/javascript" src={{asset("js/multi-form.js")}}></script>
<!-- <script src="{{asset('assets/admin/js/scripts/modal/components-modal.js')}}"></script> -->
<script type="text/javascript">
    $(document).ready(function() {
        $.validator.addMethod('date', function(value, element, param) {
            return (value != 0) && (value <= 31) && (value == parseInt(value, 10));
        }, 'Please enter a valid date!');
        $.validator.addMethod('month', function(value, element, param) {
            return (value != 0) && (value <= 12) && (value == parseInt(value, 10));
        }, 'Please enter a valid month!');
        $.validator.addMethod('year', function(value, element, param) {
            return (value != 0) && (value >= 1900) && (value == parseInt(value, 10));
        }, 'Please enter a valid year not less than 1900!');
        $.validator.addMethod('username', function(value, element, param) {
            var nameRegex = /^[a-zA-Z0-9]+$/;
            return value.match(nameRegex);
        }, 'Only a-z, A-Z, 0-9 characters are allowed');

        var val = {
            // Specify validation rules
            rules: {
                nom: "required",
                image: "required",
                prenom: "required",
                telephone: "required",
                address: "required",
                matricule: "required",
                model: "required",
                marque: "required",
                typePermi: "required",
                numeroPermi: "required",
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true,
                    minlength: 8,
                    maxlength: 16,
                },
                password_confirmation: {
                    required: true,
                }
            },
            // Specify validation error messages
            messages: {
                matricule: "ce champs est obligatoire",
                image: "ce champs est obligatoire",
                typePermi: "ce champs est obligatoire",
                model: "ce champs est obligatoire",
                marque: "ce champs est obligatoire",
                nom: "ce champs est obligatoire",
                numeroPermi: "ce champs est obligatoire",
                prenom: "ce champs est obligatoire",
                telephone: "ce champ est obligatoire",
                address: "ce champs est obligatoire",
                email: {
                    required: "Email est obligatoire",
                    email: "invalid email",
                },
                password: {
                    required: "mot de pass est obligatoire",
                    minlength: "mot doit etre au minimum 8 characters",
                    maxlength: "mot doit etre au maximum 8 characters",
                },
                password_confirmation: {
                    required: "confirmation mot de pass est obligatoire",
                }
            }
        }

        $("#form_data_chau").multiStepForm({
            // defaultStep:0,
            beforeSubmit: function(form, submit) {
                console.log("called before submiting the form");
                console.log(form);
                console.log(submit);
            },
            validations: val,
        }).navigateTo(0);

    });
</script>
<script>
    $(document).ready(function() {
        var modal = document.getElementById("iconForm");
        $("#btnLoadModal").click(function() {
            console.log(modal);
            modal.style.display = "block";
        });
        $(document).on('submit', "#login_chauffeur", function(e) {
            e.preventDefault();
            $.ajax({
                url: "{{route('chauffeur.connexion')}}",
                method: "POST",
                data: $("#login_chauffeur").serialize(),
                success: function(data) {
                    if (!data.status) {
                        $("#type_error").show('slow');
                        $("#type_error").text(data.message);
                    } else {
                        $("#type_error").hide();
                        window.location.href = "/";

                    }
                },
                error(error) {
                    console.log(error);
                }
            });
        })

    });
</script>


@endsection
