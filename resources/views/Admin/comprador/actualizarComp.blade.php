@extends('Admin.adminMaster')
@section('content')

<h1 class="text-center mt-5 mb-5">Actualizar Comprador</h1>

<form class="container" style="width: 20rem;">
    <!-- Rut input -->
    <div class="form-outline">
        <input type="number" id="form2Example1" class="form-control" />
        <label class="form-label" for="form2Example1">Rut Comprador</label>
    </div>

    <!-- Nombre input -->
    <div class="form-outline">
        <input type="email" id="form2Example2" class="form-control" />
        <label class="form-label" for="form2Example2">Correo Electrónico</label>
    </div>

    <!-- Apellidos input -->
    <div class="form-outline">
        <input type="text" id="form2Example2" class="form-control" />
        <label class="form-label" for="form2Example2">Teléfono</label>
    </div>

    <!-- Submit button -->
    <a type="button" href="compradores" class="btn btn-outline-primary btn-block mb-4 ms-5"">Volver</a>
    <button type="button" class="btn btn-primary btn-block mb-4"">Actualizar</button>

@endsection