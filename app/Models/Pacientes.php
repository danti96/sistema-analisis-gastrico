<?php

namespace App\Models;

use Carbon\Carbon;
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
        'fullname',
        'edad',
        'meses',
        'dias'
    ];


    public function getFullnameAttribute()
    {
        return trim($this->apellidos . ' ' . $this->nombres);
    }

    public function getEdadAttribute()
    {
        if (empty($this->fecha_nacimiento) || is_null($this->fecha_nacimiento)) return 0;
        $fechaNacimiento = Carbon::parse($this->fecha_nacimiento); // cambia por tu fecha
        $hoy = Carbon::now();
        $edad = $fechaNacimiento->diff($hoy);
        return $edad->y;
    }
    public function getMesesAttribute()
    {
        if (empty($this->fecha_nacimiento) || is_null($this->fecha_nacimiento)) return 0;
        $fechaNacimiento = Carbon::parse($this->fecha_nacimiento); // cambia por tu fecha
        $hoy = Carbon::now();
        $edad = $fechaNacimiento->diff($hoy);
        return $edad->m;
    }
    public function getDiasAttribute()
    {
        if (empty($this->fecha_nacimiento) || is_null($this->fecha_nacimiento)) return 0;
        $fechaNacimiento = Carbon::parse($this->fecha_nacimiento); // cambia por tu fecha
        $hoy = Carbon::now();
        $edad = $fechaNacimiento->diff($hoy);
        return $edad->d;
    }

    public function atencionpaciente() {
        return $this->hasMany(AtencionPaciente::class,'paciente_id','id');
    }
}
