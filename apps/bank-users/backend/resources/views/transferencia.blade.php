@extends('layouts.app')

@section('content')
<h1 class="h3 mb-0 text-gray-800">Tranferencia a terceros</b></h1>

<form class="row g-3 mt-3">
    <div class="col-md-12">
        <label for="inputState" class="form-label">Cuenta Origen</label>
        <select id="inputState" class="form-select">
            <option selected>Seleccione...</option>
            <option>...</option>
        </select>
    </div>

    <div class="col-md-6">
        <label for="cuentaDestino" class="form-label">Alias cuenta destino</label>
        <input type="text" class="form-control" id="cuentaDestino" name="cuentaDestino" placeholder="########">
    </div>

    <div class="col-md-6">
        <label for="cuentaDestino" class="form-label">Numero cuenta destino</label>
        <input type="text" class="form-control" id="cuentaDestino" name="cuentaDestino" placeholder="########">
    </div>

    <div class="col-md-6">
        <label for="monto" class="form-label">Monto a transferir</label>
        <input type="text" class="form-control" id="monto">
    </div>
    <div class="col-md-6">
        <label for="concepto" class="form-label">Concepto</label>
        <input type="text" class="form-control" id="concepto">
    </div>

    <div class="col-12">
        <button type="submit" class="btn btn-primary">Continuar</button>
    </div>
</form>
@endsection