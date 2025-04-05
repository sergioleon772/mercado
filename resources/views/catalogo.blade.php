<?php
    use App\Models\Producto;
    $productos = Producto::all();

    $r = rand(1,5);
?>

@extends('master')
@section('content')

{{View::make('Templates.header')}}

<!-- <img class="img-fluid" id="foto" src="{!! asset('imagenes/imagen1.webp') !!}">
<h1>Hola</h1> -->
<div class="row" id="box-search">
    <div class="thumbnail text-center"> 
        <img class="img-fluid" style="opacity: 0.8;" id="foto" src="{!! asset('imagenes/imagen1.webp') !!}" alt=""> 
        <div class="caption mt-5">
            <img class="mt-5" src="{!! asset('imagenes/logoEmpresa.png') !!}" alt="">
        </div> 
    </div> 
</div> 



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
    // Escuchar el evento de submit en el formulario
    $('form').submit(function(e) {
        e.preventDefault(); // Evitar la recarga de la página
        var form = $(this);
        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            data: form.serialize(),
            success: function(response) {
                // Actualiza el carrito sin recargar la página
                $('#carrito-contenedor').html(response.carrito); // Actualiza el contenido del carrito
                $('#contador-carrito').text(response.contador); // Actualiza el contador de productos
                
            },
            error: function() {
                alert('Hubo un error al añadir el producto al carrito');
            }
        });
    });
});

</script>



<div class="container mt-5 mb-5">
    <div class="d-flex justify-content-center row">
        <h1 class="text-center mb-5" style="font-weight: lighter;">Productos Disponibles</h1>
        
    </div>
</div>

<div class="container mt-5 mb-5">
    <div class="row">
        @include('mensajes')

        @foreach ($productos as $producto)
        <div class="col-md-4 col-lg-3 mb-4">
            <div class="card shadow-sm border-light rounded-lg overflow-hidden">
                <!-- Imagen del producto -->
                <img src="{{ $producto->imagen }}" class="card-img-top img-fluid" alt="{{ $producto['titulo'] }}">

                <div class="card-body">
                    <!-- Título del producto -->
                    <h5 class="card-title text-center text-dark font-weight-bold">{{ $producto['titulo'] }}</h5>
                    
                    <!-- Descripción del producto -->
                    <p class="card-text text-muted" style="font-size: 0.9rem; text-align: justify;">{{ Str::limit($producto['descripcion'], 100) }}</p>

                    <!-- Precio -->
                    <h4 class="text-center text-success">${{ number_format($producto['precio'], 2) }}</h4>

                    <!-- Botones de acción -->
                    <div class="d-flex justify-content-between mt-3">
                        <a href="{{url('/producto/'.$producto->id)}}" class="btn btn-primary w-48">Ver Proveedor</a>

                        <!-- Formulario para añadir al carrito -->
                        <form action="/añadir_carrito" method="POST" class="w-48">
                            @csrf
                            <input type="hidden" name="producto_id" value="{{ $producto->id }}">
                            <button type="submit" class="btn btn-outline-warning w-100 add-to-cart" data-producto-id="{{ $producto->id }}">Añadir al Carrito</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>



{{View::make('Templates.footer')}}
@endsection