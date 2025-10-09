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
        if (!Schema::hasTable('escuchas')) {
            Schema::create('escuchas', function (Blueprint $table) {
                $table->id();
                $table->foreignId('usuario_propietario_id')->constrained('users')->onDelete('cascade');
                $table->string('nombre_asignado');
                $table->string('telefono');
                $table->foreignId('id_usuario_real')->nullable()->constrained('users')->onDelete('set null');
                $table->unique(['usuario_propietario_id', 'telefono']);
                $table->softDeletes();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('escuchas');
    }
};