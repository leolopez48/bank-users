@extends('layouts.app')

@section('content')

<div class="vh-100" style="background-color: #eee;">
    <div class="container h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-lg-12 col-xl-11">
                <div class="card text-black" style="border-radius: 25px;">
                    <div class="card-body p-md-5">
                        <div class="row justify-content-center">
                            <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                                <p class="text-center h1 fw-bold mb-4 mx-1 mx-md-4 mt-4">Registro</p>

                                <form class="mx-1 mx-md-4" method="POST" action="{{ route('register') }}"
                                    enctype="multipart/form-data">
                                    @csrf

                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                                        <div class="form-floating flex-fill mb-0 ">
                                            <div class="form-floating mb-3">
                                                <input id="name" type="text" placeholder="name@example.com"
                                                    class="form-control @error('name') is-invalid @enderror" name="name"
                                                    value="{{ old('name') }}" required autocomplete="name" autofocus>
                                                @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                                <label for="name">Nombre</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fa-solid fa-phone fa-lg me-3 fa-fw"></i>
                                        <div class="form-floating flex-fill mb-0 ">
                                            <div class="form-floating mb-3">
                                                <input id="phone" type="text" placeholder="name@example.com"
                                                    class="form-control @error('phone') is-invalid @enderror"
                                                    name="phone" value="{{ old('phone') }}" required
                                                    autocomplete="phone" autofocus>

                                                @error('phone')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                                <label for="phone">Teléfono</label>
                                            </div>
                                        </div>
                                    </div>

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

                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                        <div class="form-floating flex-fill mb-0">
                                            <input type="password"
                                                class="form-control @error('password') is-invalid @enderror" required
                                                autocomplete="current-password" id="password-confirm"
                                                name="password_confirmation" placeholder="Confirmar Contraseña">
                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                            <label for="password-confirm">Confirmar Contraseña</label>
                                        </div>
                                    </div>

                                    <p class="mb-2 pb-lg-2 text-center">Ya tienes cuenta? <a
                                            href="{{ route('login') }}">Inicia sesión acá</a></p>

                                    <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                        <button type="submit" class="btn btn-primary btn-lg">Registrar</button>
                                    </div>

                                </form>

                            </div>
                            <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">

                                <img src="https://img.freepik.com/vector-gratis/ilustracion-concepto-colaboracion_114360-3995.jpg?w=900&t=st=1669424244~exp=1669424844~hmac=98d07b5775a8fb6591613b3091191844976ee91d97781182ad84d7e4e71e9a5b"
                                    class="img-fluid" alt="Sample image">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    @endsection