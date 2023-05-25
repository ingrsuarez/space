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

    Route::get('/ficha/{idPaciente}',[App\Http\Controllers\FichaController::class, 'index'])->name('ficha.index');
    Route::post('/historial/{idPaciente}',[App\Http\Controllers\FichaController::class, 'store'])->name('ficha.store');
    Route::post('/ficha/{idPaciente}',[App\Http\Controllers\FichaController::class, 'update'])->name('ficha.update');
    Route::post('/editar/ficha',[App\Http\Controllers\FichaController::class, 'update'])->name('ficha.edit');

    //USUARIOS

    Route::resource('user', UserController::class)->name('*','user');

    //PACIENTES
    Route::resource('paciente', PacienteController::class)->names('paciente');
    Route::post('paciente',[App\Http\Controllers\PacienteController::class,'index'])->name('paciente.index');
    Route::post('paciente/store',[App\Http\Controllers\PacienteController::class,'store'])->name('paciente.store');

    //PROFESSION
    Route::get('profession/index',[App\Http\Controllers\ProfessionController::class,'index'])->middleware('can:profession.index')->name('profession.index');
    Route::get('profession/add/{profession}',[App\Http\Controllers\ProfessionController::class,'add'])->middleware('can:profession.add')->name('profession.add');
    Route::post('profession/attach/{profession}',[App\Http\Controllers\ProfessionController::class,'attach'])->middleware('can:profession.attach')->name('profession.attach');
    Route::post('profession/detach/{profession}',[App\Http\Controllers\ProfessionController::class,'detach'])->middleware('can:profession.detach')->name('profession.detach');

    Route::get('profession/edit/{id}',[App\Http\Controllers\ProfessionController::class,'edit'])->middleware('can:profession.edit')->name('profession.edit');
    Route::post('profession/update/{profession}',[App\Http\Controllers\ProfessionController::class,'update'])->middleware('can:profession.update')->name('profession.update');    
    Route::get('profession/new',[App\Http\Controllers\ProfessionController::class,'create'])->middleware('can:profession.create')->name('profession.create');
    Route::get('profession/list',[App\Http\Controllers\ProfessionController::class,'list'])->middleware('can:profession.list')->name('profession.list');
    Route::post('profession/store',[App\Http\Controllers\ProfessionController::class,'store'])->middleware('can:profession.store')->name('profession.store');
 
    Route::get('entity/new',[App\Http\Controllers\EntityController::class,'create'])->middleware('can:entity.create')->name('entity.create');
    Route::post('entity/store',[App\Http\Controllers\EntityController::class,'store'])->middleware('can:entity.store')->name('entity.store');

    

    Route::get('registration/list',[App\Http\Controllers\RegistrationController::class,'list'])->middleware('can:registration.list')->name('registration.list');
    Route::post('registration/delete/{registration}',[App\Http\Controllers\RegistrationController::class,'delete'])->middleware('can:registration.delete')->name('registration.delete');

});


