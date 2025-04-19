@extends('master')
@section('content')
    {{ View::make('partials.header_proveedor') }}


    <h1 class="text-center">
        Productos {{ optional(Auth::guard('proveedor')->user())->marca ?? 'Proveedor' }}</h1>
    @include('mensajes')
    <h1 class="text-center">
        @if (Auth::guard('proveedor')->check())
            <a href="{{ route('producto.create.proveedor') }}" class="btn btn-primary mb-3">Agregar Producto</a>
        @elseif(Auth::guard('web')->check())
            <!-- Si es administrador -->
            <a href="{{ route('producto.create') }}" class="btn btn-primary mb-3">Agregar Producto</a>
        @endif
    </h1>
    <div class="container">
        <table class="table table-light">
            <thead class="thead-light">
                <tr>
                    <th>#</th>
                    <th>Proveedor</th>
                    <th>Titulo</th>
                    <th>Marca</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Descripcion</th>
                    <th>Imagen</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($productos as $producto)
                    <tr>
                        <td>{{ $producto->id }}</td>
                        <td>{{ $producto->proveedor->marca ?? 'Sin proveedor' }}</td>
                        <td>{{ $producto->titulo }}</td>
                        <td>{{ $producto->marca }}</td>
                        <td>{{ $producto->precio }}</td>
                        <td>{{ $producto->cantidad }}</td>
                        <td>{{ $producto->descripcion }}</td>
                        <td>
                            <img src="{{ $producto->imagen }}" class="img-fluid rounded product-image"
                                style="max-width: 100px; height: auto;">
                        </td>

                        <td>

                            @if (Auth::guard('proveedor')->check())
                                <a class="btn btn-primary mb-2"
                                    href="{{ url('/producto1/' . $producto->id . '/edit') }}">Editar</a>
                            @else
                                <a class="btn btn-primary mb-2"
                                    href="{{ url('/producto/' . $producto->id . '/edit') }}">Editar</a>
                            @endif


                            @if (Auth::guard('proveedor')->check())
                                <form action="{{ route('producto1.destroy', $producto->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" class="btn btn-danger"
                                        onclick="return confirm('¿Borrar Producto?')" value="Borrar">
                                </form>
                            @else
                                <form action="{{ url('/producto/' . $producto->id) }}" method="POST">
                                    @csrf
                                    {{ method_field('DELETE') }}
                                    <input type="submit" class="btn btn-danger"
                                        onclick="return confirm('¿Borrar Producto?')" value="Borrar">
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-center text-sm" style="marginbottom: 20px;">
            {{ $productos->links('vendor.pagination.bootstrap-5') }}
        </div>

    </div>

    {{ View::make('Templates.footer') }}
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
