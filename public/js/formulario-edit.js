// // Acción cuando cambia el select de la provincia
// $('#select_provincia').on('change', function() {
//     var id_provincia = $(this).val();
//     $('#respuesta_provincia').html('<div class="loading-indicator">Loading...</div>');
//     $.ajax({
//         url: "/admin/formularios/edit/provincia/" + id_provincia, // Cambié a 'edit' para indicar que es para actualización
//         type: "GET",
//         success: function(data) {
//             $('#respuesta_provincia').html(data);
//         },
//         error: function() {
//             $('#respuesta_provincia').html('<div class="error-message">An error occurred. Please try again later.</div>');
//         }
//     });
// });

// Acción cuando cambia el select de municipio
// $(document).on('change', '#select_municipio', function(){
//     var id_municipio = $(this).val();
//     if(id_municipio) {
//         $.ajax({
//             url: "/admin/formularios/edit/get-alcalde/" + id_municipio,
//             type: "GET",
//             success: function(response) {
//                 if (response.nombre_alcalde) {
//                     $('#nombre_alcalde').val(response.nombre_alcalde);
//                 } else {
//                     $('#nombre_alcalde').val('');
//                 }
//             },
//             error: function() {
//                 alert('Error al cargar el nombre del alcalde');
//             }
//         });

//         $.ajax({
//             url: "/admin/formularios/edit/get-poblacion/" + id_municipio,
//             type: "GET",
//             success: function(response) {
//                 if (response.poblacion_total) {
//                     $('#poblacion_total').val(response.poblacion_total);
//                 } else {
//                     $('#poblacion_total').val('');
//                 }
//             },
//             error: function() {
//                 alert('Error al cargar la población total');
//             }
//         });
//     } else {
//         $('#nombre_alcalde').val('');
//         $('#poblacion_total').val('');
//     }
// });
$('#select_provincia').on('change', function() {
    var id_provincia = $(this).val();  // Obtener el id de la provincia seleccionada
    $('#respuesta_provincia').html('<div class="loading-indicator">Cargando...</div>');  // Mostrar el mensaje de carga

    // Realizar la solicitud AJAX para cargar los municipios
    $.ajax({
        url: '/admin/formularios/create/provincia/' + id_provincia,  // La URL del controlador
        type: 'GET',
        success: function(data) {
            // Llenar el select de municipios con los nuevos datos
            $('#respuesta_provincia').html(data);
        },
        error: function() {
            $('#respuesta_provincia').html('<div class="error-message">Ocurrió un error. Intenta de nuevo.</div>');
        }
    });
});

// $('#select_provincia').on('change', function() {
//     var id_provincia = $(this).val();

//     $('#respuesta_provincia').html('<div class="loading-indicator">Cargando...</div>');
//     $.ajax({
//         url: "/admin/formularios/create/provincia/" + id_provincia,
//         type: "GET",
//         success: function(data) {
//             $('#respuesta_provincia').html(data);
//         },
//         error: function() {
//             $('#respuesta_provincia').html('<div class="error-message">An error occurred. Please try again later.</div>');
//         }
//     });
// });



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


