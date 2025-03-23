@extends('master')
@section('content')

{{View::make('Templates.header')}}

<section class="py-5 my-5">
    <div class="container">
        <h1 class="mb-5">Perfil Vendedor</h1>
        <div class="bg-white shadow rounded-lg d-block d-sm-flex">
            <div class="profile-tab-nav border-right p-md-5">
                <div class="p-4">
                    <div class="img-circle text-center mb-3">
                        <img src="imagenes/user.png" alt="Image" class="shadow" style="width: 10rem;">
                    </div>
                    <h4 class="text-center">Alberto Valdivia Miguel</h4>
                </div>
                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <a class="nav-link active" id="account-tab" data-toggle="pill" href="#account" role="tab" aria-controls="account" aria-selected="true">
                        <i class="bi bi-person-circle"></i>
                        Cuenta
                    </a>
                    <a class="nav-link" id="password-tab" data-toggle="pill" href="#passwordd" role="tab" aria-controls="password" aria-selected="false">
                        <i class="bi bi-shield-lock"></i>
                        Password
                    </a>
                    
                </div>
            </div>
            <div class="tab-content p-4 p-md-5" id="v-pills-tabContent">
                <div class="tab-pane fade show active" id="account" role="tabpanel" aria-labelledby="account-tab">
                    <h3 class="mb-4">Configuración de Cuenta</h3>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Rut Empresa</label>
                                <input type="text" class="form-control" value="25.000.000-1" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nombre Marca</label>
                                <input type="text" class="form-control" value="Maui" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Correo</label>
                                <input type="text" class="form-control" value="correo1@gmail.com">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Telefono</label>
                                <input type="text" class="form-control" value="+91 9876543215">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Dirección Local</label>
                                <input type="text" class="form-control" value="Dirección local Alberto">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Productos a Comerciar</label>
                                <select class="form-select" aria-label="Default select example">
                                    <option disabled>Seleccione Tipo Producto</option>
                                    <option selected value="1">Tecnología</option>
                                    <option value="2">Vestuario</option>
                                    <option value="3">Alimentos</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Descripción</label>
                                <textarea class="form-control" rows="4">Nuestro nombre proviene de la icónica isla de Maui, Hawaii, donde se inicio el surf y están las playas con las mejores olas del mundo. Sin embargo, la leyenda de Maui and Sons comienza, irónicamente, con la fabricación de una galleta de chocolate en el continente americano. Más precisamente en el barrio de Newport Beach, al sur de California, a un par de metros de distancia del oceano pacífico. Fue aquí donde, en 1980, tres amantes del surf deciden comenzar una compañía de galletas de chispas de chocolate, “Maui’s Chocolate Chip Cookies”.</textarea>
                            </div>
                        </div>
                    </div>
                    <div>
                        <button class="btn btn-primary mt-2">Actualizar</button>
                        <button class="btn btn-light mt-2">Cancelar</button>
                    </div>
                </div>
                <div class="tab-pane fade" id="passwordd" role="tabpanel" aria-labelledby="password-tab">
                    <h3 class="mb-4">Password Settings</h3>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Old password</label>
                                <input type="password" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>New password</label>
                                <input type="password" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Confirm new password</label>
                                <input type="password" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div>
                        <button class="btn btn-primary">Update</button>
                        <button class="btn btn-light">Cancel</button>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</section>

{{View::make('Templates.footer')}}

@endsection