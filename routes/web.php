<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\TarefaController;

Route::get('/', function () {
    return view('welcome');
});

// Painel principal
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Rotas protegidas por autenticação
Route::middleware('auth')->group(function () {
    // Perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Tarefas (CRUD completo + toggle de status)
    Route::resource('tarefas', TarefaController::class);
    Route::patch('tarefas/{tarefa}/toggle', [TarefaController::class, 'toggleStatus'])->name('tarefas.toggle');
});

// Categorias
Route::resource('categorias', CategoriaController::class);

require __DIR__.'/auth.php';