// funcion para actualizar cantidad afectados
function actualizarTotalPersonaAfectada() {
    let cantidadAfectados = {};
    document.querySelectorAll('.cantidad_afectados').forEach(input => {
        let grupoId = input.getAttribute('data-grupo-id');
        cantidadAfectados[grupoId] = input.value;
    });

    $.ajax({
        url: actualizarTotalAfectadosUrl,  // Usamos la variable que contiene la URL generada por Laravel
        type: "POST",  // Método POST
        data: {
            _token: token,  // Agregar CSRF token para Laravel
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


// funcion para actualizar cantidad total educacion
function actualizarTotalesEducacion() {
    let cantidadEstudiantes = {};

    // Recolectamos los datos de los inputs para los estudiantes por modalidad
    document.querySelectorAll('.num-estudiantes').forEach(input => {
        let modalidadId = input.getAttribute('data-modalidad-id');
        let institucionId = input.getAttribute('data-institucion-id');
        let valor = parseInt(input.value) || 0;

        if (!cantidadEstudiantes[modalidadId]) {
            cantidadEstudiantes[modalidadId] = 0;
        }
        cantidadEstudiantes[modalidadId] += valor;
    });

    // Actualizamos los totales por modalidad
    for (let modalidadId in cantidadEstudiantes) {
        $('#total-modalidad-' + modalidadId).text(cantidadEstudiantes[modalidadId]);
    }

    // Actualizamos el total general
    let totalGeneral = Object.values(cantidadEstudiantes).reduce((a, b) => a + b, 0);
    $('#total-general').text(totalGeneral);
}

// Al cargar la página, actualizamos los totales para mostrar el valor inicial
document.addEventListener('DOMContentLoaded', () => {
    actualizarTotalesEducacion();
});
//----------------------------------------

function actualizarTotalesSalud() {
    let cantidadEnfermos = {};
    let totalesPorEnfermedad = {};
    let totalesPorGrupoEtario = {};  // Objeto para los totales por grupo etario
    let totalGeneral = 0;

    // Recorremos los inputs para recolectar los valores
    document.querySelectorAll('.cantidad_grupo_enfermos').forEach(input => {
        let enfermedadId = input.getAttribute('name').match(/\[(\d+)\]/)[1]; // Extraemos el ID de la enfermedad
        let grupoEtarioId = input.getAttribute('name').match(/\[(\d+)\]\[(\d+)\]/)[2]; // Extraemos el ID del grupo etario
        let valor = parseInt(input.value) || 0;  // Obtener el valor del input

        // console.log("Enfermedad ID:", enfermedadId, "Grupo Etario ID:", grupoEtarioId, "Valor:", valor);

        // Guardamos los valores por enfermedad y grupo etario
        if (!cantidadEnfermos[enfermedadId]) {
            cantidadEnfermos[enfermedadId] = {};
        }
        cantidadEnfermos[enfermedadId][grupoEtarioId] = valor;

        // Sumar para los totales por enfermedad
        if (!totalesPorEnfermedad[enfermedadId]) {
            totalesPorEnfermedad[enfermedadId] = 0;
        }
        totalesPorEnfermedad[enfermedadId] += valor;

        // Sumar para los totales por grupo etario
        if (!totalesPorGrupoEtario[grupoEtarioId]) {
            totalesPorGrupoEtario[grupoEtarioId] = 0;
        }
        totalesPorGrupoEtario[grupoEtarioId] += valor;

        // Sumar al total general
        totalGeneral += valor;

        // console.log("Enfermedad ID: " + enfermedadId);
        // console.log("Grupo Etario ID: " + grupoEtarioId);
        // console.log("Valor del input: " + valor);

    });

    // Actualizamos los totales en la interfaz de usuario
    for (let grupoEtarioId in totalesPorGrupoEtario) {
        let totalCelda = document.getElementById("total-grupo-etario-" + grupoEtarioId);
        if (totalCelda) {
            totalCelda.textContent = totalesPorGrupoEtario[grupoEtarioId]; // Actualiza el total por grupo etario
        }
    }

    // Enviamos los datos al servidor con AJAX usando `fetch`
    fetch(actualizarTotalSaludUrl, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": token  // Aseguramos que se pase el token CSRF
        },
        body: JSON.stringify({
            cantidad_grupo_enfermos: cantidadEnfermos  // Enviamos los datos de enfermos

        })
    })
    .then(response => response.json())
    .then(data => {
        console.log(data);  // Ver la respuesta en la consola

        // Actualizamos los totales por enfermedad
        for (let enfermedadId in data.totalesPorEnfermedad) {
            let totalCelda = document.getElementById("total-enfermedad-" + enfermedadId);
            if (totalCelda) {
                totalCelda.textContent = data.totalesPorEnfermedad[enfermedadId];
            }
        }
          // Actualizamos los totales por grupo etario
        for (let grupoEtarioId in data.totalesPorGrupoEtario) {
            let totalCelda = document.getElementById("total-grupo-etario-" + grupoEtarioId);
            if (totalCelda) {
                totalCelda.textContent = data.totalesPorGrupoEtario[grupoEtarioId];
            }
        }

        // Actualizamos el total global
        let totalGeneralCelda = document.getElementById("cantidad_grupo_enfermos_total-global");
        if (totalGeneralCelda) {
            totalGeneralCelda.textContent = data.totalGeneral;
        }
    })
    .catch(error => {
        console.error("Error al actualizar los totales:", error);
    });
}

// Al cargar la página, actualizamos los totales para mostrar el valor inicial
document.addEventListener('DOMContentLoaded', () => {
    actualizarTotalesSalud();  // Actualiza los totales al cargar la página
});
//-----------------------------------------
function actualizarTotalesInfraestructuras() {
    let totalInfraestructuras = 0; // Variable para el total acumulado de infraestructuras afectadas
    let cantidadInfraestructuras = {}; // Objeto para almacenar los valores de infraestructuras afectadas por tipo

    // Recorremos todos los inputs con la clase '.infraestructra-afectadas'
    document.querySelectorAll('.infraestructra-afectadas').forEach(input => {
        // Extraemos el ID del tipo de infraestructura del atributo 'name' del input
        let tipoInfraestructuraId = input.getAttribute('name').match(/\[(\d+)\]/)[1];
        let valor = parseInt(input.value) || 0; // Obtenemos el valor del input o 0 si está vacío o no es válido

        // Almacenamos el valor de la infraestructura afectada por tipo de infraestructura
        cantidadInfraestructuras[tipoInfraestructuraId] = valor;

        // Sumar el valor al total general de infraestructuras afectadas
        totalInfraestructuras += valor;
    });

    // Actualizamos el total mostrado en la interfaz
    document.getElementById('total-infraestructuras').textContent = totalInfraestructuras;

    // Enviamos los datos al servidor usando `fetch` (AJAX)
    fetch(actualizarInfraestructurasUrl, {  // `actualizarInfraestructurasUrl` es la URL de tu ruta en el backend
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": token  // Necesitamos pasar el token CSRF para la seguridad
        },
        body: JSON.stringify({
            numeros_infraestructuras_afectadas: cantidadInfraestructuras  // Enviamos el objeto con los datos de infraestructuras
        })
    })
    .then(response => response.json())  // Procesamos la respuesta JSON del servidor
    .then(data => {
        console.log(data); // Aquí puedes verificar lo que devuelve el servidor
        // Si el servidor devuelve algo que deba ser actualizado en la interfaz, puedes hacerlo aquí
    })
    .catch(error => {
        console.error("Error al actualizar los totales:", error);  // Manejamos errores si ocurren
    });
}

// Llamamos a la función cada vez que cambie el valor de un input
document.querySelectorAll('.infraestructra-afectadas').forEach(input => {
    input.addEventListener('input', actualizarTotalesInfraestructuras);
});

// También puedes llamar a la función cuando se cargue la página si quieres actualizar el total desde el inicio
document.addEventListener('DOMContentLoaded', () => {
    actualizarTotalesInfraestructuras();  // Actualiza los totales al cargar la página
});


//------------------------------------------------
// Función para actualizar el total de comunidades afectadas de servicios basicos
function actualizarTotalesComunidadesAfectadas() {
    let totalComunidadesAfectadas = 0;
    let comunidadesAfectadas = {}; // Objeto para almacenar los valores de comunidades afectadas por tipo de servicio

    // Recorremos todos los inputs con la clase '.numero_comunidades_afectadas'
    document.querySelectorAll('.numero_comunidades_afectadas').forEach(input => {
        let tipoServicioBasicoId = input.getAttribute('name').match(/\[(\d+)\]/)[1]; // Extraemos el ID del servicio básico
        let valor = parseInt(input.value) || 0; // Obtenemos el valor del input o 0 si está vacío o no es válido

        // Almacenamos el valor de comunidades afectadas por tipo de servicio
        comunidadesAfectadas[tipoServicioBasicoId] = valor;

        // Sumar al total de comunidades afectadas
        totalComunidadesAfectadas += valor;
    });

    // Actualizamos el total en la interfaz
    document.getElementById('total-comunidades-afectadas').textContent = totalComunidadesAfectadas;

    // Enviar los datos al servidor usando fetch (AJAX)
    fetch(actualizarComunidadesAfectadasUrl, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": token  // Token CSRF necesario para la seguridad
        },
        body: JSON.stringify({
            numero_comunidades_afectadas: comunidadesAfectadas  // Enviamos los valores al servidor
        })
    })
    .then(response => response.json())
    .then(data => {
        console.log(data); // Ver el resultado de la respuesta
        // Aquí puedes manejar cualquier dato adicional que quieras actualizar en la interfaz si es necesario
    })
    .catch(error => {
        console.error("Error al actualizar los totales:", error);
    });
}

