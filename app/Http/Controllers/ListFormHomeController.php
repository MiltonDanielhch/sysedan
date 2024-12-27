<?php

namespace App\Http\Controllers;

use App\Models\Formulario;
use Illuminate\Http\Request;

class ListFormHomeController extends Controller
{
    public function index(Request $request)
    {
        // Parámetros de paginación y búsqueda
        $paginate = $request->input('paginate') ?? 10;  // Número de resultados por página
        $search = $request->input('search');  // Palabra clave de búsqueda
        $location = $request->input('location');  // Ubicación seleccionada

        // Comienza la consulta
        $data = Formulario::with(['comunidad.municipio.provincia', 'incendio', 'asistencias'])
            ->where(function ($query) use ($search) {
                // Búsqueda por la palabra clave
                $query->where('id', 'like', '%' . $search . '%')
                    ->orWhereHas('comunidad', function ($query) use ($search) {
                        $query->where('nombre_comunidad', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas('comunidad.municipio', function ($query) use ($search) {
                        $query->where('nombre_municipio', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas('comunidad.municipio.provincia', function ($query) use ($search) {
                        $query->where('nombre_provincia', 'like', '%' . $search . '%');
                    });
            })
            // Filtrar por ubicación seleccionada si se proporciona
            ->when($location && $location != 'Ubicación', function ($query) use ($location) {
                $query->whereHas('comunidad.municipio.provincia', function ($query) use ($location) {
                    $query->where('nombre_provincia', $location);
                });
            })
            ->orderBy('id', 'desc')
            ->paginate($paginate);

        // Retornar los datos a la vista
        return view('frontend.listForm', compact('data'));
    }
}

