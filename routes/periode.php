<?php

Route::get('periode', 'PeriodeController@index')->name('periode');
Route::get('periode/getData/', 'PeriodeController@getData');
Route::post('periode/store', 'PeriodeController@store');
Route::put('periode/put', 'PeriodeController@put');
Route::delete('periode/delete', 'PeriodeController@delete');
