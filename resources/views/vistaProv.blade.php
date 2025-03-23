@extends('master')
@section('content')

{{View::make('Templates.header')}}

<div class="row" id="box-search">
    <div class="thumbnail "> 
        <img class="img-fluid" id="foto" src="{!! asset('imagenes/tiendaRopa.jpg') !!}" style="opacity: 0.7;"> 
        <div class="caption">
            <div class="container mt-3 mb-5">
                <div class="row" style="height:30rem;">
                    <div class="col-md-3">
                        <img src="{{ asset('storage').'/'.$producto->imagen }}" class="card-img-top" alt="..." style="margin-top: 1rem;">
                    </div>
                    <div class="col-md-9" style="color: white;">
                        <h1>{{ $producto['titulo'] }}</h1>
                        <h2>Proveedor: {{ $producto['proveedor'] }}</h2>
                        <h2>Marca: {{ $producto['marca'] }}</h2>
                        <h2>Descripción: </h2><h5>{{ $producto['descripcion'] }}</h5>
                        <h2>${{ $producto['precio'] }}</h2>
                        <div class="mt-4">
                            <form action="/añadir_carrito" method="POST">
                                @csrf
                                <input type="hidden" name="producto_id" value="{{ $producto->id }}">
                                <button class="btn btn-success">Añadir al Carrito</button>
                            </form>
                        </div>
                    </div>
                    <div class="container">
                        <h1 style="color: white;margin-top: 5rem;">Reseñas</h1>
                        <div class="card mb-3">
                            <div class="card-body">
                                <h5 class="card-title">Roberto Valenzuela Henríquez</h5>
                                <h6 class="card-subtitle mb-2 text-muted">Cantidad: 50</h6>
                                <p class="card-text">¡Excelente! muy contento con la compra, el producto es como en la descripción, de buena calidad con un diseño simple pero elegante. Contento con la compra</p>
                            </div>
                        </div>
                        <div class="card mb-3">
                            <div class="card-body">
                                <h5 class="card-title">Felipe Agurto Henríquez <i class="bi bi-trash justify-content-end"></i></h5>
                                <h6 class="card-subtitle mb-2 text-muted">Cantidad: 20</h6>
                                <p class="card-text">Buena calidad. El producto cumple con la descripción pero el diseño muy simple a mi gusto. De poder venderlos compraré más</p>
                            </div>
                        </div>
                        <div class="card mb-3">
                            <div class="card-body">
                                <h5 class="card-title">Junior Mbappe Fernandez</h5>
                                <h6 class="card-subtitle mb-2 text-muted">Cantidad: 35</h6>
                                <p class="card-text">Me gusto la simplesa del diseño, no es muy llamativa y es elegante, como me gustan las poleras.</p>
                            </div>
                        </div>
                        @auth
                            <div class="card mb-3">
                                <textarea name="" id="" cols="20" rows="3" placeholder="Ingrese Comentario"></textarea>
                            </div>
                        @endauth
                        
                    </div>
                </div>
            </div>
        </div> 
    </div> 
</div> 

{{View::make('Templates.footer')}}

@endsection