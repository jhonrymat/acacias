<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('solicitudes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('numeroIdentificacion', 50);
            $table->unsignedBigInteger('id_barrio');

            $table->string('direccion', 100);
            $table->text('evidenciaPDF');
            //estados
            $table->unsignedBigInteger('estado_id')->default(1); //1 nuevo-2 aprobada- 3 rechazada
            // observaciones
            $table->string('observaciones', 255);
            $table->boolean('terminos');
            $table->timestamps();

            // Relación con otras tablas
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('id_barrio')->references('id')->on('barrios');
            $table->foreign('estado_id')->references('id')->on('estados');
            
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solicitudes');
    }
};
