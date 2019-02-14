<?php
Route::group(['middleware' => 'can:view,App\Models\Libro'], function () {
    Route::get('libros', 'LibroController@index')->name('libros.view');
    Route::get('libros/mostrar/{libro}', 'LibroController@show')->name('libros.show');
});
Route::group(['middleware' => 'can:create,App\Models\Libro'], function () {
    Route::get('libros/nuevo', 'LibroController@create')->name('libros.create');
    Route::post('libros', 'LibroController@store')->name('libros.store');
    Route::post('libros/subir_archivos', 'LibroController@subir_archivos')->name('libros.upload');
});
Route::group(['middleware' => 'can:update,App\Models\Libro'], function () {
    Route::get('libros/{libro}', 'LibroController@edit')->name('libros.edit');
    Route::get('libros/archivos/{id}', 'LibroController@getArchivos')->name('libros.archivos');
    Route::put('libros/{libro}', 'LibroController@update')->name('libros.update');
});
Route::group(['middleware' => 'can:delete,App\Models\Libro'], function () {
    Route::delete('libros/{libro}', 'LibroController@delete')->name('libros.destroy');
    Route::put('libros/archivos/{id}', 'LibroController@delete_archivo')->name('libros.del_archivos');
});

/* Rutas de migracion */
Route::group(['prefix' => 'migracion', 'middleware' => 'can:migrate-biblioteca'], function(){
    Route::get('libros', 'MigrateController@index')->name('migracion');
    Route::get('libros_execute', 'MigrateController@iniciar')->name('migracion.view');
    Route::post('start_migration', 'MigrateController@migration_ready')->name('migracion.ready');
});
