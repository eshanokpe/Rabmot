<?php 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Agent\CartController;
use App\Http\Controllers\Agent\PaymentController;
use App\Http\Controllers\Agent\CheckoutController;
use App\Http\Controllers\Auth\AgentLoginController;
use App\Http\Controllers\Agent\AgentDashboardController;
use App\Http\Controllers\Agent\AddVehicle\AddVehicleRenewalController;
use App\Http\Controllers\Agent\AddVehicle\AddVehicleRegistrationController;
use App\Http\Controllers\Agent\AddVehicle\AddVehicleOwnershipController;
use App\Http\Controllers\Agent\AddVehicle\AgentAddVehicleController;
use App\Http\Controllers\Agent\Process\DealerPlateNumberContoller;
use App\Http\Controllers\Agent\Process\NewDriverLicenseController;
use App\Http\Controllers\Agent\Process\DriverLicenseRenewalController;
use App\Http\Controllers\Agent\Process\InternationalDriverLicenseController;
use App\Http\Controllers\Agent\Process\OtherPermitController;
use App\Http\Controllers\Agent\ProfileController;

 
Route::prefix('agent')->group(function () {
    Route::get('/login',  [AgentLoginController::class, 'showLoginForm'])->name('agent.login');  
    Route::post('/login/agent',  [AgentLoginController::class, 'login'])->name('agent.loginSubmit');
    Route::get('/forgotpassword',  [AgentLoginController::class, 'forgotpassword'])->name('agent.forgotpassword');
  
    Route::middleware('auth.agent')->group(function () {
        Route::get('/',[AgentDashboardController::class, 'index'])->name('agent.index');

        Route::get('/dashboard', [AgentDashboardController::class, 'index'])->name('agent.dashboard');

        // AddVehicleController
        Route::get('addvehicle', [AgentAddVehicleController::class, 'index'])->name('agent.addVehicle');
        Route::get('/addvehiclerenewal', [AgentAddVehicleController::class, 'addVehicleRenewal'])->name('agent.addVehicleRenewal');
        Route::post('/postaddvehiclerenewal', [AgentAddVehicleController::class, 'postAddvehicleRenewal'])->name('agent.postAddVehicleRenewal');
        Route::get('/addvehicleregistration', [AgentAddVehicleController::class, 'addVehicleRegistration'])->name('agent.addVehicleRegistration');
        Route::post('/postAddVehicleRegistration', [AgentAddVehicleController::class, 'postAddVehicleRegistration'])->name('agent.postAddVehicleRegistration');
        Route::get('addvehicleownership', [AgentAddVehicleController::class, 'addVehicleOwnership'])->name('agent.addVehicleOwnership');
        Route::post('/post/vehicleownership', [AgentAddVehicleController::class, 'postAddChangeOwnership'])->name('agent.postAddVehicleOwnership');
        
        Route::get('/pricing', [AgentDashboardController::class, 'pricing'])->name('agent.pricing');
        
        // process document
        // Vehicle Paper Renewal
        Route::get('/vehicle/paper/renewal', [AddVehicleRenewalController::class, 'index'])->name('agent.vehicleRenewalPaper');
        Route::post('/owner-vehicleRenewal-selection', [AddVehicleRenewalController::class, 'handleOwnerVehicleSelection']);
        Route::get('/user-selection', [AgentDashboardController::class, 'handleUserSelection']);
        Route::post('/vehicleRenewal-vehicleCategoryId-selection', [AddVehicleRenewalController::class, 'handleVehicleCategoryIdSelection']);
        Route::get('/get-user-add-vehicles-renewal', [AddVehicleRenewalController::class, 'getUserAddVehiclesRenewal']);
        Route::post('/vehicleRenewal-addVehicleValue-selection', [AddVehicleRenewalController::class, 'handleAddVehicleValueSelection']);
        Route::post('/post-vehicle-paper-renewal', [AddVehicleRenewalController::class, 'postRenewVehiclePaper'])->name('agent.postRenewVehiclePaper');
        Route::post('/post-vehicleRenewal', [AddVehicleRenewalController::class, 'handlePostVehicleRenewal']);
        
        // Vehicle Registration
        Route::get('/new/vehicle/registration', [AddVehicleRegistrationController::class, 'index'])->name('agent.newVehicleRegistration');
        Route::get('/ownerVehicleRegistration-selection', [AddVehicleRegistrationController::class, 'handleOwnerSelection']);
        Route::post('/owner-vehicleRegistration-selection', [AddVehicleRegistrationController::class, 'handleOwnerVehicleSelection']);
        Route::get('/get-user-add-vehicles-registration', [AddVehicleRegistrationController::class, 'getUserAddVehiclesRegistration']);
        Route::post('/vehicleRegistration-vehicleCategoryId-selection', [AddVehicleRegistrationController::class, 'handleVehicleCategoryIdSelection']);
        Route::post('/vehicleRegistration-addVehicleRegCost', [AddVehicleRegistrationController::class, 'handleVehicleRegCost']);
        Route::post('/post-vehicleRegistration', [AddVehicleRegistrationController::class, 'postNewVehicleRegistration']);

        // ChangeofOwnership
        Route::get('/changeofOwnership', [AddVehicleOwnershipController::class, 'index'])->name('agent.changeofOwnership');
        Route::get('/owner-vehicleOwnership-selection', [AddVehicleOwnershipController::class, 'handleOwnerSelection']);
        Route::post('/owner-vehicleOwnership-vehicleCategory', [AddVehicleOwnershipController::class, 'handleOwnerVehicleSelection']);
       
        Route::get('/get-user-add-vehicles-ownership', [AddVehicleOwnershipController::class, 'getUserAddVehiclesOwnership']);
        Route::post('/vehicleOwnershipCost', [AddVehicleOwnershipController::class, 'handleVehicleOwnershipCost']);
        Route::post('/vehicleOwnership-vehicleCategoryId-selection', [AddVehicleOwnershipController::class, 'handleVehicleCategoryIdSelection']);
        Route::post('/post-changeofownership', [AddVehicleOwnershipController::class, 'postChangeOfVehicleOwnership']);
        // platenumber
        Route::get('dealer-platenumber', [DealerPlateNumberContoller::class, 'index'])->name('agent.platenumber');
        Route::post('get-dealer-platenumber-price', [DealerPlateNumberContoller::class, 'getDPNPrice']);
        Route::get('get-state-dealerplatenumber', [DealerPlateNumberContoller::class, 'getState']);
        Route::post('/post/dealer/platenumber', [DealerPlateNumberContoller::class, 'postDealerPlateNumber']);
        //newdriverlicense
        Route::get('newdriverlicense', [NewDriverLicenseController::class, 'index'])->name('agent.newdriverlicense');
        Route::get('get-state-newdriverlicense', [NewDriverLicenseController::class, 'getState']);
        Route::post('get-new-newdriverlicense-lengthYears', [NewDriverLicenseController::class, 'getNDLengthYears']);
        Route::post('get-new-newdriverlicense-price', [NewDriverLicenseController::class, 'getNDLPrice']);
        Route::post('/post/newdriverlicense', [NewDriverLicenseController::class, 'postNewDriverLicense']);
        //drivers license
        Route::get('drivers/license/renewal', [DriverLicenseRenewalController::class, 'index'])->name('agent.driverslicenserenewal');
        Route::get('get-state-driverlicenserenewal', [DriverLicenseRenewalController::class, 'getState']);
        Route::post('get-driverlicenserenewal-lengthYears', [DriverLicenseRenewalController::class, 'getDLRLengthYears']);
        Route::post('get-driverlicenserenewal-price', [DriverLicenseRenewalController::class, 'getDLRPrice']);
        Route::post('/post/driverlicenserenewal', [DriverLicenseRenewalController::class, 'postDriverLicenseRenewal']);
        //drivers license
        Route::get('internationaldriverlicense', [InternationalDriverLicenseController::class, 'index'])->name('agent.internationaldriverlicense');
        Route::get('get-state-internationaldriverlicense', [InternationalDriverLicenseController::class, 'getState']);
        Route::post('get-internationaldriverlicense-lengthYears', [InternationalDriverLicenseController::class, 'getIDLLengthYears']);
        Route::post('get-internationaldriverlicense-price', [InternationalDriverLicenseController::class, 'getIDLPrice']);
        Route::post('/post/internationaldriverlicense', [InternationalDriverLicenseController::class, 'postInternationalDriverLicense']);
        //otherPermit
        Route::get('otherpermit', [OtherPermitController::class, 'index'])->name('agent.otherpermit');
        Route::get('get-permittype-otherpermit', [OtherPermitController::class, 'getPermitType']);
        Route::post('get-permittype-price', [OtherPermitController::class, 'getPrice']);
        Route::post('/post/otherPermit', [OtherPermitController::class, 'postOtherPermit']);


        Route::get('cart', [CartController::class, 'index'])->name('agent.cart'); 
        Route::post('/cart/delete', [CartController::class, 'destroy'])->name('agent.delete');
        Route::get('checkout', [CheckoutController::class, 'index'])->name('agent.checkout');

         //Payment
         Route::post('payment', [PaymentController::class, 'initiatePayment'])->name('agent.payment.initiate');
         Route::get('payment_callbackSeerbit', [PaymentController::class, 'handleGatewayCallbackSeerbit'])->name('agent.payment');
         

        Route::get('/profile', [AgentDashboardController::class, 'index'])->name('agent.profile');
        Route::get('/processHistory', [AgentDashboardController::class, 'processHistory'])->name('agent.processHistory');
        Route::get('/transactionHistory', [AgentDashboardController::class, 'transactionHistory'])->name('agent.transactionHistory');
        //Profile
        Route::get('user-profile', [ProfileController::class, 'index']);
        Route::get('edit-profile', [ProfileController::class, 'editprofile'])->name('agent.editprofile'); 
        Route::get('get-user-details', [ProfileController::class, 'userProfile']);
        Route::post('update-profile', [ProfileController::class, 'updateProfile']);
        Route::get('profile', [ProfileController::class, 'index'])->name('agent.profile');

        Route::post('/logout', [AgentLoginController::class, 'logout'])->name('agent.logout');

    });
});

