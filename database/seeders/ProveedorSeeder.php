<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProveedorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //php artisan db:seed --class=ProveedorSeeder
        DB::table('proveedores')->insert([
        [
            'rut_empresa' => '19.000.000-1',
            'marca' => 'Maui 1',
            'correo' => 'maui1@gmail.com',
            'telefono' => '123456765',
            'direccion' => 'direccion local maui 1',
            'productos_a_comerciar' => 'Vestuario'
        ],
        [
            'rut_empresa' => '19.000.000-2',
            'marca' => 'Maui 2',
            'correo' => 'maui2@gmail.com',
            'telefono' => '123456765',
            'direccion' => 'direccion local maui 2',
            'productos_a_comerciar' => 'Vestuario'
        ],
        [
            'rut_empresa' => '19.000.000-3',
            'marca' => 'Maui 3',
            'correo' => 'maui3@gmail.com',
            'telefono' => '123456765',
            'direccion' => 'direccion local maui 3',
            'productos_a_comerciar' => 'Vestuario'
        ],
        [
            'rut_empresa' => '19.000.000-4',
            'marca' => 'Maui 4',
            'correo' => 'maui4@gmail.com',
            'telefono' => '123456765',
            'direccion' => 'direccion local maui 4',
            'productos_a_comerciar' => 'Vestuario'
        ],
        [
            'rut_empresa' => '19.000.000-5',
            'marca' => 'Maui 5',
            'correo' => 'maui5@gmail.com',
            'telefono' => '123456765',
            'direccion' => 'direccion local maui 5',
            'productos_a_comerciar' => 'Vestuario'
        ],
        [
            'rut_empresa' => '19.000.000-6',
            'marca' => 'Maui 6',
            'correo' => 'maui6@gmail.com',
            'telefono' => '123456765',
            'direccion' => 'direccion local maui 6',
            'productos_a_comerciar' => 'Vestuario'
        ]
        ]);
    }
}
