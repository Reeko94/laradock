<?php

use Illuminate\Support\Facades\Route;

Route::get('containers', 'Scolabs\Docker\ClientController@index');
Route::get('/container/{id}','Scolabs\Docker\ClientController@show');
Route::get('stopContainer/{id}', 'Scolabs\Docker\ClientController@stopContainer');
Route::post('renameContainer/{id}', 'Scolabs\Docker\ClientController@renameContainer');
