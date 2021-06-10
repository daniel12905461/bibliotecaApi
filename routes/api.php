<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\LibroController;
use App\Http\Controllers\ColeccionController;
use App\Http\Controllers\AutorController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PrestamoController;

use Illuminate\Support\Facades\DB;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);
Route::post('logout', [AuthController::class, 'logout']);

Route::resource('categorias', CategoriaController::class);
Route::get('categorias/habilitar/{id}', [CategoriaController::class, 'enabled']);
Route::get('categorias/habilitados/activos', [CategoriaController::class, 'habilitados']);

Route::post('libros/pdf', [LibroController::class, 'PDF']);
Route::get('libros/pdf', [LibroController::class, 'PDF']);
Route::post('libros/{id}', [LibroController::class, 'update']);
Route::get('libros/habilitar/{id}', [LibroController::class, 'enabled']);
Route::get('libros/habilitados/activos', [LibroController::class, 'habilitados']);
Route::post('libros/reporte/find', [LibroController::class, 'find']);
Route::resource('libros', LibroController::class);

// Route::get('colecions', [ColeccionController::class, 'index']);
// Route::post('colecions', [ColeccionController::class, 'store']);
// Route::get('colecions/habilitar/{id}', [ColeccionController::class, 'enabled']);
// Route::get('colecions/habilitados', [ColeccionController::class, 'habilitados']);
// Route::delete('colecions/{id}', [ColeccionController::class, 'destroy']);

Route::resource('autors', AutorController::class);
// Route::get('autors', [AutorController::class, 'index']);
// Route::post('autors', [AutorController::class, 'store']);
// Route::get('autors/{id}', [AutorController::class, 'show']);
// Route::put('autors/{id}', [AutorController::class, 'update']);
// Route::delete('autors/{id}', [AutorController::class, 'destroy']);
Route::get('autors/habilitar/{id}', [AutorController::class, 'enabled']);
Route::get('autors/habilitados/activos', [AutorController::class, 'habilitados']);

Route::get('prestamos/prestamos', [PrestamoController::class, 'prestamos']);
Route::get('prestamos/devoluciones', [PrestamoController::class, 'devoluciones']);
Route::get('prestamos/autorizar/{id}', [PrestamoController::class, 'autorizar']);
Route::get('prestamos/devolber/{id}', [PrestamoController::class, 'devolber']);
Route::resource('prestamos', PrestamoController::class);
