<?php

use App\Http\StatusController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth:api'], function () {
    Route::group(['prefix' => 'status'], function () {
        Route::get('/', [StatusController::class, 'getAll'])->name('status.index');
    });
});
