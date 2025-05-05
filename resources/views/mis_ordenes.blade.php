@extends('master')

@section('content')
    {{ View::make('Templates.header') }}

    <div class="container mt-5 mb-5">


        <div class="d-flex justify-content-center row">
            <h1 class="text-center mb-5" style="font-weight: lighter;">Mis Ordenes</h1>
            @if (session('success'))
                <div class="alert alert-success text-center">
                    {{ session('success') }}
                </div>
            @endif

            <div class="col-md-10">
                @foreach ($ordenes as $fecha => $items)
                    @php
                        $total = $items->sum('precio'); // Sumar el precio total de los productos
                        $metodo = $items->first()->metodo_pago; // Tomar el método de pago del primer producto
                        $direccion = $items->first()->direccion; // Dirección de envío del primer producto
                        $estado = $items->first()->estado; // Estado de envío
                        $estado_pago = $items->first()->estado_pago; // Estado del pago
                    @endphp

                    <div class="card mb-4 p-3 shadow-sm">
                        <h6 class="text-muted">Fecha de orden:
                            {{ $fecha != 'Fecha no disponible' ? $fecha : 'No disponible' }}</h6>


                        <p>Total Pagado: ${{ number_format($total, 0, ',', '.') }}</p>
                        <p>Método de Pago: {{ $metodo }}</p>
                        <p>Dirección de Envío: {{ $direccion }}</p>
                        <p>Estado: {{ $estado }} | Pago: {{ $estado_pago }}</p>

                        <hr>
                        <div class="row">
                            @foreach ($items as $item)
                                <div class="col-md-3 text-center mb-3">
                                    <img src="{{ $item->imagen }}" class="img-fluid rounded" style="max-height: 100px;">
                                    <p>{{ $item->titulo }}</p>
                                    <small>{{ $item->cantidad }}x -
                                        ${{ number_format($item->precio / $item->cantidad, 0, ',', '.') }}</small>

                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach

                <div class="d-flex justify-content-center">
                    <a href="/" class="btn btn-outline-secondary me-2">Volver a Inicio</a>
                    <a href="catalogo" class="btn btn-success">Ordenar Productos</a>
                </div>
            </div>
        </div>
    </div>

    {{ View::make('Templates.footer') }}
@endsection
