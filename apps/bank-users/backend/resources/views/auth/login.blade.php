@extends('layouts.app')

@section('content')
<section class="vh-100" style="background-color: #eee;">
    <div class="container h-100">
        <div class="h-100">
            <div class="col-lg-12 col-xl-11">
                <div class="card text-black" style="border-radius: 25px;">
                    <div class="card-body p-md-5">
                        <div class="row justify-content-center">
                            <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Inicio de sesión</p>

                                <form class="mx-1 mx-md-4" method="POST" action="{{ route('login') }}">
                                    @csrf

                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                                        <div class="form-floating flex-fill mb-0 ">
                                            <div class="form-floating mb-3">
                                                <input id="email" type="email" placeholder="name@example.com"
                                                    class="form-control @error('email') is-invalid @enderror"
                                                    name="email" value="{{ old('email') }}" required
                                                    autocomplete="email" autofocus>
                                                @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                                <label for="email">Email</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                        <div class="form-floating flex-fill mb-0">
                                            <input type="password"
                                                class="form-control @error('password') is-invalid @enderror" required
                                                autocomplete="current-password" id="floatingPassword" name="password"
                                                placeholder="Password">
                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                            <label for="floatingPassword">Contraseña</label>
                                        </div>
                                    </div>




                                    <p class="mb-2 pb-lg-2 text-center">No tienes cuenta? <a
                                            href="{{ route('register') }}">Registrate acá</a></p>



                                    <div class="d-flex r mx-4 mb-3 mb-lg-4">
                                        <button type="submit" class="btn btn-primary btn-md">Acceder</button>
                                    </div>

                                    @if (Route::has('password.request'))
                                    <a class="btn btn-link float-end" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                    @endif

                                </form>

                            </div>
                            <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">

                                <img src="https://img.freepik.com/vector-gratis/hombre-mujer-tocandose-cuando-trabajo-terminado_1150-35029.jpg?w=2000"
                                    class="img-fluid" alt="Sample image">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection