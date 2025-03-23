@extends('master')
@section('content')

    {{View::make('Templates.header')}}
    @guest
    <!-- Bienvenida -->
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
                <img class="logo1" src="{!! asset('imagenes/logo1.png') !!}">
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
                <h4 id="fuente">¡Hola {{Auth::user()->name}}!</h4>
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
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Maxime, natus qui. Nihil, molestiae nobis facilis commodi magni dicta, voluptas animi porro eum modi eaque amet rem beatae. Tempora, officia nemo?</p>
            </div>
            <div class="col">
                <i class="bi bi-box-seam" style="font-size: 4rem;"></i>
                <h3 style="font-weight: lighter;">GESTIONAMOS TUS COMPRAS</h3>
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Maxime, natus qui. Nihil, molestiae nobis facilis commodi magni dicta, voluptas animi porro eum modi eaque amet rem beatae. Tempora, officia nemo?</p>
            </div>
            <div class="col">
                <i class="bi bi-truck-flatbed" style="font-size: 4rem;"></i>
                <h3 style="font-weight: lighter;">ENVÍO A LOCAL</h3>
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Maxime, natus qui. Nihil, molestiae nobis facilis commodi magni dicta, voluptas animi porro eum modi eaque amet rem beatae. Tempora, officia nemo?</p>
            </div>
        </div>
    </div>
    <!-- Fin Te Ofrecemos -->

    <!-- Carousel con productos -->
    <div id="carouselExampleControls" class="container carousel slide" data-bs-ride="carousel">
        <h1 class="text-center mt-5" style="font-weight: lighter;">Productos Disponibles</h1>
        <div class="carousel-inner">
            @foreach ( $productos as $producto )
            <div class="carousel-item {{ $producto['id']==1?'active':'' }}">
                <img src="{{ asset('storage').'/'.$producto->imagen }}" class="d-block " alt="...">
                <div class="carousel-caption rounded-pill" id="caption-carousel" >
                    <h1 style="font-weight: lighter;" id="fuente">{{ $producto['titulo'] }}</h1>
                    <p id="fuente">{{ $producto['descripcion'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
        
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true" id="btn-carousel"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true" id="btn-carousel"></span>
            <span class="visually-hidden">Next</span>
        </button>
        <div class="d-flex justify-content-center">
            <a href="catalogo" class="btn btn-success rounded-pill w-25">Ver más productos</a>
        </div>
        
    </div>
    <!-- Fin Carousel con productos -->

    <!-- Contacto -->
    <div id="prob">
        <div class="container w-50">
            <h1 class="text-center" id="fuente">Contacto</h1>
            <form action="" id="fuente" class="row g-2">
                <div class="col-12">
                    <label for="exampleFormControlInput1" class="form-label">Nombre</label>
                    <input type="email" class="form-control" require id="exampleFormControlInput1" placeholder="Ingrese su nombre"> 
                </div>
                <div class="col-12">
                    <label for="exampleFormControlInput1" class="form-label">Direccion</label>
                    <input type="text" class="form-control" require id="exampleFormControlInput1" placeholder="Ingrese su direccion"> 
                </div>
                <div class="col-6">
                    <label for="exampleFormControlInput1" class="form-label">Email</label>
                    <input type="text" class="form-control" require id="exampleFormControlInput1" placeholder="Ingrese su email"> 
                </div>
                <div class="col-6">
                    <label for="exampleFormControlInput1" class="form-label">Telefono</label>
                    <input type="text" class="form-control" require id="exampleFormControlInput1" placeholder="Ingrese su telefono"> 
                </div>
                <div class="col-12">
                    <label for="exampleFormControlInput1" class="form-label">Asunto</label>
                    <input type="text" class="form-control" require id="exampleFormControlInput1" placeholder="Ingrese su asunto"> 
                </div>
                <div class="col-12">
                    <label for="exampleFormControlInput1" class="form-label">Mensaje</label>
                    <textarea class="form-control" cols="30" rows="5"></textarea>
                </div>

                <div class="col-12 d-flex justify-content-center">
                    <button class="btn btn-dark">Enviar</button>
                </div>
                
            </form>
        </div>
    </div>
    <!-- Fin Contacto -->

    {{View::make('Templates.footer')}}

@endsection