<?php

namespace App\Http\Controllers;

use App\Models\DetalleAreaForestal;
use App\Models\DetalleEnfermedad;
use App\Models\DetalleFaunaSilvestre;
use App\Models\GrupoEtario;
use App\Models\Institucion;
use App\Models\ModalidadEducacion;
use App\Models\Municipio;
use App\Models\Provincia;
use App\Models\TipoCultivo;
use App\Models\TipoEspecie;
use App\Models\TipoFaunaEspecie;
use App\Models\TipoInfraestructura;
use App\Models\TipoServicioBasico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FormController extends Controller
{
    public function index(Request $request)
    {

        return view('vendor.voyager.formularios.browse');
    }

    public function create(Request $request){
        $provincias = Provincia::all();
        $municipios = Municipio::all();
        $grupoEtarios = GrupoEtario::all();
        $detalleEnfermedades = DetalleEnfermedad::all();
        $modalidadEducacions = ModalidadEducacion::all();
        $institucions = Institucion::all();
        $tipoInfraestructuras = TipoInfraestructura::all();
        $tiposerviciobasicos = TipoServicioBasico::all();
        $tipoEspecies = TipoEspecie::all();
        $tipoCultivos = TipoCultivo::all();
        $detalleAreaForestals = DetalleAreaForestal::all();
        $detalleFaunaSilvestres = DetalleFaunaSilvestre::all();
        $tipoFaunaEspecies = TipoFaunaEspecie::all();
        return view('vendor.voyager.formularios.edit-add', compact('provincias', 'municipios', 'grupoEtarios', 'detalleEnfermedades', 'modalidadEducacions', 'institucions', 'tipoInfraestructuras', 'tiposerviciobasicos', 'tipoEspecies', 'tipoCultivos', 'detalleAreaForestals', 'detalleFaunaSilvestres', 'tipoFaunaEspecies'));
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



    public function store(Request $request)
    {
        $datos = request()->all();
        dd($datos);
        // $validatedData = $request->validate([
        //     'provincia_id' => 'required|exists:provincias,id',
        //     'municipio_id' => 'required|exists:municipios,id',
        //     'nombre_alcalde' => 'required|string|max:255',
        //     'poblacion_total' => 'required|integer|min:1',
        // ]);

        // DB::beginTransaction();

        // try {
        //     // Buscar la provincia y el municipio seleccionados
        //     $provincia = Provincia::findOrFail($validatedData['provincia_id']);
        //     $municipio = Municipio::findOrFail($validatedData['municipio_id']);

        //     $municipio->nombre_alcalde = $validatedData['nombre_alcalde'];
        //     $municipio->poblacion_total =$validatedData['poblacion_total'];

        //     // Guardar los cambios
        //     $municipio->save();
        //     dd($municipio);

        //     DB::commit();

        //     return redirect()->back()->with('success', 'Datos guardados correctamente.');

        // } catch (\Exception $e) {
        //     DB::rollback();

        //     // Manejo de errores
        //     return redirect()->back()->with('error', 'Ocurrió un error al guardar los datos: ' . $e->getMessage());
        // }
    }
    // public function updateMunicipio(Request $request, $id)
    // {
    //     // Validación de los datos del formulario
    //     $request->validate([
    //         'nombre_alcalde' => 'required|string',
    //         'poblacion_total' => 'required|integer',
    //     ]);

    //     // Encuentra el municipio por su ID
    //     $municipio = Municipio::findOrFail($id);

    //     // Actualiza los campos especificados
    //     $municipio->update([
    //         'nombre_alcalde' => $request->nombre_alcalde,
    //         'poblacion_total' => $request->poblacion_total,
    //     ]);
    //     dd($municipio);
    //     // Redireccionar o devolver una respuesta
    //     return redirect()->back()->with('success', 'Datos del municipio actualizados correctamente.');
    // }
}
