@extends('Admin.adminMaster')
@section('content')
    <h1 class="text-center mt-1 mb-6">Menú Usuarios</h1>
    <div class="container">
        <div class="row w-25 mx-auto">
            <a class="btn btn-primary mb-2" href="registrarComp">Registrar Usuario</a>

        </div>
    </div>
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-striped-columns mt-3">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">RUT</th>
                <th scope="col">Nombre</th>
                <th scope="col">Apellidos</th>
                <th scope="col">Correo</th>
                <th scope="col">Teléfono</th>
                <th scope="col">Dirección</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($compradores as $comprador)
                <tr>
                    <th scope="row">{{ $comprador->id }}</th>
                    <td>{{ $comprador->rut }}</td>
                    <td>{{ $comprador->name }}</td>
                    <td>{{ $comprador->lastname }}</td>
                    <td>{{ $comprador->email }}</td>
                    <td>{{ $comprador->phone }}</td>
                    <td>{{ $comprador->address }}</td>
                    <td>

                        <a class="btn btn-primary" href="{{ route('compradores.edit', $comprador->id) }}">Editar</a>



                        <form action="{{ route('compradores.destroy', $comprador->id) }}" method="POST"
                            style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <input type="submit" class="btn btn-danger" onclick="return confirm('¿Borrar este Usuario?')"
                                value="Borrar">
                        </form>

                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>
    <div class="d-flex justify-content-center text-sm">
        {{ $compradores->links('vendor.pagination.bootstrap-5') }}
    </div>
@endsection
