<?php

namespace Database\Seeders;

use App\Models\Producto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Provider\Image;

class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $producto = Producto::all();
        // Ingresar datos rapidos a la base de datos
        DB::table('productos')->insert([
        [
            'proveedor_id' => '1',
            'proveedor' => 'Sebastian Piñera',
            'titulo' => 'Camisa',
            'marca' => 'Maui',
            'precio' => '10000',
            'cantidad' => '10',
            'imagen' => asset('imagenes/logoEmpresa.png'),
            'descripcion' => 'Descripcion camisa Maui'
        ],
        [
            'proveedor_id' => '2',
            'proveedor' => 'Felipe Camiruaga',
            'titulo' => 'Camisa',
            'marca' => 'Maui',
            'precio' => '10000',
            'cantidad' => '10',
            'imagen' => asset('imagenes/logoEmpresa.png'),
            'descripcion' => 'Descripcion camisa Maui'
        ],
        [
            'proveedor_id' => '3',
            'proveedor' => 'Messi',
            'titulo' => 'Camisa',
            'marca' => 'Maui',
            'precio' => '10000',
            'cantidad' => '10',
            'imagen' => asset('imagenes/logoEmpresa.png'),
            'descripcion' => 'Descripcion camisa Maui'
        ],
        [
            'proveedor_id' => '4',
            'proveedor' => 'Cristiano',
            'titulo' => 'Camisa',
            'marca' => 'Maui',
            'precio' => '10000',
            'cantidad' => '10',
            'imagen' => url(asset('imagenes/logoEmpresa.png')),
            'descripcion' => 'Descripcion camisa Maui'
        ],
        [
            'proveedor_id' => '5',
            'proveedor' => 'Donald Trump',
            'titulo' => 'Camisa',
            'marca' => 'Maui',
            'precio' => '10000',
            'cantidad' => '10',
            'imagen' => asset('imagenes/logoEmpresa.png'),
            'descripcion' => 'Descripcion camisa Maui'
        ],
        [
            'proveedor_id' => '6',
            'proveedor' => 'Felipe Kast',
            'titulo' => 'Camisa',
            'marca' => 'Maui',
            'precio' => '10000',
            'cantidad' => '10',
            'imagen' => asset('imagenes/logoEmpresa.png'),
            'descripcion' => 'Descripcion camisa Maui'
        ]
        ]);
    }
}
