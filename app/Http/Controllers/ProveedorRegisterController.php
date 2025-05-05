<?php

namespace App\Http\Controllers;
use App\Models\Proveedor;
use App\Models\Producto;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class ProveedorRegisterController extends Controller
{
    public function registrar_proveedor(Request $request)
    {
        $validated = $request->validate([
            'rut_empresa' => 'required|unique:proveedores',
            'password' => 'required|min:6',
            'marca' => 'required',
            'productos_a_comerciar' => 'required',
            'correo' => 'required|email',
            'telefono' => 'required',
            'direccion' => 'required',
        ]);

        Proveedor::create([
            'rut_empresa' => $validated['rut_empresa'],
            'password' => bcrypt($validated['password']),
            'marca' => $validated['marca'],
            'productos_a_comerciar' => $validated['productos_a_comerciar'],
            'correo' => $validated['correo'],
            'telefono' => $validated['telefono'],
            'direccion' => $validated['direccion'],
        ]);

        return redirect('/login_proveedor')->with('success', 'Proveedor registrado correctamente');
    }
    public function google() {
        return view('googleAutocomplete');
      }
      
    
    public function create() {
        return view('Admin.proveedor.registrarProv'); // Vista que usará el admin
    }
    
    
    public function store(Request $request) {
        // Validación
        $request->validate([
            'rut_empresa' => 'required|unique:proveedores,rut_empresa|max:20',
            'password' => 'required|min:6',
            'marca' => 'required',
            'productos_a_comerciar' => 'required',
            'correo' => 'required|email|unique:proveedores,correo',
            'telefono' => 'required|max:15',
            'direccion' => 'required'
        ]);
    
        // Crear nuevo proveedor
        $proveedor = new Proveedor();
        $proveedor->rut_empresa = $request->rut_empresa;
        $proveedor->password = bcrypt($request->password); // Encripta la contraseña
        $proveedor->marca = $request->marca;
        $proveedor->productos_a_comerciar = $request->productos_a_comerciar;
        $proveedor->correo = $request->correo;
        $proveedor->telefono = $request->telefono;
        $proveedor->direccion = $request->direccion;
        $proveedor->save();
    
        return redirect()->route('proveedores')->with('success', 'Proveedor registrado correctamente.');
    }
    
    public function showLoginForm()
    {
        return view('perfilVendedor');  // Asegúrate de que el archivo de la vista sea 'loginprovedor.blade.php'
    }
    

    public function login(Request $request)
{
    $validated = $request->validate([
        'rut_empresa' => 'required|string',
        'password' => 'required|string',
    ]);

    // Intenta autenticar al proveedor
    if (Auth::guard('proveedor')->attempt(['rut_empresa' => $validated['rut_empresa'], 'password' => $validated['password']], true)) {
        // Elimina el dd() y la línea Log::info
        return redirect()->route('dashboard.proveedor'); // Redirige al dashboard después de iniciar sesión
    }

    // Si falla la autenticación
    return back()->withErrors(['error' => 'Credenciales incorrectas']);
}

public function index()
    {
        return view('proveedor.dashboard');
    }
    public function indexprod()
    {    
        if (!Auth::guard('proveedor')->check()) {
            return redirect('/')->with('error', 'Acceso denegado.');
        }
       
        $proveedor = Auth::guard('proveedor')->user();
        
        $productos = Producto::where('proveedor_id', $proveedor->id)->paginate(4);;
    
        return view('producto.indexProd',compact('productos'));
    }

    public function mostrarproveedores()
    {
        // Obtener todos los proveedores desde la base de datos
        #$proveedores['proveedores'] = Proveedor::all();

        // Retornar la vista con los proveedores
        #return view('Admin.proveedor.proveedores', $proveedores);

        $proveedores = Proveedor::paginate(4); // ✅ ESTA LÍNEA ES CLAVE
        #$proveedores = Proveedor::with('proveedor')->paginate(4); // ✅ ESTA LÍNEA ES CLAVE
        return view('Admin.proveedor.proveedores', compact('proveedores'));
    }
    public function mostrarusuarios()
    {
        // Obtener todos los proveedores desde la base de datos
        $compradores['compradores'] = User::paginate(6); // Cambia '4' por el número de registros que quieras mostrar por página

        // Retornar la vista con los proveedores
        return view('Admin.comprador.compradores', $compradores);
    }
    public function actualizarprov($id) {
        $proveedor = Proveedor::findOrFail($id); // Busca el proveedor o devuelve un 404
        return view('proveedor.actualizarProv', compact('proveedor'));
    }
    public function actualizop(Request $request, $id) {
        $proveedor = Proveedor::findOrFail($id);
    
        // Validar los datos
        $request->validate([
            'correo' => 'required|email',
            'telefono' => 'required|string',
            'direccion' => 'required|string',
            'productos_a_comerciar' => 'required|string|min:1',
        ]);
    
        // Actualizar los campos permitidos
        $proveedor->update($request->only(['correo', 'telefono', 'direccion', 'productos_a_comerciar']));

    
        return redirect('/proveedores')->with('success', 'Proveedor actualizado correctamente');
    }

    public function destroy($id) {
        $proveedor = Proveedor::findOrFail($id); // Busca el proveedor o da error 404
        $proveedor->delete(); // Borra el proveedor
    
        return redirect('/proveedores')->with('success', 'Proveedor eliminado correctamente');
    }
    
    
    
    public function logout()
    {
        Session::flush(); // Limpia la sesión

        Auth::guard('proveedor')->logout(); // Cierra sesión del proveedor

        return redirect()->to('/');
    }
    public function perfil()
    {
        return view('perfilVendedor');
    }
    public function edit()
    {
        $proveedor = Auth::guard('proveedor')->user();
        return view('proveedor.perfil', compact('proveedor'));
    }
    

    public function update(Request $request)
    {
        $proveedor = Auth::guard('proveedor')->user();

        // Validar datos del formulario
        $request->validate([
            'correo' => 'required|email|unique:proveedores,correo,' . $proveedor->id,
            'telefono' => 'required|string|max:15',
            'direccion' => 'required|string|max:255',
            'productos_a_comerciar' => 'nullable|string|max:255',
            'descripcion' => 'nullable|string|max:500',
        ]);

        // Actualizar datos
        $proveedor->update([
            'correo' => $request->correo,
            'telefono' => $request->telefono,
            'direccion' => $request->direccion,
            'productos_a_comerciar' => $request->productos_a_comerciar,
            'descripcion' => $request->descripcion,
        ]);

        return redirect()->route('perfil_proveedor')->with('success', 'Perfil actualizado correctamente.');
    }
    public function updatePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);

        $proveedor = Auth::guard('proveedor')->user();

        if (!Hash::check($request->old_password, $proveedor->password)) {
            return response()->json(['errors' => ['old_password' => ['La contraseña actual es incorrecta.']]], 422);
        }

        $proveedor->password = Hash::make($request->new_password);
        $proveedor->save();

        return response()->json(['message' => 'Contraseña actualizada correctamente.']);
    }
    

}
