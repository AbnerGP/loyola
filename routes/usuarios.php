<?php
Route::group(['middleware' => 'can:view,App\Models\User'], function () {
    Route::get('usuarios', 'UserController@index')->name('users.view');
});
Route::group(['middleware' => 'can:create,App\Models\User'], function () {
    Route::get('usuarios/nuevo', 'UserController@create')->name('users.create');
    Route::post('usuarios', 'UserController@store')->name('users.store');
});
Route::group(['middleware' => 'can:update,App\Models\User'], function () {
    Route::put('usuarios/{user}', 'UserController@update')->name('users.update');
    Route::put('usuarios/status/{user}', 'UserController@change_status')->name('users.status');
    Route::put('usuarios/password/{user}', 'UserController@change_password')->name('users.password');
});
Route::group(['middleware' => 'can:delete,App\Models\User'], function () {
    Route::delete('usuarios/{user}', 'UserController@delete')->name('users.destroy');
});
