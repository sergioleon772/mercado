@extends('Admin.adminMaster')
@section('content')


<form action="{{ url('/proveedor/'.$proveedor->id) }}" class="container mt-5 mb-5 w-50" method="POST">
    @csrf
    {{ method_field('PATCH') }}
    <h1 class="text-center mb-3">Modificar Proveedor</h1>
    
    <div class="row g-3">
        <div class="col-6">
            <label for="rutInput" class="form-label">RUT Empresa</label>
            <input type="text" value="{{ $proveedor->rut_empresa }}" class="form-control" disabled>
        </div>
        <div class="col-6">
            <label for="marcaInput" class="form-label">Marca</label>
            <input type="text" value="{{ $proveedor->marca }}" class="form-control" disabled>
        </div>
        <div class="col-6">
            <label for="correoInput" class="form-label">Correo</label>
            <input type="email" value="{{ $proveedor->correo }}" class="form-control" name="correo" id="correoInput" required>
        </div>
        <div class="col-6">
            <label for="telefonoInput" class="form-label">Teléfono</label>
            <input type="number" value="{{ $proveedor->telefono }}" class="form-control" name="telefono" id="telefonoInput" required>
        </div>
        <div class="col-12">
            <label for="direccionInput" class="form-label">Dirección</label>
            <input type="text" value="{{ $proveedor->direccion }}" class="form-control" name="direccion" id="direccionInput" required>
        </div>
        
        <div class="col-12">
    <label for="productosInput" class="form-label">Productos a Comerciar</label>
    <textarea name="productos_a_comerciar" class="form-control @error('productos_a_comerciar') is-invalid @enderror" id="productosInput" cols="30" rows="3">{{ old('productos_a_comerciar', $proveedor->productos_a_comerciar) }}</textarea>
    
    @error('productos_a_comerciar')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

        <div class="col-12 d-flex justify-content-center">
            <a href="/proveedores" class="btn btn-outline-secondary me-2">Volver</a>
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </div>
    </div>
    
</form>


@endsection