<?php
    use App\Http\Controllers\ProductoController;
    $total = ProductoController::itemCarrito();

?>
@extends('master')
@section('content')

{{View::make('Templates.header')}}

@if ($total==0)
    <div class="container">
        <div class="d-flex justify-content-center align-items-center" style="height: 30rem;">
            <div>
                <h1>El carrito está vacío</h1>
                <a href="catalogo" class="btn btn-outline-secondary d-block">Buscar Productos</a>
            </div>
        </div>
        
    </div>
    
@else
    <div class="container mt-5 mb-5">
        <div class="d-flex justify-content-center row">
            <div class="col-md-10">
                @include('mensajes')
                @foreach ( $productos as $producto )
                    <div class="row p-2 bg-white border rounded mb-3">
                        <div class="col-md-3 mt-1"><img class="img-fluid img-responsive rounded product-image" src="{{ asset('storage').'/'.$producto->imagen }}"></div>
                        <div class="col-md-6 mt-1">
                            <h5 id="fuente">{{ $producto->titulo }}</h5>
                            <div class="d-flex flex-row">
                                <div class="ratings mr-2">
                                    <i class="bi bi-star-fill" style="color: orange;"></i>
                                    <i class="bi bi-star-fill" style="color: orange;"></i>
                                    <i class="bi bi-star-fill" style="color: orange;"></i>
                                    <i class="bi bi-star-fill" style="color: orange;"></i>
                                </div>
                            </div>
                            <div class="mt-1 mb-1 spec-1">
                                <span>Cantidad: {{ $producto->cantidad }}</span>
                            </div>
                            <div class="mt-1 mb-1 spec-1">
                                <span>Proveedor: {{$producto->proveedor}}</span>
                                <br>
                            </div>
                            <p class="text-justify text-truncate">{{ $producto->descripcion }}<br><br></p>
                        </div>
                        <div class="align-items-center align-content-center col-md-3 border-left mt-1">
                            <div class="d-flex flex-row align-items-center">
                                <h4 class="mr-1">${{ $producto->precio }}</h4>
                            </div>
                            <h6 class="text-success">Free shipping</h6>
                            <div class="d-flex flex-column mt-4">
                                <a href="/quitar_carrito/{{ $producto->carrito_id }}" onclick="return confirm('¿Quitar del carrito?')" class="btn btn-danger">Quitar del Carrito</a>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="d-flex justify-content-center">
                    <a href="catalogo" class="btn btn-outline-secondary me-2">Volver</a>
                    <a href="ordenar_ahora" class="btn btn-success">Ordenar Ahora</a>
                </div>
            </div>
        </div>
    </div>
    
    <!-- <div class="container mt-5 mb-5">
        <div class="row">
            @include('mensajes')
            @foreach ( $productos as $producto )
                <div class="card me-2" style="width: 18rem;">
                    <img src="{{ asset('storage').'/'.$producto->imagen }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">{{$producto->titulo}}</h5>
                        <p class="card-text">{{$producto->descripcion}}</p>
                        <a href="/quitar_carrito/{{ $producto->carrito_id }}" class="btn btn-danger">Quitar del Carrito</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="container mb-3">
        <a href="producto" class="btn btn-outline-secondary">Volver</a>
        <a href="ordenar_ahora" class="btn btn-success">Ordenar Ahora</a>
    </div> -->
@endif

{{View::make('Templates.footer')}}

@endsection