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
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            // $table->bigInteger('proveedor_id')->unsigned();
            $table->string('proveedor');
            $table->string('titulo');
            $table->string('marca');
            $table->string('precio');
            $table->string('cantidad');
            $table->string('imagen');
            $table->string('descripcion');
            $table->timestamps();

            // $table->foreign('proveedor_id')->references('id')->on('proveedores')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productos');
    }
};
