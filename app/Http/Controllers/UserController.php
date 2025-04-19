<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
