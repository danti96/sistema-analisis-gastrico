<?php

use App\Http\Controllers\AtencionPacienteController;
use App\Http\Controllers\PacienteController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {


    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');


    Route::get('/paciente', [ PacienteController::class, 'index' ])->name('paciente.index');

    Route::post('/paciente', [ PacienteController::class, 'store' ])->name('paciente.store');

    Route::get('/paciente/create', [ PacienteController::class, 'create' ])->name('paciente.create');

    Route::get('/paciente/show/{id}', [ PacienteController::class, 'show' ])->name('paciente.show');

    Route::put('/paciente.edit', [ PacienteController::class, 'edit' ])->name('paciente.edit');

    Route::get('/paciente/paginate', [ PacienteController::class, 'paginate' ])->name('paciente.paginate');

    Route::delete('/paciente/{id}', [ PacienteController::class, 'destroy' ])->name('paciente.destroy');



    Route::get('/atencion-paciente', [ AtencionPacienteController::class, 'index'])->name('atencionpaciente.index');
    Route::post('/atencion-paciente', [ AtencionPacienteController::class, 'store'])->name('atencionpaciente.store');
});
