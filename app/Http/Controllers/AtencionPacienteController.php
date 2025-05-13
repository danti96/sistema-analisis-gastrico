<?php

namespace App\Http\Controllers;

use App\Models\AtencionPaciente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
            $rq = $request->all();

            $medico_id = Auth::user()->id;
            $image_process = $request['imagenanalisis'];
            $image_original = $request['processedImageAnalisis_image'];

            $path_image_process = $this->saveBase64File($image_process, 'public/images/images_process');
            $path_image_original = $this->saveBase64File($image_original, 'public/images/images_original');

            $data = [
                'paciente_id' => $request['paciente'],
                'medico_id' => $medico_id,

                'motivoconsulta' => $request['motivoconsulta'],
                'antecedentepersonales' => $request['antecedentepersonales'],
                'antecedentefamiliares' => $request['antecedentefamiliares'],

                'imagen_procesada' => $path_image_process,
                'imagen_original' => $path_image_original,

                'resultado_afectacion' => $request['processedImageAnalisis_text'],
                'porcentaje_afectacion' => $request['processedImageAnalisis_pred'],
            ];

            AtencionPaciente::create($data);

            return response()->json(["message" => "Registro creado correctamente."]);
        } catch (\Throwable $th) {
            Log::error(["getLine"=>$th->getLine(), "getMessage"=>$th->getMessage()]);
            return response()->json(["message" => "Error al crear registro."], 400);
        }
    }

    function saveBase64File($base64String, $path = 'uploads')
    {
        // Obtener el tipo de archivo
        if (preg_match('/^data:(.*);base64,/', $base64String, $match)) {
            $mimeType = $match[1]; // ej: image/png
            $base64String = substr($base64String, strpos($base64String, ',') + 1);
        } else {
            throw new \Exception("Cadena base64 inválida.");
        }

        // Decodificar base64
        $fileData = base64_decode($base64String);

        // Obtener la extensión del archivo
        $extension = explode('/', $mimeType)[1]; // ej: png

        // Generar un nombre único
        $filename = Str::uuid() . '.' . $extension;

        // Guardar el archivo en storage/app/$path
        Storage::put("$path/$filename", $fileData);

        return str_replace('public/','',$path)."/$filename"; // Ruta del archivo guardado
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
