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
})->name('landing');

Route::get('/confirm/{token}', [App\Http\Controllers\GuestController::class, 'confirm'])->name('confirm.appointment');
Route::get('/confirmed/{appointment}/{confirmation}', [App\Http\Controllers\GuestController::class, 'confirmed'])->name('confirmed.appointment');
Auth::routes(['verify'=>true]);

Route::middleware(['verified'])->group(function(){

    //LIVEWIRE

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::post('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('searchPaciente');
    Route::get('/panel', [App\Http\Controllers\HomeController::class, 'dashboard'])->name('dashboard');
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
    Route::post('paciente/createAndAppoint',[App\Http\Controllers\PacienteController::class,'createWithAppointment'])
    ->name('createAndAppoint');
    
    Route::post('wating/attach/{paciente}/{institution}',[App\Http\Controllers\PacienteController::class,'wating_attach'])->middleware('can:wating.attach')->name('wating.attach');
    Route::get('editPaciente/{paciente}',[App\Http\Controllers\PacienteController::class,'updateAppointment'])->name('paciente.updateAppointment');
    
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

    // NOTES

    Route::get('notes/index',[App\Http\Controllers\NoteController::class,'create'])
        ->middleware('can:notes.create')
        ->name('notes.create');
    Route::get('notes/show',[App\Http\Controllers\NoteController::class,'show'])
        ->middleware('can:notes.show')
        ->name('notes.show');
    Route::post('note/store',[App\Http\Controllers\NoteController::class,'store'])
        ->middleware('can:notes.create')
        ->name('note.store');
    Route::get('note/delete/{note}',[App\Http\Controllers\NoteController::class,'delete'])
        ->middleware('can:note.delete')
        ->name('note.delete');
    Route::post('note/read',[App\Http\Controllers\NoteController::class,'read'])
        ->middleware('can:notes.create')
        ->name('note.read');

    //INSTITUTION

    Route::get('institution/index',[App\Http\Controllers\InstitutionController::class,'index'])
        ->middleware('can:institution.index')
        ->name('institution.index');

    Route::get('institution/create',[App\Http\Controllers\InstitutionController::class,'create'])
        ->middleware('can:institution.create')
        ->name('institution.create');

    Route::post('institution/store',[App\Http\Controllers\InstitutionController::class,'store'])
        ->middleware('can:institution.store')
        ->name('institution.store');

    Route::get('institution/edit/{institution}',[App\Http\Controllers\InstitutionController::class,'edit'])
        ->middleware('can:institution.edit')
        ->name('institution.edit');

    Route::post('institution/update/{institution}',[App\Http\Controllers\InstitutionController::class,'update'])
        ->middleware('can:institution.update')
        ->name('institution.update');

    Route::get('institution/show',[App\Http\Controllers\InstitutionController::class,'show'])
        ->middleware('can:institution.show')
        ->name('institution.show');

    Route::post('institution/show',[App\Http\Controllers\InstitutionController::class,'show'])
        ->middleware('can:institution.show')
        ->name('institution.search');

    Route::get('institution/add/{institution}',[App\Http\Controllers\InstitutionController::class,'attach'])
        ->middleware('can:institution.attach')
        ->name('institution.attach');

    Route::get('institution/remove/{institution}',[App\Http\Controllers\InstitutionController::class,'detach'])
        ->middleware('can:institution.detach')
        ->name('institution.detach');

    Route::get('institution/sheets',[App\Http\Controllers\InstitutionController::class,'sheets'])
        ->middleware('can:institution.sheets')
        ->name('institution.sheets');
        
    Route::get('institution/sheetsAttach/{institution}/{sheet}',[App\Http\Controllers\InstitutionController::class,'attachSheet'])
        ->middleware('can:institution.sheets')
        ->name('institutionSheet.attach');    
    Route::get('institution/sheetsDetach/{institution}/{sheet}',[App\Http\Controllers\InstitutionController::class,'detachSheet'])
        ->middleware('can:institution.sheets')
        ->name('institutionSheet.detach'); 
        
    Route::get('institution/servicesAttach/{institution}/{service}',[App\Http\Controllers\InstitutionController::class,'attachService'])
        ->middleware('can:institution.services')
        ->name('institutionService.attach');    
    Route::get('institution/servicesDetach/{institution}/{service}',[App\Http\Controllers\InstitutionController::class,'detachService'])
        ->middleware('can:institution.services')
        ->name('institutionService.detach'); 
    // ROOMS

    Route::get('institution/rooms',[App\Http\Controllers\InstitutionController::class,'room'])
        ->middleware('can:institution.room')->name('institution.room');
    Route::post('institution/store/room',[App\Http\Controllers\InstitutionController::class,'roomStore'])
        ->middleware('can:institution.room')->name('room.store');
    Route::get('institution/remove/room/{room}',[App\Http\Controllers\InstitutionController::class,'roomDelete'])
        ->middleware('can:institution.room')->name('room.delete');
   
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

    Route::post('calendar/day',[App\Http\Controllers\AppointmentController::class,'day'])
        ->middleware('can:appointment.index')
        ->name('appointment.day');

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
    Route::post('calendar/confirm',[App\Http\Controllers\AppointmentController::class,'confirm'])
        ->middleware('can:appointment.index')
        ->name('appointment.confirm');
    //AGENDAS
    Route::get('agendas/index/{professional?}',[App\Http\Controllers\AgendaController::class,'index'])
        ->middleware('can:agenda.index')
        ->name('agendas.index');
    Route::post('agenda/store',[App\Http\Controllers\AgendaController::class,'store'])->middleware('can:agenda.store')->name('agenda.store');
    Route::post('agenda/edit',[App\Http\Controllers\AgendaController::class,'edit'])->middleware('can:agenda.edit')->name('agenda.edit');
    Route::get('agenda/delete/{agenda}/{professional?}',[App\Http\Controllers\AgendaController::class,'delete'])->middleware('can:agenda.delete')->name('agenda.delete');

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


    //SERVICES
    Route::get('services/new',[App\Http\Controllers\ServicesController::class,'new'])
        ->middleware('can:services.new')->name('services.new');

    Route::post('services/store',[App\Http\Controllers\ServicesController::class,'store'])
        ->middleware('can:services.new')->name('services.store');

    Route::post('laboratory/file/store',[App\Http\Controllers\FilesController::class,'store'])
        ->middleware('can:store.file')->name('store.file');

    Route::get('laboratory/file/download/{file}',[App\Http\Controllers\FilesController::class,'download'])
        ->middleware('can:store.file')->name('download.file');

    Route::post('fibroscan/file/store',[App\Http\Controllers\FilesController::class,'storeFibroscan'])
        ->middleware('can:store.file')->name('store.fibroscan');

    Route::get('fibroscan/file/download/{file}',[App\Http\Controllers\FilesController::class,'downloadFibroscan'])
        ->middleware('can:store.file')->name('download.fibroscan');
    
    Route::post('ecografia/file/store',[App\Http\Controllers\FilesController::class,'storeEcografia'])
        ->middleware('can:store.file')->name('store.ecografia');

    Route::get('ecografia/file/download/{file}',[App\Http\Controllers\FilesController::class,'downloadEcografia'])
        ->middleware('can:store.file')->name('download.ecografia');

    Route::post('endoscopia/file/store',[App\Http\Controllers\FilesController::class,'storeEndoscopia'])
        ->middleware('can:store.file')->name('store.endoscopia');

    Route::get('endoscopia/file/download/{file}',[App\Http\Controllers\FilesController::class,'downloadEndoscopia'])
        ->middleware('can:store.file')->name('download.endoscopia');

    Route::post('cardiologia/file/store',[App\Http\Controllers\FilesController::class,'storeCardiologia'])
        ->middleware('can:store.file')->name('store.cardiologia');

    Route::get('cardiologia/file/download/{file}',[App\Http\Controllers\FilesController::class,'downloadCardiologia'])
        ->middleware('can:store.file')->name('download.cardiologia');

    //SHEETS
    Route::get('sheet/index',[App\Http\Controllers\SheetController::class,'index'])
        ->middleware('can:sheet.index')->name('sheet.index');

    Route::post('sheet/store',[App\Http\Controllers\SheetController::class,'store'])
        ->middleware('can:sheet.store')->name('sheet.store');

    Route::get('sheet/clinical/{paciente}/{insurance?}',[App\Http\Controllers\SheetController::class,'clinical'])
        ->middleware('can:clinical.create')->name('clinical.create');
        
    Route::post('sheet/clinical/{paciente}',[App\Http\Controllers\SheetController::class,'clinicalSave'])
    ->middleware('can:clinical.create')->name('clinical.save');

    Route::get('sheet/clinical/edit/{clinicalSheet}',[App\Http\Controllers\SheetController::class,'clinicalEdit'])
    ->middleware('can:clinical.create')->name('clinical.edit');

    Route::post('sheet/clinical/update/{paciente}/{clinicalSheet}',[App\Http\Controllers\SheetController::class,'clinicalUpdate'])
    ->middleware('can:clinical.create')->name('clinical.update');
    
    Route::get('sheet/clinical/pdf/{clinicalSheet}',[App\Http\Controllers\SheetController::class,'clinicalPDF'])
    ->middleware('can:clinical.create')->name('clinical.pdf'); 

    Route::get('sheet/nutrition/{paciente}/{insurance?}',[App\Http\Controllers\SheetController::class,'nutrition'])
        ->middleware('can:nutrition.create')->name('nutrition.create');
        
    Route::post('sheet/nutrition/{paciente}',[App\Http\Controllers\SheetController::class,'nutritionSave'])
    ->middleware('can:nutrition.create')->name('nutrition.save');

    Route::get('sheet/nutrition/edit/{nutritionSheet}',[App\Http\Controllers\SheetController::class,'nutritionEdit'])
    ->middleware('can:nutrition.create')->name('nutrition.edit');

    Route::get('sheet/nutrition/pdf/{nutritionSheet}',[App\Http\Controllers\SheetController::class,'nutritionPDF'])
    ->middleware('can:nutrition.create')->name('nutrition.pdf'); 

    Route::post('sheet/nutrition/update/{paciente}/{nutritionSheet}',[App\Http\Controllers\SheetController::class,'nutritionUpdate'])
    ->middleware('can:nutrition.create')->name('nutrition.update');

    Route::get('sheet/psychological/{paciente}',[App\Http\Controllers\SheetController::class,'psychological'])
        ->middleware('can:psychological.create')->name('psychological.create');

    Route::post('sheet/psychological/{paciente}',[App\Http\Controllers\SheetController::class,'psychologicalSave'])
    ->middleware('can:psychological.create')->name('psychological.save');

    Route::get('sheet/psychological/edit/{psychologicalSheet}',[App\Http\Controllers\SheetController::class,'psychologicalEdit'])
    ->middleware('can:psychological.create')->name('psychological.edit');

    Route::get('sheet/psychological/pdf/{psychologicalSheet}',[App\Http\Controllers\SheetController::class,'psychologicalPDF'])
    ->middleware('can:psychological.create')->name('psychological.pdf'); 

    Route::post('sheet/psychological/update/{paciente}/{psychologicalSheet}',[App\Http\Controllers\SheetController::class,'psychologicalUpdate'])
    ->middleware('can:psychological.create')->name('psychological.update');

    Route::get('sheet/kinesiology/{paciente}',[App\Http\Controllers\SheetController::class,'kinesiology'])
        ->middleware('can:kinesiology.create')->name('kinesiology.create');

    Route::post('sheet/kinesiology/{paciente}',[App\Http\Controllers\SheetController::class,'kinesiologySave'])
    ->middleware('can:kinesiology.create')->name('kinesiology.save');

    Route::get('sheet/kinesiology/edit/{kinesiologySheet}',[App\Http\Controllers\SheetController::class,'kinesiologyEdit'])
    ->middleware('can:kinesiology.create')->name('kinesiology.edit');

    Route::get('sheet/kinesiology/pdf/{kinesiologySheet}',[App\Http\Controllers\SheetController::class,'kinesiologyPDF'])
    ->middleware('can:kinesiology.create')->name('kinesiology.pdf'); 

    Route::post('sheet/kinesiology/update/{paciente}/{kinesiologySheet}',[App\Http\Controllers\SheetController::class,'kinesiologyUpdate'])
    ->middleware('can:kinesiology.create')->name('kinesiology.update');
    //ACCOUNTS
    
    Route::get('accounts/cash',[App\Http\Controllers\AccountsController::class,'show'])
    ->middleware('can:accounts.show')->name('accounts.show'); 
    
    Route::post('accounts/balance/{date?}',[App\Http\Controllers\AccountsController::class,'balance'])
    ->middleware('can:accounts.show')->name('accounts.balance'); 

});


Route::prefix('pacientes')->name('pacientes.')->group(function(){
    Route::middleware(['guest:pacientes'])->group(function (){
        Route::view('login','pacientes.login')->name('login');
        Route::post('authenticate',[App\Http\Controllers\PacienteController::class,'authenticate'])
        ->name('authenticate');
        
    });
    Route::middleware(['auth:pacientes'])->group(function (){
        Route::get('inicio',[App\Http\Controllers\PacienteController::class,'home'])
        ->name('index');
        Route::post('logout', [App\Http\Controllers\PacienteController::class, 'logoutPaciente'])
        ->name('logout');
    });
});