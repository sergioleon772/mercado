@extends('Admin.adminMaster')
@section('content')
    <div class="container mt-5">
        <h2>Editar Usuario</h2>
        <form method="POST" action="{{ route('compradores.update', $comprador->id) }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Rut</label>
                <input type="text" name="rut" class="form-control" value="{{ $comprador->rut }}" readonly>
            </div>
            <div class="mb-3">
                <label>Nombre</label>
                <input type="text" name="name" class="form-control" value="{{ $comprador->name }}">
            </div>

            <div class="mb-3">
                <label>Apellido</label>
                <input type="text" name="lastname" class="form-control" value="{{ $comprador->lastname }}">
            </div>

            <div class="mb-3">
                <label>Correo</label>
                <input type="email" name="email" class="form-control" value="{{ $comprador->email }}">
            </div>

            <div class="mb-3">
                <label>Teléfono</label>
                <input type="number" name="phone" class="form-control" value="{{ $comprador->phone }}">
            </div>

            <div class="mb-3">
                <label>Dirección</label>
                <input type="text" name="address" class="form-control" value="{{ $comprador->address }}">
            </div>

            <button type="submit" class="btn btn-success">Actualizar</button>
            <a href="/compradores" class="btn btn-secondary">Volver</a>
        </form>
    </div>
@endsection
