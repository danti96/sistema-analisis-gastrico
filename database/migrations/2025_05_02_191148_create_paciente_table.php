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
        Schema::create('pacientes', function (Blueprint $table) {
            $table->id();

            $table->string('apellidos', 60);
            $table->string('nombres', 60)->nullable();
            $table->date('fecha_nacimiento')->nullable();

            $table->string('estado_civil', 60)->nullable();
            $table->string('sexo', 10)->nullable();
            $table->string('tipo_identificacion', 20)->nullable();
            $table->string('identificacion', 20)->unique();

            $table->string('correo', 100)->nullable();
            $table->string('celular', 20)->nullable();
            $table->text('direccion')->nullable();

            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pacientes');
    }
};
