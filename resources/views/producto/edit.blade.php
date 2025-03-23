@extends('Admin.admin')
@section('content')


<form action="{{ url('/producto/'.$producto->id) }}" class="container mt-5 mb-5 w-50" method="POST" enctype="multipart/form-data">
    @csrf
    {{ method_field('PATCH') }}
    <h1 class="text-center mb-3">Ingrese el Producto</h1>
    <form action="/producto" method="POST" enctype="multipart/form-data">
        @csrf
        <div  class="row g-3">
            <div class="col-6">
                <label for="provInput" class="from-label">Proveedor</label>
                <input type="text" value="{{ $producto->proveedor }}" class="form-control" name="proveedor" id="provInput">
            </div>
            <div class="col-6">
                <label for="tituloInput" class="from-label">Titulo</label>
                <input type="text" value="{{ $producto->titulo }}" class="form-control" name="titulo" id="tituloInput">
            </div>
            <div class="col-6">
                <label for="marcaInput" class="from-label">Marca</label>
                <input type="text" value="{{ $producto->marca }}" class="form-control" name="marca" id="marcaInput">
            </div>
            <div class="col-6">
                <label for="precioInput" class="from-label">Precio</label>
                <input type="text" value="{{ $producto->precio }}" class="form-control" name="precio" id="precioInput">
            </div>
            <div class="col-6">
                <label for="cantidadInput" class="from-label">Cantidad</label>
                <input type="text" value="{{ $producto->cantidad }}" class="form-control" name="cantidad" id="cantidadInput">
            </div>
            <div class="col-6">
                <label for="imagenInput" class="from-label">Imagen</label>
                <img src="{{ asset('storage').'/'.$producto->imagen }}" width="100" alt="">
                <input type="file" value="{{ $producto->imagen }}" class="form-control" name="imagen" id="imagenInput">
            </div>
            <div class="col-12">
                <label for="descInput" class="from-label">Descripcion</label>
                <!-- <input type="text" class="form-control" name="descripcion" id="descInput"> -->
                <textarea name="descripcion" value="{{ $producto->descripcion }}" class="form-control" id="descInput" cols="30" rows="5"></textarea>
            </div>

            <div class="col-12 d-flex justify-content-center">
                <a href="/producto" class="btn btn-outline-secondary me-2">Volver</a>
                <button type="submit" class="btn btn-primary">Actualizar</button>
            </div>
        </div>
    </form>
</form>


@endsection