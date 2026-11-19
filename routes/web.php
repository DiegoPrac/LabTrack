<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DeviceController;

Route::get('/', function () {
    return redirect()->route('devices.index');
});

Route::resource('devices', DeviceController::class)->except(['show']);
