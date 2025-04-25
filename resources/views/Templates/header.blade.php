<?php
use App\Http\Controllers\ProductoController;
$total = ProductoController::itemCarrito();

?>
@extends('master')




<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Barra Navegador -->
<nav class="navbar navbar-expand-md"
    style="background-color: #fd7e14;height: 5rem;box-shadow: 2px 2px 5px rgb(131, 131, 131);">
    <div class="container-fluid">
        <a class="navbar-brand" href="/"><img class="w-25 ms-5" src="{!! asset('imagenes/logoEmpresa.png') !!}" alt=""></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
            aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>




        <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <!-- <a class="nav-link active" aria-current="page" href="/">Inicio</a>
                    <a class="nav-link" href="#">Quienes Somos</a>
                    <a class="nav-link" href="#">Proveedores</a>
                    <a class="nav-link" href="#">Preguntas Frecuentes</a> -->

                <div class="me-lg-5">


                    @guest

                        <a class="btn btn-outline-dark btn-sm me-2 mb-2" href="/opcion_login">Iniciar Sesión</a>
                        <a class="btn btn-dark btn-sm mb-2" href="/opcion_registro">Registrarse</a>


                    @endguest
                    @auth
                        <a href="/lista_carrito" id="btn-nav" class="bi bi-cart ms-4">
                            <h4 class="d-inline" style="font-weight: lighter;">
                                <span id="contador-carrito" class="badge bg-warning text-dark">
                                    {{ $total }}
                                </span>



                            </h4>
                        </a>
                        <li class="nav-item dropdown d-inline">
                            <a class="nav-link dropdown-toggle d-inline" href="#" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <h4 class="bi bi-person d-inline" style="font-weight: lighter;color: black;">
                                    {{ Auth::user()->name }}</h4>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="/mis_ordenes">Mis Ordenes</a></li>
                                <li><a class="dropdown-item" href="/perfil">Perfil</a></li>
                                <li><a class="dropdown-item" href="/logout">Cerrar Sesión</a></li>

                            </ul>
                        </li>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</nav>
