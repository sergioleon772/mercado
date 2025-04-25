<?php

namespace App\Models;
use App\Models\Producto;
use App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrito extends Model
{
    use HasFactory;
    public $table = 'carrito';
    protected $fillable = [
        'user_id',
        'producto_id',
        'cantidad',
    ];

    // Relaciones (opcional pero recomendado)
    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
}
