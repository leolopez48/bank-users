@extends('layouts.app')

@section('content')
{{-- <div class="px-4 py-5 my-5 text-center">
    <img class="d-block mx-auto mb-4" src="logo.svg" alt="" width="250" height="125">
    <h1 class="display-5 fw-bold">Bienvenido</h1>
    <div class="col-lg-6 mx-auto">
        <p class="lead "> {{ Auth::user()->name }}</p>
        <p class="lead "> {{ Auth::user()->email }}</p>
        <p class="lead mb-4">Has iniciado sesión correctamente, ahora puedes regresar al inicio.</p>
        <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
            <a type="button" href="http://localhost:5173/callback" class="btn btn-dark btn-lg px-4 gap-3">Ir al
                inicio</a>

        </div>
    </div>
</div> --}}
<div class="overflow-hidden">
    <div class="container-fluid col-xxl-8">
        <div class="row flex-lg-nowrap align-items-center g-5">
            <div class="order-lg-1 w-100">
                <img style="clip-path: polygon(25% 0%, 100% 0%, 100% 99%, 0% 100%);"
                    src="https://www.unotv.com/uploads/2023/03/familiar-banco-fallecido-153448.jpg"
                    class="d-none d-md-block mx-lg-auto img-fluid" alt="Photo by Milad Fakurian" loading="lazy"
                    sizes="(max-width: 1080px) 100vw, 1080px" width="2160" height="768">
            </div>
            <div class="col-lg-6 col-xl-5 text-center text-lg-start pt-lg-5 mt-xl-4">
                <div class="lc-block mb-4">
                    <div editable="rich">
                        <h1 class="fw-bold display-3">Bienvenido</h1>
                    </div>
                </div>

                <div class="lc-block mb-5">
                    <div editable="rich">
                        <p class="rfs-8"><b>{{ Auth::user()->name }}</b> iniciaste sesión correctamente, ahora
                            puedes
                            acceder a la aplicación!</p>
                    </div>
                </div>
                <a type="button" href="http://localhost:5173/callback" class="btn btn-dark btn-lg px-4 gap-3">Ir al
                    inicio</a>
            </div>

        </div>
    </div>
</div>

@endsection