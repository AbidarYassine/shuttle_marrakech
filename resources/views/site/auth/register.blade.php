@extends('layouts.site.login')

@section('content')



    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <section class="flexbox-container">
                    <div class="col-12 d-flex align-items-center justify-content-center">
                        <div class="col-md-6 col-sm-12 col-xl-4 col-lg-6 box-shadow-2 p-0">
                            <div class="card border-grey border-lighten-3 px-1 py-1 m-0">
                                <div class="card-header border-0 pb-0">
                                    <div class="card-title text-center">
                                        <img style="height:130px; width: 130px"
                                             src="{{asset('assets/images/site/login.gif')}}"
                                             alt="image login">
                                    </div>
                                </div>
                                <div class="card-content">
                                    <p class="card-subtitle line-on-side text-muted text-center font-small-3 mx-2 my-1">
                                        <span>Se Connecter</span>
                                    </p>
                                    <div class="card-body pt-2">
                                        <form class="form-horizontal" action="{{route('register')}}" method="post">
                                            @csrf
                                            <fieldset class="form-group floating-label-form-group">
                                                <input type="text"
                                                       class="form-control @error('name') is-invalid @enderror"
                                                       id="user-name" name="name" placeholder="Nom d'utilisation">
                                                @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                  </span>
                                                @enderror
                                            </fieldset>
                                            <fieldset class="form-group floating-label-form-group">
                                                <input type="email"
                                                       class="form-control @error('email') is-invalid @enderror"
                                                       id="user-email"
                                                       name="email"
                                                       placeholder=" Email Address">
                                                @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                  </span>
                                                @enderror
                                            </fieldset>
                                            <fieldset class="form-group floating-label-form-group">
                                                <input type="telephone"
                                                       class="form-control @error('telephone') is-invalid @enderror"
                                                       id="user-email"
                                                       name="telephone"
                                                       placeholder="Telephone">
                                                @error('telephone')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                  </span>
                                                @enderror
                                            </fieldset>
                                            <fieldset class="form-group floating-label-form-group mb-1">
                                                <input type="password"
                                                       name="password"
                                                       class="form-control @error('password') is-invalid @enderror"
                                                       id="user-password"
                                                       placeholder="Mot de passe">
                                                @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                  </span>
                                                @enderror
                                            </fieldset>
                                            <fieldset class="form-group floating-label-form-group mb-1">
                                                <input type="password"
                                                       class="form-control"
                                                       id="user-password"
                                                       name="password_confirmation"
                                                       placeholder="Confirmation">
                                                @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                  </span>
                                                @enderror
                                            </fieldset>
                                            <div class="form-group row">
                                                <div class="col-md-6 col-12"><a
                                                        href="#" class="card-link">Forgot
                                                        Password?</a></div>
                                            </div>
                                            <button type="submit" class="btn btn-outline-info btn-block"><i
                                                    class="ft-user"></i> Se Connecter
                                            </button>
                                        </form>
                                    </div>
                                    <div class="card-body pt-0">
                                        <a href="{{route('login')}}" class="btn btn-outline-danger btn-block"><i
                                                class="ft-unlock"></i> Connexion</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection
