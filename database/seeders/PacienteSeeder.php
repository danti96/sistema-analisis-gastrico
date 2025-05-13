<?php

namespace Database\Seeders;

use App\Models\Pacientes;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;


class PacienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i=0; $i < 10; $i++) {
            Pacientes::create([
                'apellidos' => fake()->lastName(),
                'nombres' => fake()->firstName(),
                'fecha_nacimiento' => fake()->date(),
                'estado_civil' => fake()->randomElement(["Soltero/a", "Casado/a", "Divorciado/a", "Union Libre", "Otros"]),
                'sexo' => fake()->randomElement(['Masculino', 'Femenino']),
                'tipo_identificacion' => fake()->randomElement(['Cédula', 'Ruc', 'Pasaporte']),
                'identificacion' => fake()->dni(),
                'correo' => fake()->unique()->safeEmail(),
                'celular' => fake()->mobileNumber(),
                'direccion' => fake()->address(),
                'status' => 1
            ]);
        }
    }
}
