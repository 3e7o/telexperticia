@extends('layout.master2')

@section('content')
<div class="page-content d-flex align-items-center justify-content-center">

  <div class="row w-100 mx-0 auth-page">
    <div class="col-md-8 col-xl-6 mx-auto">
      <div class="card">
        <div class="row">
          <div class="col-md-4 pr-md-0">
            <div class="auth-left-wrapper" style="background-image: url({{ asset('assets/images/portada1.jpg') }})">

            </div>
          </div>
          <div class="col-md-8 pl-md-0">
            <div class="auth-form-wrapper px-4 py-5">
              <a href="#" class="noble-ui-logo d-block mb-2">COSSMIL<span>Telexperticia</span></a>
              <h5 class="text-muted font-weight-normal mb-4">¡Bienvenido de nuevo! Ingrese a su cuenta.</h5>
              <form method="POST" action="{{ route('login') }}" class="forms-sample">
                @csrf
                <div class="form-group">
                  <label for="username">Usuario</label>
                  <input id="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" required autocomplete="on" autofocus>
                            @if ($errors->has('username'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('username') }}</strong>
                                </span>
                            @endif
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Contraseña</label>
                  <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                </div>
                <div class="form-check form-check-flat form-check-primary">
                  <label class="form-check-label" for="remember">
                    <input type="checkbox" class="form-check-input">
                    {{ __('Remember Me') }}
                  </label>
                </div>
                <div class="mt-3">
                  <button type="submit" class="btn btn-primary mr-2 mb-2 mb-md-0">
                    {{ __('Login') }}
                  </button>
                </div>
                <a href="{{ route('password.request') }}" class="d-block mt-3 text-muted">{{ __('Forgot Your Password?') }}</a>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>
@endsection
