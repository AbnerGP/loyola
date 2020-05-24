<?php
Route::get('solicitudes', 'RequestController@view')->name('request.view')->middleware('can:view,App\Models\Request');
Route::delete('solicitudes/{request}', 'RequestController@delete')->name('request.destroy')->middleware('can:delete,App\Models\Request');