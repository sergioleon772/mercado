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
    Schema::table('ordenes', function (Blueprint $table) {
        $table->decimal('precio', 10, 2)->after('direccion'); // Agregar la columna 'precio'
    });
}

public function down()
{
    Schema::table('ordenes', function (Blueprint $table) {
        $table->dropColumn('precio'); // Eliminar la columna en caso de rollback
    });
}

};
