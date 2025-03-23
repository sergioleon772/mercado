@extends('master')
@section('content')

{{View::make('Templates.header')}}

<div class="container mt-5 mb-5">
    <div class="d-flex justify-content-center row">
        <h1 class="text-center mb-5" style="font-weight: lighter;">Mis Ordenes</h1>
        <div class="col-md-10">
            @foreach ( $ordenes as $orden )
                <div class="row p-2 bg-white border rounded mb-3">
                    <div class="col-md-3 mt-1"><img class="img-fluid img-responsive rounded product-image" src="{{ asset('storage').'/'.$orden->imagen }}"></div>
                    <div class="col-md-6 mt-1">
                        <h5 id="fuente">{{ $orden->titulo }}</h5>
                        <div class="d-flex flex-row">
                            <div class="ratings mr-2">
                                <i class="bi bi-star-fill" style="color: orange;"></i>
                                <i class="bi bi-star-fill" style="color: orange;"></i>
                                <i class="bi bi-star-fill" style="color: orange;"></i>
                                <i class="bi bi-star-fill" style="color: orange;"></i>
                            </div>
                        </div>
                        <div class="mt-1 mb-1 spec-1">
                            <span>Estado de Envío: {{ $orden->estado }}</span>
                        </div>
                        <div class="mt-1 mb-1 spec-1">
                            <span>Estado de Pago: {{$orden->estado_pago}}</span>
                        </div>
                        <div class="mt-1 mb-1 spec-1">
                            <span>Método de Pago: {{$orden->metodo_pago}}</span>
                        </div>
                        <div class="mt-1 mb-1 spec-1">
                            <span>Dirección de Envío: {{$orden->direccion}}</span>
                        </div>
                    </div>
                    <div class="align-items-center align-content-center col-md-3 border-left mt-1">
                        <div class="d-flex flex-row align-items-center">
                            <h4 class="mr-1">${{ $orden->precio+10000 }}</h4>
                        </div>
                        <h6 class="text-success">Free shipping</h6>
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

<!-- <div class="container mt-5 mb-5">
        <div class="row">
            @include('mensajes')
            @foreach ( $ordenes as $orden )
                <div class="card me-2 w-25">
                    <img src="{{ asset('storage').'/'.$orden->imagen }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">{{$orden->titulo}}</h5>
                        <p class="card-text">{{$orden->descripcion}}</p>
                    </div>
                    <h5>Estado de envio: {{ $orden->estado }}</h5>
                    <h5>Estado de pago: {{ $orden->estado_pago }}</h5>
                    <h5>Método de pago: {{ $orden->metodo_pago }}</h5>
                    <h5>Dirección de envío: {{ $orden->direccion }}</h5>
                </div>
            @endforeach
        </div>
    </div> -->

{{View::make('Templates.footer')}}

@endsection