@extends('Admin.adminMaster')
@section('content')
<h1 class="text-center mt-5 mb-5">Menú Compradores</h1>
<div class="container">
    <div class="row w-25 mx-auto">
            <a class="btn btn-primary mb-2" href="registrarComp">Registrar Usuario</a>
            <a class="btn btn-primary mb-2" href="actualizarComp">Actualizar Usuario</a>
            <a class="btn btn-primary mb-2" href="eliminarComp">Eliminar Usuario</a>
    </div>
</div>

<table class="table table-striped-columns mt-5">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">RUT</th>
      <th scope="col">Nombre</th>
      <th scope="col">Apellidos</th>
      <th scope="col">Correo</th>
      <th scope="col">Teléfono</th>
      <th scope="col">Dirección</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>20.000.000-1</td>
      <td>José</td>
      <td>Pedro Castillo</td>
      <td>correo@gmail.com</td>
      <td>123456789</td>
      <td>Dirección Usuario</td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>20.000.000-2</td>
      <td>Pedro</td>
      <td>Castillo</td>
      <td>correo1@gmail.com</td>
      <td>123456789</td>
      <td>Dirección Usuario</td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td>20.000.000-3</td>
      <td>Gabriel</td>
      <td>Boric Font</td>
      <td>correo2@gmail.com</td>
      <td>123456789</td>
      <td>Dirección Usuario</td>
    </tr>
    <tr>
      <th scope="row">4</th>
      <td>20.000.000-4</td>
      <td>Alberto</td>
      <td>Angel Fernádez</td>
      <td>correo3@gmail.com</td>
      <td>123456789</td>
      <td>Dirección Usuario</td>
    </tr>
    <tr>
      <th scope="row">5</th>
      <td>20.000.000-5</td>
      <td>Juan</td>
      <td>Evo Morales</td>
      <td>correo4@gmail.com</td>
      <td>123456789</td>
      <td>Dirección Usuario</td>
    </tr>
    <tr>
      <th scope="row">6</th>
      <td>20.000.000-6</td>
      <td>Jair</td>
      <td>Messias Bolsonaro</td>
      <td>correo5@gmail.com</td>
      <td>123456789</td>
      <td>Dirección Usuario</td>
    </tr>
  </tbody>
</table>

@endsection