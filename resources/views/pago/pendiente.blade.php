@extends('master')
@section('content')
    <div class="container mt-5">
        <h2>⏳ Pago pendiente</h2>
        <p>Tu pago está en proceso. Te notificaremos cuando se confirme.</p>
        <a href="{{ url('/') }}" class="btn btn-info">Volver al inicio</a>
    </div>
@endsection
