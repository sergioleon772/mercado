@extends('master')

@section('content')
    @include('partials.header_proveedor')

    <section class="py-5 my-5">
        <div class="container">
            <h1 class="mb-5">Perfil Vendedor</h1>

            <!-- Mensajes de éxito o error de contraseña -->
            @if (session('password_success'))
                <div class="alert alert-success">{{ session('password_success') }}</div>
            @endif
            @if (session('password_error'))
                <div class="alert alert-danger">{{ session('password_error') }}</div>
            @endif

            <div class="bg-white shadow rounded-lg d-block d-sm-flex">
                <div class="profile-tab-nav border-right p-md-5">
                    <div class="p-4">
                        <div class="img-circle text-center mb-3">
                            <img src="{{ asset('imagenes/user.png') }}" alt="Perfil" class="shadow" style="width: 10rem;">
                        </div>
                        <h4 class="text-center">{{ optional(Auth::guard('proveedor')->user())->marca ?? 'Proveedor' }}</h4>
                    </div>
                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist">
                        <a class="nav-link active" id="account-tab" data-bs-toggle="pill" href="#account" role="tab">
                            <i class="bi bi-person-circle"></i> Cuenta
                        </a>
                        <a class="nav-link" id="password-tab" data-bs-toggle="pill" href="#password" role="tab">
                            <i class="bi bi-shield-lock"></i> Contraseña
                        </a>
                    </div>
                </div>

                <div class="tab-content p-4 p-md-5" id="v-pills-tabContent">
                    <!-- Configuración de Cuenta -->
                    <div class="tab-pane fade show active" id="account" role="tabpanel">
                        <h3 class="mb-4">Configuración de Cuenta</h3>

                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif

                        <form method="POST" action="{{ route('actualizar') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Rut Empresa</label>
                                        <input type="text" class="form-control"
                                            value="{{ optional(Auth::guard('proveedor')->user())->rut_empresa ?? '' }}"
                                            disabled>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nombre Marca</label>
                                        <input type="text" class="form-control"
                                            value="{{ optional(Auth::guard('proveedor')->user())->marca ?? 'Proveedor' }}"
                                            disabled>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Correo</label>
                                        <input type="email" name="correo" class="form-control"
                                            value="{{ optional(Auth::guard('proveedor')->user())->correo ?? '' }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Teléfono</label>
                                        <input type="text" name="telefono" class="form-control"
                                            value="{{ optional(Auth::guard('proveedor')->user())->telefono ?? '' }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Dirección Local</label>
                                        <input type="text" name="direccion" class="form-control"
                                            value="{{ optional(Auth::guard('proveedor')->user())->direccion ?? '' }}">
                                    </div>
                                </div>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-primary mt-2">Actualizar</button>
                                <button type="reset" class="btn btn-light mt-2">Cancelar</button>
                            </div>
                        </form>
                    </div>

                    <!-- Configuración de Contraseña -->
                    <div class="tab-pane fade" id="password" role="tabpanel">
                        <h3 class="mb-4">Configuración de Contraseña</h3>
                        <div id="password-message"></div>

                        <form id="passwordForm" method="POST" action="{{ route('updatePassword') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Contraseña actual</label>
                                        <div class="input-group">
                                            <input type="password" name="old_password" class="form-control password-field">
                                            <button type="button" class="btn btn-outline-secondary toggle-password">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nueva contraseña</label>
                                        <div class="input-group">
                                            <input type="password" name="new_password" class="form-control password-field">
                                            <button type="button" class="btn btn-outline-secondary toggle-password">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Confirmar nueva contraseña</label>
                                        <div class="input-group">
                                            <input type="password" name="new_password_confirmation"
                                                class="form-control password-field">
                                            <button type="button" class="btn btn-outline-secondary toggle-password">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div>
                                <button type="submit" class="btn btn-primary">Actualizar</button>
                                <button type="reset" class="btn btn-light">Cancelar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('Templates.footer')

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function() {
            $(".toggle-password").click(function() {
                var input = $(this).closest('.input-group').find('.password-field');
                var icon = $(this).find('i');
                input.attr("type", input.attr("type") === "password" ? "text" : "password");
                icon.toggleClass("bi-eye bi-eye-slash");
            });

            $("#passwordForm").submit(function(e) {
                e.preventDefault();
                var formData = $(this).serialize();

                $.post("{{ route('updatePassword') }}", formData, function(response) {
                    $("#password-message").html('<div class="alert alert-success">' + response
                        .message + '</div>');
                }).fail(function(xhr) {
                    var errors = xhr.responseJSON.errors;
                    var errorHtml = '<div class="alert alert-danger">';
                    $.each(errors, function(key, value) {
                        errorHtml += value[0] + "<br>";
                    });
                    errorHtml += '</div>';
                    $("#password-message").html(errorHtml);
                });
            });
        });
    </script>
@endsection
