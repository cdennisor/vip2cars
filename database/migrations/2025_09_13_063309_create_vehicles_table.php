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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id(); // ID autoincrementable
            $table->string('plate')->unique(); // Placa del vehículo (única)
            $table->string('brand'); // Marca del vehículo
            $table->string('model'); // Modelo del vehículo
            $table->year('manufacturing_year'); // Año de fabricación del vehículo
            $table->unsignedBigInteger('id_client'); // Clave foránea para relacionar con clientes
            $table->timestamps(); // Timestamps para created_at y updated_at

            // Establecer la relación con clientes
            $table->foreign('id_client')->references('id')->on('clients')->onDelete('cascade')->onUpdate('cascade');

            // Asegurarse que un cliente solo pueda tener un vehículo con la misma placa
            $table->unique(['plate', 'id_client']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
