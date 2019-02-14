<?php

Route::group(['namespace' => 'Cms'], function() {
    Route::group(['prefix' => 'page'], function() {
        Route::group(['middleware' => 'can:view,App\Models\Page'], function(){
            Route::get('/', 'PageController@index')->name('cms.page.index');
        });
        Route::group(['middleware' => 'can:create,App\Models\Page'], function(){
            Route::get('/create', 'PageController@create')->name('cms.page.create');
            Route::post('/create', 'PageController@store')->name('cms.page.store');
        });
        Route::group(['middleware' => 'can:update,App\Models\Page'], function() {
            Route::get('/{page}', 'PageController@edit')->name('cms.page.edit');
            Route::put('/{page}', 'PageController@update')->name('cms.page.upload');
        });
        Route::group(['middleware' => 'can:delete,App\Models\Page'], function() {
            Route::delete('/{page}', 'PageController@delete')->name('cms.page.destroy');
        });
    });
    Route::group(['prefix' => 'media'], function () {
        Route::get('/', 'MediaController@index')->name('cms.media.index');
        Route::delete('/{media}', 'MediaController@delete')->name('cms.media.destroy');

        Route::post('/upload', 'MediaController@upload')->name('cms.media.store');
        Route::get('/view_ajax', 'MediaController@view_ajax')->name('cms.media.view-ajax');
    });
});