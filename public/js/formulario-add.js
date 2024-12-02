
// Acción cuando cambia el select de la provincia
$('#select_provincia').on('change', function() {
    var id_provincia = $(this).val();

    $('#respuesta_provincia').html('<div class="loading-indicator">Loading...</div>');
    $.ajax({
        url: "/admin/formularios/create/provincia/" + id_provincia,
        type: "GET",
        success: function(data) {
            $('#respuesta_provincia').html(data);
        },
        error: function() {
            $('#respuesta_provincia').html('<div class="error-message">An error occurred. Please try again later.</div>');
        }
    });
});

// Acción cuando cambia el select de municipio (para cargar otros datos)
$(document).on('change', '#select_municipio', function(){
    var id_municipio = $(this).val();
    if(id_municipio){
        $.ajax({
            url: "/admin/formularios/create/municipio/" + id_municipio,
            type: "GET",
            success: function(data) {
                $('#respuesta_municipio').html(data);
            },
            error: function(xhr, status, error) {
                alert("An error occurred: " + error);
            }
        });
    } else {
        alert('Por favor, selecciona un municipio.');
    }
});

// Obtener el nombre del alcalde del municipio seleccionado
$(document).on('change', '#select_municipio', function(){
    var id_municipio = $(this).val();
    if(id_municipio){
        $.ajax({
            url:"/admin/formularios/create/get-alcalde/" + id_municipio,
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
    } else {
        $('#nombre_alcalde').val('');
    }
});

// Obtener la población total del municipio seleccionado
$(document).on('change', '#select_municipio', function(){
    var id_municipio = $(this).val();
    if(id_municipio){
        $.ajax({
            url:"/admin/formularios/create/get-poblacion/" + id_municipio,
            type: "GET",
            success: function(response) {
                if (response.poblacion_total) {
                    $('#poblacion_total').val(response.poblacion_total);
                } else {
                    $('#poblacion_total').val('');
                }
            },
            error: function() {
                alert('Error al cargar la población');
            }
        });
    } else {
        $('#poblacion_total').val('');
    }
});

// Enviar el formulario del modal con AJAX
$(document).ready(function () {
    $('#modalForm').on('submit', function (e) {
        e.preventDefault(); // Prevenir que el formulario se envíe de forma convencional

        var formData = $(this).serialize(); // Obtener todos los datos del formulario
        var url = "/admin/comunidad"; // Definir la URL de destino

        $.ajax({
            url: url, // La URL de destino del formulario
            method: 'POST',
            data: formData,
            success: function (response) {
                if (response.success) {
                    $('#nombre_comunidad').val(response.nombre_comunidad);
                    $('#tipo_comunidad').val(response.tipo_comunidad);
                    $('#select_municipio').val(response.municipio_id);

                    alert(response.message); // Muestra el mensaje de éxito
                    $('#myModal').modal('hide'); // Cerrar el modal
                } else {
                    alert("Hubo un error al guardar la comunidad");
                }
            },
            error: function () {
                alert("Ocurrió un error al intentar enviar los datos.");
            }
        });
    });
});
