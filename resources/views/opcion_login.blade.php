@extends('master')

@section('content')
    {{ View::make('Templates.header') }}

    <div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
        <div class="row text-center">

            <!-- Botón Comprador -->
            <div class="col-12 col-md-6 mb-4">
                <a href="/login" id="btn-grande" class="btn btn-outline-success w-100 p-5 shadow-lg rounded"
                    style="transition: all 0.3s ease-in-out;">
                    <h2>Usuario</h2>
                    <i class="bi bi-person d-block" style="font-size: 5rem;"></i>
                </a>
            </div>

            <!-- Botón Vendedor -->
            <div class="col-12 col-md-6 mb-4">
                <a href="login_proveedor" id="btn-grande" class="btn btn-outline-success w-100 p-5 shadow-lg rounded"
                    style="transition: all 0.3s ease-in-out;">
                    <h2>Proveedor</h2>
                    <i class="bi bi-building d-block" style="font-size: 5rem;"></i>
                </a>
            </div>

        </div>
    </div>

    {{ View::make('Templates.footer') }}
@endsection

@push('styles')
    <!-- Agregar estilos adicionales si es necesario -->
    <style>
        #btn-grande:hover {
            transform: scale(1.05);
            box-shadow: 0px 4px 15px rgba(0, 123, 255, 0.5);
        }

        h2 {
            font-size: 2rem;
            font-weight: 600;
        }
    </style>
@endpush
