@extends('layouts.app')

@section('content')
<h1 class="h3 mb-0 text-gray-800">Cuentas</b></h1>

<div class="row mt-3">
    @foreach ($cuentas as $cuenta)
    <div class="col-xl-12 col-md-12 mb-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between p-md-1">
                    <div class="d-flex flex-row">
                        <div class="align-self-center">
                            <img class="rounded-circle shadow-1-strong me-3" width="65" height="65"
                                src="https://w7.pngwing.com/pngs/816/714/png-transparent-accounts-receivable-accounting-bank-account-accounting-angle-text-service-thumbnail.png"
                                alt="avatar" />
                        </div>
                        <div>
                            <h4>{{ $cuenta['nombre'] }}</h4>
                            <p class="mb-0"><b>Cuenta:</b> {{ $cuenta['numero_cuenta'] }}</p>
                            <p class="mb-0"><b>Saldo:</b> ${{ $cuenta['saldo']}}</p>
                            <p class="mb-0"><b>Tipo:</b> {{ $cuenta['tipo']}}</p>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection