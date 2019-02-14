<?php
Route::group(['middleware' => 'can:view,App\Models\Role'], function () {
    Route::get('roles', 'RolController@index')->name('roles.view');
});
Route::group(['middleware' => 'can:create,App\Models\Role'], function () {
    Route::get('roles/nuevo', 'RolController@create')->name('roles.create');
    Route::post('roles', 'RolController@store')->name('roles.store');
});
Route::group(['middleware' => 'can:update,App\Models\Role'], function () {
    Route::get('roles/{id}', 'RolController@edit')->name('roles.edit');
    Route::put('roles/{role}', 'RolController@update')->name('roles.update');
});
Route::group(['middleware' => 'can:delete,App\Models\Role'], function () {
    Route::delete('roles/{role}', 'RolController@delete')->name('roles.destroy');
});