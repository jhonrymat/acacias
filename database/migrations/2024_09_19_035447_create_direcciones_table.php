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
        Schema::create('direcciones', function (Blueprint $table) {
            $table->id();
            $table->string('tipoViaPrimaria')->nullable(); // Calle, Carrera, etc.
            $table->string('numeroViaPrincipal')->nullable();
            $table->string('letraViaPrincipal')->nullable();
            $table->string('bis')->nullable();
            $table->string('letraBis')->nullable();
            $table->string('cuadranteViaPrincipal')->nullable();
            $table->string('numeroViaGeneradora')->nullable();
            $table->string('letraViaGeneradora')->nullable();
            $table->string('numeroPlaca')->nullable();
            $table->string('cuadranteViaGeneradora')->nullable();
            $table->unsignedBigInteger('barrio_id'); // Relación con barrio
            $table->timestamps();

            // Definir la clave foránea
            $table->foreign('barrio_id')->references('id')->on('barrios')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('direcciones');
    }
};
