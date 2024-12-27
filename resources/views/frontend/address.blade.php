<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mapa con Geocodificación</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
    <style>
        html, body, #map {
            height: 100%;
            width: 100%;
            margin: 0;
            padding: 0;
        }

        #form-container {
            position: absolute;
            top: 10px;
            left: 45px;
            z-index: 1000;
            background: rgba(255, 255, 255, 0.9);
            padding: 10px;
            border-radius: 5px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
        }

        #geocodeError {
            position: absolute;
            display: none;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            margin: auto;
            padding: 25px;
            width: 250px;
            height: 150px;
            background: #fff;
            border: 2px solid #000;
            font-weight: bold;
            font-size: 1.1em;
            text-align: center;
            z-index: 2000;
        }

        #errorCloseBtn {
            position: absolute;
            padding: 8px;
            top: 2px;
            right: 4px;
            font-weight: bold;
            font-size: 0.96em;
        }

        #errorText {
            margin-top: 30px;
        }

        button {
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <div id="map"></div>
    <div id="geocodeError">
        <button id="errorCloseBtn" onclick="document.getElementById('geocodeError').style.display = 'none';">X</button>
        <div id="errorText">No se encontró la ubicación. Intente con otro nombre de municipio o provincia.</div>
    </div>

    <div id="form-container">
        <form id="searchForm" onsubmit="submitSearch(); return false;">
            <label for="departamento">Departamento:</label>
            <input type="text" id="departamento" name="departamento" value="Beni"><br>

            <label for="provincia">Provincia:</label>
            <input type="text" id="provincia" name="provincia"><br>

            <label for="municipio">Municipio:</label>
            <input type="text" id="municipio" name="municipio"><br>

            <label for="comunidad">Comunidad:</label>
            <input type="text" id="comunidad" name="comunidad"><br>

            <button type="submit">Buscar</button>
            <button type="button" onclick="resetMap()">Restablecer</button>
        </form>
    </div>

    <script>
        'use strict';

        document.addEventListener('DOMContentLoaded', function() {
            console.log('DOM fully loaded and parsed');

            const map = L.map('map', {
                center: [-13.1795, -66.2419],
                zoom: 7,
            });

            const osm = L.tileLayer('//{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© <a href="//www.openstreetmap.org/">OpenStreetMap</a> contributors, CC BY-SA license'
            }).addTo(map);

            // Inicializamos el geocodificador
            const osmGeocoder = L.Control.Geocoder.nominatim();
            const geocoderControl = L.Control.geocoder({
                geocoder: osmGeocoder,
                collapsed: false
            }).addTo(map);

            // Función para geocodificar la dirección
            function geocodeAddress(address, fallbackAddress) {
                console.log('Geocoding address:', address);
                osmGeocoder.geocode(address, function(results) {
                    console.log('Geocode results:', results);
                    if (results.length > 0) {
                        const result = results[0];
                        console.log('Geocode result:', result);
                        if (result && result.center) {
                            map.setView(result.center, 14);
                            L.marker(result.center).addTo(map)
                                .bindPopup(result.name)
                                .openPopup();
                        } else {
                            console.error('Geocode result does not contain center:', result);
                            document.getElementById('geocodeError').style.display = 'block';
                        }
                    } else {
                        console.error('No geocode results found');
                        if (fallbackAddress) {
                            console.log('Trying fallback address:', fallbackAddress);
                            geocodeAddress(fallbackAddress);
                        } else {
                            document.getElementById('geocodeError').style.display = 'block';
                        }
                    }
                });
            }

            // Obtener parámetros de la URL y geocodificar
            const urlParams = new URLSearchParams(window.location.search);
            const provincia = urlParams.get('provincia');
            const municipio = urlParams.get('municipio');
            const comunidad = urlParams.get('comunidad');
            if (provincia && municipio) {
                document.getElementById('provincia').value = provincia;
                document.getElementById('municipio').value = municipio;
                if (comunidad) {
                    document.getElementById('comunidad').value = comunidad;
                    const address = `${comunidad}, ${municipio}, ${provincia}, Beni`;
                    const fallbackAddress = `${municipio}, ${provincia}, Beni`;
                    console.log('URL parameters:', { provincia, municipio, comunidad });
                    geocodeAddress(address, fallbackAddress);
                } else {
                    const address = `${municipio}, ${provincia}, Beni`;
                    console.log('URL parameters:', { provincia, municipio });
                    geocodeAddress(address);
                }
            }

            // Función para enviar la búsqueda
            window.submitSearch = function() {
                const departamento = document.getElementById('departamento').value;
                const provincia = document.getElementById('provincia').value;
                const municipio = document.getElementById('municipio').value;
                const comunidad = document.getElementById('comunidad').value;
                console.log('Search parameters:', { departamento, provincia, municipio, comunidad });
                if (departamento && provincia && municipio) {
                    let address = `${municipio}, ${provincia}, ${departamento}`;
                    let fallbackAddress = null;
                    if (comunidad) {
                        address = `${comunidad}, ${municipio}, ${provincia}, ${departamento}`;
                        fallbackAddress = `${municipio}, ${provincia}, ${departamento}`;
                    }
                    const searchInput = document.querySelector('.leaflet-control-geocoder-form input[type="search"]');
                    if (searchInput) {
                        searchInput.value = address;
                        const event = new KeyboardEvent('keydown', {
                            bubbles: true,
                            cancelable: true,
                            key: 'Enter',
                            keyCode: 13
                        });
                        searchInput.dispatchEvent(event);
                        geocodeAddress(address, fallbackAddress);
                    } else {
                        console.error('Search input not found');
                    }
                }
            }

            // Función para restablecer el mapa
            window.resetMap = function() {
                map.setView([-13.1795, -66.2419], 7);
                document.getElementById('searchForm').reset();
            }
        });
    </script>
</body>
</html>
