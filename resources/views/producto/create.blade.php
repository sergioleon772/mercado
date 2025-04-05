@extends(Auth::guard('proveedor')->check() ? 'master' : 'Admin.adminMaster')
@section('content')
    @if (Auth::guard('proveedor')->check())
        {{ View::make('partials.header_proveedor') }}
    @endif

    <div class="container mt-5 mb-5 w-50">
        <h1 class="text-center mb-3">Ingrese el Producto</h1>
        <form action="{{ Auth::guard('proveedor')->check() ? '/producto1' : '/producto' }}" method="POST" class="row g-3"
            enctype="multipart/form-data">

            @csrf

            @if (Auth::guard('proveedor')->check())
                <input type="hidden" name="proveedor_id" value="{{ Auth::user()->id }}">
            @else
                <div class="col-6">
                    <label for="provInput" class="form-label">Proveedor</label>
                    <select class="form-control" name="proveedor_id" required>
                        <option value="" disabled selected>Seleccione un proveedor</option>
                        @foreach ($proveedores as $proveedor)
                            <option value="{{ $proveedor->id }}">{{ $proveedor->marca }} - {{ $proveedor->rut_empresa }}
                            </option>
                        @endforeach
                    </select>

                    @error('proveedor_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            @endif



            <div class="col-6">
                <label for="tituloInput" class="form-label">Titulo</label>
                <input type="text" class="form-control" name="titulo" id="tituloInput" value="{{ old('titulo') }}">
                @error('titulo')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-6">
                <label for="marcaInput" class="form-label">Marca</label>
                <input type="text" class="form-control" name="marca" id="marcaInput" value="{{ old('marca') }}">
                @error('marca')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-6">
                <label for="precioInput" class="form-label">Precio</label>
                <input type="number" class="form-control" name="precio" id="precioInput" value="{{ old('precio') }}"
                    required min="0" step="0.01">
                @error('precio')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-6">
                <label for="cantidadInput" class="form-label">Cantidad</label>
                <input type="number" class="form-control" name="cantidad" id="cantidadInput" value="{{ old('cantidad') }}"
                    required min="1" step="1">
                @error('cantidad')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-6">
                <label for="imagenInput" class="form-label">Imagen</label>
                <input type="file" class="form-control" name="imagen" id="imagenInput" required>
                @error('imagen')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-12">
                <label for="descInput" class="form-label">Descripcion</label>
                <textarea name="descripcion" class="form-control" id="descInput" cols="30" rows="5" required>{{ old('descripcion') }}</textarea>
                @error('descripcion')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-12 d-flex justify-content-center">
                <a href="{{ Auth::guard('proveedor')->check() ? '/ver_productos' : '/producto' }}"
                    class="btn btn-outline-secondary me-2">Volver</a>
                <button type="submit" class="btn btn-primary">Agregar</button>
            </div>
        </form>

    </div>

    @if (Auth::guard('proveedor')->check())
        {{ View::make('Templates.footer') }}
    @endif


@endsection
