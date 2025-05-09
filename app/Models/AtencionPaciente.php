<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AtencionPaciente extends Model
{
    use HasFactory;


    protected $table = 'atencion_paciente';
    protected $fillable = [
        'paciente_id',
        'medico_id',
        'motivoconsulta',
        'antecedentepersonales',
        'antecedentefamiliares',
        'imagen_original',
        'imagen_procesada',
        'resultado_afectacion',
        'porcentaje_afectacion',
    ];
}
