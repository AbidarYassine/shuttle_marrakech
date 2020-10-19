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
                                <div class="card-header border-0">
                                    <div class="card-title text-center">
                                        <img style="height:130px; width: 130px"
                                             src="{{asset('assets/images/site/login.gif')}}"
                                             alt="image login">
                                    </div>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <form class="form-horizontal" action="{{route('login')}}" method="post">
                                            @csrf
                                            <fieldset class="form-group col-12 position-relative has-icon-left">
                                                <input type="text"
                                                       class="form-control @error('email') is-invalid @enderror"
                                                       name="email" value="{{ old('email') }}" required
                                                       autocomplete="email" autofocus id="user-name"
                                                       placeholder="Email"
                                                       required>
                                                @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                  </span>
                                                @enderror
                                                <div class="form-control-position">
                                                    <i class="ft-user"></i>
                                                </div>
                                            </fieldset>
                                            <fieldset class="form-group col-12 position-relative has-icon-left">
                                                <input type="password"
                                                       class="form-control @error('password') is-invalid @enderror"
                                                       name="password"
                                                       id="user-password"
                                                       placeholder="Mot de passe"
                                                       required>
                                                @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                  </span>
                                                @enderror
                                                <div class="form-control-position">
                                                    <i class="la la-key"></i>
                                                </div>
                                            </fieldset>
                                            <div class="form-group row">
                                                <div class="col-md-6 col-12 text-center">
                                                    <fieldset>
                                                        <input class="form-check-input" type="checkbox" name="remember"
                                                               id="remember" {{ old('remember') ? 'checked' : '' }}>
                                                        <label for="remember-me"> Remember Me</label>
                                                    </fieldset>
                                                </div>
                                                <div class="col-md-6 col-12 float-sm-left text-center"><a
                                                        href="{{route('password.request')}}" class="card-link">Forgot
                                                        Password?</a></div>
                                            </div>
                                            <button type="submit" class="btn btn-outline-info btn-block"><i
                                                    class="ft-unlock"></i> Connexion
                                            </button>
                                        </form>
                                    </div>
                                    <p class="card-subtitle line-on-side text-muted text-center font-small-3 mx-2 my-1">
                                        <span>Ou</span>
                                    </p>
                                    <div class="card-body">
                                        <a href="{{route('register')}}"
                                           class="btn btn-outline-danger btn-block"><i class="ft-user"></i> Se Connecter</a>
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
