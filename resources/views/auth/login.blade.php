@extends('auth.layout')

@section('content')
    <div class="img d-none d-lg-block" style="background-image: url({{asset('css/auth/login.jpg')}});"></div>

    <div class="container-fluid p-5">
        <form class="text-center w-100 m-auto" method="POST" action="{{ route('login') }}">
            {{ csrf_field() }}
            <p class="h4 mb-4">Entrar</p>

            <input type="email" name="email" class="form-control mb-4 rounded-0 mb-4 border-right-0 border-top-0 border-left-0 border-dark @error('email') is-invalid @enderror"" placeholder="Email">


            <input type="password" name="password" id="defaultLoginFormPassword" class="form-control rounded-0 mb-4 border-right-0 border-top-0 border-left-0 border-dark @error('password') is-invalid @enderror" placeholder="Contraseña">

            <button class="btn btn-dark btn-block my-4 font-weight-bolder" type="submit">Entrar</button>

            <div class="container-fluid d-flex justify-content-around flex-column">
                <p class="text-primary">
                    -o-
                </p>
                <a href="/register" class="btn btn-outline-dark pl-3 pr-3 mb-1">Registrate</a>
                <p class="my-4"> <a href="{{route('password.request')}}" >¿Se te ha olvidado la contraseña?</a></p>
            </div>
        </form>
    </div>

    <!--Componente login/registro  router-view-->
@endsection
