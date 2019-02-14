<?php
Route::group(['middleware' => 'can:view,App\Models\User'], function () {
    Route::get('usuarios', 'UserController@index')->name('usuarios.view');
});
Route::group(['middleware' => 'can:create,App\Models\User'], function () {
    Route::get('usuarios/nuevo', 'UserController@create')->name('usuarios.create');
    Route::post('usuarios', 'UserController@store')->name('usuarios.store');
});
Route::group(['middleware' => 'can:update,App\Models\User'], function () {
    Route::get('usuarios/{id}', 'UserController@edit')->name('usuarios.edit');
    Route::put('usuarios/{user}', 'UserController@update')->name('usuarios.update');
});
Route::group(['middleware' => 'can:delete,App\Models\User'], function () {
    Route::delete('usuarios/{user}', 'UserController@delete')->name('usuarios.destroy');
});