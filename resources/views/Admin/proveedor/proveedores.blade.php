@extends('Admin.adminMaster')
@section('content')
<h1 class="text-center mt-5 mb-5">Menú Proveedores</h1>
<div class="container">
    <div class="row w-25 mx-auto">
            <a class="btn btn-primary mb-2" href="registrarProv">Registrar Usuario</a>
            <a class="btn btn-primary mb-2" href="actualizarProv">Actualizar Usuario</a>
            <a class="btn btn-primary mb-2" href="eliminarProv">Eliminar Usuario</a>
    </div>
</div>

<table class="table table-striped-columns mt-5">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">RUT Empresa</th>
      <th scope="col">Nombre Proveedor</th>
      <th scope="col">Marca</th>
      <th scope="col">Correo</th>
      <th scope="col">Teléfono</th>
      <th scope="col">Dirección Local</th>
      <th scope="col">Productos a Comerciar</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>25.000.000-1</td>
      <td>Alberto</td>
      <td>Maui</td>
      <td>empresa1@gmail.com</td>
      <td>123456789</td>
      <td>Dirección Local</td>
      <td>Producto1</td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>25.000.000-2</td>
      <td>Juan</td>
      <td>Nike</td>      
      <td>empresa2@gmail.com</td>
      <td>123456789</td>
      <td>Dirección Local</td>
      <td>Producto2</td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td>25.000.000-3</td>
      <td>Jorge</td>
      <td>Adidas</td>
      <td>empresa3@gmail.com</td>
      <td>123456789</td>
      <td>Dirección Local</td>
      <td>Producto3</td>
    </tr>
    <tr>
      <th scope="row">4</th>
      <td>25.000.000-4</td>
      <td>Tomás</td>
      <td>Coca-cola</td>
      <td>empresa4@gmail.com</td>
      <td>123456789</td>
      <td>Dirección Local</td>
      <td>Producto4</td>
    </tr>
    <tr>
      <th scope="row">5</th>
      <td>25.000.000-5</td>
      <td>Roberto</td>
      <td>PF</td>
      <td>empresa5@gmail.com</td>
      <td>123456789</td>
      <td>Dirección Local</td>
      <td>Producto5</td>
    </tr>
    <tr>
      <th scope="row">6</th>
      <td>25.000.000-6</td>
      <td>Manuel</td>
      <td>Colún</td>
      <td>empresa6@gmail.com</td>
      <td>123456789</td>
      <td>Dirección Local</td>
      <td>Producto6</td>
    </tr>
  </tbody>
</table>
@endsection