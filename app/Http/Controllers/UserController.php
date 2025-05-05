<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    public function show(){
        return view('perfil');
    }
    public function edit($id)
{
    $comprador = User::findOrFail($id);
    return view('Admin.comprador.actualizarComp', compact('comprador'));
}
public function actualizoperfil(Request $request)
{
    $user = Auth::user();

    $request->validate([
        'email' => 'required|email',
        'phone' => 'required|string',
        'address' => 'required|string',
    ]);

    $user->email = $request->input('email');
    $user->phone = $request->input('phone');
    $user->address = $request->input('address');
    $user->save();

    return redirect()->back()->with('success', 'Perfil actualizado correctamente.');

}
public function actualizarcontrasena(Request $request)
{
    $request->validate([
        'old_password' => 'required',
        'new_password' => 'required|min:6|confirmed',
    ]);

    $user = Auth::user();

    if (!Hash::check($request->old_password, $user->getOriginal('password'))) {
        return response()->json(['errors' => ['old_password' => ['La contraseña actual es incorrecta.']]], 422);
    }

    $user->password = $request->new_password; // El setter hace el hash
    $user->save();

    return response()->json(['message' => 'Contraseña actualizada correctamente.']);
}




public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string',
        'lastname' => 'required|string',
        'email' => 'required|email',
        'phone' => 'required',
        'address' => 'required',
    ]);

    $comprador = User::findOrFail($id);
    $comprador->update($request->all());

    return redirect('compradores')->with('success', 'Usuario actualizado correctamente');
}

public function destroy($id)
{
    $comprador = User::findOrFail($id);
    $comprador->delete();

    return redirect('compradores')->with('success', 'Usuario eliminado correctamente');
}

}
