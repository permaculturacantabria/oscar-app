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
        if (!Schema::hasTable('sesiones')) {
            Schema::create('sesiones', function (Blueprint $table) {
                $table->id();
                $table->foreignId('usuario_id')->constrained('users')->onDelete('cascade');
                $table->foreignId('escucha_id')->constrained('escuchas')->onDelete('cascade');
                $table->string('nombre_sesion');
                $table->enum('modalidad', ['presencial', 'online', 'telefono']);
                $table->enum('estado', ['pendiente', 'realizada']);
                $table->enum('tipo_sesion', ['Libre', 'Proceso_10_pasos']);
                $table->date('fecha');
                $table->time('hora');
                $table->integer('duracion'); // in minutes?
                $table->text('notas')->nullable();
                // Evaluación
                $table->integer('evaluacion_1')->nullable();
                $table->integer('evaluacion_2')->nullable();
                $table->enum('descarga_dominante', ['izquierda', 'derecha'])->nullable();
                // Removed foreign key constraints to catalog tables - will be added in migration 0017
                $table->unsignedBigInteger('tema_id')->nullable();
                $table->unsignedBigInteger('memoria_temprana_id')->nullable();
                $table->unsignedBigInteger('mensaje_angustioso_id')->nullable();
                $table->unsignedBigInteger('direccion_id')->nullable();
                $table->unsignedBigInteger('contradiccion_id')->nullable();
                $table->unsignedBigInteger('contradiccion_escucha_id')->nullable();
                $table->unsignedBigInteger('pedacito_realidad_id')->nullable();
                $table->unsignedBigInteger('restimulacion_id')->nullable();
                $table->unsignedBigInteger('compromiso_social_id')->nullable();
                $table->unsignedBigInteger('proximo_paso_id')->nullable();
                $table->unsignedBigInteger('sesion_fisica_id')->nullable();
                $table->unsignedBigInteger('necesidad_congelada_id')->nullable();
                $table->foreignId('proceso_id')->nullable()->constrained('procesos')->onDelete('set null');
                $table->index(['usuario_id', 'estado', 'tipo_sesion']);
                $table->index(['fecha', 'usuario_id']);
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
        Schema::dropIfExists('sesiones');
    }
};