<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TrabajoController;
use App\Http\Controllers\AuthController;
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

Route::get('/', function () {
    return view('welcome');
});



Auth::routes(['verify'=>true]);

Route::middleware(['verified'])->group(function(){

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    //PROYECTOS

    Route::get('/proyectos',[App\Http\Controllers\ProyectosController::class, 'index']);
    Route::post('/proyectos',[App\Http\Controllers\ProyectosController::class, 'store'])->name('proyecto');

    //trabajos
    Route::prefix('trabajo')->group(function () {
    Route::get('/nuevo', [App\Http\Controllers\TrabajoController::class, 'index'])->name('nuevoTrabajo');
    Route::post('/store',[App\Http\Controllers\TrabajoController::class, 'store'])->name('storeTrabajo');
    Route::get('/listado', [App\Http\Controllers\TrabajoController::class, 'listado'])->name('listadoTrabajos');
    });


    //USUARIOS

    Route::resource('usuario', UserController::class);
});


