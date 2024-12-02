<?php

namespace App\Http\Controllers;

use App\Models\Comunidad;
use App\Models\Municipio;
use Illuminate\Http\Request;

class ComunidadController extends Controller
{
    public function store(Request $request)
    {
        // Validación de datos
        $validated = $request->validate([
            'nombre_comunidad' => 'required|string|max:255',
            'tipo_comunidad' => 'required|string|max:255',
            'municipio_id' => 'required|integer|exists:municipios,id',
        ]);

        // Buscar el municipio
        $municipio = Municipio::find($validated['municipio_id']);

        // Crear la comunidad
        $comunidad = Comunidad::create([
            'nombre_comunidad' => $validated['nombre_comunidad'],
            'tipo_comunidad' => $validated['tipo_comunidad'],
            'municipio_id' => $municipio->id,
        ]);

        // Retornar la respuesta en formato JSON con los datos guardados
        return response()->json([
            'success' => true,
            'message' => 'Comunidad registrada con éxito.',
            'nombre_comunidad' => $comunidad->nombre_comunidad,
            'tipo_comunidad' => $comunidad->tipo_comunidad,
            'municipio_id' => $comunidad->municipio_id,
        ]);
    }
}
