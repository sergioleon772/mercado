@extends('master')
@section('content')
    <div class="container mt-5">
        <h2>❌ Pago fallido</h2>
        <p>Hubo un problema al procesar tu pago. Inténtalo nuevamente o utiliza otro método de pago.</p>
        <a href="{{ url('lista_carrito') }}" class="btn btn-warning">Volver al carrito</a>
    </div>
@endsection
