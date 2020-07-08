<?php

use Illuminate\Support\Facades\Route;

Route::get('containers', 'Scolabs\Docker\ClientController@index');
Route::get('/container/{id}','Scolabs\Docker\ClientController@show');
