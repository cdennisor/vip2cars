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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nombres del cliente
            $table->string('last_name'); // Apellidos del cliente
            $table->string('document_number')->unique(); // Número de documento del cliente (único)
            $table->string('email')->unique()->nullable(); // Correo electrónico (único)
            $table->string('phone')->nullable(); // Teléfono del cliente
            $table->timestamps(); // Timestamps para created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
