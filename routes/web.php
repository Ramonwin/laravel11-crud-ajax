<?php

use App\Http\Controllers\PegawaiController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/pegawai', function () {
    return view('pegawai.index');
});

Route::resource('/pegawaiAjax', PegawaiController::class);
