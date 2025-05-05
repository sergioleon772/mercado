@extends('master')

@section('content')
    {{ View::make('Templates.header') }}

    <div class="container mt-5 mb-5">
        <h2>Instrucciones para Transferencia Bancaria</h2>

        <p>Gracias por tu pedido. Para completar la compra, realiza una transferencia a la siguiente cuenta:</p>

        <ul>
            <li><strong>Banco:</strong> Banco Ejemplo</li>
            <li><strong>Cuenta:</strong> 123456789</li>
            <li><strong>Tipo de Cuenta:</strong> Cuenta Corriente</li>
            <li><strong>Nombre:</strong> Tu Empresa Ltda.</li>
            <li><strong>RUT:</strong> 12.345.678-9</li>
            <li><strong>Monto:</strong> ${{ number_format($total, 0, ',', '.') }}</li>
            <li><strong>Asunto:</strong> Pago pedido usuario {{ Auth::user()->name }}</li>
        </ul>

        <p>Una vez realizada la transferencia, por favor envíanos el comprobante al correo
            <strong>ventas@tuempresa.cl</strong>
        </p>

        <a href="#" class="btn btn-primary mt-3">Volver al inicio</a>
    </div>
@endsection
