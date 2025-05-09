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
        Schema::create('atencion_paciente', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('paciente_id');
            $table->unsignedBigInteger('medico_id');
            $table->string('motivoconsulta')->nullable();
            $table->string('antecedentepersonales')->nullable();
            $table->string('antecedentefamiliares')->nullable();


            $table->string('imagen_original')->nullable();
            $table->string('imagen_procesada')->nullable();
            $table->text('resultado_afectacion')->nullable();
            $table->string('porcentaje_afectacion')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('atencion_paciente');
    }
};
