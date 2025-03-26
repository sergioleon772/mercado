<?php

namespace App\Http\Controllers;

use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use App\Http\Requests\LoginRequest;
use App\Models\Carrito;
use App\Models\Orden;
use App\Models\Producto;
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
        $datos['productos'] = Producto::all();
        return view('Admin.productos.productos',$datos);
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
            return view('producto.create');
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
        if(Auth::check()){
            $producto = Producto::findOrFail($id);
            return view('producto.edit',compact('producto'));
        }
        return redirect('/');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    
     

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

    public function añadirCarrito(Request $req){
        if(Auth::check()){
            $carrito = new Carrito();
            $carrito->user_id = Auth::user()->id;
            $carrito->producto_id = $req->producto_id;
            $carrito->save();
            return redirect('catalogo')->with('success','Producto agregado al carrito');
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
        $productos = DB::table('carrito')
        ->join('productos','carrito.producto_id','=','productos.id')
        ->where('carrito.user_id',$userId)
        ->select('productos.*','carrito.id as carrito_id')
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
        $allCarrito = Carrito::where('user_id',$userId)->get();
        foreach($allCarrito as $carrito){
            $order = new Orden;
            $order->producto_id = $carrito['producto_id'];
            $order->user_id = $carrito['user_id'];
            $order->metodo_pago = $req->metodo_pago;
            $order->estado_pago = 'Pendiente';
            $order->estado = 'Pendiente';
            $order->direccion = $req->direccion;
            $order->save();
            Carrito::where('user_id',$userId)->delete();
        }
        
        return redirect('/')->with('success','Pedido Realizado');
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
