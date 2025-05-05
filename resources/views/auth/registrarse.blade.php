{{-- Templates/header incluye CSS, meta csrf-token, Bootstrap, iconos, etc. --}}
{{ View::make('Templates.header') }}

<div class="container mt-5 mb-5 w-50">
    <form action="/registrarse" method="POST" class="row g-3">
        @csrf

        <div class="text-center w-100">
            <h1 class="mb-4">Registrarse</h1>
            <h6>Ingrese los campos solicitados</h6>
        </div>

        @include('mensajes')

        <div class="col-6 form-floating">
            <input type="text" id="rut" name="rut" class="form-control" oninput="formatearRut()" required
                value="{{ old('rut') }}" placeholder="Ej: 12.345.678-9" />
            <label for="rut">Rut</label>
        </div>

        <div class="col-6 form-floating position-relative">
            <input type="password" id="password" name="password" class="form-control pe-5" required
                placeholder="Ingrese una contraseña segura" />
            <label for="password"><i class="bi bi-lock"></i> Contraseña</label>
            <button type="button" id="togglePassword"
                class="btn position-absolute top-50 end-0 translate-middle-y me-2 p-0 border-0 bg-transparent">
                <i class="bi bi-eye-slash fs-5"></i>
            </button>
        </div>

        <div class="col-6 form-floating">
            <input type="text" name="name" id="name" class="form-control" placeholder="Nombre"
                value="{{ old('name') }}" required />
            <label for="name">Nombre</label>
        </div>
        <div class="col-6 form-floating">
            <input type="text" name="lastname" id="lastname" class="form-control" value="{{ old('lastname') }}"
                placeholder="Apellido" required />
            <label for="lastname">Apellido</label>
        </div>
        <div class="col-6 form-floating">
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}"
                placeholder="Correo" required />
            <label for="email">Correo</label>
        </div>
        <div class="col-6 form-floating">
            <input type="number" name="phone" value="{{ old('phone') }}" pattern="^\s?9\s?\d{4}\s?\d{4}$" required
                id="phone" class="form-control" placeholder="Teléfono" required />
            <label for="phone">Teléfono</label>
        </div>

        <div class="col-12 form-floating">

            <input type="text" id="address" name="address" value="{{ old('address') }}" class="form-control"
                placeholder="Ingresa tu dirección" autocomplete="off" required />
            <label for="address">Dirección</label>
        </div>


        <div class="col-12 d-flex justify-content-center mt-4">
            <a href="/" class="btn btn-outline-secondary me-3">Volver</a>
            <button type="submit" class="btn btn-primary">Registrarse</button>
        </div>
    </form>
</div>

{{-- Templates/script incluye Bootstrap JS, Axios u otros --}}
{{ View::make('Templates.script') }}
<script
    src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google_maps.key') }}&libraries=places&language=es&region=CL&callback=initAutocomplete"
    async defer></script>

<script src="{{ asset('js/google-autocomplete.js') }}"></script>


{{ View::make('Templates.footer') }}
