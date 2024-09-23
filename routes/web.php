<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\PriceController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\MailController;

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

//Agent 
require __DIR__.'/admin.php';
require __DIR__.'/agent.php';
require __DIR__.'/user.php';

Route::get('/verifyemail/{token}', [RegisterController::class, 'verify']);
Route::post('/forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post'); 
Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('/reset-password/', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');
Route::get('/password/reset/', [ForgotPasswordController::class, 'showResetForm'])->name('password.request');
Route::get('/verification/notice', [VerificationController::class, 'notice'])->name('verification.notice');

Auth::routes();

Route::get('/', [FrontendController::class, 'index'])->name('index');
Route::get('/signin', [FrontendController::class, 'signin'])->name('signin');
Route::get('/signup', [FrontendController::class, 'signup'])->name('signup');
Route::get('/pricing', [PriceController::class, 'pricing'])->name('pricing');
Route::get('/processpapers', [FrontendController::class, 'processpapers'])->name('processpapers');
Route::get('/contactus', [FrontendController::class, 'contactus'])->name('contactus');
Route::get('/community', [FrontendController::class, 'community'])->name('community');
Route::get('/aboutus', [FrontendController::class, 'aboutus'])->name('aboutus');
Route::get('/policy', [FrontendController::class, 'policy'])->name('policy');
Route::get('/howitwork', [FrontendController::class, 'howitwork'])->name('howitwork');
Route::get('/terms', [FrontendController::class, 'terms'])->name('terms');

//pricing
Route::get('/get-state/pricing', [PriceController::class, 'getState']);
Route::post('/get-vehicle/renewal', [PriceController::class, 'getVehicleRenewalPrice']);
Route::get('/get-state/vehicleregistration/', [PriceController::class, 'getVehicleRegistration']);
Route::post('/get-vehicle-registration/price', [PriceController::class, 'getVehicleRegistrationPrice']);
Route::get('/get-state/changeofownership/', [PriceController::class, 'getChangeofOwnership']);
Route::post('/get-changeofownership/price', [PriceController::class, 'getChangeofOwnershipPrice']);
Route::post('/get-newdriverLicenses/length', [PriceController::class, 'getNewdriverLicensesLength']);
Route::post('/get-newdriverLicenses/price', [PriceController::class, 'getNewdriverLicensesPrice']);
Route::post('/get-driverLicenseRenewal/length', [PriceController::class, 'getDriverLicenseRenewalLength']);
Route::post('/get-driverLicenseRenewal/price', [PriceController::class, 'getDriverLicenseRenewalPrice']);
Route::get('/get-otherPermit', [PriceController::class, 'getOtherPermit']);
Route::post('/get-otherPermit/price', [PriceController::class, 'getOtherPermitPrice']);
Route::post('/get-internationaDriverLicense/length', [PriceController::class, 'getInternationaDriverLicenseLength']);
Route::post('/get-internationaDriverLicense/price', [PriceController::class, 'getInternationaDriverLicensePrice']);

