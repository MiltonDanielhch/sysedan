<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Agregar Comunidad</h4>
            </div>
            <div class="modal-body">
                <!-- Formulario dentro del modal -->
                <form id="modalForm" action="{{ route('comunidad.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="nombre_comunidad_modal">Nombre Comunidad</label>
                        <input type="text" name="nombre_comunidad" id="nombre_comunidad_modal" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="tipo_comunidad_modal">Tipo de Comunidad</label>
                        <select name="tipo_comunidad" id="tipo_comunidad_modal" class="form-control" required>
                            <option value="">Seleccione un tipo</option>
                            <option value="INDÍGENA">INDÍGENA</option>
                            <option value="CAMPESINA">CAMPESINA</option>
                            <option value="INTERCULTURAL">INTERCULTURAL</option>
                        </select>
                    </div>
                    <select name="municipio_id" id="select_municipio_modal" class="form-control" required>
                        <option value="" disabled selected>-- Selecciona un Municipio --</option>
                        @foreach ($municipios as $municipio)
                        <option value="{{ $municipio->id }}">{{ $municipio->nombre_municipio }}</option>
                        @endforeach
                    </select>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Guardar cambios</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>



