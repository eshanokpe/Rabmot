<?php 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AgentLoginController;
use App\Http\Controllers\Agent\AgentDashboardController;
 

 
Route::prefix('agent')->group(function () {
    Route::get('/login',  [AgentLoginController::class, 'showLoginForm'])->name('agent.login');  
    Route::post('/login/agent',  [AgentLoginController::class, 'login'])->name('agent.loginSubmit');
    Route::get('/forgotpassword',  [AgentLoginController::class, 'forgotpassword'])->name('agent.forgotpassword');
 
    Route::middleware('auth.agent')->group(function () {
        Route::get('/',[AgentDashboardController::class, 'index'])->name('agent.index');

        Route::get('/dashboard', [AgentDashboardController::class, 'index'])->name('agent.dashboard');
        Route::get('/cart', [AgentDashboardController::class, 'index'])->name('agent.cart');

        Route::get('/profile', [AgentDashboardController::class, 'index'])->name('agent.profile');
        Route::get('/processHistory', [AgentDashboardController::class, 'processHistory'])->name('agent.processHistory');
        Route::get('/transactionHistory', [AgentDashboardController::class, 'transactionHistory'])->name('agent.transactionHistory');
    
        Route::post('/logout', [AgentLoginController::class, 'logout'])->name('agent.logout');

    });
});

