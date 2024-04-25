<?php

use App\Http\Controllers\CalendarioController;
use App\Http\Controllers\ComunicadoController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\EstudianteController;
use App\Http\Controllers\MateriaController;
use App\Http\Controllers\ProfesorContoller;
use App\Http\Controllers\TareaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TutorController;



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
    Route::resource('usuarios', UserController::class);
    Route::resource('tutores', TutorController::class);
    Route::get('profesores/asignar/{id}', [ProfesorContoller::class, 'asignar'])->name('profesores.asignar');
    Route::post('profesores/asignar/{id}', [ProfesorContoller::class, 'asignarmateria'])->name('profesores.asignar.materia');
    Route::get('profesores/mensaje-asignar', [ProfesorContoller::class, 'messageAsignar'])->name('profesores.mensaje-asignar');
    Route::delete('profesores/{id}/eliminar-materias-asignadas', [ProfesorContoller::class, 'eliminarMateriasAsignadas'])->name('profesores.eliminar-materias-asignadas');
    Route::resource('profesores', ProfesorContoller::class);
    Route::resource('materia', MateriaController::class);
    Route::resource('curso', CursoController::class);
    Route::resource('estudiantes',EstudianteController::class);
    Route::resource('calendario', CalendarioController::class);
    Route::post('/user-import', [UserController::class, 'importExcel'])->name('users.import.excel');
    Route::post('/tutor-import', [TutorController::class, 'importExcel'])->name('tutors.import.excel');
    Route::post('/profesor-import', [ProfesorContoller::class, 'importExcel'])->name('profesors.import.excel');
    Route::post('/estudiante-import', [EstudianteController::class, 'importExcel'])->name('estudiantes.import.excel');
    Route::resource('comunicado',ComunicadoController::class);
    Route::resource('comunicados',ComunicadoController::class);
    Route::post('/comunicado/download/{id}', [ComunicadoController::class, 'download'])->name('comunicado.download');
    Route::resource('tarea', TareaController::class);
    Route::post('/tarea/download/{id}', [TareaController::class, 'download'])->name('tarea.download');

    
});
