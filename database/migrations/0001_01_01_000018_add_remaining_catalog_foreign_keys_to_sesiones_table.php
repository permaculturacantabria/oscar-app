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
            // Add foreign key constraints for remaining catalog tables that don't exist yet
            if (Schema::hasTable('contradicciones_escuchas')) {
                $table->foreign('contradiccion_escucha_id')->references('id')->on('contradicciones_escuchas')->onDelete('set null');
            }
            if (Schema::hasTable('pedacitos_realidad')) {
                $table->foreign('pedacito_realidad_id')->references('id')->on('pedacitos_realidad')->onDelete('set null');
            }
            if (Schema::hasTable('restimulaciones')) {
                $table->foreign('restimulacion_id')->references('id')->on('restimulaciones')->onDelete('set null');
            }
            if (Schema::hasTable('compromisos_sociales')) {
                $table->foreign('compromiso_social_id')->references('id')->on('compromisos_sociales')->onDelete('set null');
            }
            if (Schema::hasTable('proximos_pasos')) {
                $table->foreign('proximo_paso_id')->references('id')->on('proximos_pasos')->onDelete('set null');
            }
            if (Schema::hasTable('sesiones_fisicas')) {
                $table->foreign('sesion_fisica_id')->references('id')->on('sesiones_fisicas')->onDelete('set null');
            }
            if (Schema::hasTable('necesidades_congeladas')) {
                $table->foreign('necesidad_congelada_id')->references('id')->on('necesidades_congeladas')->onDelete('set null');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sesiones', function (Blueprint $table) {
            $table->dropForeign(['contradiccion_escucha_id']);
            $table->dropForeign(['pedacito_realidad_id']);
            $table->dropForeign(['restimulacion_id']);
            $table->dropForeign(['compromiso_social_id']);
            $table->dropForeign(['proximo_paso_id']);
            $table->dropForeign(['sesion_fisica_id']);
            $table->dropForeign(['necesidad_congelada_id']);
        });
    }
};