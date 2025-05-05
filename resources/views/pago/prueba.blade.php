@extends('master')

@section('content')
    <div class="container">
        <h1>Prueba de pago con MercadoPago</h1>

        <form action="{{ route('pago.preferencia') }}" method="POST">
            @csrf
            <input type="hidden" name="total" value="1000">
            <input type="hidden" name="direccion" value="Av. Siempre Viva 123">

            <button type="submit" class="btn btn-success">
                Pagar con MercadoPago
            </button>
        </form>
    </div>
@endsection
