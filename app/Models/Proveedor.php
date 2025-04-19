<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; // Cambiar Model por Authenticatable
use Illuminate\Notifications\Notifiable;

class Proveedor extends Authenticatable
{
    use Notifiable; // Opcional, si quieres notificaciones

    protected $table = 'proveedores'; // Nombre de la tabla en la BD

    public function productos()
{
    return $this->hasMany(Producto::class);
}

    protected $fillable = [
        'rut_empresa',
        'password',
        'marca',
        'productos_a_comerciar',
        'correo',
        'telefono',
        'direccion',
    ];

    
    // En el modelo Proveedor
    protected $hidden = ['password', 'remember_token'];


    
}
