<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ScrappingController;
use App\Http\Controllers\ScrappingNacionalController;
use App\Http\Controllers\PublicidadController;
use App\Http\Controllers\LoginController;
/*
|-----------------------------------------|--------------------------------------------------------------------------
---------------------------------
| Web
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
Route::get('/nacionales', [ScrappingNacionalController::class, 'altoNivelRecientes']);

/********** P U B L I C I D A D *************** */


Route::get('/login', [LoginController::class, 'index']);
Route::post('/login', [LoginController::class, 'loginValidate']);
Route::get('/logout', [LoginController::class, 'logout']);



Route::get('/admin', [PublicidadController::class, 'index']);
Route::post('/admin/addPublicidad', [PublicidadController::class, 'store']);
Route::delete('/admin/deletePublicidad/{id}', [PublicidadController::class, 'destroy']);
Route::get('/admin/editPublicidad/{id}', [PublicidadController::class, 'edit']);
Route::patch('/admin/updatePublicidad/{id}', [PublicidadController::class, 'update']);

