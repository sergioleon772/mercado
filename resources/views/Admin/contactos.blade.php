@extends('Admin.adminMaster')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1 class="text-center mb-4">Contáctanos</h1>

            <div class="card">
                <div class="card-header">
                    <h3>Información de Contacto</h3>
                </div>
                <div class="card-body">
                    <h4><i class="bi bi-geo-alt"></i> Dirección</h4>
                    <p>Calle Ejemplo 123, Ciudad, País</p>

                    <h4><i class="bi bi-telephone"></i> Teléfono</h4>
                    <p>+123 456 7890</p>

                    <h4><i class="bi bi-envelope"></i> Correo Electrónico</h4>
                    <p>contacto@ejemplo.com</p>

                    <h4><i class="bi bi-facebook"></i> Síguenos en Redes Sociales</h4>
                    <ul class="list-unstyled">
                        <li><a href="https://www.facebook.com/ejemplo" target="_blank">Facebook</a></li>
                        <li><a href="https://twitter.com/ejemplo" target="_blank">Twitter</a></li>
                        <li><a href="https://www.instagram.com/ejemplo" target="_blank">Instagram</a></li>
                    </ul>

                    <h4><i class="bi bi-clock"></i> Horarios de Atención</h4>
                    <p>Lunes a Viernes: 9:00 AM - 6:00 PM</p>
                    <p>Sábados: 10:00 AM - 2:00 PM</p>

                    <h4><i class="bi bi-signpost"></i> Cómo Llegar</h4>
                    <p>Nos encontramos ubicados en el centro de la ciudad, cerca de la estación de metro Ejemplo. Puedes llegar fácilmente en transporte público.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
    <!-- Agrega Bootstrap (ya debería estar incluido en tu proyecto) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Agrega Bootstrap Icons (solo si aún no lo tienes en tu proyecto) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
@endpush

@push('scripts')
    <!-- Agrega Bootstrap JS (opcional si ya lo tienes) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
@endpush
