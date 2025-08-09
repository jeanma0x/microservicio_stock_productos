<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('ventas', function (Blueprint $table) {
            $table->id();
            $table->string('nit', 25); // NIT del cliente
            $table->timestamp('fecha')->useCurrent(); // Fecha y hora de venta
            $table->decimal('total', 10, 2)->default(0); // Total de la venta
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ventas');
    }
};