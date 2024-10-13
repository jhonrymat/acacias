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
        Schema::create('validaciones', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_solicitud');
            $table->timestamp('fechaValidacion');
            $table->boolean('validacionSalud')->default(false);
            $table->string('evidenciaSalud', 255)->nullable();
            $table->boolean('validacionElecciones')->default(false);
            $table->string('evidenciaElecciones', 255)->nullable();
            $table->boolean('validacionJuntas')->default(false);
            $table->string('evidenciaJuntas', 255)->nullable();
            $table->timestamps();

            // Relación con solicitudes
            $table->foreign('id_solicitud')->references('id')->on('solicitudes');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('validaciones');
    }
};
