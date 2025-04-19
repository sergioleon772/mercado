@extends('master')
@section('content')
    {{ View::make('Templates.header') }}

    <div class="container mt-5 mb-5 w-50">
        <form action="/registrarse1" method="POST" class="row g-3">
            @csrf
            <div class="text-center">
                <h1 style="margin-bottom: 2rem;">Registrarse Proveedor</h1>
                <h6>Ingrese los campos solicitados</h6>
            </div>

            @include('mensajes')
            <div class="col-6 form-floating">
                <input type="text" placeholder="rut_empresa" name="rut_empresa" id="rut_empresa" class="form-control" />
                <label class="form-label" for="form2Example1">Rut Empresa</label>
            </div>
            <div class="col-6 form-floating">
                <input type="password" placeholder="Contraseña" name="password" id="form2Example2" class="form-control" />
                <label class="form-label" for="form2Example2">Contraseña</label>
            </div>
            <div class="col-6 form-floating">
                <input type="text" placeholder="marca" name="marca" id="marca" class="form-control" />
                <label class="form-label" for="form2Example2">Marca</label>
            </div>
            <div class="col-6 form-floating">
                <input type="text" placeholder="productos_a_comerciar" name="productos_a_comerciar"
                    id="productos_a_comerciar" class="form-control" />
                <label class="form-label" for="form2Example2">Productos a Comerciar</label>
            </div>
            <div class="col-6 form-floating">
                <input type="email" placeholder="Correo" name="correo" id="correo" class="form-control" />
                <label class="form-label" for="form2Example2">Correo</label>
            </div>
            <div class="col-6 form-floating">
                <input type="text" placeholder="Telefono" name="telefono" id="telefono" class="form-control" />
                <label class="form-label" for="form2Example2">Teléfono</label>
            </div>
            <div class="col-12 form-floating">
                <input type="text" placeholder="Dirección" name="direccion" id="direccion" class="form-control" />
                <label class="form-label" for="form2Example2">Dirección</label>
            </div>
            <!-- <div class="col-2">
                    <select class="form-control" name="comp_o_emp" id="">
                        <option selected value="2">Proveedor</option>
                    </select>
                </div> -->

            <div class="col-12 d-flex justify-content-center">
                <a href="/" class="btn btn-outline-secondary me-2">Volver</a>
                <button type="submit" class="btn btn-primary">Registrarse</button>
            </div>
        </form>
    </div>


    {{ View::make('Templates.footer') }}
@endsection
