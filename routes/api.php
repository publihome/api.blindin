<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ScrappingController;
use App\Http\Controllers\ScrappingNacionalController;
use App\Http\Controllers\NoticiasSecundarias;
use App\Http\Controllers\NoticiasTerciarias;
use App\Http\Controllers\NoticiasPrincipales;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
     return $request->user();
    
});

Route::get('/primarias/{region}',[NoticiasPrincipales::class, 'index']);
Route::get("/primarias/sports/{region}",[NoticiasPrincipales::class, 'sports']);
Route::get("/primarias/health/{region}",[NoticiasPrincipales::class, 'health']);
Route::get("/primarias/economy/{region}",[NoticiasPrincipales::class, 'economy']);

Route::get("/secundarias/{region}",[NoticiasSecundarias::class, 'index']);
Route::get("/secundarias/sports/{region}",[NoticiasSecundarias::class, 'sports']);
Route::get("/secundarias/health/{region}",[NoticiasSecundarias::class, 'health']);
Route::get("/secundarias/economy/{region}",[NoticiasSecundarias::class, 'economy']);

Route::get("/terciarias/{region}",[NoticiasTerciarias::class, 'index']);
Route::get("/terciarias/sports/{region}",[NoticiasTerciarias::class, 'sports']);
Route::get("/terciarias/health/{region}",[NoticiasTerciarias::class, 'health']);
Route::get("/terciarias/economy/{region}",[NoticiasTerciarias::class, 'economy']);

Route::get("/search/{word}",[ScrappingController::class, 'searchNew']);

Route::get("/oaxaca",[ScrappingController::class, 'index']);
Route::get("/nacionales",[ScrappingNacionalController::class, 'index']);
Route::get("/s",[ScrappingController::class, 'milenioHealth']);
