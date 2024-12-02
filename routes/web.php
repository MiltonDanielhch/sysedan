<?php

use App\Http\Controllers\ComunidadController;
use App\Http\Controllers\Voyager\FormController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use TCG\Voyager\Facades\Voyager;

Route::get('login', function () {
    return redirect('admin/login');
})->name('login');

Route::get('/', function () {
    return redirect('admin');
});

Route::get('maintenance', function () {
    return view('errors.maintenance');
})->name('errors.maintenance');

Route::group(['prefix' => 'admin', 'middleware' => 'desarrollo.creativo'], function () {
    Voyager::routes();
    Route::resource('formularios', FormController::class)->middleware('auth');
    Route::get('formularios/ajax/list', [FormController::class, 'list'])->name('formularios.list');
    Route::get('formularios/create/provincia/{id_provincia}', [FormController::class, 'buscar_municipio'])->name('admin.formulario.buscar_municipio');
    Route::get('formularios/create/municipio/{id_municipio}', [FormController::class, 'buscar_comunidad'])->name('admin.formulario.buscar_comunidad');
    Route::get('formularios/create/get-alcalde/{municipioId}', [FormController::class, 'getAlcalde'])->name('admin.formulario.getAlcalde');
    Route::get('formularios/create/get-poblacion/{municipioId}', [FormController::class, 'getPoblacion'])->name('admin.formulario.getPoblacion');

    // Rutas para actualizar el formulario
    Route::get('formularios/edit/provincia/{provinciaId}', [FormController::class, 'getMunicipiosForEdit'])->name('get.municipios.edit');
    Route::get('formularios/edit/get-alcalde/{municipioId}', [FormController::class, 'getAlcaldeForEdit'])->name('get.alcalde.edit');
    Route::get('formularios/edit/get-poblacion/{municipioId}', [FormController::class, 'getPoblacionForEdit'])->name('get.poblacion.edit');


    Route::post('/actualizar-total-afectados', [FormController::class, 'actualizarTotalAfectados'])->name('actualizarTotalAfectados');

    Route::post('/comunidad', [ComunidadController::class, 'store'])->name('comunidad.store');

});

// Clear cache
Route::get('/admin/clear-cache', function() {
    Artisan::call('optimize:clear');
    return redirect('/admin/profile')->with(['message' => 'Cache eliminada.', 'alert-type' => 'success']);
})->name('clear.cache');
