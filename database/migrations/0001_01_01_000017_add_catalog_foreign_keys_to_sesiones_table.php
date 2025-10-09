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
            // Check if foreign key constraints don't already exist before adding them
            $foreignKeys = Schema::getConnection()->getDoctrineSchemaManager()->listTableForeignKeys('sesiones');
            $existingConstraints = array_map(function($fk) { return $fk->getName(); }, $foreignKeys);
            
            // Only add constraints that don't already exist
            if (!in_array('sesiones_tema_id_foreign', $existingConstraints) && Schema::hasTable('temas')) {
                $table->foreign('tema_id', 'sesiones_tema_id_foreign')->references('id')->on('temas')->onDelete('set null');
            }
            if (!in_array('sesiones_memoria_temprana_id_foreign', $existingConstraints) && Schema::hasTable('memorias_tempranas')) {
                $table->foreign('memoria_temprana_id', 'sesiones_memoria_temprana_id_foreign')->references('id')->on('memorias_tempranas')->onDelete('set null');
            }
            if (!in_array('sesiones_mensaje_angustioso_id_foreign', $existingConstraints) && Schema::hasTable('mensajes_angustiosos')) {
                $table->foreign('mensaje_angustioso_id', 'sesiones_mensaje_angustioso_id_foreign')->references('id')->on('mensajes_angustiosos')->onDelete('set null');
            }
            if (!in_array('sesiones_direccion_id_foreign', $existingConstraints) && Schema::hasTable('direcciones')) {
                $table->foreign('direccion_id', 'sesiones_direccion_id_foreign')->references('id')->on('direcciones')->onDelete('set null');
            }
            if (!in_array('sesiones_contradiccion_id_foreign', $existingConstraints) && Schema::hasTable('contradicciones')) {
                $table->foreign('contradiccion_id', 'sesiones_contradiccion_id_foreign')->references('id')->on('contradicciones')->onDelete('set null');
            }
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