@extends('master')

@section('content')
    @include('Templates.header')

    <div class="container my-5">
        <!-- Imagen de fondo -->
        <div class="position-relative mb-5">
            <img class="img-fluid w-100 rounded shadow" src="{{ asset('imagenes/tiendaRopa.jpg') }}"
                style="opacity: 0.6; height: 300px; object-fit: cover;">
            <div class="position-absolute top-50 start-50 translate-middle text-center text-white">
                <h1 class="display-4 fw-bold">Detalle del Producto</h1>
            </div>
        </div>

        <!-- Información del producto -->
        <div class="row align-items-center bg-dark text-white rounded shadow p-4 mb-5">
            <!-- Imagen -->
            <div class="col-md-4 text-center mb-3">
                <img src="{{ $producto->imagen }}" class="img-fluid rounded shadow" alt="Imagen del producto"
                    style="max-height: 300px; object-fit: contain;">
            </div>

            <!-- Detalles -->
            <div class="col-md-8">
                <h2 class="fw-bold">{{ $producto->titulo }}</h2>
                <p><strong>Proveedor:</strong> {{ $producto->proveedor->marca }}</p>
                <p><strong>Marca:</strong> {{ $producto->marca }}</p>
                <p><strong>Descripción:</strong> {{ $producto->descripcion }}</p>
                <h3 class="text-success fw-bold mt-3">${{ $producto->precio }}</h3>

                <!-- Botón -->
                <form action="/añadir_carrito" method="POST" class="mt-3">
                    @csrf
                    <input type="hidden" name="producto_id" value="{{ $producto->id }}">
                    <button class="btn btn-success px-4">Añadir al Carrito</button>
                </form>
            </div>
        </div>

        <!-- Reseñas -->
        <div class="bg-light rounded shadow p-4 mb-5">
            <h3 class="mb-4 text-center">Reseñas de Clientes</h3>

            @foreach ([['nombre' => 'Roberto Valenzuela Henríquez', 'cantidad' => 50, 'comentario' => '¡Excelente! muy contento con la compra, el producto es como en la descripción, de buena calidad con un diseño simple pero elegante. Contento con la compra'], ['nombre' => 'Felipe Luis', 'cantidad' => 20, 'comentario' => 'Buena calidad. El producto cumple con la descripción pero el diseño muy simple a mi gusto. De poder venderlos compraré más'], ['nombre' => 'Junior Mbappe Fernandez', 'cantidad' => 35, 'comentario' => 'Me gusto la simplesa del diseño, no es muy llamativa y es elegante, como me gustan las poleras.']] as $resena)
                <div class="card mb-3 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">
                            {{ $resena['nombre'] }}
                            @if ($resena['nombre'] === 'Felipe Luis')
                                <i class="bi bi-trash float-end text-danger"></i>
                            @endif
                        </h5>
                        <h6 class="card-subtitle mb-2 text-muted">Cantidad: {{ $resena['cantidad'] }}</h6>
                        <p class="card-text">{{ $resena['comentario'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Comentario nuevo -->
        @auth
            <div class="bg-white rounded shadow p-4 mb-5">
                <h4 class="mb-3">Deja tu comentario</h4>
                <form action="#" method="POST">
                    @csrf
                    <div class="mb-3">
                        <textarea name="comentario" class="form-control" rows="3" placeholder="Escribe tu reseña..."></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Enviar Comentario</button>
                </form>
            </div>
        @endauth
    </div>

    @include('Templates.footer')
@endsection
