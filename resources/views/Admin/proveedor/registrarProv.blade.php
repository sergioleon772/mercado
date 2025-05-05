@extends('Admin.adminMaster')

@section('content')
    <div class="container mt-5 mb-5 w-50">
        <h1 class="text-center mb-3">Registrar Proveedor</h1>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('proveedor.store') }}" method="POST" class="row g-3">
            @csrf

            <!-- Rut Empresa con formato -->
            <div class="col-6 form-floating">
                <input type="text" name="rut_empresa" id="rut_empresa" class="form-control" required placeholder=" " />
                <label for="rut_empresa">Rut Empresa</label>
            </div>

            <!-- Contraseña con botón mostrar/ocultar -->
            <!-- Contraseña con botón mostrar/ocultar -->
            <div class="col-6 form-floating position-relative">
                <input type="password" id="password" name="password" class="form-control" required placeholder=" " />
                <label for="password"><i class="bi bi-lock"></i> Contraseña</label>
                <button class="btn btn-outline-secondary position-absolute top-50 end-0 translate-middle-y me-2"
                    type="button" id="togglePassword" tabindex="-1">
                    <i class="bi bi-eye-slash" id="toggleIcon"></i>
                </button>
            </div>


            <div class="col-6 form-floating">
                <input type="text" name="marca" id="marca" class="form-control" required placeholder=" " />
                <label for="marca">Marca</label>
            </div>

            <div class="col-6 form-floating">
                <input type="text" name="productos_a_comerciar" id="productos_a_comerciar" class="form-control" required
                    placeholder=" " />
                <label for="productos_a_comerciar">Productos a Comerciar</label>
            </div>

            <div class="col-6 form-floating">
                <input type="email" name="correo" id="correo" class="form-control" required placeholder=" " />
                <label for="correo">Correo</label>
            </div>

            <div class="col-6 form-floating">
                <input type="number" name="telefono" id="telefono" class="form-control" required placeholder=" " />
                <label for="telefono">Teléfono</label>
            </div>

            <div class="col-12 form-floating">
                <input type="text" name="direccion" id="address" class="form-control" required placeholder=" " />
                <label for="direccion">Dirección</label>
            </div>

            <div class="col-12 d-flex justify-content-center">
                <a href="/proveedores" class="btn btn-outline-secondary me-2">Volver</a>
                <button type="submit" class="btn btn-primary">Registrar</button>
            </div>
        </form>
    </div>

    {{ View::make('Templates.script') }}
    <script src="{{ asset('js/google-autocomplete.js') }}"></script>

    {{-- Después el de Google Maps --}}
    <script
        src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google_maps.key') }}&libraries=places&language=es&region=CL&callback=initAutocomplete"
        async defer></script>
@endsection
