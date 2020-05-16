@extends('auth.layout')

@section('content')
    <div class="img d-none d-lg-block" style="background-image: url({{asset('css/auth/s.jpg')}});" ></div>
    <div class="container-fluid p-5">
        <form class="text-center w-100 m-auto" method="POST" action="{{ route('register') }}">
            {{ csrf_field() }}
            <p class="h4 mb-3">Registro</p>

            <input type="text" name="username" class="form-control mb-4 rounded-0 mb-4 border-right-0 border-top-0 border-left-0 border-dark  @error('username') is-invalid @enderror" placeholder="Usuario">

            <input type="email" name="email" class="form-control mb-4 rounded-0 mb-4 border-right-0 border-top-0 border-left-0 border-dark @error('email') is-invalid @enderror" placeholder="Email">

            <input type="password" name="password" class="form-control rounded-0 mb-4 border-right-0 border-top-0 border-left-0 border-dark @error('password') is-invalid @enderror" placeholder="Contraseña">

            <input type="password" name="password_confirmation"  class="form-control rounded-0 mb-4 border-right-0 border-top-0 border-left-0 border-dark " placeholder="Repite la contraseña">

            <button class="btn btn-dark btn-block my-4 font-weight-light" type="submit">Registrarse</button>


            <div class="container-fluid d-flex justify-content-around flex-column">
                <p class="text-primary">
                    -o-
                </p>
                <a href="/login" class="btn btn-outline-dark pl-3 pr-3 mb-1">Entrar</a>
            </div>
        </form>
    </div>
@endsection
