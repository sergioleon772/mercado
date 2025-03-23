@extends('master')
@section('content')

{{View::make('Templates.header')}}

<div class="container mt-5 mb-5">
    <table class="table">
    <tbody>
        <tr>
        <td>Precio compra</td>
        <td>${{ $total }}</td>
        </tr>
        <tr>
        <td>Impuesto</td>
        <td>$10000</td>
        </tr>
        <tr>
        <td>Envío</td>
        <td>$0</td>
        </tr>
        <tr>
        <td>Precio Total</td>
        <td>${{ $total+10000 }}</td>
        </tr>
    </tbody>
    </table>
    <form action="lugar_pedido" method="POST">
        @csrf
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Dirección de Envío</label>
            <textarea type="text" id="exampleFormControlInput1" class="form-control" name="direccion" rows="2">{{ Auth::user()->address }}</textarea>
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Example textarea</label>
            <select name="metodo_pago" class="form-control">
                <option value="" disabled selected>--Método de Pago--</option>
                <option value="WebPay">WebPay</option>
                <option value="Transferencia">Transferencia</option>
                <option value="Efectivo">Efectivo</option>
            </select>
        </div>
        <a href="lista_carrito" class="btn btn-outline-secondary">Volver</a>
        <button type="submit" class="btn btn-success">Ordenar</button>
    </form>
    
</div>


{{View::make('Templates.footer')}}

@endsection