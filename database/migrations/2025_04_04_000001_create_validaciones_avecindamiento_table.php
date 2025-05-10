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
        Schema::create('validaciones_avecindamiento', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_solicitud'); // clave foránea con convención estándar

            $table->string('validacion1', 255)->nullable();
            $table->string('validacion2', 255)->nullable();
            $table->json('JAComunal')->nullable();
            $table->text('notas')->nullable();
            $table->boolean('visible')->default(false);
            $table->string('qr_url')->nullable();

            $table->boolean('evidencia_residencia')->nullable();
            $table->json('tiempo_residencia')->nullable(); // { "anios": X, "meses": Y }

            $table->timestamps();

            // Relación con solicitudes_avecindamiento
            $table->foreign('id_solicitud')->references('id')->on('solicitudes_avecindamiento');
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('validaciones_avecindamiento');
    }
};
