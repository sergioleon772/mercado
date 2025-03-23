@extends('Admin.adminMaster')
@section('content')

<h1 class="text-center mt-5 mb-5">Eliminar Producto</h1>

<form class="container" style="width: 30rem;">
    <!-- Rut input -->
    <div class="form-outline">
        <input type="number" id="form2Example1" class="form-control" />
        <label class="form-label" for="form2Example1">Rut Empresa</label>
    </div>

    <div class="form-outline">
        <input type="number" id="form2Example1" class="form-control" />
        <label class="form-label" for="form2Example1">ID Producto</label>
    </div>

    <!-- Nombre input -->
    <div class="form-outline">
        <textarea class="form-control" id="form2Example2" cols="30" rows="10"></textarea>
        <label class="form-label" for="form2Example2">Motivo</label>
    </div>

    <!-- Submit button -->
    <a type="button" href="productos" class="btn btn-outline-primary btn-block mb-4" style="margin-left: 8rem;"">Volver</a>
    <button type="button" class="btn btn-primary btn-block mb-4"">Eliminar</button>

@endsection