<?php

namespace App\Http\Controllers;

use App\Models\AtencionPaciente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AtencionPacienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('modules.atencion-paciente.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $data = [
                'paciente_id' => $request['paciente_id'],
                'medico_id' => $request['medico_id'],
                'motivoconsulta' => $request['motivoconsulta'],
                'antecedentepersonales' => $request['antecedentepersonales'],
                'antecedentefamiliares' => $request['antecedentefamiliares'],
                'imagen_original' => $request['imagen_original'],
                'imagen_procesada' => $request['imagen_procesada'],
                'resultado_afectacion' => $request['resultado_afectacion'],
                'porcentaje_afectacion' => $request['porcentaje_afectacion'],
            ];
            AtencionPaciente::create($data);
            return response()->json(["message" => "Registro creado correctamente."]);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return response()->json(["message" => "Error al crear registro."], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
