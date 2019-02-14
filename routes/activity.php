<?php


Route::group(['prefix' => 'activity', 'middleware' => ['web', 'auth', 'can:view-activity']], function () {

    // Dashboards
    //Route::get('/', '\jeremykenedy\LaravelLogger\App\Http\Controllers\LaravelLoggerController@showAccessLog')->name('activity');
    Route::get('/', 'LoggerController@showAccessLog')->name('activity');
    Route::get('/cleared', ['uses' => '\jeremykenedy\LaravelLogger\App\Http\Controllers\LaravelLoggerController@showClearedActivityLog'])->name('cleared');

    // Drill Downs
    Route::get('/log/{id}', '\jeremykenedy\LaravelLogger\App\Http\Controllers\LaravelLoggerController@showAccessLogEntry');
    Route::get('/cleared/log/{id}', '\jeremykenedy\LaravelLogger\App\Http\Controllers\LaravelLoggerController@showClearedAccessLogEntry');

    // Forms
    Route::delete('/clear-activity', ['uses' => '\jeremykenedy\LaravelLogger\App\Http\Controllers\LaravelLoggerController@clearActivityLog'])->name('clear-activity');
    Route::delete('/destroy-activity', ['uses' => '\jeremykenedy\LaravelLogger\App\Http\Controllers\LaravelLoggerController@destroyActivityLog'])->name('destroy-activity');
    Route::post('/restore-log', ['uses' => '\jeremykenedy\LaravelLogger\App\Http\Controllers\LaravelLoggerController@restoreClearedActivityLog'])->name('restore-activity');

    //Restablecer
    Route::put('/restablecer/{activity}', 'RestablecerController@restablecer')->name('activity.restablecer')->middleware('can:restore-activity');
});
