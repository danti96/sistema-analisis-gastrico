<?php

namespace App\Http\Controllers;

use App\Models\Pacientes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function dashboardpaciente()
    {

        if (!is_null(auth()->user()->paciente_id)) {
            $paciente_id  = auth()->user()->paciente_id;

            $paciente = Pacientes::with('atencionpaciente')->find($paciente_id);

            return view('modules.paciente.show', compact('paciente'));
        } else {
            return view('dashboard');
        }
    }
}
