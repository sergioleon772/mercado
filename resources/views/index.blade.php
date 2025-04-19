@extends('master')
@section('content')
    {{ View::make('Templates.header') }}
    @guest
        <!-- Bienvenida -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="container">
            <div class="row" style="margin-top: 5rem;">
                <div class="col-sm-12 col-md-5 text-center" style="margin-top: 10rem;">
                    <h1 id="fuente">Bienvenido a</h1>
                    <h1 id="fuente">Mercado Proveedores</h1>
                    <p id="fuente">Todo lo que necesites con las mejores opciones</p>
                    <div style="margin-left: 5rem;">
                    </div>

                </div>
                <div class="col-sm-12 col-md-7">
                    <img class="logo1" src="{!! asset('imagenes/logo1.png') !!}"
                        style="max-width: 100%; height: auto; display: block; margin: 0 auto;">

                </div>
            </div>
        </div>

        <!-- Fin Bienvenida -->
    @endguest

    @auth

        <div class="container">
            <div class="row" style="margin-top: 5rem;">
                <div class="col-sm-12 col-md-5 text-center" style="margin-top: 10rem;">
                    <h1 id="fuente">Bienvenido a Mercado Proveedores</h1>
                    <p id="fuente">Todo lo que necesites con las mejores opciones</p>
                    <h4 id="fuente">¡Hola {{ Auth::user()->name }}!</h4>
                </div>
                <div class="col-sm-12 col-md-7">
                    <img class="logo1" src="{!! asset('imagenes/logo1.png') !!}">
                </div>
            </div>
        </div>
    @endauth

    <!-- Te Ofrecemos -->
    <div class="container mt-5">
        <div class="row text-center">
            <h1 class="mb-5" style="font-weight: lighter;">Te Ofrecemos</h1>
            <div class="col">
                <i class="bi bi-cart3" style="font-size: 4rem;"></i>
                <h3 style="font-weight: lighter;">PRODUCTOS PARA TI</h3>
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Maxime, natus qui. Nihil, molestiae nobis
                    facilis commodi magni dicta, voluptas animi porro eum modi eaque amet rem beatae. Tempora, officia nemo?
                </p>
            </div>
            <div class="col">
                <i class="bi bi-box-seam" style="font-size: 4rem;"></i>
                <h3 style="font-weight: lighter;">GESTIONAMOS TUS COMPRAS</h3>
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Maxime, natus qui. Nihil, molestiae nobis
                    facilis commodi magni dicta, voluptas animi porro eum modi eaque amet rem beatae. Tempora, officia nemo?
                </p>
            </div>
            <div class="col">
                <i class="bi bi-truck-flatbed" style="font-size: 4rem;"></i>
                <h3 style="font-weight: lighter;">ENVÍO A LOCAL</h3>
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Maxime, natus qui. Nihil, molestiae nobis
                    facilis commodi magni dicta, voluptas animi porro eum modi eaque amet rem beatae. Tempora, officia nemo?
                </p>
            </div>
        </div>
    </div>
    <!-- Fin Te Ofrecemos -->

    <!-- Carousel con productos -->
    <!-- Carousel con productos mejorado -->
    <div id="carouselExampleControls" class="container carousel slide" data-bs-ride="carousel">
        <h1 class="text-center mt-5" style="font-weight: lighter;">Productos Mas vistos</h1>
        <div class="carousel-inner">
            @foreach ($productos as $index => $producto)
                <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                    <div class="d-flex justify-content-center">
                        <div class="card shadow-sm" style="width: 18rem;">
                            <img src="{{ $producto->imagen }}" width="auto" alt="{{ $producto->titulo }}">
                            <div class="card-body text-center">
                                <h5 class="card-title">{{ $producto->titulo }}</h5>
                                <p class="card-text small">{{ Str::limit($producto->descripcion, 100) }}</p>
                                <a href="#" class="btn btn-primary btn-sm">Ver más</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>

        <div class="d-flex justify-content-center mt-3">

            <a href="{{ url('catalogo') }}" class="btn btn-success rounded-pill w-100 w-md-25">Ver más productos</a>

        </div>
    </div>

    <!-- Fin Carousel con productos -->

    <!-- Contacto -->


    <div id="prob">
        <div class="container w-100 w-md-75 w-lg-50">

            <h1 class="text-center" id="fuente">Contacto</h1>
            <form action="{{ route('contact') }}" method="POST" id="fuente" class="row g-2">
                @csrf <!-- Asegúrate de incluir la protección CSRF -->

                <div class="col-12">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" name="nombre" class="form-control" required placeholder="Ingrese su nombre">
                </div>
                <div class="col-12">
                    <label for="direccion" class="form-label">Direccion</label>
                    <input type="text" name="direccion" class="form-control" required placeholder="Ingrese su direccion">
                </div>
                <div class="col-6">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" required placeholder="Ingrese su email">
                </div>
                <div class="col-6">
                    <label for="telefono" class="form-label">Telefono</label>
                    <input type="number" name="telefono" class="form-control" required
                        placeholder="Ingrese su telefono">
                </div>
                <div class="col-12">
                    <label for="asunto" class="form-label">Asunto</label>
                    <input type="text" name="asunto" class="form-control" required placeholder="Ingrese su asunto">
                </div>
                <div class="col-12">
                    <label for="mensaje" class="form-label">Mensaje</label>
                    <textarea name="mensaje" class="form-control" cols="30" rows="5" required></textarea>
                </div>

                <div class="col-12 d-flex justify-content-center">
                    <button class="btn btn-dark">Enviar</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Fin Contacto -->

    {{ View::make('Templates.footer') }}
@endsection
