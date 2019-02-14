<?php


Route::get('/', 'BibliotecaController@page');

Route::get('/libros', 'BibliotecaController@ViewLibros');
Route::post('/libros', 'BibliotecaController@ViewLibros')->name('libro.search');
Route::get('/libro/{id}/{name}', 'BibliotecaController@ViewLibro')->name('libro.single.view');

Route::get('{slug}', 'BibliotecaController@page');