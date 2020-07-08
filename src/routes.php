<?php

use Illuminate\Support\Facades\Route;

Route::get('containers', 'Scolabs\Docker\ClientController@index');
