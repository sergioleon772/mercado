@extends('Admin.adminMaster')

@section('content')
    <h1 class="text-center mt-5 mb-5">Menú Proveedores</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-striped mt-5">
        <thead>
            <tr>
                <th>ID</th>
                <th>RUT Empresa</th>

                <th>Marca</th>
                <th>Correo</th>
                <th>Teléfono</th>
                <th>Dirección Local</th>
                <th>Productos a Comerciar</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($proveedores as $proveedor)
                <tr>
                    <td>{{ $proveedor->id }}</td>
                    <td>{{ $proveedor->rut_empresa }}</td>

                    <td>{{ $proveedor->marca }}</td>
                    <td>{{ $proveedor->correo }}</td>
                    <td>{{ $proveedor->telefono }}</td>
                    <td>{{ $proveedor->direccion }}</td>
                    <td>{{ $proveedor->productos_a_comerciar }}</td>
                    <td>

                        <a class="btn btn-primary mb-2"
                            href="{{ url('/proveedor/' . $proveedor->id . '/actualizarProv') }}">Editar</a>



                        <form action="{{ route('proveedor.destroy', $proveedor->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="submit" class="btn btn-danger" onclick="return confirm('¿Borrar este proveedor?')"
                                value="Borrar">
                        </form>

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center text-sm">
        {{ $proveedores->links('vendor.pagination.bootstrap-5') }}
    </div>
    <a href="proveedor/create" class="btn btn-primary mb-3">Agregar Proveedor</a>
    </div>
@endsection
