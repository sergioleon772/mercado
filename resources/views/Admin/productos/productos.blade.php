@extends('Admin.adminMaster')
@section('content')
<h1 class="text-center mt-5 mb-5">Menú Productos</h1>

<div class="container">
<table class="table table-light">
    <thead class="thead-light">
        <tr>
            <th>#</th>
            <th>Proveedor</th>
            <th>Titulo</th>
            <th>Marca</th>
            <th>Precio</th>
            <th>Cantidad</th>
            <th>Descripcion</th>
            <th>Imagen</th>
            <th>Acciones</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($productos as $producto)
            <tr>
                <td>{{ $producto->id }}</td>
                <td>{{ $producto->proveedor }}</td>
                <td>{{ $producto->titulo }}</td>
                <td>{{ $producto->marca }}</td>
                <td>{{ $producto->precio }}</td>
                <td>{{ $producto->cantidad }}</td>
                <td>{{ $producto->descripcion }}</td>
                <td>
                    <img src="{{ asset('storage').'/'.$producto->imagen }}" width="100" alt="">
                </td>
                <td>
                
                <a class="btn btn-primary mb-2" href="{{ url('/producto/'.$producto->id.'/edit') }}">Editar</a>

                <form action="{{ url('/producto/'.$producto->id) }}" method="POST">
                    @csrf
                    {{ method_field('DELETE') }}
                    <input type="submit" class="btn btn-danger" onclick="return confirm('¿Borrar Producto?')" value="Borrar">
                </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@include('mensajes')
<a href="producto/create" class="btn btn-primary mb-3">Agregar Producto</a>
</div>


@endsection