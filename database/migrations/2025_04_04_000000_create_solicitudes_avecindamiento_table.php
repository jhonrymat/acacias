<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('solicitudes_avecindamiento', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('numeroIdentificacion', 50);
            $table->unsignedBigInteger('id_barrio');
            $table->string('direccion', 100);

            $table->double('lat')->nullable();
            $table->double('lng')->nullable();

            // Evidencias archivos
            $table->text('accion_comunal')->nullable();
            $table->text('electoral')->nullable();
            $table->text('sisben')->nullable();
            $table->text('cedula')->nullable();
            $table->text('recibo')->nullable();

            // Estados
            $table->unsignedBigInteger('estado_id')->default(1);
            $table->unsignedBigInteger('actualizado_por')->nullable();
            $table->unsignedBigInteger('Validador2_id')->nullable();

            // Fecha de emisión
            $table->date('fecha_emision')->nullable();

            // Observaciones
            $table->text('observaciones')->nullable();
            $table->boolean('terminos');
            $table->timestamps();

            // Relación con otras tablas
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('id_barrio')->references('id')->on('barrios');
            $table->foreign('estado_id')->references('id')->on('estados');
            $table->foreign('actualizado_por')->references('id')->on('users');
            $table->foreign('Validador2_id')->references('id')->on('users');
            $table->boolean('es_favorito')->default(false);
            $table->string('tipo_persona_cargo')->nullable();
            $table->string('nombre_persona_cargo')->nullable();
            $table->string('documento_persona_cargo')->nullable();

            // Crear índice en la columna estado_id
            $table->index('estado_id', 'idx_estado_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solicitudes_avecindamiento');
    }
};