// Llamamos a la función cada vez que cambie el valor de un input
document.querySelectorAll('.numero_comunidades_afectadas').forEach(input => {
    input.addEventListener('input', actualizarTotalesComunidadesAfectadas);
});

// También puedes llamar a la función cuando se cargue la página si quieres actualizar el total desde el inicio
document.addEventListener('DOMContentLoaded', () => {
    actualizarTotalesComunidadesAfectadas();  // Actualiza los totales al cargar la página
});


//--------------------------------
function actualizarTotalesPecuarios() {
    let totalAnimalesAfectados = 0;
    let totalAnimalesFallecidos = 0;
    let animalesAfectados = {}; // Para almacenar los valores de animales afectados por especie
    let animalesFallecidos = {}; // Para almacenar los valores de animales fallecidos por especie

    // Recorremos todos los inputs con la clase '.numero-animales-afectados'
    document.querySelectorAll('.numero-animales-afectados').forEach(input => {
        let tipoEspecieId = input.getAttribute('name').match(/\[(\d+)\]/)[1]; // Extraemos el ID de la especie
        let valorAfectados = parseInt(input.value) || 0; // Obtenemos el valor de afectados o 0 si no es válido

        // Almacenamos el valor de animales afectados por especie
        animalesAfectados[tipoEspecieId] = valorAfectados;

        // Sumamos al total de animales afectados
        totalAnimalesAfectados += valorAfectados;
    });

    // Recorremos todos los inputs con la clase '.numero-animales-fallecidos'
    document.querySelectorAll('.numero-animales-fallecidos').forEach(input => {
        let tipoEspecieId = input.getAttribute('name').match(/\[(\d+)\]/)[1]; // Extraemos el ID de la especie
        let valorFallecidos = parseInt(input.value) || 0; // Obtenemos el valor de fallecidos o 0 si no es válido

        // Almacenamos el valor de animales fallecidos por especie
        animalesFallecidos[tipoEspecieId] = valorFallecidos;

        // Sumamos al total de animales fallecidos
        totalAnimalesFallecidos += valorFallecidos;
    });

    // Actualizamos los totales en la interfaz
    document.getElementById('total-animales-afectados').textContent = totalAnimalesAfectados;
    document.getElementById('total-animales-fallecidos').textContent = totalAnimalesFallecidos;

    // Enviar los datos al servidor usando fetch (AJAX)
    fetch(actualizarPecuariosUrl, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": token  // Token CSRF necesario para la seguridad
        },
        body: JSON.stringify({
            numero_animales_afectados: animalesAfectados,  // Enviamos los animales afectados por especie
            numero_animales_fallecidos: animalesFallecidos // Enviamos los animales fallecidos por especie
        })
    })
    .then(response => response.json())
    .then(data => {
        console.log(data); // Ver el resultado de la respuesta
        // Aquí puedes manejar cualquier dato adicional que quieras actualizar en la interfaz si es necesario
    })
    .catch(error => {
        console.error("Error al actualizar los totales:", error);
    });
}

