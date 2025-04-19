@extends('Admin.adminMaster')

@section('content')
    <div class="container d-flex justify-content-center">
        <div class="card shadow-lg mt-5 p-4" style="width: 40rem;">
            <div class="card-body">
                <h2 class="text-center mb-4">Registrar Usuario</h2>
                @include('mensajes')
                <form action="/admin/crear-usuario" method="POST">

                    @csrf

                    <!-- Primera fila: Rut y Nombre -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold" for="rut"><i class="bi bi-card-list"></i> Rut</label>

                            <input type="text" id="rut" name="rut" class="form-control"
                                oninput="formatearRut()" required value="{{ old('rut') }}"
                                placeholder="Ej: 12.345.678-9" />


                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold" for="nombre"><i class="bi bi-person"></i> Nombre</label>
                            <input type="text" id="nombre" name="name" class="form-control" required
                                placeholder="Ej: Juan" />
                        </div>
                    </div>

                    <!-- Segunda fila: Apellidos y Correo -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold" for="apellidos"><i class="bi bi-person"></i> Apellidos</label>
                            <input type="text" id="apellidos" name="lastname" class="form-control" required
                                placeholder="Ej: Pérez Gómez" />
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold" for="correo"><i class="bi bi-envelope"></i> Correo</label>
                            <input type="email" id="correo" name="email" class="form-control" required
                                placeholder="Ej: ejemplo@email.com" />
                        </div>
                    </div>

                    <!-- Tercera fila: Teléfono y Dirección -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold" for="telefono"><i class="bi bi-telephone"></i>
                                Teléfono</label>
                            <input type="number" id="telefono" name="phone" class="form-control" required
                                placeholder="Ej: +56912345678" />
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold" for="direccion"><i class="bi bi-house-door"></i>
                                Dirección</label>
                            <input type="text" id="direccion" name="address" class="form-control" required
                                placeholder="Ej: Calle Falsa 123, Santiago" />
                        </div>
                    </div>

                    <!-- Cuarta fila: Contraseña con botón para mostrar/ocultar -->
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label class="form-label fw-bold" for="password"><i class="bi bi-lock"></i> Contraseña</label>
                            <div class="input-group">
                                <input type="password" id="password" name="password" class="form-control" required
                                    placeholder="Ingrese una contraseña segura" />
                                <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                    <i class="bi bi-eye-slash"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Botones -->
                    <div class="d-flex justify-content-between">
                        <a href="/compradores" class="btn btn-outline-primary"><i class="bi bi-arrow-left"></i> Volver</a>
                        <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Registrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <!-- Script para mostrar/ocultar la contraseña -->
    <script>
        document.getElementById("togglePassword").addEventListener("click", function() {
            let passwordField = document.getElementById("password");
            let icon = this.querySelector("i");

            if (passwordField.type === "password") {
                passwordField.type = "text";
                icon.classList.remove("bi-eye-slash");
                icon.classList.add("bi-eye");
            } else {
                passwordField.type = "password";
                icon.classList.remove("bi-eye");
                icon.classList.add("bi-eye-slash");
            }
        });


        function limpiarRut(rut) {
            return rut.replace(/[^0-9kK]/g, "").toUpperCase();
        }

        function formatearRut(rut) {
            rut = limpiarRut(rut);
            if (rut.length <= 1) return rut;

            const cuerpo = rut.slice(0, -1);
            const dv = rut.slice(-1);

            // Agregar puntos cada tres dígitos desde el final
            let cuerpoFormateado = "";
            let i = 0;
            for (let pos = cuerpo.length - 1; pos >= 0; pos--) {
                cuerpoFormateado = cuerpo[pos] + cuerpoFormateado;
                i++;
                if (i % 3 === 0 && pos !== 0) {
                    cuerpoFormateado = "." + cuerpoFormateado;
                }
            }

            return cuerpoFormateado + "-" + dv;
        }

        document.addEventListener("DOMContentLoaded", function() {
            const rutInput = document.getElementById("rut");

            rutInput.addEventListener("input", function(e) {
                const cursor = rutInput.selectionStart;
                const rutSinFormato = limpiarRut(rutInput.value);
                const rutFormateado = formatearRut(rutSinFormato);
                rutInput.value = rutFormateado;
            });
        });
    </script>
@endsection
