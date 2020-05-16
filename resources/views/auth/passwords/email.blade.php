@extends('auth.layout')

@section('content')
    <div class="img d-none d-lg-block" style="background-image: url({{asset('css/auth/login.jpg')}});"></div>

    <div class="container-fluid p-5">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                Hemos enviado un link de recuperacion a tu email!
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}" class="text-center w-100 m-auto">
            {{ csrf_field() }}
            <p class="h4 mb-3">Recuperar Contraseña</p>
                    <input type="email" name="email"
                           class="form-control mb-4 rounded-0 mb-4 border-right-0 border-top-0 border-left-0 border-dark @error('email') is-invalid @enderror"
                           placeholder="Email">


                    @error('email')
                    <span class="invalid-feedback" role="alert">
                                        <strong>No podemos encontrar a ese usuario</strong>
                                    </span>
                    @enderror



                    <button type="submit" class="btn btn-dark btn-block my-4 font-weight-bolder">
                        {{ __('Enviar email de recuperacion') }}
                    </button>

        </form>
    </div>

@endsection
