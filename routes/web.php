<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ScrappingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [ScrappingController::class, 'index']);
Route::get('/noticias2', [ScrappingController::class, 'imparcial']);
Route::get('/noticias3', [ScrappingController::class, 'rotativo']);
Route::get('/noticias4', [ScrappingController::class, 'tiempo']);
