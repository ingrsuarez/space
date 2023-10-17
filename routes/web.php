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

Route::get('/confirm/{token}', [App\Http\Controllers\GuestController::class, 'confirm'])->name('confirm.appointment');

Auth::routes(['verify'=>true]);

Route::middleware(['verified'])->group(function(){

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::post('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('searchPaciente');
    //HISTORIAL

    Route::get('/ficha/{idPaciente}',[App\Http\Controllers\FichaController::class, 'index'])->name('ficha.index');
    Route::post('/historial/{idPaciente}',[App\Http\Controllers\FichaController::class, 'store'])->name('ficha.store');
    Route::post('/ficha/{idPaciente}',[App\Http\Controllers\FichaController::class, 'update'])->name('ficha.update');
    Route::post('/editar/ficha',[App\Http\Controllers\FichaController::class, 'update'])->name('ficha.edit');

    //USUARIOS

    Route::resource('user', UserController::class)->name('*','user');
    Route::get('user/delete/{user}',[App\Http\Controllers\UserController::class,'destroy'])->middleware('can:user.delete')->name('user.delete');

    //PACIENTES
    Route::resource('paciente', PacienteController::class)->names('paciente');
    Route::post('paciente',[App\Http\Controllers\PacienteController::class,'index'])->name('paciente.index');
    Route::post('paciente/store',[App\Http\Controllers\PacienteController::class,'store'])->name('paciente.store');
    Route::post('paciente/createAndAppoint',[App\Http\Controllers\PacienteController::class,'createWithAppointment'])->name('createAndAppoint');
    Route::post('wating/attach/{paciente}/{institution}',[App\Http\Controllers\PacienteController::class,'wating_attach'])->middleware('can:wating.attach')->name('wating.attach');

   Route::get('wating/detach/{paciente}/{institution}',[App\Http\Controllers\PacienteController::class,'wating_detach'])->name('wating.detach');
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

    //INSTITUTION

    Route::get('institution/index',[App\Http\Controllers\InstitutionController::class,'index'])->middleware('can:institution.index')->name('institution.index');

    Route::get('institution/create',[App\Http\Controllers\InstitutionController::class,'create'])->middleware('can:institution.create')->name('institution.create');

    Route::post('institution/store',[App\Http\Controllers\InstitutionController::class,'store'])->middleware('can:institution.store')->name('institution.store');

    Route::get('institution/edit/{institution}',[App\Http\Controllers\InstitutionController::class,'edit'])->middleware('can:institution.edit')->name('institution.edit');

    Route::post('institution/update/{institution}',[App\Http\Controllers\InstitutionController::class,'update'])->middleware('can:institution.update')->name('institution.update');

    Route::get('institution/show',[App\Http\Controllers\InstitutionController::class,'show'])->middleware('can:institution.show')->name('institution.show');

    Route::post('institution/show',[App\Http\Controllers\InstitutionController::class,'show'])->middleware('can:institution.show')->name('institution.search');

    Route::get('institution/add/{institution}',[App\Http\Controllers\InstitutionController::class,'attach'])->middleware('can:institution.attach')->name('institution.attach');

    Route::get('institution/remove/{institution}',[App\Http\Controllers\InstitutionController::class,'detach'])->middleware('can:institution.detach')->name('institution.detach');


    // SEGURO MEDICO

    Route::get('insurance/create',[App\Http\Controllers\InsuranceController::class,'create'])
        ->middleware('can:insurance.create')
        ->name('insurance.create');

    Route::post('insurance/store',[App\Http\Controllers\InsuranceController::class,'store'])
        ->middleware('can:insurance.store')
        ->name('insurance.store');

    Route::get('insurance/show',[App\Http\Controllers\InsuranceController::class,'show'])
        ->middleware('can:insurance.show')
        ->name('insurance.show');

    Route::get('insurance/list',[App\Http\Controllers\InsuranceController::class,'active'])
        ->middleware('can:insurance.active')
        ->name('insurance.active');

    Route::get('insurance/attach/{insurance}/{user}',[App\Http\Controllers\InsuranceController::class,'attach'])
        ->middleware('can:insurance.active')
        ->name('insurance.attach');

    Route::get('insurance/detach/{insurance}/{user}',[App\Http\Controllers\InsuranceController::class,'detach'])
        ->middleware('can:insurance.active')
        ->name('insurance.detach');
    
    Route::post('insurance/update',[App\Http\Controllers\InsuranceController::class,'patient_charge'])
        ->middleware('can:insurance.active')
        ->name('insurance.patient_charge');
        

    Route::get('insurance/edit/{insurance}',[App\Http\Controllers\InsuranceController::class,'edit'])
        ->middleware('can:insurance.show')
        ->name('insurance.edit');

    Route::get('insurance/delete',[App\Http\Controllers\InsuranceController::class,'delete'])
        ->middleware('can:insurance.delete')
        ->name('insurance.delete');

    //CALENDAR EVENTS

    Route::get('calendar/index',[App\Http\Controllers\AppointmentController::class,'index'])
        ->middleware('can:appointment.index')
        ->name('appointment.index');

    Route::get('calendar/show/{institution_id?}{user_id?}',[App\Http\Controllers\AppointmentController::class,'show'])
        ->middleware('can:appointment.index')
        ->name('appointment.show');

    Route::post('calendar/show',[App\Http\Controllers\AppointmentController::class,'show'])
        ->middleware('can:appointment.institution')
        ->name('appointment.show');

    Route::post('calendar/store',[App\Http\Controllers\AppointmentController::class,'store'])
        ->middleware('can:appointment.store')
        ->name('appointment.store');

    Route::post('calendar/cancel',[App\Http\Controllers\AppointmentController::class,'cancel'])
        ->middleware('can:appointment.cancel')
        ->name('appointment.cancel');

    Route::post('calendar/reschedule',[App\Http\Controllers\AppointmentController::class,'reschedule'])
        ->middleware('can:appointment.cancel')
        ->name('appointment.reschedule');

    Route::get('calendar/reschedule',[App\Http\Controllers\AppointmentController::class,'index'])
        ->middleware('can:appointment.index')
        ->name('appointment.reschedule');

    Route::post('calendar/restore',[App\Http\Controllers\AppointmentController::class,'restore'])
        ->middleware('can:appointment.store')
        ->name('appointment.restore');
        
    Route::post('calendar/wating',[App\Http\Controllers\AppointmentController::class,'toWaitingList'])
        ->middleware('can:appointment.store')
        ->name('appointment.toWaitingList');

    Route::post('calendar/storeLock',[App\Http\Controllers\AppointmentController::class,'storeLock'])
        ->middleware('can:appointment.index')
        ->name('appointment.storeLock');

    Route::post('calendar/storePatient',[App\Http\Controllers\AppointmentController::class,'storePatient'])
        ->middleware('can:appointment.index')
        ->name('appointment.storePatient');

    Route::post('calendar/sendConfirmation',[App\Http\Controllers\WaController::class,'send'])
        ->middleware('can:appointment.index')
        ->name('wa.send');

    //AGENDAS
    Route::get('agendas/index',[App\Http\Controllers\AgendaController::class,'index'])->middleware('can:agenda.index')->name('agendas.index');
    Route::post('agenda/store',[App\Http\Controllers\AgendaController::class,'store'])->middleware('can:agenda.store')->name('agenda.store');
    Route::post('agenda/edit',[App\Http\Controllers\AgendaController::class,'edit'])->middleware('can:agenda.edit')->name('agenda.edit');
    Route::get('agenda/delete/{agenda}',[App\Http\Controllers\AgendaController::class,'delete'])->middleware('can:agenda.delete')->name('agenda.delete');

    //Add Remove User
    Route::get('institution/addUser/{institution}/{user}',[App\Http\Controllers\InstitutionController::class,'attachUser'])->middleware('can:institution.attach')->name('userInstitution.attach');
    Route::get('institution/removeUser/{institution}/{user}',[App\Http\Controllers\InstitutionController::class,'detachUser'])->middleware('can:institution.detach')->name('userInstitution.detach');
    Route::get('institution/addAdmin/{institution}/{user}',[App\Http\Controllers\InstitutionController::class,'attachAdmin'])->middleware('can:institution.attach')->name('institution.attachAdmin');
    Route::get('institution/deleteAdmin/{institution}/{user}',[App\Http\Controllers\InstitutionController::class,'detachAdmin'])->middleware('can:institution.detach')->name('institution.detachAdmin');

    //Roles
    Route::get('secure/roles',[App\Http\Controllers\SecureController::class,'index'])->middleware('can:role.index')->name('role.index');

    Route::get('role/{role}',[App\Http\Controllers\SecureController::class,'edit'])->middleware('can:role.index')->name('role.edit');

    Route::get('secure/attachRole/{permission}/{role}',[App\Http\Controllers\SecureController::class,'attachRole'])->middleware('can:permission.attach')->name('permission.attach');

    Route::get('secure/detachRole/{permission}/{role}',[App\Http\Controllers\SecureController::class,'detachRole'])->middleware('can:permission.detach')->name('permission.detach');

    Route::get('secure/permission/create',[App\Http\Controllers\SecureController::class,'createPermission'])->middleware('can:permission.create')->name('permission.create');

    Route::post('secure/permission/store',[App\Http\Controllers\SecureController::class,'storePermission'])->middleware('can:role.index')->name('permission.store');

});


