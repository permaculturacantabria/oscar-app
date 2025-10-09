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
        // Skip this migration - foreign keys will be added in migration 0018 after all tables exist
        // This prevents dependency issues during migration
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