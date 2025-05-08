<?php

namespace App\Http\Controllers;

use App\Models\Pacientes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PacienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('modules.paciente.index');
    }

    public function paginate(Request $request)
    {
        $rq = $request->all();

        $limit = $rq['limit'] ?? 10;
        $search = $rq['search'] ?? '';

        $paginacion = Pacientes::orderByDesc('id');

        if (!empty($search)) {
            $paginacion = $paginacion->orwhere(["apellidos" => $search, "nombres" => $search])
                ->orwhere(DB::raw("LOWER(CONCAT(apellidos,' ',nombres))", 'like', '%' . strtolower($search) . '%'))
                ->orwhere(["identificacion" => $search])
                ->orwhere(["correo" => $search])
                ->orwhere(["celular" => $search]);

            if (strtotime($search) !== false) {
                $paginacion = $paginacion->orwhere(["fecha_nacimiento" => $search]);
            }
        }

        $paginacion = $paginacion->paginate($limit);

        return response()->json($paginacion);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('modules.paciente.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request = $request->all();
        try {
            $paciente = [
                "nombres" => $request["nombres"],
                "apellidos" => $request["apellidos"],
                "fecha_nacimiento" => $request["fecha_nacimiento"],
                "estado_civil" => $request["estado_civil"],
                "sexo" => $request["sexo"],
                "tipo_identificacion" => $request["tipo_identificacion"],
                "identificacion" => $request["identificacion"],
                "correo" => $request["correo"],
                "celular" => $request["celular"],
                "direccion" => $request["direccion"],
                "status" => 1,
            ];

            $filter = [
                "identificacion" => $paciente["identificacion"],
                "tipo_identificacion" => $paciente["tipo_identificacion"]
            ];

            if (Pacientes::where($filter)->exists()) {
                return response()->json(["message" => "Paciente con " . $request["tipo_identificacion"] . " " . $paciente["identificacion"] . " ya se encuentra registrado"], 422);
            }

            $paciente = Pacientes::create($paciente);

            return response()->json(["message" => "Paciente registrado correctamente."]);

        } catch (\Throwable $th) {
            Log::error(json_encode(["file" => "PacienteController", "line" => $th->getLine(), "error" => $th->getMessage()]));
            return response()->json(["message" => "Error crear un nuevo registro."], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $paciente = Pacientes::find($id);

        return view('modules.paciente.show', compact('paciente'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $paciente = Pacientes::find($id);

        return view('modules.paciente.edit', compact('id', 'paciente'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request = $request->all();
        $paciente = [
            "nombres" => $request["nombres"],
            "apellidos" => $request["apellidos"],
            "fecha_nacimiento" => $request["fecha_nacimiento"],
            "estado_civil" => $request["estado_civil"],
            "sexo" => $request["sexo"],
            "tipo_identificacion" => $request["tipo_identificacion"],
            "identificacion" => $request["identificacion"],
            "correo" => $request["correo"],
            "celular" => $request["celular"],
            "direccion" => $request["direccion"],
            "status" => $request["status"],
        ];
        $filter = [
            "identificacion" => $paciente["identificacion"],
            "tipo_identificacion" => $paciente["tipo_identificacion"]
        ];

        //* Asegurarnos que exista el registro
        if (!Pacientes::find($id)->exists()) return response()->json(["message" => "Paciente no ha sido encontrado."], 404);
        //* Asegura que no sea el mismo registro
        if (Pacientes::where($filter)->where('id', '!=', $id)->exists()) {
            return response()->json(["message" => "Paciente con " . $request["tipo_identificacion"] . " " . $paciente["identificacion"] . " ya se encuentra registrado"], 422);
        }

        $paciente = Pacientes::where('id', $id)->update($paciente);

        return response()->json(["message" => "Paciente actualizado correctamente"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $paciente = Pacientes::where('id', $id)->first();

        if (!$paciente) {
            return response()->json([
                'message' => 'Paciente no encontrado.',
            ], 404);
        }

        try {
            $paciente->status = !$paciente->status;
            $paciente->save();

            return response()->json([
                'message' => 'Paciente deshabilitado correctamente.',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Fallo al deshabilitar el paciente.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
