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
            // columna estado1
            $table->string('validacion1', 255)->nullable();
            // columna estado2
            $table->string('validacion2', 255)->nullable();
            // adjunto JAComunal
            $table->json('JAComunal')->nullable();

            $table->text('notas')->nullable();
            // permitir visualizacion de ciudadano, booleano
            $table->boolean('visible')->default(false);
            $table->string('qr_url')->nullable(); // Enlace del QR generado

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
