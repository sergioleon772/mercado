@extends('master')

@section('content')
    {{ View::make('Templates.header') }}

    <div class="container mt-5 mb-5">
        @php
            $precioNeto = $precioTotal / 1.19; // Precio antes del impuesto (neto)
            $impuesto = $precioNeto * 0.19; // Impuesto (19%)
            $precioTotal = $precioNeto + $impuesto; // Precio total con impuesto
        @endphp

        <table class="table">
            <tbody>
                <tr>
                    <td>Precio Neto</td>
                    <td>${{ number_format($precioNeto, 2) }}</td> <!-- Precio sin IVA -->
                </tr>
                <tr>
                    <td>Impuesto (19%)</td>
                    <td>${{ number_format($impuesto, 2) }}</td> <!-- Impuesto calculado -->
                </tr>
                <tr>
                    <td>Envío</td>
                    <td>$0</td>
                </tr>
                <tr>
                    <td>Precio Total</td>
                    <td>${{ number_format($precioTotal, 2) }}</td> <!-- Precio con IVA -->
                </tr>
            </tbody>
        </table>

        <!-- Formulario de dirección y método de pago -->
        <form action="{{ route('pago.crear') }}" method="POST">
            @csrf
            <input type="hidden" name="total" value="{{ $precioTotal }}">
            <div class="mb-3">
                <label class="form-label">Dirección de Envío</label>
                <textarea class="form-control" name="direccion" rows="2">{{ Auth::user()->address }}</textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Método de Pago</label>
                <select name="metodo_pago" required>
                    <option value="">Seleccione método</option>
                    <option value="Tarjeta">Tarjeta</option>
                    <option value="Transferencia">Transferencia</option>
                </select>
            </div>
            <a href="lista_carrito" class="btn btn-outline-secondary">Volver</a>
            <button type="submit" class="btn btn-success">Ordenar</button>
        </form>

        <!-- Botón de MercadoPago -->
        <div class="mt-4">
            <h3>Pago con Mercado Pago</h3>
            <script src="https://www.mercadopago.com.ar/integrations/v1/web-payment-checkout.js"
                data-preference-id="{{ $preference_id }}" data-button-label="Pagar con Mercado Pago"></script>
        </div>

    </div>

    {{ View::make('Templates.footer') }}
@endsection