// Llamamos a la función cada vez que cambie el valor de los inputs
document.querySelectorAll('.numero-animales-afectados, .numero-animales-fallecidos').forEach(input => {
    input.addEventListener('input', actualizarTotalesPecuarios);
});

// También puedes llamar a la función cuando se cargue la página si quieres actualizar el total desde el inicio
document.addEventListener('DOMContentLoaded', () => {
    actualizarTotalesPecuarios();  // Actualiza los totales al cargar la página
});

//--------------------------------
function actualizarTotalesAgricolas() {
    let totalHectareasAfectadas = 0;
    let totalHectareasPerdidas = 0;
    let hectareasAfectadas = {}; // Objeto para almacenar las hectáreas afectadas por tipo de cultivo
    let hectareasPerdidas = {}; // Objeto para almacenar las hectáreas perdidas por tipo de cultivo

    // Recorremos todos los inputs de hectáreas afectadas
    document.querySelectorAll('.hectareas-afectadas').forEach(input => {
        let tipoCultivoId = input.getAttribute('name').match(/\[(\d+)\]/)[1]; // Extraemos el ID del tipo de cultivo
        let valorAfectadas = parseFloat(input.value) || 0; // Obtenemos el valor de hectáreas afectadas o 0 si no es válido

        // Almacenamos el valor de hectáreas afectadas por tipo de cultivo
        hectareasAfectadas[tipoCultivoId] = valorAfectadas;

        // Sumar al total de hectáreas afectadas
        totalHectareasAfectadas += valorAfectadas;
    });

    // Recorremos todos los inputs de hectáreas perdidas
    document.querySelectorAll('.hectareas-perdidas').forEach(input => {
        let tipoCultivoId = input.getAttribute('name').match(/\[(\d+)\]/)[1]; // Extraemos el ID del tipo de cultivo
        let valorPerdidas = parseFloat(input.value) || 0; // Obtenemos el valor de hectáreas perdidas o 0 si no es válido

        // Almacenamos el valor de hectáreas perdidas por tipo de cultivo
        hectareasPerdidas[tipoCultivoId] = valorPerdidas;

        // Sumar al total de hectáreas perdidas
        totalHectareasPerdidas += valorPerdidas;
    });

    // Actualizamos los totales en la interfaz
    document.getElementById('total-hectareas-afectadas').textContent = totalHectareasAfectadas;
    document.getElementById('total-hectareas-perdidas').textContent = totalHectareasPerdidas;

    // Enviar los datos al servidor usando fetch (AJAX)
    fetch(actualizarAgricolasUrl, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": token  // Token CSRF necesario para la seguridad
        },
        body: JSON.stringify({
            hectareas_afectadas: hectareasAfectadas,  // Enviamos las hectáreas afectadas por tipo de cultivo
            hectareas_perdidas: hectareasPerdidas // Enviamos las hectáreas perdidas por tipo de cultivo
        })
    })
    .then(response => response.json())
    .then(data => {
        console.log(data); // Ver el resultado de la respuesta
        // Aquí puedes manejar cualquier dato adicional que quieras actualizar en la interfaz si es necesario
    })
    .catch(error => {
        console.error("Error al actualizar los totales:", error);
    });
}

