<?php

namespace App\Http\Controllers;

use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use App\Http\Requests\LoginRequest;
use App\Models\Carrito;
use App\Models\Orden;
use App\Models\Producto;
use App\Models\Proveedor;
use App\Models\Contacto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productos = Producto::with('proveedor')->paginate(4); // ✅ ESTA LÍNEA ES CLAVE
        return view('Admin.productos.productos', compact('productos'));
        #$datos['productos'] = Producto::all();
        #return view('Admin.productos.productos',$datos);
    }
    public function home()
    {
        $datos['productos'] = Producto::paginate(5);
        return view('index',$datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $req)
    {
        if(Auth::check()){
            $proveedores = Proveedor::all();  // Obtener todos los proveedores
            return view('producto.create', ['proveedores' => $proveedores]);
        }
        return redirect('/');
    }
    public function storeproveedor(Request $request)
{
    $request->validate([
        'proveedor_id' => 'required',
        'titulo' => 'required|string|max:255',
        'marca' => 'required|string|max:255',
        'precio' => 'required|numeric|min:0',
        'cantidad' => 'required|integer|min:1',
        'imagen' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        'descripcion' => 'required|string|max:1000',
    ]);
    $datosProducto = request()->except('_token');

    if ($request->hasFile('imagen')) {
        $uploadedFile = $request->file('imagen');

        // Subir a Cloudinary y obtener la URL
        $uploadedImage = Cloudinary::upload($uploadedFile->getRealPath(), [
            'folder' => 'productos' // Carpeta en Cloudinary
        ]);

        $datosProducto['imagen'] = $uploadedImage->getSecurePath(); // URL de la imagen
    }

    Producto::insert($datosProducto);
    return redirect('ver_productos')->with('success', 'Producto ingresado');
}
public function editProveedor($id)
{
    $producto = Producto::where('proveedor_id', auth()->user()->id)->findOrFail($id);
    return view('producto.edit', compact('producto'));
}



public function updateProveedor(Request $request, $id)
{
    $producto = Producto::where('proveedor_id', auth()->user()->id)->findOrFail($id);

    // Validación de los datos
    $request->validate([
        'titulo' => 'required|string|max:255',
        'marca' => 'required|string|max:255',
        'precio' => 'required|numeric|min:0',
        'cantidad' => 'required|integer|min:1',
        'descripcion' => 'nullable|string',
        'imagen' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    // Actualizar los campos básicos
    $producto->titulo = $request->titulo;
    $producto->marca = $request->marca;
    $producto->precio = $request->precio;
    $producto->cantidad = $request->cantidad;
    $producto->descripcion = $request->descripcion;

    // Si el usuario sube una nueva imagen
    if ($request->hasFile('imagen')) {
        // Eliminar la imagen anterior de Cloudinary si existe
        if ($producto->imagen) {
            // Extraer el public_id de la URL almacenada en la base de datos
            $publicId = pathinfo($producto->imagen, PATHINFO_FILENAME);
            Cloudinary::destroy("productos/{$publicId}");
        }

        // Subir la nueva imagen a Cloudinary
        $uploadedImage = Cloudinary::upload($request->file('imagen')->getRealPath(), [
            'folder' => 'productos', // Carpeta donde se guardarán las imágenes en Cloudinary
        ]);

        // Guardar la URL de la nueva imagen en la base de datos
        $producto->imagen = $uploadedImage->getSecurePath();
    }

    $producto->save();
    
    
    return redirect('ver_productos')->with('success', 'Producto actualizado correctamente.');
}
public function destroyProveedor($id)
{
    $producto = Producto::findOrFail($id);

    // Verifica si el usuario autenticado es el proveedor del producto
    if (Auth::guard('proveedor')->check() && Auth::id() == $producto->proveedor_id) {
        $producto->delete();
        return redirect()->back()->with('success', 'Producto eliminado correctamente.');
    }

    return redirect()->back()->with('error', 'No tienes permiso para eliminar este producto.');
}



    public function createProveedor()
{
    if (Auth::guard('proveedor')->check()) {
        $proveedor = Auth::guard('proveedor')->user();  // Proveedor solo se ve a sí mismo
        return view('producto.create', ['proveedores' => [$proveedor]]);
    }
    return redirect('/');
}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    

     public function store(Request $request)
     {
         $request->validate([
             'proveedor_id' => 'required',
             'titulo' => 'required|string|max:255',
             'marca' => 'required|string|max:255',
             'precio' => 'required|numeric|min:0',
             'cantidad' => 'required|integer|min:1',
             'imagen' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
             'descripcion' => 'required|string|max:1000',
         ],[
            'proveedor_id.unique' => 'El RUT ya ha sido registrado.',
        ]);
     
         // Obtener todos los datos del request excepto el token
         $datosProducto = $request->except('_token');
         $datosProducto['proveedor'] = $request->input('proveedor_id');
         // Si se sube una imagen, se procesa y se agrega la URL
         if ($request->hasFile('imagen')) {
             $uploadedFile = $request->file('imagen');
     
             // Subir a Cloudinary y obtener la URL
             $uploadedImage = Cloudinary::upload($uploadedFile->getRealPath(), [
                 'folder' => 'productos'
             ]);
     
             // Agregar la URL de la imagen al array de datos
             $datosProducto['imagen'] = $uploadedImage->getSecurePath();
         }
     
         // Usar el modelo Eloquent para crear un nuevo producto
         Producto::create($datosProducto);
     
         return redirect('producto')->with('success', 'Producto ingresado');
     }
     


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Producto::findOrFail($id);
        return view('vistaProv',['producto'=>$data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $producto = Producto::findOrFail($id);

    if (Auth::guard('proveedor')->check()) {
        // Si el usuario es proveedor, solo le pasamos su producto
        return view('producto.edit', compact('producto'));
    } else {
        // Si el usuario es admin, necesita la lista de proveedores
        $proveedores = Proveedor::all();
        return view('producto.edit', compact('producto', 'proveedores'));
    }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    
     

     
     
     public function verCarrito()
     {
         $userId = Auth::id(); // Obtiene el ID del usuario autenticado
         
         $productosAgrupados = DB::table('carrito')
             ->join('productos', 'carrito.producto_id', '=', 'productos.id')
             ->where('carrito.usuario_id', $userId)
             ->select(
                 'productos.id',
                 'productos.titulo',
                 'productos.imagen',
                 'productos.precio',
                 'productos.proveedor',
                 'productos.descripcion',
                 DB::raw('COUNT(carrito.producto_id) as cantidad_total'),
                 DB::raw('MAX(productos.cantidad) as stock_disponible'), // Cantidad disponible según proveedor
                 DB::raw('MIN(carrito.id) as carrito_id') // Para quitar del carrito
             )
             ->groupBy('productos.id', 'productos.titulo', 'productos.imagen', 'productos.precio', 'productos.proveedor', 'productos.descripcion')
             ->get();
     
         // Calcular el total de productos en el carrito
         $total = $productosAgrupados->sum('cantidad_total');
     
         return view('carrito', compact('productosAgrupados', 'total'));
     }
     



     public function update(Request $request, $id)
     {
         $datosProducto = request()->except(['_token', '_method']);
     
         if ($request->hasFile('imagen')) {    // Verificar si hay una nueva imagen
             $producto = Producto::findOrFail($id);
     
             // Eliminar la imagen anterior de Cloudinary (si existe)
             if ($producto->imagen) {
                 // Extraer el public_id incluyendo la carpeta 'productos'
                 $publicId = $this->getCloudinaryPublicId($producto->imagen);
                 
                 // Eliminar la imagen de Cloudinary
                 Cloudinary::destroy($publicId); // Elimina la imagen de Cloudinary
             }
     
             // Subir la nueva imagen a Cloudinary
             $uploadedImage = Cloudinary::upload($request->file('imagen')->getRealPath(), [
                 'folder' => 'productos', // Especifica la carpeta de almacenamiento en Cloudinary
             ]);
     
             // Obtener la URL segura de la imagen subida
             $datosProducto['imagen'] = $uploadedImage->getSecurePath(); // Guarda la URL de la imagen subida
         }
     
         // Actualizar el producto en la base de datos
         Producto::where('id', '=', $id)->update($datosProducto);
     
         // Redirigir a la lista de productos con un mensaje de éxito
         return redirect('/producto')->with('success', 'Producto actualizado exitosamente');
     }
     
     /**
      * Función para obtener el public_id de Cloudinary
      * a partir de la URL de la imagen almacenada, considerando la carpeta 'productos'
      */
     private function getCloudinaryPublicId($url)
     {
         // Obtener la parte de la URL que contiene el public_id
         $path = parse_url($url, PHP_URL_PATH); // Obtiene el path de la URL
         $pathArray = explode('/', $path); // Divide la URL en partes
     
         // El public_id es la parte después de 'productos/'
         // y antes de la extensión de la imagen (ejemplo .jpg, .png)
         array_shift($pathArray); // Elimina la parte 'image'
         array_shift($pathArray); // Elimina 'upload'
         
         $publicId = implode('/', $pathArray); // Crear el public_id con la carpeta 'productos'
     
         return $publicId;
     }
     
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Auth::check()){
            $producto = Producto::findOrFail($id);

            if(Storage::delete('public/'.$producto->imagen)){
                Producto::destroy($id);
            }

            return redirect('producto')->with('success','Producto '.$producto->titulo.' Borrado');
        }
        return redirect('/');
    }

    /***public function añadirCarrito(Request $req){
        if(Auth::check()){
            $carrito = new Carrito();
            $carrito->user_id = Auth::user()->id;
            $carrito->producto_id = $req->producto_id;
            $carrito->save();
            return redirect('catalogo')->with('success','Producto agregado al carrito');
        }
        return redirect('/login');
    }*/
    public function añadirCarrito(Request $req)
{
    if (Auth::check()) {
        $producto_id = $req->producto_id;
        $user_id = Auth::user()->id;

        // Verificar si el producto ya está en el carrito
        $carrito = Carrito::where('user_id', $user_id)
                         ->where('producto_id', $producto_id)
                         ->first();

        if (!$carrito) {
            // Si el producto no está en el carrito, agregarlo con cantidad 1
            $carrito = new Carrito();
            $carrito->user_id = $user_id;
            $carrito->producto_id = $producto_id;
            $carrito->cantidad = 1;  // Establecer la cantidad a 1 al agregarlo por primera vez
            $carrito->save();
        } else {
            // Si el producto ya está en el carrito, aumentar la cantidad
            $carrito->cantidad++;
            $carrito->save();
        }

        return redirect('catalogo')->with('success', 'Producto agregado al carrito');
    }

    return redirect('/login');
}



    static function itemCarrito(){
        if(Auth::check()){
            $userId = Auth::user()->id;
            return Carrito::where('user_id',$userId)->count();
        }
    }
    public function listaCarrito(){
        if(!Auth::check()){
            return redirect('/login');
        }
        $userId = Auth::user()->id;
        /*$productos = DB::table('carrito')
        ->join('productos','carrito.producto_id','=','productos.id')
        ->where('carrito.user_id',$userId)
        ->select('productos.*','carrito.id as carrito_id')
        ->get();*/

        $productos = DB::table('carrito')
    ->join('productos', 'carrito.producto_id', '=', 'productos.id')
    ->leftJoin('proveedores', 'productos.proveedor_id', '=', 'proveedores.id')
    ->where('carrito.user_id', $userId)
    ->select('productos.*', 'carrito.id as carrito_id', 'proveedores.marca as proveedor_marca')
    ->get();


        return view('lista_carrito',['productos'=>$productos]);
    }
    public function quitarCarrito($id){
        Carrito::destroy($id);
        return redirect('lista_carrito')->with('success','Producto quitado del carrito');
    }

    public function ordenarAhora(){
        if(!Auth::check()){
            return redirect('/login');
        }
        $userId = Auth::user()->id;
        $total = $productos = DB::table('carrito')
        ->join('productos','carrito.producto_id','=','productos.id')
        ->where('carrito.user_id',$userId)
        ->sum('productos.precio');

        return view('ordenar_ahora',['total'=>$total]);
    }
    public function lugarPedido(Request $req){
        if(!Auth::check()){
            return redirect('/login');
        }
    
        $userId = Auth::user()->id;
        $allCarrito = Carrito::where('user_id', $userId)->get();
    
        // Inicializamos el precio total
        $precioTotal = 0;
    
        foreach($allCarrito as $carrito){
            // Obtener el precio del producto
            $producto = Producto::find($carrito->producto_id);
            if (!$producto) {
                continue; // Si no se encuentra el producto, saltamos al siguiente
            }
    
            // Sumar el precio del producto al total
            $precioTotal += $producto->precio; // Suponiendo que el producto tiene un campo "precio"
            
            // Guardar en la tabla ordenes
            $order = new Orden;
            $order->producto_id = $producto->id;
            $order->user_id = $userId;
            $order->metodo_pago = $req->metodo_pago;
            $order->estado_pago = 'Pendiente';
            $order->estado = 'Pendiente';
            $order->direccion = $req->direccion;
            $order->precio = $precioTotal; // Ahora guardamos el precio total
            $order->save();
        }
    
        // Eliminar productos del carrito después de guardar la orden
        Carrito::where('user_id', $userId)->delete();
        
        return redirect('/')->with('success', 'Pedido Realizado');
    }
    
    public function misOrdenes(){
        if(!Auth::check()){
            return redirect('/login');
        }
        $userId = Auth::user()->id;
        $ordenes = DB::table('ordenes')
        ->join('productos','ordenes.producto_id','=','productos.id')
        ->where('ordenes.user_id',$userId)
        ->get();

        return view('mis_ordenes',['ordenes'=>$ordenes]);
    }

    

    public function contact(Request $request)
    {
    // Validación de los datos del formulario
        $validated = $request->validate([
            'nombre' => 'required|string',
            'direccion' => 'required|string',
            'email' => 'required|email',
            'telefono' => 'required|string',
            'asunto' => 'required|string',
            'mensaje' => 'required|string',
        ]);

        // Guardar los datos en la tabla "contactos"
        Contacto::create($validated);

        // Redireccionar con un mensaje de éxito
        return back()->with('success', 'Mensaje enviado con éxito');
    }

}
