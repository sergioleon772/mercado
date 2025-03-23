<?php

use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// AUTH

Route::get('opcion_login',function(){return view('opcion_login');});
Route::get('/registrarse', [RegisterController::class,'show'] );
Route::post('/registrarse', [RegisterController::class,'register'] );

Route::get('/login', [LoginController::class,'show']);
Route::post('/login', [LoginController::class,'login']);

// HOME
// Route::get('/', function () {return view('index');});
Route::get('/', [ProductoController::class, 'home']);
Route::get('catalogo', [ProductoController::class, 'catalogo']);

Route::get('/logout', [LogoutController::class,'logout']);


Route::get('/perfil', function () {
    return view('perfil');
});

// PRODCUTO
// Route::get('/producto/indexProd', [ProductoController::class,'index']);
// Route::get('/producto/create', [ProductoController::class,'create']);
Route::resource('producto',ProductoController::class);
// Route::get('producto/index',ProductoController::class,'vista');

//CARRITO Y ORDEN
Route::post('/añadir_carrito', [ProductoController::class,'añadirCarrito']);
Route::get('/lista_carrito', [ProductoController::class,'listaCarrito']);
Route::get('/quitar_carrito/{id}', [ProductoController::class,'quitarCarrito']);
Route::get('/ordenar_ahora', [ProductoController::class,'ordenarAhora']);
Route::post('/lugar_pedido', [ProductoController::class,'lugarPedido']);
Route::get('/mis_ordenes', [ProductoController::class,'misOrdenes']);

//PERFIL USUARIO
Route::get('perfil',[UserController::class,'show']);

//PROVEEDOR
Route::get('login_proveedor',function(){
    return view('proveedor/login_proveedor');
});
Route::get('registro_proveedor',function(){
    return view('proveedor/registro_proveedor');
});

Route::get('/admin', function () {
    return view('admin/admin');
});


// COMPRADOR
Route::get('compradores', function () {
    return view('admin/comprador/compradores');
});
Route::get('registrarComp', function () {
    return view('admin/comprador/registrarComp');
});
Route::get('actualizarComp', function () {
    return view('admin/comprador/actualizarComp');
});
Route::get('eliminarComp', function () {
    return view('admin/comprador/eliminarComp');
});

// PROVEEDOR
Route::get('proveedores', function () {
    return view('admin/proveedor/proveedores');
});
Route::get('registrarProv', function () {
    return view('admin/proveedor/registrarProv');
});
Route::get('actualizarProv', function () {
    return view('admin/proveedor/actualizarProv');
});
Route::get('eliminarProv', function () {
    return view('admin/proveedor/eliminarProv');
});
Route::get('/vistaProv', function () {
    return view('vistaProv');
});
Route::get('admin/perfilVendedor', function () {
    return view('perfilVendedor');
});

// PRODUCTO
Route::get('admin/productos', function () {
    return view('admin/productos/productos');
});
Route::get('admin/eliminarProd', function () {
    return view('admin/productos/eliminarProd');
});

// CONTACTO
Route::get('admin/contactos', function () {
    return view('admin/contactos');
});

// CATALOGO
Route::get('/catalogo', function () {
    return view('catalogo');
});