// Llamamos a la función cada vez que cambie el valor de los inputs
document.querySelectorAll('.hectareas-afectadas, .hectareas-perdidas').forEach(input => {
    input.addEventListener('input', actualizarTotalesAgricolas);
});

// También puedes llamar a la función cuando se cargue la página si quieres actualizar el total desde el inicio
document.addEventListener('DOMContentLoaded', () => {
    actualizarTotalesAgricolas();  // Actualiza los totales al cargar la página
});

//------------------------------------
function actualizarTotalesForestales() {
    let totalHectareasPerdidasForestales = 0;
    let hectareasPerdidasForestales = {}; // Objeto para almacenar hectáreas perdidas por tipo de área forestal

    // Recorremos todos los inputs de hectáreas perdidas forestales
    document.querySelectorAll('.hectareas-perdidas-forestales').forEach(input => {
        let detalleAreaForestalId = input.getAttribute('name').match(/\[(\d+)\]/)[1]; // Extraemos el ID del detalle del área forestal
        let valorPerdidas = parseFloat(input.value) || 0; // Obtenemos el valor de hectáreas perdidas o 0 si no es válido

        // Almacenamos el valor de hectáreas perdidas forestales por tipo de área forestal
        hectareasPerdidasForestales[detalleAreaForestalId] = valorPerdidas;

        // Sumar al total de hectáreas perdidas forestales
        totalHectareasPerdidasForestales += valorPerdidas;
    });

    // Actualizamos el total de hectáreas perdidas forestales en la interfaz
    document.getElementById('total-hectareas-perdidas-forestales').textContent = totalHectareasPerdidasForestales;

    // Enviar los datos al servidor usando fetch (AJAX)
    fetch(actualizarForestalesUrl, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": token  // Token CSRF necesario para la seguridad
        },
        body: JSON.stringify({
            hectareas_perdidas_forestales: hectareasPerdidasForestales  // Enviamos las hectáreas perdidas forestales por tipo de área forestal
        })
    })
    .then(response => response.json())
    .then(data => {
        console.log(data); // Ver el resultado de la respuesta
        // Aquí puedes manejar cualquier dato adicional que quieras actualizar en la interfaz si es necesario
    })
    .catch(error => {
        console.error("Error al actualizar los totales:", error);
    });
}

// Llamamos a la función cada vez que cambie el valor de los inputs
document.querySelectorAll('.hectareas-perdidas-forestales').forEach(input => {
    input.addEventListener('input', actualizarTotalesForestales);
});

// También puedes llamar a la función cuando se cargue la página para actualizar los totales si ya hay valores preexistentes
document.addEventListener('DOMContentLoaded', () => {
    actualizarTotalesForestales();  // Actualiza los totales al cargar la página
});

