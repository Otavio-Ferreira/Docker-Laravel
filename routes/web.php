<?php

use App\Http\Controllers\Web\Auth\LoginController;
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
});