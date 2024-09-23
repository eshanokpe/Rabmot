<?php 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AgentLoginController;
use App\Http\Controllers\Agent\AgentDashboardController;


Route::get('agent/forgotpassword',  [AgentLoginController::class, 'forgotpassword'])->name('agent-forgotpassword');
Route::get('/login/agent',  [AgentLoginController::class, 'showLoginForm'])->name('agent.login');
Route::post('/login/agent',  [AgentLoginController::class, 'login'])->name('agent.login');
Route::get('/forgotpassword/agent',  [AgentLoginController::class, 'forgotpassword'])->name('agent.forgotpassword');

Route::middleware(['auth', 'role:agent'])->group(function () {
    Route::get('/agent/dashboard', [AgentDashboardController::class, 'index'])->name('agent.dashboard');

    Route::get('/agent/cart', [AgentDashboardController::class, 'index'])->name('agent.cart');

    Route::get('/agent/profile', [AgentDashboardController::class, 'index'])->name('agent.profile');
    Route::get('/agent/processHistory', [AgentDashboardController::class, 'processHistory'])->name('agent.processHistory');
    Route::get('/agent/transactionHistory', [AgentDashboardController::class, 'transactionHistory'])->name('agent.transactionHistory');

    Route::post('agent/logout', [AgentLoginController::class, 'logout'])->name('agent.logout');
});