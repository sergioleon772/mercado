<!-- partials/carrito-contenido.blade.php -->
<ul class="list-group">
    @foreach ($carrito as $productoId => $producto)
        <li class="list-group-item d-flex justify-content-between align-items-center">
            {{ $producto['titulo'] }} - ${{ number_format($producto['precio'], 2) }} x {{ $producto['cantidad'] }}
        </li>
    @endforeach
</ul>
