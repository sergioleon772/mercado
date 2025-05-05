<?php

// **Aquí se cerró el bloque PHP**
?>
@extends('master')
@section('content')
    {{ View::make('Templates.header') }}

    <div id="wallet_container"> </div>
    <div class="container mt-5 mb-5">
        @php
            $precioNeto = $total / 1.19;
            $impuesto = $precioNeto * 0.19;
        @endphp

        <h3>Resumen de Orden</h3>
        <table class="table">
            <tbody>
                <tr>
                    <td>Precio Neto</td>
                    <td>${{ number_format($precioNeto, 2) }}</td>
                </tr>
                <tr>
                    <td>Impuesto (19%)</td>
                    <td>${{ number_format($impuesto, 2) }}</td>
                </tr>
                <tr>
                    <td>Envío</td>
                    <td>$0</td>
                </tr>
                <tr>
                    <td><strong>Precio Total</strong></td>
                    <td><strong>${{ number_format($total, 2) }}</strong></td>
                </tr>
            </tbody>
        </table>

        <form id="form-checkout" method="POST" action="{{ route('pago.preferencia') }}" method="POST">
            @csrf
            <input type="hidden" name="total" value="{{ $total }}">
            <div class="mb-3">
                <label for="direccion" class="form-label">Dirección de Envío</label>
                <textarea name="direccion" class="form-control" rows="2">{{ Auth::user()->address ?? '' }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Método de Pago</label>
                <select name="metodo_pago" id="metodo_pago" class="form-select" required>
                    <option value="">Seleccione método</option>
                    <option value="Tarjeta">Tarjeta</option>
                    <option value="Transferencia">Transferencia</option>
                </select>
            </div>

            <a href="/lista_carrito" class="btn btn-outline-secondary">Volver</a>
            <div id="wallet_container"> </div>
            <button type="submit" id="boton-ordenar" class="btn btn-success">
                Pagar con MercadoPago
            </button>


        </form>

        <script>
            const mp = new MercadoPago('TEST-293c1473-c10a-4496-af39-2cc8b24e2237', {
                locale: 'es-CL'
            });

            mp.bricks.create('wallet', "wallet_container", {
                initialization: {
                    preferenceId: 1,
                },
                customization: {
                    paymentMethods: {
                        title: 'Métodos de Pago',
                        description: 'Selecciona tu método de pago preferido',
                    },
                    installments: {
                        title: 'Cuotas',
                        description: 'Selecciona el número de cuotas',
                    },
                },
            }).then((brick) => {
                brick.render();
            });
        </script>


        <div id="form-checkout__card" class="mt-4"></div>
        <p id="error-message" class="text-danger mt-2"></p>
    </div>
@endsection
