// Acción cuando cambia el select de la provincia
$('#select_provincia').on('change', function() {
    var id_provincia = $(this).val();
    $('#respuesta_provincia').html('<div class="loading-indicator">Loading...</div>');
    $.ajax({
        url: "/admin/formularios/edit/provincia/" + id_provincia, // Cambié a 'edit' para indicar que es para actualización
        type: "GET",
        success: function(data) {
            $('#respuesta_provincia').html(data);
        },
        error: function() {
            $('#respuesta_provincia').html('<div class="error-message">An error occurred. Please try again later.</div>');
        }
    });
});

// Función para actualizar el total de afectados por incendios
function actualizarTotal() {
    let cantidadAfectados = {};
    document.querySelectorAll('.cantidad_afectados').forEach(input => {
        let grupoId = input.getAttribute('data-grupo-id');
        cantidadAfectados[grupoId] = input.value;
    });

    $.ajax({
        url: "/actualizarTotalAfectados",  // Ruta del controlador
        type: "POST",
        data: {
            _token: "{{ csrf_token() }}",
            cantidad_afectados_por_incendios: cantidadAfectados
        },
        success: function(response) {
            $('#totalAfectados').text(response.totalAfectados);
        },
        error: function() {
            alert("Hubo un error al actualizar el total.");
        }
    });
}

// Función para actualizar los totales cuando cambie un valor
document.querySelectorAll('.num-estudiantes').forEach(input => {
    input.addEventListener('input', function() {
        const modalidadId = input.dataset.modalidadId;
        const institucionId = input.dataset.institucionId;

        // Actualizamos el total de la modalidad
        let totalModalidad = 0;
        document.querySelectorAll(`input[data-modalidad-id="${modalidadId}"]`).forEach(i => {
            totalModalidad += parseInt(i.value) || 0;
        });

        document.getElementById(`total-modalidad-${modalidadId}`).textContent = totalModalidad;

        // Actualizamos el total general
        let totalGeneral = 0;
        document.querySelectorAll('[id^="total-modalidad-"]').forEach(total => {
            totalGeneral += parseInt(total.textContent) || 0;
        });

        document.getElementById('total-general').textContent = totalGeneral;
    });
});

// Función para actualizar los totales por enfermedad
document.querySelectorAll('.cantidad_grupo_enfermos').forEach(function(input) {
    input.addEventListener('change', function() {
        const detalleEnfermedadId = this.getAttribute('data-detalle-enfermedad-id');
        const grupoEtarioId = this.getAttribute('data-grupo-etario-id');
        const newValue = parseInt(this.value) || 0;

        updateRowTotal(grupoEtarioId);
        updateTotalEnfermedad(detalleEnfermedadId);
        updateGlobalTotal();
    });
});

function updateRowTotal(grupoEtarioId) {
    let rowTotal = 0;
    document.querySelectorAll(`.grupo-etario-row[data-grupo-etario-id="${grupoEtarioId}"] .cantidad_grupo_enfermos`).forEach(function(input) {
        rowTotal += parseInt(input.value) || 0;
    });
    const rowTotalCell = document.querySelector(`.grupo-etario-row[data-grupo-etario-id="${grupoEtarioId}"] .row-total`);
    rowTotalCell.textContent = rowTotal;
}

function updateTotalEnfermedad(detalleEnfermedadId) {
    let totalEnfermedad = 0;
    document.querySelectorAll(`.cantidad-input[data-detalle-enfermedad-id="${detalleEnfermedadId}"]`).forEach(function(input) {
        totalEnfermedad += parseInt(input.value) || 0;
    });
    const totalEnfermedadCell = document.querySelector(`.total-enfermedad[data-enfermedad-id="${detalleEnfermedadId}"]`);
    totalEnfermedadCell.textContent = totalEnfermedad;
}

function updateGlobalTotal() {
    let globalTotal = 0;
    document.querySelectorAll('.total-enfermedad').forEach(function(cell) {
        globalTotal += parseInt(cell.textContent) || 0;
    });
    document.getElementById('cantidad_grupo_enfermos_total-global').textContent = globalTotal;
}

// Función para actualizar el total de afectados
function updateTotal() {
    let total = 0;
    document.querySelectorAll('.affected-number').forEach(function(input) {
        total += parseFloat(input.value) || 0;
    });
    document.getElementById('total-affected').textContent = total;
}

updateTotal();

document.querySelectorAll('.affected-number').forEach(function(input) {
    input.addEventListener('input', updateTotal);
});

// Función para actualizar el total de comunidades afectadas
function updateTotalComunidades() {
    let total = 0;
    document.querySelectorAll('.numero_comunidades_afectadas').forEach(function(input) {
        total += parseFloat(input.value) || 0;
    });
    document.getElementById('total-comunidades-afectadas').textContent = total;
}

updateTotalComunidades();

document.querySelectorAll('.numero_comunidades_afectadas').forEach(function(input) {
    input.addEventListener('input', updateTotalComunidades);
});

// Función para actualizar los totales de animales afectados y fallecidos
function updateTotals() {
    let totalAfectados = 0;
    let totalFallecidos = 0;

    document.querySelectorAll('.affected-number').forEach(function(input) {
        totalAfectados += parseFloat(input.value) || 0;
    });

    document.querySelectorAll('.deceased-number').forEach(function(input) {
        totalFallecidos += parseFloat(input.value) || 0;
    });

    document.getElementById('total-animales-afectados').textContent = totalAfectados;
    document.getElementById('total-animales-fallecidos').textContent = totalFallecidos;
}

updateTotals();

document.querySelectorAll('.affected-number, .deceased-number').forEach(function(input) {
    input.addEventListener('input', updateTotals);
});

// Función para actualizar los totales de hectáreas afectadas y perdidas
function updateHectaresTotals() {
    let totalAfectadas = 0;
    let totalPerdidas = 0;

    document.querySelectorAll('.affected-hectares').forEach(function(input) {
        totalAfectadas += parseFloat(input.value) || 0;
    });

    document.querySelectorAll('.lost-hectares').forEach(function(input) {
        totalPerdidas += parseFloat(input.value) || 0;
    });

    document.getElementById('total-hectareas-afectadas').textContent = totalAfectadas;
    document.getElementById('total-hectareas-perdidas').textContent = totalPerdidas;
}

updateHectaresTotals();

document.querySelectorAll('.affected-hectares, .lost-hectares').forEach(function(input) {
    input.addEventListener('input', updateHectaresTotals);
});

// Acción cuando cambia el select de municipio
$(document).on('change', '#select_municipio', function(){
    var id_municipio = $(this).val();
    if(id_municipio) {
        $.ajax({
            url: "/admin/formularios/edit/get-alcalde/" + id_municipio,
            type: "GET",
            success: function(response) {
                if (response.nombre_alcalde) {
                    $('#nombre_alcalde').val(response.nombre_alcalde);
                } else {
                    $('#nombre_alcalde').val('');
                }
            },
            error: function() {
                alert('Error al cargar el nombre del alcalde');
            }
        });

        $.ajax({
            url: "/admin/formularios/edit/get-poblacion/" + id_municipio,
            type: "GET",
            success: function(response) {
                if (response.poblacion_total) {
                    $('#poblacion_total').val(response.poblacion_total);
                } else {
                    $('#poblacion_total').val('');
                }
            },
            error: function() {
                alert('Error al cargar la población total');
            }
        });
    } else {
        $('#nombre_alcalde').val('');
        $('#poblacion_total').val('');
    }
});
