<?php

namespace App\Http\Controllers\Voyager;

use App\Http\Controllers\Controller;
use App\Models\Comunidad;
use App\Models\Incendio;
use App\Models\Municipio;
use App\Models\Provincia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FormController extends Controller
{
    public function index(Request $request)
    {
        return view('vendor.voyager.formularios.browse');
    }

    public function list(Request $request)
    {
        $paginate = request('paginate') ?? 10;
        $search = request('search');
        // $data = Provincia::all();
        // $data = $data->paginate($paginate);
        if($request->ajax()){
            $provincias = DB::table('provincias')
            ->where('nombre_provincia', 'like', '%' . $search . '%')
            ->paginate($paginate);
            // dd($provincias);
            $html = view('voyager::formularios.list', compact('provincias'))->render();
            return response()->json([
                'code' => 200,
                'html' => $html,
                'msg' => 'success',
            ],200);
        }else{
            return response()->json([
                'code' => 404,
                'msg' => 'error',
                'message' => 'Error, no se puede acceder a la pagina'
            ], 404);
        }
    }

    public function create()
    {
        $provincias = Provincia::all();
        $municipios = Municipio::all();
         return view('vendor.voyager.formularios.edit-add', compact('provincias', 'municipios'));
    }

    public function buscar_municipio($id_provincia){
        try{
            $municipios = DB::table('municipios')->where('provincia_id', $id_provincia)->get();
            return view('vendor.voyager.formularios.cargar_municipios', compact('municipios'));

        }catch(\Exception $exception){
            return response()->json(['mensaje'=>'Error']);
        }
    }
    public function getAlcalde($municipioId)
    {
        $municipio = Municipio::find($municipioId);

        // Verifica que el municipio exista antes de intentar acceder a sus datos
        if ($municipio) {
            return response()->json(['nombre_alcalde' => $municipio->nombre_alcalde]);
        } else {
            return response()->json(['error' => 'Municipio no encontrado'], 404);
        }
    }

    public function getPoblacion($municipioId)
    {
        $municipio = Municipio::find($municipioId);

        // Verifica que el municipio exista antes de intentar acceder a sus datos
        if ($municipio) {
            return response()->json(['poblacion_total' => $municipio->poblacion_total]);
        } else {
            return response()->json(['error' => 'Municipio no encontrado'], 404);
        }
    }


    public function store(Request $request){
        // dd($request);

        // Validación de datos
        $validatedData = $request->validate([
            // formulario
            // 'fecha_llenado' => 'required|date',
            //comunidad
            'nombre_comunidad' => 'required|string',
            'tipo_comunidad' => 'required|string',
            'municipio_id' => 'required|integer|exists:municipios,id',
            //incendio
            'fecha_inicio' => 'required|date',
            'causas_probables' => 'nullable|string',
            'estado' => 'nullable|string',
            // comunidad_incendios
            // 'incendios_registrados' => 'required|integer',
            // 'incendios_activos' => 'required|integer',
            // 'necesidades' => 'nullable|string',
            // 'num_familias_afectadas' => 'required|integer',
            // 'num_familias_damnificadas' => 'required|integer',
        ]);

        return DB::transaction(function () use ($validatedData) {

            // Encontrar el municipio
            $municipio = Municipio::find($validatedData['municipio_id']);

            // Crear la comunidad
            $comunidad = Comunidad::create([
                'nombre_comunidad' => $validatedData['nombre_comunidad'],
                'tipo_comunidad' => $validatedData['tipo_comunidad'],
                'municipio_id' => $validatedData['municipio_id'],
            ]);

            // Crear el incendio
            $incendio = Incendio::create([
                'fecha_inicio' => $validatedData['fecha_inicio'],
                'causas_probables' => $validatedData['causas_probables'],
                'estado' => $validatedData['estado'],
            ]);


            // Redirigir después de guardar
            return redirect()->route('formularios.index')->with('success', 'Formulario guardado correctamente');
        }, 1);

    }
}
