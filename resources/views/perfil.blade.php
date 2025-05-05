{{ View::make('Templates.header') }}
<meta name="csrf-token" content="{{ csrf_token() }}">

<section class="py-5 my-5">
    <div class="container">
        <h1 class="mb-5">Perfil Comprador</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white shadow rounded-lg d-block d-sm-flex">
            <div class="profile-tab-nav border-end p-md-5">
                <div class="p-4">
                    <div class="img-circle text-center mb-3">
                        <img src="imagenes/user.png" alt="Image" class="shadow" style="width: 10rem;">
                    </div>
                    <h4 class="text-center">{{ Auth::user()->name }}</h4>
                </div>
                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <a class="nav-link active" id="account-tab" data-bs-toggle="pill" href="#account" role="tab"
                        aria-controls="account" aria-selected="true">
                        <i class="bi bi-person-circle"></i> Cuenta
                    </a>
                    <a class="nav-link" id="password-tab" data-bs-toggle="pill" href="#password" role="tab"
                        aria-controls="password" aria-selected="false">
                        <i class="bi bi-shield-lock"></i> Password
                    </a>
                </div>
            </div>

            <div class="tab-content p-4 p-md-5" id="v-pills-tabContent">
                <!-- CONFIGURACIÓN DE CUENTA -->
                <div class="tab-pane fade show active" id="account" role="tabpanel" aria-labelledby="account-tab">
                    <h3 class="mb-4">Configuración de Cuenta</h3>

                    <form method="POST" action="{{ route('perfilusuario.update') }}">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Rut</label>
                                    <input type="text" class="form-control" value="{{ Auth::user()->rut }}" disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nombre</label>
                                    <input type="text" class="form-control" value="{{ Auth::user()->name }}"
                                        disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Apellido</label>
                                    <input type="text" class="form-control" value="{{ Auth::user()->lastname }}"
                                        disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Correo</label>
                                    <input type="email" name="email" class="form-control"
                                        value="{{ Auth::user()->email }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Teléfono</label>
                                    <input type="tel" name="phone" class="form-control"
                                        value="{{ Auth::user()->phone }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Dirección Local</label>
                                    <input type="text" id="address" name="address" class="form-control"
                                        value="{{ Auth::user()->address }}">
                                </div>
                            </div>
                        </div>

                        <div>
                            <button type="submit" class="btn btn-primary mt-2">Actualizar</button>
                            <button type="reset" class="btn btn-light mt-2">Cancelar</button>
                        </div>
                    </form>
                </div>

                <!-- CAMBIO DE CONTRASEÑA -->
                <div class="tab-pane fade" id="password" role="tabpanel">
                    <h3 class="mb-4">Configuración de Contraseña</h3>
                    <div id="password-message"></div>

                    <form id="passwordForm" method="POST" action="{{ route('actualizarcontrasena') }}">
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
                                        <input type="password" name="new_password"
                                            class="form-control password-field">
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
                            <button class="btn btn-primary">Actualizar</button>
                            <button type="reset" class="btn btn-light">Cancelar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Scripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script
    src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google_maps.key') }}&libraries=places&language=es&region=CL&callback=initAutocomplete"
    async defer></script>
<script src="{{ asset('js/google-autocomplete.js') }}"></script>

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

            $.post("{{ route('actualizarcontrasena') }}", formData, function(response) {
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

{{ View::make('Templates.footer') }}
