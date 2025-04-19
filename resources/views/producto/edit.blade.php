@extends(Auth::guard('proveedor')->check() ? 'master' : 'Admin.adminMaster')

@section('content')

    @if (Auth::guard('proveedor')->check())
        {{ View::make('partials.header_proveedor') }}
    @endif

    <h1 class="text-center mb-3">Modificar el Producto</h1>

    <form action="{{ route('producto1.update', $producto->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST') <!-- Laravel solo permite POST en esta ruta -->

        <div class="row g-3">
            <!-- Si el usuario es un proveedor, asigna automáticamente su ID -->
            @if (Auth::guard('proveedor')->check())
                <input type="hidden" name="proveedor_id" value="{{ Auth::user()->id }}">
            @else
                <div class="col-6">
                    <label for="provInput" class="form-label">Proveedor</label>
                    <select class="form-control" name="proveedor_id" required>
                        <option value="" disabled selected>Seleccione un proveedor</option>
                        @foreach ($proveedores as $proveedor)
                            <option value="{{ $proveedor->id }}"
                                {{ $producto->proveedor_id == $proveedor->id ? 'selected' : '' }}>
                                {{ $proveedor->marca }} - {{ $proveedor->rut_empresa }}
                            </option>
                        @endforeach
                    </select>
                    @error('proveedor_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            @endif

            <!-- Título -->
            <div class="col-6">
                <label for="tituloInput" class="form-label">Título</label>
                <input type="text" value="{{ old('titulo', $producto->titulo) }}" class="form-control" name="titulo"
                    id="tituloInput">
            </div>

            <!-- Marca -->
            <div class="col-6">
                <label for="marcaInput" class="form-label">Marca</label>
                <input type="text" value="{{ old('marca', $producto->marca) }}" class="form-control" name="marca"
                    id="marcaInput">
            </div>

            <!-- Precio -->
            <div class="col-6">
                <label for="precioInput" class="form-label">Precio</label>
                <input type="number" value="{{ old('precio', $producto->precio) }}" class="form-control" name="precio"
                    id="precioInput">
            </div>

            <!-- Cantidad -->
            <div class="col-6">
                <label for="cantidadInput" class="form-label">Cantidad</label>
                <input type="number" value="{{ old('cantidad', $producto->cantidad) }}" class="form-control"
                    name="cantidad" id="cantidadInput">
            </div>

            <!-- Imagen -->
            <div class="col-6">
                <label for="imagenInput" class="form-label">Imagen</label>
                <input type="file" class="form-control" name="imagen" id="imagenInput">
                @if ($producto->imagen)
                    <div class="mt-2">
                        <img src="{{ $producto->imagen }}" alt="Imagen actual" width="100">
                    </div>
                @endif
            </div>

            <!-- Descripción -->
            <div class="col-12">
                <label for="descInput" class="form-label">Descripción</label>
                <textarea name="descripcion" class="form-control" id="descInput" cols="30" rows="5">{{ old('descripcion', $producto->descripcion) }}</textarea>
            </div>

            <!-- Botones -->
            <div class="col-12 d-flex justify-content-center">
                <a href="{{ Auth::guard('proveedor')->check() ? url('/ver_productos') : url('/producto') }}"
                    class="btn btn-outline-secondary me-2">
                    Volver
                </a>
                <button type="submit" class="btn btn-primary">Actualizar</button>
            </div>

        </div>
    </form>

    @if (Auth::guard('proveedor')->check())
        {{ View::make('Templates.footer') }}
    @endif

@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
