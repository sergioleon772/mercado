@extends('master')
@section('content')
    {{ View::make('Templates.header') }}

    <div class="container mt-5 mb-5">
        @php
            $precioNeto = $total / 1.19; // Precio antes del impuesto (neto)
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


        <form action="lugar_pedido" method="POST">
            @csrf
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Dirección de Envío</label>
                <textarea id="exampleFormControlInput1" class="form-control" name="direccion" rows="2">{{ Auth::user()->address }}</textarea>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Método de Pago</label>
                <select name="metodo_pago" required>
                    <option value="">Seleccione método</option>
                    <option value="Tarjeta">Tarjeta</option>
                    <option value="Transferencia">Transferencia</option>
                </select>

            </div>
            <a href="lista_carrito" class="btn btn-outline-secondary">Volver</a>
            <button type="submit" class="btn btn-success">Ordenar</button>
        </form>
    </div>

    {{ View::make('Templates.footer') }}
@endsection
