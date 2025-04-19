@extends('master') 

@section('content')
    {{ View::make('partials.header_proveedor') }}

    <div class="container">
        <div class="row" style="margin-top: 5rem;">
            <div class="col-sm-12 col-md-5 text-center" style="margin-top: 10rem;">
                <h1 id="fuente">Panel de Proveedor</h1>
                <p id="fuente">Gestión de productos y pedidos</p>
                <h4 id="fuente">¡Hola, {{ optional(Auth::guard('proveedor')->user())->marca ?? 'Proveedor' }}!</h4> 

                <p id="fuente">Bienvenido a tu panel de gestión. Aquí podrás administrar tus productos y pedidos.</p>
            </div>
            <div class="col-sm-12 col-md-7">
                <img class="logo1" src="{!! asset('imagenes/logo1.png') !!}" style="max-width: 100%; height: auto; display: block; margin: 0 auto;">
            </div>
        </div>
    </div>

    <!-- Opciones de gestión -->
    <div class="container mt-5">
        <div class="row text-center">
            <h1 class="mb-5" style="font-weight: lighter;">Opciones para Proveedores</h1>
            <div class="col">
                <i class="bi bi-box-seam" style="font-size: 4rem;"></i>
                <h3 style="font-weight: lighter;">Mis Productos</h3>
                <p>Administra los productos que ofreces en la plataforma.</p>
                <a href="ver_productos" class="btn btn-primary">Ver Productos</a>
            </div>
            <div class="col">
                <i class="bi bi-cart3" style="font-size: 4rem;"></i>
                <h3 style="font-weight: lighter;">Pedidos Recibidos</h3>
                <p>Revisa y gestiona los pedidos de tus clientes.</p>
                <a href="#" class="btn btn-primary">Ver Pedidos</a>
            </div>
            <div class="col">
                <i class="bi bi-gear" style="font-size: 4rem;"></i>
                <h3 style="font-weight: lighter;">Configuración</h3>
                <p>Actualiza tu información y preferencias.</p>
                <a href="#" class="btn btn-primary">Configurar</a>
            </div>
        </div>
    </div>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>