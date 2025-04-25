<?php
use App\Models\Producto;
$productos = Producto::all();
$r = rand(1, 5);
?>

@extends('master')
@section('content')
    {{ View::make('Templates.header') }}
    @include('mensajes')

    <div class="row" id="box-search">
        <div class="thumbnail text-center">
            <img class="img-fluid" style="opacity: 0.8;" id="foto" src="{!! asset('imagenes/imagen1.webp') !!}" alt="">
            <div class="caption mt-5">
                <img class="mt-5" src="{!! asset('imagenes/logoEmpresa.png') !!}" alt="">
            </div>
        </div>
    </div>

    <!-- Toast flotante -->
    <div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 9999;">
        <div id="toast-carrito" class="toast align-items-center text-white bg-success border-0" role="alert"
            aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    Producto añadido al carrito correctamente
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                    aria-label="Cerrar"></button>
            </div>
        </div>
    </div>

    <div class="container mt-5 mb-5">
        <div class="d-flex justify-content-center row">
            <h1 class="text-center mb-5" style="font-weight: lighter;">Productos Disponibles</h1>
        </div>

        <div class="row">
            @foreach ($productos as $producto)
                <div class="col-md-4 col-lg-3 mb-4 d-flex">
                    <div class="card shadow-sm border-light rounded-lg overflow-hidden h-100">
                        <img src="{{ $producto->imagen }}" class="card-img-top img-fluid" alt="{{ $producto->titulo }}"
                            style="height: 200px; object-fit: cover;">

                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title text-center text-dark font-weight-bold">{{ $producto->titulo }}</h5>
                            <p class="card-text text-muted" style="font-size: 0.9rem; text-align: justify;">
                                {{ Str::limit($producto->descripcion, 100) }}
                            </p>
                            <h4 class="text-center text-success mt-auto">${{ number_format($producto->precio, 2) }}</h4>

                            <div class="d-flex justify-content-between gap-3 mt-3">
                                <a href="{{ url('/producto/' . $producto->id) }}" class="btn btn-primary w-50">Detalle</a>

                                <!-- Formulario de añadir al carrito -->
                                <form action="/añadir_carrito" method="POST" class="w-50 formulario-carrito">
                                    @csrf
                                    <input type="hidden" name="producto_id" value="{{ $producto->id }}">

                                    <!-- Botón "Añadir" visible al inicio -->
                                    <div class="d-grid">
                                        <button type="button" class="btn btn-success btn-sm btn-mostrar-cantidad"
                                            onclick="mostrarCantidad({{ $producto->id }})">
                                            Añadir
                                        </button>
                                    </div>

                                    <!-- Contenedor oculto inicialmente: selector de cantidad + Confirmar -->
                                    <div id="contenedorCantidad{{ $producto->id }}" class="mt-2 d-none text-center">
                                        <div class="d-flex justify-content-center align-items-center mb-2">
                                            <button type="button" class="btn btn-outline-secondary btn-sm"
                                                onclick="cambiarCantidad({{ $producto->id }}, -1)">−</button>
                                            <input type="number" name="cantidad" id="cantidad{{ $producto->id }}"
                                                value="1" min="1" class="form-control mx-2 text-center"
                                                style="width: 60px;">
                                            <button type="button" class="btn btn-outline-secondary btn-sm"
                                                onclick="cambiarCantidad({{ $producto->id }}, 1)">+</button>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-sm">Confirmar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    {{ View::make('Templates.footer') }}

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Scripts de cantidad y AJAX -->
    <script>
        function cambiarCantidad(id, cambio) {
            let input = document.getElementById('cantidad' + id);
            let valor = parseInt(input.value);

            if (!isNaN(valor)) {
                valor += cambio;

                if (valor < 1) {
                    // Ocultar el contenedor de cantidad y mostrar el botón "Añadir"
                    const form = document.querySelector(`input[name="producto_id"][value="${id}"]`).closest('form');
                    const boton = form.querySelector('.btn-mostrar-cantidad');
                    const contenedor = document.getElementById(`contenedorCantidad${id}`);

                    contenedor.classList.add('d-none');
                    boton.classList.remove('d-none');

                    input.value = 1; // Reiniciar el valor por si se vuelve a abrir
                } else {
                    input.value = valor;
                }
            }
        }


        function mostrarCantidad(id) {
            const form = document.querySelector(`input[name="producto_id"][value="${id}"]`).closest('form');
            const boton = form.querySelector('.btn-mostrar-cantidad');
            const contenedor = document.getElementById(`contenedorCantidad${id}`);

            boton.classList.add('d-none');
            contenedor.classList.remove('d-none');
        }

        $(document).ready(function() {
            $('.formulario-carrito').submit(function(e) {
                e.preventDefault();
                var form = $(this);

                $.ajax({
                    url: form.attr('action'),
                    type: 'POST',
                    data: form.serialize(),
                    success: function(response) {
                        $('#carrito-contenedor').html(response.carrito || '');
                        $('#contador-carrito').text(response.contador || '');

                        const toastEl = document.getElementById('toast-carrito');
                        const toast = new bootstrap.Toast(toastEl);
                        toast.show();

                        $('#mensaje-carrito')
                            .removeClass('d-none')
                            .text('Producto añadido al carrito correctamente');

                        setTimeout(function() {
                            $('#mensaje-carrito').addClass('d-none').text('');
                        }, 3000);

                        // Reinicia el formulario visual
                        form.find('.btn-mostrar-cantidad').removeClass('d-none');
                        form.find('[id^=contenedorCantidad]').addClass('d-none');
                        form.find('input[type=number]').val(1);
                    },
                    error: function() {
                        alert('Hubo un error al añadir el producto al carrito');
                    }
                });
            });
        });
    </script>
@endsection
