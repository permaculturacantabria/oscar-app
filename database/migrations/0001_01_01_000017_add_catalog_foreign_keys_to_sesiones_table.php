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
        Schema::table('sesiones', function (Blueprint $table) {
            // Add foreign key constraints to catalog tables
            $table->foreign('tema_id')->references('id')->on('temas')->onDelete('set null');
            $table->foreign('memoria_temprana_id')->references('id')->on('memorias_tempranas')->onDelete('set null');
            $table->foreign('mensaje_angustioso_id')->references('id')->on('mensajes_angustiosos')->onDelete('set null');
            $table->foreign('direccion_id')->references('id')->on('direcciones')->onDelete('set null');
            $table->foreign('contradiccion_id')->references('id')->on('contradicciones')->onDelete('set null');
            $table->foreign('contradiccion_escucha_id')->references('id')->on('contradicciones_escuchas')->onDelete('set null');
            $table->foreign('pedacito_realidad_id')->references('id')->on('pedacitos_realidad')->onDelete('set null');
            $table->foreign('restimulacion_id')->references('id')->on('restimulaciones')->onDelete('set null');
            $table->foreign('compromiso_social_id')->references('id')->on('compromisos_sociales')->onDelete('set null');
            $table->foreign('proximo_paso_id')->references('id')->on('proximos_pasos')->onDelete('set null');
            $table->foreign('sesion_fisica_id')->references('id')->on('sesiones_fisicas')->onDelete('set null');
            $table->foreign('necesidad_congelada_id')->references('id')->on('necesidades_congeladas')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sesiones', function (Blueprint $table) {
            $table->dropForeign(['tema_id']);
            $table->dropForeign(['memoria_temprana_id']);
            $table->dropForeign(['mensaje_angustioso_id']);
            $table->dropForeign(['direccion_id']);
            $table->dropForeign(['contradiccion_id']);
            $table->dropForeign(['contradiccion_escucha_id']);
            $table->dropForeign(['pedacito_realidad_id']);
            $table->dropForeign(['restimulacion_id']);
            $table->dropForeign(['compromiso_social_id']);
            $table->dropForeign(['proximo_paso_id']);
            $table->dropForeign(['sesion_fisica_id']);
            $table->dropForeign(['necesidad_congelada_id']);
            
            $table->dropColumn([
                'tema_id',
                'memoria_temprana_id',
                'mensaje_angustioso_id',
                'direccion_id',
                'contradiccion_id',
                'contradiccion_escucha_id',
                'pedacito_realidad_id',
                'restimulacion_id',
                'compromiso_social_id',
                'proximo_paso_id',
                'sesion_fisica_id',
                'necesidad_congelada_id'
            ]);
        });
    }
};