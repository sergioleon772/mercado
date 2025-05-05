{{ View::make('Templates.header') }}

<form method="POST" action="/login" class="container" style="width: 20rem;margin-top:5rem;">
    @csrf
    <h1 class="text-center" style="margin-bottom: 2rem;">Iniciar Sesión</h1>
    @include('mensajes')

    <div class="form-floating mb-3">
        <input type="text" placeholder="Rut" name="rut" id="rut" class="form-control" />
        <label class="form-label" for="form2Example1">Rut</label>
    </div>

    <!-- Password input -->
    <div class="form-floating mb-3 position-relative">
        <input type="password" id="password" name="password" class="form-control pe-5" required
            placeholder="Ingrese contraseña" />
        <label for="password"><i class="bi bi-lock"></i> Contraseña</label>
        <button type="button" id="togglePassword"
            class="btn position-absolute top-50 end-0 translate-middle-y me-2 p-0 border-0 bg-transparent">
            <i class="bi bi-eye-slash fs-5"></i>
        </button>
    </div>

    <!-- 2 column grid layout for inline styling -->
    <div class="row mb-4">
        <div class="col d-flex justify-content-center">
            <!-- Checkbox -->
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="form2Example31" checked />
                <label class="form-check-label" for="form2Example31"> Recordarme </label>
            </div>
        </div>

        <div class="col">
            <!-- Simple link -->
            <a href="#!">¿Olvidaste tu Contraseña?</a>
        </div>
    </div>

    <!-- Submit button -->
    <button type="submit" class="btn btn-primary btn-block mb-4" style="margin-left: 6rem;">Ingresar</button>

    <!-- Register buttons -->
    <div class="text-center" style="margin-bottom: 2rem;">
        <p>¿No estás Registrado? <a href="/registrarse">Registrarse</a></p>
        <p>o inicia sesión con:</p>
        <button type="button" class="btn btn-link btn-floating mx-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-brand-facebook" width="30"
                height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none"
                stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M7 10v4h3v7h4v-7h3l1 -4h-4v-2a1 1 0 0 1 1 -1h3v-4h-3a5 5 0 0 0 -5 5v2h-3" />
            </svg>
        </button>

        <button type="button" class="btn btn-link btn-floating mx-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-brand-google" width="30"
                height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none"
                stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M17.788 5.108a9 9 0 1 0 3.212 6.892h-8" />
            </svg>
        </button>
    </div>
</form>
{{ View::make('Templates.script') }}

{{ View::make('Templates.footer') }}
