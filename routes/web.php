<?php

use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProveedorRegisterController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Aquí es donde puedes registrar las rutas web para tu aplicación.
| Las rutas se cargan dentro del grupo de middleware "web".
|
*/

// AUTH
Route::get('opcion_login', function() {
    return view('opcion_login');
});

Route::get('opcion_registro', function() {
    return view('opcion_registro');
});

Route::get('/registrarse', [RegisterController::class, 'show']);
Route::post('/registrarse', [RegisterController::class, 'register']);


// PROVEEDOR
Route::get('login_proveedor', function() {
    return view('proveedor/login_proveedor');
});
Route::get('/registro_proveedor', function() {
    return view('proveedor/registro_proveedor');
});
Route::post('/registrarse1', [ProveedorRegisterController::class, 'registrar_proveedor']);
Route::post('/loginprovedor', [ProveedorRegisterController::class, 'login']);
Route::get('/loginprovedor', [ProveedorRegisterController::class, 'index'])->name('loginprovedor.form');



Route::get('/dashboard_proveedor', [ProveedorRegisterController::class, 'index'])
    ->middleware('auth:proveedor') // Esto asegura que solo los proveedores autenticados pueden acceder al dashboard
    ->name('dashboard.proveedor');



Route::middleware(['auth:proveedor'])->group(function () {
    Route::get('/perfil_proveedor', [ProveedorRegisterController::class, 'perfil'])->name('perfil_proveedor');
    Route::get('/perfil', [ProveedorRegisterController::class, 'edit'])->name('proveedor.perfil');
    Route::post('/actualizar', [ProveedorRegisterController::class, 'update'])->name('actualizar');
    Route::post('/actualizar-password', [ProveedorRegisterController::class, 'updatePassword'])->name('updatePassword');
    Route::get('/ver_productos',[ProveedorRegisterController::class, 'indexprod']);
    
    Route::get('/producto/create/proveedor', [ProductoController::class, 'createProveedor'])->name('producto.create.proveedor');
   
Route::post('/producto1', [ProductoController::class, 'storeproveedor'])->name('producto.store');
Route::get('/producto1/{id}/edit', [ProductoController::class, 'editProveedor'])->name('producto1.edit');
    Route::post('/producto1/{id}/update', [ProductoController::class, 'updateProveedor'])->name('producto1.update');
    Route::delete('/producto1/{id}', [ProductoController::class, 'destroyProveedor'])->name('producto1.destroy');


    // Ruta para el proveedor, que acepta POST

// Ruta para el usuario normal, que también acepta POST

});

Route::post('/producto/store', [ProductoController::class, 'store'])->name('producto.store');

Route::get('/login', [LoginController::class, 'show'])->name('login');  // Ruta con nombre 'login'
Route::post('/login', [LoginController::class, 'login']);

Route::get('/logout', [LogoutController::class, 'logout']);

// HOME
Route::get('/', [ProductoController::class, 'home']);
Route::get('catalogo', [ProductoController::class, 'catalogo']);

Route::post('/contacto', [ProductoController::class, 'contact'])->name('contact');  // Enviar mensaje de contacto

Route::get('/perfil', function () {
    return view('perfil');
});



// PRODUCTO
Route::resource('producto', ProductoController::class);

// CARRITO Y ORDEN
Route::get('/carrito/aumentar/{id}', [ProductoController::class, 'aumentarCantidad']);
Route::get('/carrito/disminuir/{id}', [ProductoController::class, 'disminuirCantidad']);

Route::post('/añadir_carrito', [ProductoController::class, 'añadirCarrito']);
Route::get('/lista_carrito', [ProductoController::class, 'listaCarrito']);
Route::get('/quitar_carrito/{id}', [ProductoController::class, 'quitarCarrito']);
Route::get('/ordenar_ahora', [ProductoController::class, 'ordenarAhora']);
Route::post('/lugar_pedido', [ProductoController::class, 'lugarPedido']);
Route::get('/mis_ordenes', [ProductoController::class, 'misOrdenes']);
Route::post('/agregar_carrito', [ProductoController::class, 'agregarCarrito'])->name('agregar_carrito');

// PERFIL USUARIO
Route::get('perfil', [UserController::class, 'show']);


// Middleware para rutas administrativas
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', function () {
        return view('Admin/admin');
    });

    Route::get('compradores', function () {
        return view('Admin/comprador/compradores');
    });

    Route::post('/admin/crear-usuario', [RegisterController::class, 'register'])
        ->name('admin.crear-usuario');



  
    Route::get('/compradores/{id}/editar', [UserController::class, 'edit'])->name('compradores.edit');
    Route::put('/compradores/{id}', [UserController::class, 'update'])->name('compradores.update');
    Route::delete('/compradores/{id}', [UserController::class, 'destroy'])->name('compradores.destroy');


    Route::get('registrarComp', function () {
        return view('Admin/comprador/registrarComp');
    });

    Route::get('actualizarComp', function () {
        return view('Admin/comprador/actualizarComp');
    });

    Route::get('eliminarComp', function () {
        return view('Admin/comprador/eliminarComp');
    });


    // PRODUCTO
    Route::get('admin/productos', function () {
        return view('Admin/productos/productos');
    });
    Route::get('/compradores',[ProveedorRegisterController::class, 'mostrarusuarios'])->name('usuarios');
    Route::get('/proveedores',[ProveedorRegisterController::class, 'mostrarproveedores'])->name('proveedores');
    
    Route::get('/proveedor/{id}/actualizarProv', [ProveedorRegisterController::class, 'actualizarprov'])->name('proveedor.edit');

    Route::patch('/proveedor/{id}', [ProveedorRegisterController::class, 'actualizop'])->name('proveedor.actualizop');

    Route::delete('/proveedor/{id}', [ProveedorRegisterController::class, 'destroy'])->name('proveedor.destroy');

    Route::get('/proveedor/create', [ProveedorRegisterController::class, 'create'])->name('proveedor.create');
    Route::post('/proveedor', [ProveedorRegisterController::class, 'store'])->name('proveedor.store');


    Route::get('admin/eliminarProd', function () {
        return view('Admin/productos/eliminarProd');
    });

    // CONTACTO
    Route::get('/contactos', function () {
        return view('Admin/contactos');
    });
    
});

// CATALOGO
Route::get('/catalogo', function () {
    return view('catalogo');
});
