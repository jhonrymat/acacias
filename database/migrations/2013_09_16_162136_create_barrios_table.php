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
        Schema::create('barrios', function (Blueprint $table) {
            $table->id();
            $table->string('nombreBarrio');
            $table->string('tipoUnidad'); // Por ejemplo: Unidad de Planeación Zonal, etc.
            $table->string('codigoNumero')->nullable(); // Código o número asociado al barrio (si aplica)
            $table->string('zona'); // Puede ser 'barrio' o 'vereda'
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barrios');
    }
};
