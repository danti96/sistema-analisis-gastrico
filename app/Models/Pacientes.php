<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pacientes extends Model
{
    use HasFactory;

    protected $table = 'pacientes';
    protected $fillable = [
        'apellidos',
        'nombres',
        'fecha_nacimiento',
        'estado_civil',
        'sexo',
        'tipo_identificacion',
        'identificacion',
        'correo',
        'celular',
        'direccion',
        'status',
    ];

    protected $appends = [
        'fullname'
    ];


    public function getFullnameAttribute()
    {
        return trim($this->apellidos . ' ' . $this->nombres);
    }

}
