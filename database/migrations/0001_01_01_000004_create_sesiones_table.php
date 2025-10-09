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
            // FKs to catalogs
            $table->foreignId('tema_id')->nullable()->constrained('temas')->onDelete('set null');
            $table->foreignId('memoria_temprana_id')->nullable()->constrained('memorias_tempranas')->onDelete('set null');
            $table->foreignId('mensaje_angustioso_id')->nullable()->constrained('mensajes_angustiosos')->onDelete('set null');
            $table->foreignId('direccion_id')->nullable()->constrained('direcciones')->onDelete('set null');
            $table->foreignId('contradiccion_id')->nullable()->constrained('contradicciones')->onDelete('set null');
            $table->foreignId('contradiccion_escucha_id')->nullable()->constrained('contradicciones_escuchas')->onDelete('set null');
            $table->foreignId('pedacito_realidad_id')->nullable()->constrained('pedacitos_realidad')->onDelete('set null');
            $table->foreignId('restimulacion_id')->nullable()->constrained('restimulaciones')->onDelete('set null');
            $table->foreignId('compromiso_social_id')->nullable()->constrained('compromisos_sociales')->onDelete('set null');
            $table->foreignId('proximo_paso_id')->nullable()->constrained('proximos_pasos')->onDelete('set null');
            $table->foreignId('sesion_fisica_id')->nullable()->constrained('sesiones_fisicas')->onDelete('set null');
            $table->foreignId('necesidad_congelada_id')->nullable()->constrained('necesidades_congeladas')->onDelete('set null');
            // Evaluación
            $table->integer('evaluacion_1')->nullable();
            $table->integer('evaluacion_2')->nullable();
            $table->enum('descarga_dominante', ['izquierda', 'derecha'])->nullable();
            $table->foreignId('proceso_id')->nullable()->constrained('procesos')->onDelete('set null');
            $table->index(['usuario_id', 'estado', 'tipo_sesion']);
            $table->index(['fecha', 'usuario_id']);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sesiones');
    }
};