<?php
Route::group(['middleware' => 'can:view,App\Models\Categoria'], function () {
    Route::get('categorias', 'CategoriaController@index')->name('categorias.view');
});
Route::group(['middleware' => 'can:create,App\Models\Categoria'], function () {
    Route::get('categorias/nuevo', 'CategoriaController@create')->name('categorias.create');
    Route::post('categorias', 'CategoriaController@store')->name('categorias.store');
});
Route::group(['middleware' => 'can:update,App\Models\Categoria'], function () {
    Route::get('categorias/{id}', 'CategoriaController@edit')->name('categorias.edit');
    Route::put('categorias/{categoria}', 'CategoriaController@update')->name('categorias.update');
});
Route::group(['middleware' => 'can:delete,App\Models\Categoria'], function () {
    Route::delete('categorias/{categoria}', 'CategoriaController@delete')->name('categorias.destroy');
});