<?php

use Illuminate\Support\Facades\Route;

Route::get('containers', 'Scolabs\Docker\ClientController@index');
Route::get('stopContainer/{id}', 'Scolabs\Docker\ClientController@stopContainer');