//---------------------------------
function actualizarTotalesFaunaSilvestre() {
    let totalFaunaSilvestre = 0;
    let faunaSilvestreData = {}; // Objeto para almacenar los valores de fauna silvestre afectada por especie

    // Recorremos todos los inputs de fauna silvestre afectada
    document.querySelectorAll('.fauna-silvestre').forEach(input => {
        let detalleFaunaSilvestreId = input.getAttribute('name').match(/\[(\d+)\]/)[1];  // Extraemos el ID de detalle de fauna silvestre
        let tipoEspecieId = input.getAttribute('name').match(/\[(\d+)\]\[(\d+)\]/)[2];  // Extraemos el ID de tipo de especie
        let cantidad = parseInt(input.value) || 0; // Obtenemos el valor o 0 si está vacío o es inválido

        // Almacenamos los valores en el objeto para cada detalle de fauna silvestre y tipo de especie
        if (!faunaSilvestreData[detalleFaunaSilvestreId]) {
            faunaSilvestreData[detalleFaunaSilvestreId] = {};
        }
        faunaSilvestreData[detalleFaunaSilvestreId][tipoEspecieId] = cantidad;

        // Sumamos al total
        totalFaunaSilvestre += cantidad;
    });

    // Actualizamos el total de fauna silvestre afectada en la interfaz
    document.getElementById('total-fauna-silvestre').textContent = totalFaunaSilvestre;

    // Enviar los datos al servidor usando fetch (AJAX)
    fetch(actualizarFaunaSilvestreUrl, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": token  // Token CSRF necesario para la seguridad
        },
        body: JSON.stringify({
            fauna_silvestre_afectada: faunaSilvestreData  // Enviamos los valores de fauna silvestre afectada
        })
    })
    .then(response => response.json())
    .then(data => {
        console.log(data); // Ver el resultado de la respuesta
        // Aquí puedes manejar cualquier dato adicional que quieras actualizar en la interfaz si es necesario
    })
    .catch(error => {
        console.error("Error al actualizar los totales:", error);
    });
}

// Llamamos a la función cada vez que cambie el valor de los inputs
document.querySelectorAll('.fauna-silvestre').forEach(input => {
    input.addEventListener('input', actualizarTotalesFaunaSilvestre);
});

// También puedes llamar a la función cuando se cargue la página para actualizar los totales si ya hay valores preexistentes
document.addEventListener('DOMContentLoaded', () => {
    actualizarTotalesFaunaSilvestre();  // Actualiza los totales al cargar la página
});

//-----------------------
function actualizarTotalPlantines() {
    let totalPlantines = 0;

    // Recorremos todos los inputs de cantidad de plantines
    document.querySelectorAll('.cantidad-plantines').forEach(input => {
        let cantidad = parseInt(input.value) || 0; // Obtenemos el valor o 0 si es vacío o no es válido
        totalPlantines += cantidad; // Sumamos al total
    });

    // Actualizamos el total de plantines en el DOM
    document.getElementById('totalPlantines').textContent = totalPlantines;

    // Si deseas enviar los datos al servidor, puedes hacerlo usando AJAX
    let plantinesData = [];
    document.querySelectorAll('.cantidad-plantines').forEach((input, index) => {
        let plantinId = document.querySelectorAll('input[name="id_plantins[]"]')[index].value;
        let cantidad = parseInt(input.value) || 0;
        plantinesData.push({ id: plantinId, cantidad: cantidad });
    });

    // Enviar los datos al servidor usando fetch
    fetch(actualizarReforestacionUrl, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": token // Token CSRF para la seguridad
        },
        body: JSON.stringify({
            plantines: plantinesData
        })
    })
    .then(response => response.json())
    .then(data => {
        console.log(data); // Puedes manejar la respuesta si es necesario
    })
    .catch(error => {
        console.error("Error al actualizar los datos de reforestación:", error);
    });
}

// Llamamos a la función cada vez que cambie el valor de los inputs
document.querySelectorAll('.cantidad-plantines').forEach(input => {
    input.addEventListener('input', actualizarTotalPlantines);
});

// También puedes llamar a la función al cargar la página para actualizar los totales si ya hay valores preexistentes
document.addEventListener('DOMContentLoaded', () => {
    actualizarTotalPlantines();  // Actualiza el total al cargar la página
});



// // actualizar el total de reforestacion
// document.addEventListener('DOMContentLoaded', function() {
//     const inputs = document.querySelectorAll('input[name="cantidad_plantines[]"]');
//     const totalElement = document.getElementById('totalPlantines');

//     // Función para actualizar la suma total
//     function updateTotal() {
//         let total = 0;
//         // Itera sobre todos los inputs y suma sus valores
//         inputs.forEach(function(input) {
//             total += parseInt(input.value) || 0;  // Asegura que no se sumen valores NaN
//         });
//         // Muestra el total actualizado
//         totalElement.textContent = total;
//     }

//     // Agrega un listener de evento 'input' a cada campo
//     inputs.forEach(function(input) {
//         input.addEventListener('input', updateTotal);
//     });

//     // Inicializa la suma al cargar la página
//     updateTotal();
// });
