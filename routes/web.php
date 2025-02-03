<?php

use Illuminate\Support\Facades\Route;
// Load custom routes file
require base_path('routes/api.php');

Route::get('/', function () {
    return view('welcome');
});
