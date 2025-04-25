@extends('master')
@section('content')
    {{ View::make('Templates.header') }}

    @guest
        @if (session('success'))
            <div class="alert alert-success text-center">
                {{ session('success') }}
            </div>
        @endif

        <div class="container my-5">
            <div class="row align-items-center">
                <div class="col-md-6 text-center mb-4 mb-md-0">
                    <h1 class="display-5">Bienvenido a</h1>
                    <h1 class="display-5 text-primary">Mercado Proveedores</h1>
                    <p class="lead">Todo lo que necesites con las mejores opciones</p>
                </div>
                <div class="col-md-6 text-center">
                    <img class="img-fluid" src="{{ asset('imagenes/logo1.png') }}" alt="Logo Mercado Proveedores">
                </div>
            </div>
        </div>
    @endguest

    @auth
        <div class="container my-5">
            <div class="row align-items-center">
                <div class="col-md-6 text-center mb-4 mb-md-0">
                    <h1 class="display-5">Bienvenido a Mercado Proveedores</h1>
                    <p class="lead">Todo lo que necesites con las mejores opciones</p>
                    <h4>¡Hola {{ Auth::user()->name }}!</h4>
                </div>
                <div class="col-md-6 text-center">
                    <img class="img-fluid" src="{{ asset('imagenes/logo1.png') }}" alt="Logo Mercado Proveedores">
                </div>
            </div>
        </div>
    @endauth

    <!-- Sección Te Ofrecemos -->
    <div class="container my-5">
        <h2 class="text-center mb-5">Te Ofrecemos</h2>
        <div class="row text-center g-4">
            <div class="col-md-4">
                <i class="bi bi-cart3 fs-1"></i>
                <h4>PRODUCTOS PARA TI</h4>
                <p class="text-muted">Todo tipo de productos seleccionados para ti al mejor precio.</p>
            </div>
            <div class="col-md-4">
                <i class="bi bi-box-seam fs-1"></i>
                <h4>GESTIONAMOS TUS COMPRAS</h4>
                <p class="text-muted">Nos encargamos de cada paso para que tu compra sea rápida y segura.</p>
            </div>
            <div class="col-md-4">
                <i class="bi bi-truck-flatbed fs-1"></i>
                <h4>ENVÍO A LOCAL</h4>
                <p class="text-muted">Recibe tus pedidos directamente en tu local u oficina.</p>
            </div>
        </div>
    </div>

    <!-- Carousel con productos -->
    <div class="container my-5">
        <h2 class="text-center mb-4">Productos más vistos</h2>
        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                @foreach ($productos as $index => $producto)
                    <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                        <div class="d-flex justify-content-center">
                            <div class="card shadow-sm" style="width: 18rem;">
                                <img src="{{ $producto->imagen }}" class="card-img-top" alt="{{ $producto->titulo }}">

                                <div class="card-body
                                    text-center">
                                    <h5 class="card-title">{{ $producto->titulo }}</h5>
                                    <p class="card-text">{{ Str::limit($producto->descripcion, 100) }}</p>
                                    <div class="card-body text-center"> ${{ $producto->precio }}</div>
                                    <!-- Botón para abrir modal -->
                                    <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#modalCantidad{{ $producto->id }}">Añadir al carrito</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal por producto -->
                    <div class="modal fade" id="modalCantidad{{ $producto->id }}" tabindex="-1"
                        aria-labelledby="modalLabel{{ $producto->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <form action="{{ route('agregar_carrito') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="producto_id" value="{{ $producto->id }}">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalLabel{{ $producto->id }}">Seleccionar cantidad
                                            {{ $producto->titulo }}
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Cerrar"></button>
                                    </div>
                                    <div class="modal-body text-center">
                                        <div class="d-flex justify-content-center align-items-center mb-3">
                                            <button type="button" class="btn btn-outline-secondary btn-sm"
                                                onclick="cambiarCantidad({{ $producto->id }}, -1)">−</button>
                                            <input type="number" name="cantidad" id="cantidad{{ $producto->id }}"
                                                value="1" min="1" class="form-control mx-2 text-center"
                                                style="width: 60px;" readonly>
                                            <button type="button" class="btn btn-outline-secondary btn-sm"
                                                onclick="cambiarCantidad({{ $producto->id }}, 1)">+</button>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-success">Añadir</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Anterior</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Siguiente</span>
            </button>
        </div>

        <div class="text-center mt-4">
            <a href="{{ url('catalogo') }}" class="btn btn-success px-4 rounded-pill">Ver más productos</a>
        </div>
    </div>

    <!-- Contacto -->
    <div class="container my-5">
        <h2 class="text-center mb-4">Contacto</h2>
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-6">
                <form action="{{ route('contact') }}" method="POST" class="border p-4 shadow-sm rounded bg-light">
                    @csrf
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" name="nombre" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="direccion" class="form-label">Dirección</label>
                        <input type="text" name="direccion" class="form-control" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Correo</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="telefono" class="form-label">Teléfono</label>
                            <input type="number" name="telefono" class="form-control" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="asunto" class="form-label">Asunto</label>
                        <input type="text" name="asunto" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="mensaje" class="form-label">Mensaje</label>
                        <textarea name="mensaje" class="form-control" rows="4" required></textarea>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-dark px-5">Enviar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{ View::make('Templates.footer') }}

    <script>
        function cambiarCantidad(id, cambio) {
            let input = document.getElementById('cantidad' + id);
            let valor = parseInt(input.value);
            if (!isNaN(valor)) {
                valor += cambio;
                if (valor < 1) valor = 1;
                input.value = valor;
            }
        }
    </script>
@endsection
