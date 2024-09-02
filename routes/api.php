<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\StudentController;


Route::get('index', [StudentController::class, 'index']);
Route::get('show/{id}', [StudentController::class, 'show']);
Route::post('store', [StudentController::class, 'store']);
Route::put('update/{id}', [StudentController::class, 'update']);
Route::delete('destroy/{id}', [StudentController::class, 'destroy']);
