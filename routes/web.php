<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\WebNewsController;
use App\Http\Controllers\PublicidadController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\NoticiasController;

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

// Route::get('/', [PublicidadController::class, 'index']);

// Route::get('/', [ScrappingController::class, 'index']);
// Route::get('/noticias2', [ScrappingControlphp arler::class, 'imparcial']);
// Route::get('/noticias3', [ScrappingController::class, 'rotativo']);
// Route::get('/noticias4', [ScrappingController::class, 'tiempo']);
// Route::get('/nacionales', [ScrappingNacionalController::class, 'altoNivelRecientes']);

/********** P U B L I C I D A D *************** */


Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'loginValidate']);
Route::get('/logout', [LoginController::class, 'logout']);

// administrador


Route::get('/admin', [AdminController::class, 'index'])->middleware('auth');
Route::resource('/admin/noticias', NoticiasController::class)->middleware('auth');


// Publicidad
Route::get('/admin/publicidad', [PublicidadController::class, 'index'])->middleware('auth');
Route::post('/admin/addPublicidad', [PublicidadController::class, 'store'])->middleware('auth');
Route::delete('/admin/deletePublicidad/{id}', [PublicidadController::class, 'destroy'])->middleware('auth');
Route::get('/admin/editPublicidad/{id}', [PublicidadController::class, 'edit'])->middleware('auth');
Route::patch('/admin/updatePublicidad/{id}', [PublicidadController::class, 'update'])->middleware('auth');




//Recientes


Route::get('/', function(){
    return redirect('/Recientes');
});

Route::get('/Recientes',[WebNewsController::class, 'Recientes']);
Route::get('/Salud',[WebNewsController::class, 'Salud']);
Route::get('/Economia',[WebNewsController::class, 'Economia']);
Route::get('/Deportes',[WebNewsController::class, 'Deportes']);
Route::get('/Covid',[WebNewsController::class, 'Covid']);