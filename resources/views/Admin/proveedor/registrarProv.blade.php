@extends('Admin.adminMaster')
@section('content')
    <div class="container mt-5 mb-5 w-50">
        <h1 class="text-center mb-3">Registrar Proveedor</h1>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('proveedor.store') }}" method="POST" class="row g-3">
            @csrf
            <div class="col-6 form-floating">
                <input type="text" name="rut_empresa" id="rut_empresa" class="form-control" required />
                <label for="rut_empresa">Rut Empresa</label>
            </div>
            <div class="col-6 form-floating">
                <input type="password" name="password" id="password" class="form-control" required />
                <label for="password">Contraseña</label>
            </div>
            <div class="col-6 form-floating">
                <input type="text" name="marca" id="marca" class="form-control" required />
                <label for="marca">Marca</label>
            </div>
            <div class="col-6 form-floating">
                <input type="text" name="productos_a_comerciar" id="productos_a_comerciar" class="form-control"
                    required />
                <label for="productos_a_comerciar">Productos a Comerciar</label>
            </div>
            <div class="col-6 form-floating">
                <input type="email" name="correo" id="correo" class="form-control" required />
                <label for="correo">Correo</label>
            </div>
            <div class="col-6 form-floating">
                <input type="number" name="telefono" id="telefono" class="form-control" required />
                <label for="telefono">Teléfono</label>
            </div>
            <div class="col-12 form-floating">
                <input type="text" name="direccion" id="direccion" class="form-control" required />
                <label for="direccion">Dirección</label>
            </div>

            <div class="col-12 d-flex justify-content-center">
                <a href="/proveedores" class="btn btn-outline-secondary me-2">Volver</a>
                <button type="submit" class="btn btn-primary">Registrar</button>
            </div>
        </form>
    </div>
@endsection
