<?php

use App\Http\PedidoController;
use App\Http\StatusController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth:api'], function () {
    Route::group(['prefix' => 'status'], function () {
        Route::get('/', [StatusController::class, 'getAll'])->name('status.index');
    });

    Route::group(['prefix' => 'pedidos'], function () {
        Route::post('/store', [PedidoController::class, 'store'])->name('pedidos.store');
        Route::get('/edit/{id}', [PedidoController::class, 'edit'])->name('pedidos.edit');
        Route::delete('/delete/{id}', [PedidoController::class, 'delete'])->name('pedidos.delete');
    });
});
