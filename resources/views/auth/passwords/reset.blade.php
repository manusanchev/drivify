@extends('auth.layout')

@section('content')
    <div class="img d-none d-lg-block" style="background-image: url({{asset('css/auth/login.jpg')}});"></div>

    <div class="container-fluid p-5">
        <div class="text-center w-100 m-auto">

            <form method="POST" action="{{ route('password.update') }}">
                {{ csrf_field() }}
                <p class="h4 mb-3">Recuperar Contraseña</p>
                <input type="hidden" name="token" value="{{ $token }}">

                    <input id="email" type="email" class="form-control mb-4 rounded-0 mb-4 border-right-0 border-top-0 border-left-0 border-dark @error('email') is-invalid @enderror"
                               name="email"
                               value="{{ $email ?? old('email') }}" placeholder="email" required autocomplete="email" autofocus>



                        <input id="password" type="password"
                               class="form-control mb-4 rounded-0 mb-4 border-right-0 border-top-0 border-left-0 border-dark @error('password') is-invalid @enderror"
                               name="password" placeholder="Contraseña" required autocomplete="new-password">

                        <input id="password-confirm" type="password" class="form-control mb-4 rounded-0 mb-4 border-right-0 border-top-0 border-left-0 border-dark" name="password_confirmation"
                               required placeholder="Confirmar contraseña"
                               autocomplete="new-password">


                        <button type="submit"  class="btn btn-dark btn-block my-4 font-weight-bolder">
                            {{ __('Modificar Contraseña') }}
                        </button>

            </form>
        </div>
    </div>

@endsection
