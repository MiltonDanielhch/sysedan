<?php

namespace App\Http\Controllers;

use App\Models\AreaForestal;
use App\Models\Asistencia;
use App\Models\DetalleEnfermedad;
use App\Models\Educacion;
use App\Models\FaunaSilvestre;
use App\Models\Formulario;
use App\Models\Infraestructura;
use App\Models\ModalidadEducacion;
use App\Models\PersonaAfectadaIncendio;
use App\Models\Reforestacion;
use App\Models\Salud;
use App\Models\SectorAgricola;
use App\Models\SectorPecuario;
use App\Models\ServicioBasico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class FormDataController extends Controller
{
    public function index($id){

        try {

            $form = Formulario::findOrFail($id);

            $personasAfectadas = PersonaAfectadaIncendio::where('formulario_id', $id)->get();

            $asistencias = Asistencia::where('formulario_id', $id)->get();

            $educacions = Educacion::with('modalidadEducacion', 'institucion')->where('formulario_id', $id)->get();
            $modalidadEducacions = ModalidadEducacion::all();

            $pecuarios = SectorPecuario::where('formulario_id', $id)->get();


            $saluds = Salud::with('detalleEnfermedad', 'grupoEtario')->where('formulario_id', $id)->get();
            $detalleEnfermedades = DetalleEnfermedad::all();

            $infraestructuras = Infraestructura::with('tipoInfraestructura')->where('formulario_id', $id)->get();

            $servicioBasicos = ServicioBasico::with('tipoServicioBasico')->where('formulario_id', $id)->get();

            $sectorPecuarios = SectorPecuario::with('tipoEspecie')->where('formulario_id', $id)->get();

            $sectorAgricolas = SectorAgricola::with('tipoCultivo')->where('formulario_id', $id)->get();

            $areaForestals = AreaForestal::with('detalleAreaForestal')->where('formulario_id', $id)->get();

            $faunaSilvestres = FaunaSilvestre::with('detalleFaunaSilvestre', 'tipoEspecie')->where('formulario_id', $id)->get();

            $reforestacions = Reforestacion::where('formulario_id', $id)->get();

        } catch (\Exception $e) {
            Log::error('Error al cargar formulario: ' . $e->getMessage());
            return redirect()->route('formularios.index')->with('error', 'Hubo un problema al cargar el formulario.');
        }
        return view('frontend.formdata', compact('form', 'personasAfectadas', 'educacions', 'modalidadEducacions', 'pecuarios', 'saluds', 'detalleEnfermedades', 'infraestructuras', 'servicioBasicos', 'sectorPecuarios', 'sectorAgricolas', 'areaForestals', 'faunaSilvestres', 'asistencias', 'reforestacions'));
    }
}
