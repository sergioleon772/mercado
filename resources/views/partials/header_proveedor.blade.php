@extends('master')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mercado</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js"
        integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous">
    </script>
</head>

<body>
    <!-- Barra Navegador -->
    <nav class="navbar navbar-expand-lg"
        style="background-color: #fd7e14;height: 5rem;box-shadow: 2px 2px 5px rgb(131, 131, 131);">
        <div class="container-fluid">
            <a class="navbar-brand" href="/dashboard_proveedor"><img class="w-25 ms-5" src="{!! asset('imagenes/logoEmpresa.png') !!}"
                    alt=""></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <div style="margin-right: 5rem;">
                        @guest
                            <a class="btn btn-outline-dark" href="opcion_login">Iniciar Sesión</a>
                            <a class="btn btn-dark" href="opcion_registro">Registrarse</a>
                        @endguest
                        @auth

                            <li class="nav-item dropdown d-inline">
                                <a class="nav-link dropdown-toggle d-inline" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <h4 class="bi bi-person d-inline" style="font-weight: lighter;color: black;">
                                        {{ optional(Auth::guard('proveedor')->user())->marca ?? 'Proveedor' }}</h4>
                                </a>
                                <ul class="dropdown-menu">

                                    <li><a class="dropdown-item" href="/perfil_proveedor">Perfil</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="/logout">Cerrar Sesión</a></li>
                                </ul>
                            </li>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Fin barra navegador -->
