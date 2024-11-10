@extends('voyager::master')
@section('css')
<meta name="csrf-token" content="{{ csrf_token() }}">
@stop
@section('page_title', isset($formulario) ? 'Editar formulario' : 'Crear formulario')

@section('page_header')
<h1 class="page-title">
    <i class="voyager-people"></i>
    {{ isset($formulario) ? 'Editar' : 'Crear' }} formulario
</h1>
@stop

@section('content')
<div class="page-content edit-add container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-bordered">
                <div class="panel-body">
                    <div class="form-group">
                        {{-- LISTADO DE LUGAR --}}
                        <div class="row">
                            <div class="panel-group" id="accordionLugar" role="tablist" aria-multiselectable="true">
                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="headingLugar">
                                        <h4 class="panel-title">
                                            <a role="button" data-toggle="collapse" data-parent="#accordionLugar"
                                                href="#collapseLugar" aria-expanded="true"
                                                aria-controls="collapseLugar">
                                                LISTADO DEL LUGAR
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseLugar" class="panel-collapse collapse in" role="tabpanel"
                                        aria-labelledby="headingLugar">
                                        <div class="panel-body">
                                            <div class="form-group col-md-6">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading"><b>Lugar</b></div>
                                                    <div class="panel-body">
                                                        {{-- Select Provincia --}}
                                                        <div class="form-group">
                                                            <label for="provincia"><b>Provincia</b></label>
                                                            <select name="provincia" id="select_provincia"
                                                                class="form-control" required>
                                                                <option value="" disabled selected>-- Selecciona
                                                                    Provincia--</option>
                                                                @foreach ($provincias as $provincia)
                                                                <option value="{{ $provincia->id }}">{{
                                                                    $provincia->nombre_provincia }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="page-content edit-add container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-bordered">
                            <div class="panel-body">
                                <div>
                                    <form action="{{route('formularios.store')}}" method="POST">
                                        {{ csrf_field() }}

                                        <div class="form-group">
                                            <label for="nombre">Nombre</label>
                                            <input type="text" class="form-control" name="nombre" id="nombre"
                                                placeholder="Nombre" value="" required>
                                        </div>

                                        {{-- <div class="form-group">
                                            <label for="">Unidad </label>
                                            <select name="unidad_id" id="unidad_id" class="form-control select2"
                                                required>
                                                <option value="">Seleccione una opción</option>
                                            </select>
                                        </div> --}}
                                        <button type="submit" class="btn btn-primary">Guardar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
