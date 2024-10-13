<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('nombre_2', 100)->nullable();
            $table->string('apellido_1', 100);
            $table->string('apellido_2', 100);
            $table->string('email')->unique();
            $table->string('telefonoContacto', 20)->unique();
            $table->unsignedBigInteger('id_tipoSolicitante');
            $table->unsignedBigInteger('id_tipoDocumento');
            $table->string('numeroIdentificacion', 50)->unique();
            $table->string('ciudadExpedicion', 100);
            $table->date('fechaNacimiento');
            $table->unsignedBigInteger('id_nivelEstudio')->nullable();
            $table->unsignedBigInteger('id_genero')->nullable();
            $table->unsignedBigInteger('id_ocupacion')->nullable(); // Cambiado de string a unsignedBigInteger
            $table->unsignedBigInteger('id_poblacion')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->foreignId('current_team_id')->nullable();
            $table->string('profile_photo_path', 2048)->nullable();
            $table->timestamps();

            // Relaciones de clave foránea
            $table->foreign('id_tipoDocumento')->references('id')->on('tdocumentos');
            $table->foreign('id_nivelEstudio')->references('id')->on('nestudios');
            $table->foreign('id_genero')->references('id')->on('generos');
            $table->foreign('id_ocupacion')->references('id')->on('ocupacion');
            $table->foreign('id_poblacion')->references('id')->on('poblacion');
            $table->foreign('id_tipoSolicitante')->references('id')->on('tsolicitantes');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
