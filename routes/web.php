<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TrabajoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FichaController;
use App\Http\Controllers\PacienteController;
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
    Route::post('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('searchPaciente');
    //PROYECTOS

    Route::get('/ficha/{idPaciente}',[App\Http\Controllers\FichaController::class, 'index']);
    Route::post('/historial/{idPaciente}',[App\Http\Controllers\FichaController::class, 'store'])->name('guardarHistorial');
    Route::post('/ficha/{idPaciente}',[App\Http\Controllers\FichaController::class, 'updateFicha'])->name('actualizarFicha');
    Route::post('/editar/ficha',[App\Http\Controllers\FichaController::class, 'update'])->name('editarFicha');

    //USUARIOS

    Route::resource('user', UserController::class)->name('*','user');
    Route::get('/pacientes/busqueda',[PacienteController::class,'busqueda'])->name('pacientes.busqueda');
    Route::post('/pacientes/busqueda',[PacienteController::class,'busqueda'])->name('pacientes.busqueda');
    Route::resource('pacientes', PacienteController::class);
});


