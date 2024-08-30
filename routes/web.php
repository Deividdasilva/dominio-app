<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DomainRuleController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Redirecionar para 'domain-rules' dependendo da autenticação
Route::get('/', function () {
    return redirect()->route('domain-rules.index');
});

// Rotas protegidas por autenticação
Route::middleware(['auth'])->group(function () {
    // Rotas de criação e listagem de regras de domínio
    Route::resource('domain-rules', DomainRuleController::class)->except(['edit', 'update', 'destroy']);

    // Aplicando o middleware para garantir que apenas o proprietário possa editar, atualizar ou excluir
    Route::middleware(['check.owner'])->group(function () {
        Route::get('domain-rules/{domainRule}/edit', [DomainRuleController::class, 'edit'])->name('domain-rules.edit');
        Route::put('domain-rules/{domainRule}', [DomainRuleController::class, 'update'])->name('domain-rules.update');
        Route::delete('domain-rules/{domainRule}', [DomainRuleController::class, 'destroy'])->name('domain-rules.destroy');
    });
});

// Rotas de perfil
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
