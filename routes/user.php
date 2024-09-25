<?php 
 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController; 
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\User\DealerPlateNumberContoller;
use App\Http\Controllers\User\NewDriverLicenseController;
use App\Http\Controllers\User\DriverLicenseRenewalController;
use App\Http\Controllers\User\InternationalDriverLicenseController;
use App\Http\Controllers\User\OtherPermitController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\TopicCommentController;
use App\Http\Controllers\User\AddVehicle\AddVehicleRenewalController;
use App\Http\Controllers\User\AddVehicle\AddVehicleRegistrationController;
use App\Http\Controllers\User\AddVehicle\AddVehicleOwnershipController;
 
 
Route::middleware(['auth'])->group(function () {
    Route::get('/home', [HomeController::class, 'index']);
    Route::get('/home', [HomeController::class, 'index'])->name('home');
   
    Route::prefix('/home')->middleware('auth')->group(function () {   
        Route::get('/pricing', [HomeController::class, 'pricing'])->name('home.pricing');

        Route::get('addvehiclerenewal', [AddVehicleRenewalController::class, 'index'])->name('home.addVehicleRenewal');
        Route::post('/add-vehicle-renewal', [AddVehicleRenewalController::class, 'postAddVehicleRenewal'])->name('home.postAddVehicleRenewal');
        
        Route::get('/vehicle/paper/renewal', [AddVehicleRenewalController::class, 'vehicleRenewalPaper'])->name('home.vehicleRenewalPaper');
        Route::post('/post-vehicle-paper-renewal', [AddVehicleRenewalController::class, 'postRenewVehiclePaper'])->name('home.postRenewVehiclePaper');
        Route::get('/vehicle-paper-renewal/edit/{encryptedId}', [AddVehicleRenewalController::class, 'editVehiclePaperRenewal'])
         ->name('edit.vehiclePaperRenewal');

        Route::get('vehicle/paper/delete/{encryptedId}', [AddVehicleRenewalController::class, 'deleteVehiclePaperRenewal'])->name('delete.vehiclePaperRenewal');
        Route::get('/get-user-add-vehicles-renewal', [AddVehicleRenewalController::class, 'getUserAddVehiclesRenewal']);
        Route::post('/vehicleRenewal-state-selection', [AddVehicleRenewalController::class, 'handleStateSelection']);
        Route::get('/vehicleRenewal-state-selection', [AddVehicleRenewalController::class, 'handleStateSelection']);
        Route::post('/vehicleRenewal-vehicleCategoryId-selection', [AddVehicleRenewalController::class, 'handleVehicleCategoryIdSelection']);
        Route::post('/vehicleRenewal-addVehicleValue-selection', [AddVehicleRenewalController::class, 'handleAddVehicleValueSelection']);
        Route::post('/post-vehicleRenewal', [AddVehicleRenewalController::class, 'handlePostVehicleRenewal']);
        
        Route::get('new/vehicle/registration', [AddVehicleRegistrationController::class, 'newVehicleRegistration'])->name('home.newVehicleRegistration');
        Route::get('addvehicleregistration', [AddVehicleRegistrationController::class, 'index'])->name('home.addVehicleRegistration');
        Route::get('/get-user-add-vehicles-registration', [AddVehicleRegistrationController::class, 'getUserAddVehiclesRegistration']);
        Route::post('/vehicleRegistration-state-selection', [AddVehicleRegistrationController::class, 'handleStateSelection']);
        Route::post('/vehicleRegistration-vehicleCategoryId-selection', [AddVehicleRegistrationController::class, 'handleVehicleCategoryIdSelection']);
        Route::post('/vehicleRegistration-addVehicleRegCost', [AddVehicleRegistrationController::class, 'handleVehicleRegCost']);
        Route::post('/post-vehicleRegistration', [AddVehicleRegistrationController::class, 'postNewVehicleRegistration']);
        
        Route::get('addvehicleownership', [AddVehicleOwnershipController::class, 'index'])->name('home.addVehicleOwnership');
        Route::get('changeofwnership', [AddVehicleOwnershipController::class, 'changeofOwnership'])->name('home.changeofOwnership');
        Route::post('/changeofownership-state-selection', [AddVehicleOwnershipController::class, 'handleStateSelection']);
        Route::get('/get-user-add-vehicles-ownership', [AddVehicleOwnershipController::class, 'getUserAddVehiclesOwnership']);
        Route::post('/vehicleOwnership-vehicleCategoryId-selection', [AddVehicleOwnershipController::class, 'handleVehicleCategoryIdSelection']);
        Route::post('/vehicleOwnershipCost', [AddVehicleOwnershipController::class, 'handleVehicleOwnershipCost']);

        Route::get('platenumber', [DealerPlateNumberContoller::class, 'index'])->name('home.platenumber');
        Route::post('get-dealer-platenumber-price', [DealerPlateNumberContoller::class, 'getDPNPrice']);
        Route::get('get-state-dealerplatenumber', [DealerPlateNumberContoller::class, 'getState']);
        Route::post('/post/dealer/platenumber', [DealerPlateNumberContoller::class, 'postDealerPlateNumber']);

        Route::get('newdriverlicense', [NewDriverLicenseController::class, 'index'])->name('home.newdriverlicense');
        Route::get('get-state-newdriverlicense', [NewDriverLicenseController::class, 'getState']);
        Route::post('get-new-newdriverlicense-lengthYears', [NewDriverLicenseController::class, 'getNDLengthYears']);
        Route::post('get-new-newdriverlicense-price', [NewDriverLicenseController::class, 'getNDLPrice']);
        Route::post('/post/newdriverlicense', [NewDriverLicenseController::class, 'postNewDriverLicense']);

        Route::get('drivers/license/renewal', [DriverLicenseRenewalController::class, 'index'])->name('home.driverslicenserenewal');
        Route::get('get-state-driverlicenserenewal', [DriverLicenseRenewalController::class, 'getState']);
        Route::post('get-driverlicenserenewal-lengthYears', [DriverLicenseRenewalController::class, 'getDLRLengthYears']);
        Route::post('get-driverlicenserenewal-price', [DriverLicenseRenewalController::class, 'getDLRPrice']);
        Route::post('/post/driverlicenserenewal', [DriverLicenseRenewalController::class, 'postDriverLicenseRenewal']);

        Route::get('internationaldriverlicense', [InternationalDriverLicenseController::class, 'index'])->name('home.internationaldriverlicense');
        Route::get('get-state-internationaldriverlicense', [InternationalDriverLicenseController::class, 'getState']);
        Route::post('get-internationaldriverlicense-lengthYears', [InternationalDriverLicenseController::class, 'getIDLLengthYears']);
        Route::post('get-internationaldriverlicense-price', [InternationalDriverLicenseController::class, 'getIDLPrice']);
        Route::post('/post/internationaldriverlicense', [InternationalDriverLicenseController::class, 'postInternationalDriverLicense']);

        Route::get('otherpermit', [OtherPermitController::class, 'index'])->name('home.otherpermit');
        Route::get('get-permittype-otherpermit', [OtherPermitController::class, 'getPermitType']);
        Route::post('get-permittype-price', [OtherPermitController::class, 'getPrice']);
        Route::post('/post/otherPermit', [OtherPermitController::class, 'postOtherPermit']);


        Route::get('cart', [CartController::class, 'index'])->name('home.cart'); 
        Route::post('/cart/delete', [CartController::class, 'destroy'])->name('cart.delete');
        Route::get('checkout', [CheckoutController::class, 'index'])->name('home.checkout');

        Route::post('payment', [PaymentController::class, 'initiatePayment'])->name('home.payment.initiate');
        Route::get('payment_callbackSeerbit', [PaymentController::class, 'handleGatewayCallbackSeerbit'])->name('home.payment');
        
        Route::get('/topics', [HomeController::class, 'indexT'])->name('topics.index');
        Route::get('faq', [HomeController::class, 'faq'])->name('home.faq');
        Route::get('processhistory', [HomeController::class, 'processHistory'])->name('home.processHistory');
        Route::get('transactionhistory', [HomeController::class, 'transactionHistory'])->name('home.transactionHistory'); 
    
        Route::get('faq', [HomeController::class, 'faq'])->name('home.faq');
        Route::get('success', [HomeController::class, 'success'])->name('home.success');
        Route::get('deleteprocesshistory', [HomeController::class, 'deleteprocesshistory'])->name('home.deleteprocesshistory');
        Route::get('transactionhistory', [HomeController::class, 'transactionHistory'])->name('home.transactionHistory');
        Route::get('deletetransactionhistory', [HomeController::class, 'deletetransactionhistory'])->name('home.deletetransactionhistory');
        
        Route::get('user-profile', [ProfileController::class, 'index']);
        Route::get('edit-profile', [ProfileController::class, 'editprofile'])->name('home.editprofile'); 
        Route::get('get-user-details', [ProfileController::class, 'userProfile']);
        Route::post('update-profile', [ProfileController::class, 'updateProfile']);
        Route::get('profile', [ProfileController::class, 'profile'])->name('home.profile');
        // Routes for topics
        Route::get('/topics', [TopicCommentController::class, 'index'])->name('topics.index');
        Route::get('/topics/create', [TopicCommentController::class, 'create'])->name('topics.create');
        Route::post('/topics', [TopicCommentController::class, 'store'])->name('topics.store');
        Route::get('/topics/{topic}', [TopicCommentController::class, 'show'])->name('topics.show');
        Route::get('/topics/{topic}/edit', [TopicCommentController::class, 'edit'])->name('topics.edit');
        Route::put('/topics/{topic}', [TopicCommentController::class, 'update'])->name('topics.update');
        Route::delete('/topics/{topic}', [TopicCommentController::class, 'destroy'])->name('topics.destroy');
        // Routes for comments
        Route::post('/topics/{topic}/comments', [TopicCommentController::class, 'storeComment'])->name('comments.store');
        Route::get('/topics/{topic}/comments/{comment}/edit', [TopicCommentController::class, 'editComment'])->name('comments.edit');
        Route::put('/topics/{topic}/comments/{comment}', [TopicCommentController::class, 'updateComment'])->name('comments.update');
        Route::delete('/topics/{topic}/comments/{comment}', [TopicCommentController::class, 'destroyComment'])->name('comments.destroy');
        Route::get('vehicle/paper/details/{encryptedId}', [TopicCommentController::class, 'editvehiclepaper'])->name('edit.vehiclepaper');
        Route::get('vehicle/paper/delete/{encryptedId}', [TopicCommentController::class, 'deletevehiclepaper'])->name('delete.vehiclepaper');
 
    
    });
    // AddVehicleController
    Route::get('addvehicle', [HomeController::class, 'addvehicle'])->name('home.addVehicle');
 
   

    Route::post('postaddvehicleregistration', [AddVehicleRegistrationController::class, 'postAddVehicleRegistration'])->name('home.postAddVehicleRegistration');
    Route::post('post-new-vehicle-registration', [AddVehicleRegistrationController::class, 'postNewVehicleRegistration'])->name('home.postNewVehicleRegistration');
    
    
    Route::post('postvehicleownership', [AddVehicleOwnershipController::class, 'postAddvehicleOwnership'])->name('home.postAddVehicleOwnership');
    Route::post('post/changeofOwnership', [AddVehicleOwnershipController::class, 'postchangeofownership'])->name('home.postchangeofownership');

});

 

