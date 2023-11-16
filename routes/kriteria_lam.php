<?php

Route::get('kriteria-lam', 'KriteriaController@index_lam')->name('kriterialam');
Route::get('kriteria-lam/getData/', 'KriteriaController@getData');
Route::post('kriteria-lam/store', 'KriteriaController@store');
Route::put('kriteria-lam/put', 'KriteriaController@put');
Route::delete('kriteria-lam/delete', 'KriteriaController@delete');
Route::get('search-kriteria-lam', 'KriteriaController@getLam');
