<?php


Route::get('/', 'HomeController@index')->name('site.index');
Route::get('/quienes-somos', 'HomeController@about')->name('site.about');
Route::get('/niveles-educativos', 'HomeController@levels')->name('site.levels');
Route::get('/niveles-educativos/kinder', 'HomeController@kinder')->name('site.levels.kinder');
Route::get('/niveles-educativos/primaria', 'HomeController@primaria')->name('site.levels.primaria');
Route::get('/niveles-educativos/secundaria', 'HomeController@secundaria')->name('site.levels.secundaria');
Route::get('/niveles-educativos/preparatoria', 'HomeController@prepa')->name('site.levels.prepa');
Route::get('/language-school', 'HomeController@language')->name('site.language');
Route::get('/viajes', 'HomeController@viajes')->name('site.viajes');
Route::get('/logros', 'HomeController@logros')->name('site.logros');
Route::get('/instalaciones', 'HomeController@instalaciones')->name('site.instalaciones');
Route::get('/contacto', 'HomeController@contact')->name('site.contact');

Route::get('/libros', 'BibliotecaController@ViewLibros');
Route::post('/libros', 'BibliotecaController@ViewLibros')->name('libro.search');
Route::get('/libro/{id}/{name}', 'BibliotecaController@ViewLibro')->name('libro.single.view');

Route::get('{slug}', 'BibliotecaController@page');