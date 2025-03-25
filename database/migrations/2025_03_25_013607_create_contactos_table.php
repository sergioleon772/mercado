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
    Schema::create('contactos', function (Blueprint $table) {
        $table->id();
        $table->string('nombre');
        $table->string('direccion');
        $table->string('email');
        $table->string('telefono');
        $table->string('asunto');
        $table->text('mensaje');
        $table->timestamps();  // Esto agregará las columnas created_at y updated_at
    });
}

public function down()
{
    Schema::dropIfExists('contactos');
}

};
