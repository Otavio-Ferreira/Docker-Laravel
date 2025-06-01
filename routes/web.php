<?php

use App\Http\Controllers\Web\Auth\LoginController;
use App\Http\Controllers\Web\Settings\RolesController;
use App\Http\Controllers\Web\Settings\UsersController;
use App\Http\Controllers\Web\System\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return to_route('login');
});


Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('login/enviar', [LoginController::class, 'store'])->name('login.store');

Route::get('login/resetar', [LoginController::class, 'reset'])->name('login.reset');
Route::post('login/solicitar', [LoginController::class, 'send'])->name('login.send');

Route::get('login/editar/{token}', [LoginController::class, 'edit'])->name('login.edit');
Route::get('login/registrar/{token}', [LoginController::class, 'register'])->name('login.register');
Route::post('login/atualizar/{token}', [LoginController::class, 'update'])->name('login.update');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [HomeController::class, 'index'])->name('home.index');

    Route::get('users/sair', [UsersController::class, 'logout'])->name('logout');

    Route::group(['middleware' => ['auth', 'permission:adicionar_grupo']], function () {
        Route::get('gupos', [RolesController::class, 'index'])->name('roles.index');
        Route::post('grupos/adicionar', [RolesController::class, 'store'])->name('roles.store');
        Route::post('grupos/atualizar/{id}', [RolesController::class, 'update'])->name('roles.update');
    });

    Route::group(['middleware' => ['auth', 'permission:adicionar_usuário']], function () {
        Route::get('usuarios', [UsersController::class, 'index'])->name('users.index');
        Route::post('usuarios/adicionar', [UsersController::class, 'store'])->name('users.store');
        Route::post('usuarios/atualizar/{id}', [UsersController::class, 'update'])->name('users.update');
        Route::delete('usuarios/deletar/{id}', [UsersController::class, 'destroy'])->name('users.destroy');
    });
});