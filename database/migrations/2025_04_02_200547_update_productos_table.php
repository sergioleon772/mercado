<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('productos', function (Blueprint $table) {
            // Agregar la nueva columna proveedor_id (permite valores NULL temporalmente)
            $table->unsignedBigInteger('proveedor_id')->nullable()->after('id');
            
           // $table->dropColumn('proveedor'); // Eliminar la columna proveedor
            
            // Crear la clave foránea con la tabla proveedores
            $table->foreign('proveedor_id')->references('id')->on('proveedores')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('productos', function (Blueprint $table) {
            // Eliminar la clave foránea y la columna si se revierte la migración
            $table->dropForeign(['proveedor_id']);
            $table->dropColumn('proveedor_id');
        });
    }
};
