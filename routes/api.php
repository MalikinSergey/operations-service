<?php

use App\Http\Controllers\Api\OperationController;
use Illuminate\Support\Facades\Route;


Route::get('/health', fn() => ['success' => true]);

// get чтобы удобнее тестить, в рабочем коде будет POST
Route::get('/operations/store', [OperationController::class, 'store']);

Route::get('/operations', [OperationController::class, 'index']);
