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
        Schema::create('role_iframes', function (Blueprint $table) {
            $table->id();
            $table->string('role'); // Nombre del rol (e.g., 'admin', 'validador1')
            $table->string('iframe_title'); // Título del iframe
            $table->text('iframe_src'); // URL del iframe
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('role_iframes');
    }
};
