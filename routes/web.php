<?php

use App\Http\Controllers\PegawaiController;
use Illuminate\Support\Facades\Route;


Route::get('/', [PegawaiController::class, 'index'])->name('pegawai');
