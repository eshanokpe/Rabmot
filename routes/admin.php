<?php 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Admin\ProcessDocument\AdminProcessDocument;
use App\Http\Controllers\Admin\Transaction\AdminTransactionController;
use App\Http\Controllers\Admin\PromoCodeController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminProcessTypeController;
use App\Http\Controllers\Admin\AdminAddVehicleController;
use App\Http\Controllers\Admin\AdminVehiclePriceController;
use App\Http\Controllers\Admin\AdminAddedVehicleController;
use App\Http\Controllers\Admin\DriverLicenseController;
use App\Http\Controllers\Admin\DealersPlateNumberPriceController;
use App\Http\Controllers\Admin\DriverLicenseRenewalController;
use App\Http\Controllers\Admin\VehicleChangeOfOwnershipPriceController;
use App\Http\Controllers\Admin\AdminVehicleRenewalPriceController;
use App\Http\Controllers\Admin\AdminVehicleRegistrationPriceController;
use App\Http\Controllers\Admin\OtherPermitPriceController;
use App\Http\Controllers\Admin\InternationalDriverLicensePriceController;




 
Route::prefix('admin')->group(function () {
    Route::get('/login',  [AdminLoginController::class, 'showLoginForm'])->name('admin.login');  
    Route::post('/login/amin',  [AdminLoginController::class, 'login'])->name('admin.loginSubmit');
    Route::get('/forgotpassword',  [AdminLoginController::class, 'forgotpassword'])->name('admin-forgotpassword');
    Route::get('/forgotpassword',  [AdminLoginController::class, 'forgotpassword'])->name('admin.forgotpassword');
 
    Route::middleware('auth.admin')->group(function () {
        Route::get('/',[AdminDashboardController::class, 'index'])->name('admin.index');
        
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
        
        //Processe Type
        Route::get('/vehicle/paper-renewal', [AdminProcessTypeController::class, 'processVehiclePaperRenewal'])->name('admin.processVehiclePaperRenewal');
        Route::get('/vehicle/paper-renewal/view/{id}', [AdminProcessTypeController::class, 'viewVehiclePaperRenewal'])->name('admin.viewVehiclePaperRenewal');
        
        Route::get('/vehicle/registration', [AdminProcessTypeController::class, 'processNewVehicleRegistration'])->name('admin.processNewVehicleRegistration');
        Route::get('/vehicle/registration/view/{id}', [AdminProcessTypeController::class, 'viewNewVehicleRegistration'])->name('admin.viewNewVehicleRegistration');

        Route::get('/ownership/change', [AdminProcessTypeController::class, 'processChangeOfOwnership'])->name('admin.processChangeOfOwnership');
        Route::get('/ownership/change/view/{id}', [AdminProcessTypeController::class, 'viewChangeOfOwnership'])->name('admin.viewChangeOfOwnership');

        Route::get('/ownership/license-paper/download/{id}', [AdminProcessTypeController::class, 'downloadChangeOfOwnershipLicensePaper'])->name('changeOfOwnershipLicensePaper.download');
        Route::get('/ownership/proof/download/{id}', [AdminProcessTypeController::class, 'downloadChangeOfOwnershipProof'])->name('changeOfOwnershipProof.download');
        Route::get('/ownership/agreement/download/{id}', [AdminProcessTypeController::class, 'downloadChangeOfOwnershipAgreement'])->name('changeOfOwnershipAgreement.download');
        Route::get('/ownership/means-of-id/download/{id}', [AdminProcessTypeController::class, 'downloadChangeOfOwnershipMeansOfId'])->name('changeOfOwnershipMeansOfId.download');

        Route::get('/new/driver/license', [AdminProcessTypeController::class, 'processNewDriverLicense'])->name('admin.processNewDriverlicense');
        Route::get('/newdriver/license/view/{id}', [AdminProcessTypeController::class, 'viewNewDriverLicense'])->name('admin.viewNewDriverLicense');
        Route::get('/newdriver-licenseRenewal/download/{id}', [AdminProcessTypeController::class, 'downloadnewDriverLicensedocument'])->name('newDriverlicensedocument.download');

        Route::get('/newdriver/license-renewal', [AdminProcessTypeController::class, 'processnewDriverlicenseRenewal'])->name('admin.processNewDriverLicenseRenewal');
        Route::get('/newdriver/license-renewal/view/{id}', [AdminProcessTypeController::class, 'viewnewdriverlicenseRenewal'])->name('admin.viewNewDriverLicenseRenewal');
        Route::get('/driver/license-renewal/download/{id}', [AdminProcessTypeController::class, 'downloadnewDriverlicenseRenewaldocument'])->name('newDriverlicenseRenewaldocument.download');
 
        Route::get('/international-driver-license', [AdminProcessTypeController::class, 'processInternationalDriverLicense'])->name('admin.processInternationalDriverLicense');
        Route::get('/international-driver-license/view/{id}', [AdminProcessTypeController::class, 'viewInternationalDriverLicense'])->name('admin.viewInternationalDriverlicense');
        Route::get('/international-driver-license-passport/download/{id}', [AdminProcessTypeController::class, 'downloadInternationalDriverLicensePassPort'])->name('internationalDriverlicensepassport.download');

        Route::get('/dealer/plateNumber', [AdminProcessTypeController::class, 'processDealerPlateNumber'])->name('admin.processDealerPlateNumber');
        Route::get('/viewplateNumber/{id}', [AdminProcessTypeController::class, 'viewDealerPlateNumber'])->name('admin.viewplateNumber');
        Route::get('/download/plateNumberpassportpassport/{id}', [AdminProcessTypeController::class, 'downloadPlateNumberPassPort'])->name('plateNumberpassport.download');
        Route::get('/download/plateNumbercertificate/{id}', [AdminProcessTypeController::class, 'downloadPlateNumberCertificate'])->name('plateNumbercertificate.download');
        Route::get('/download/plateNumbercompanyLetterhead/{id}', [AdminProcessTypeController::class, 'downloadPlateNumberCompanyLetterhead'])->name('plateNumbercompanyLetterhead.download');
        
        Route::get('/otherPermit', [AdminProcessTypeController::class, 'processOtherPermit'])->name('admin.processOtherPermit');
        Route::get('/viewotherPermit/{id}', [AdminProcessTypeController::class, 'viewOtherPermit'])->name('admin.viewOtherPermit');
        Route::get('/download/otherpermitpassport/{id}', [AdminProcessTypeController::class, 'downloadotherpermitpassport'])->name('otherpermitpassport.download');
        Route::get('/download/otherpermitmeansofID/{id}', [AdminProcessTypeController::class, 'downloadotherpermitmeansofID'])->name('otherpermitmeansofID.download');
        Route::get('/download/otherpermitpictureoftheVehicleLicense/{id}', [AdminProcessTypeController::class, 'downloadotherpermitpictureoftheVehicleLicense'])->name('otherpermitpictureoftheVehicleLicense.download');
        Route::get('/download/otherpermitaffidavit/{id}', [AdminProcessTypeController::class, 'downloadotherpermitaffidavit'])->name('otherpermitaffidavit.download');
        Route::get('/download/otherpermitpolicereport/{id}', [AdminProcessTypeController::class, 'downloadotherpermitpolicereport'])->name('otherpermitpolicereport.download');
        Route::put('/update/deliveryinprogress/paper/{id}', [AdminDashboardController::class, 'updatedeliveryinprogressStatus'])->name('admin.update-deliveryinprogress-status');

        //Getaddvehiclerenewal
        Route::get('/vehicle-renewals', [AdminAddedVehicleController::class, 'showAddVehicleRenewal'])->name('admin.vehicle.renewals');
        Route::get('/vehicle-renewals/{id}', [AdminAddedVehicleController::class, 'showVehicleRenewalDetails'])->name('admin.vehicle.renewals.view');
        Route::put('/vehicle-renewals/{id}', [AdminAddedVehicleController::class, 'updateVehicleRenewal'])->name('admin.vehicle.renewals.update');
        Route::get('/vehicle-license-papers/download/{id}', [AdminAddedVehicleController::class, 'downloadVehicleLicensePapers'])->name('vehicle.license.papers.download');
        Route::get('/vehicle-insurance-papers/download/{id}', [AdminAddedVehicleController::class, 'downloadVehicleInsurancePapers'])->name('vehicle.insurance.papers.download');
        Route::get('/vehicle-roadworthiness/download/{id}', [AdminAddedVehicleController::class, 'downloadVehicleRoadworthiness'])->name('vehicle.roadworthiness.download');
        Route::get('/vehicle-hackney-permit/download/{id}', [AdminAddedVehicleController::class, 'downloadVehicleHackneyPermit'])->name('vehicle.hackney.permit.download');
        Route::get('/vehicle-state-carriage-permit/download/{id}', [AdminAddedVehicleController::class, 'downloadVehicleStateCarriagePermit'])->name('vehicle.state.carriage.permit.download');
        Route::get('/vehicle-local-government-permit/download/{id}', [AdminAddedVehicleController::class, 'downloadVehicleLocalGovernmentPermit'])->name('vehicle.local.government.permit.download');
        Route::get('/vehicle-midyear-permit/download/{id}', [AdminAddedVehicleController::class, 'downloadVehicleMidyearPermit'])->name('vehicle.midyear.permit.download');
        Route::get('/vehicle-means-of-id/download/{id}', [AdminAddedVehicleController::class, 'downloadVehicleMeansOfId'])->name('vehicle.means.of.id.download');

        //Getnewvehicleregistration
        Route::get('/vehicle-registrations/new', [AdminAddedVehicleController::class, 'showAddNewVehicleRegistration'])->name('admin.vehicle.registrations.new');
        Route::get('/vehicle-registrations/{id}', [AdminAddedVehicleController::class, 'showAddNewVehicleRegistrationDetails'])->name('admin.vehicle.registrations.view'); 
        Route::put('/vehicle-registrations/{id}', [AdminAddedVehicleController::class, 'updateVehicleRegistration'])->name('admin.vehicle.registration.update');
        Route::get('/vehicle-registrations/download/custom-paper/{id}', [AdminAddedVehicleController::class, 'downloadVehicleRegistrationCustomPaper'])->name('vehicle.registration.custom.paper.download');
        Route::get('/vehicle-registrations/download/means-of-id/{id}', [AdminAddedVehicleController::class, 'downloadVehicleRegistrationMeansOfId'])->name('vehicle.registration.means.of.id.download');

        //GetaddchangeOfownership
        Route::get('/change-of-ownership', [AdminAddedVehicleController::class, 'showAddChangeOfOwnership'])->name('admin.changeOfOwnership');
        Route::get('/change-of-ownership/{id}', [AdminAddedVehicleController::class, 'viewAddChangeOfOwnership'])->name('admin.changeOfOwnership.view');
        Route::put('/change-of-ownership/{id}', [AdminAddedVehicleController::class, 'updateChangeOfOwnership'])->name('admin.vehicle.changeOfOwnership.update');
        
        Route::get('/change-of-ownership/download/vehicle-license/{id}', [AdminAddedVehicleController::class, 'downloadChangeOfOwnershipVehicleLicense'])->name('changeOfOwnership.vehicle.license.download');
        Route::get('/change-of-ownership/download/proof-of-ownership/{id}', [AdminAddedVehicleController::class, 'downloadChangeOfOwnershipProofOfOwnership'])->name('changeOfOwnership.proof.download');
        Route::get('/change-of-ownership/download/agreements/{id}', [AdminAddedVehicleController::class, 'downloadChangeOfOwnershipAgreements'])->name('changeOfOwnership.agreements.download');
        Route::get('/change-of-ownership/download/means-of-id/{id}', [AdminAddedVehicleController::class, 'downloadChangeOfOwnershipMeansOfID'])->name('changeOfOwnership.means.of.id.download');
        
        //Add Vehicle Renewal
        Route::get('/vehicle-renewal/add', [AdminAddVehicleController::class, 'addVehicleRenewal'])->name('admin.vehicle.renewal.add');
        Route::post('/vehicle-renewal', [AdminAddVehicleController::class, 'storeVehicleRenewal'])->name('admin.vehicle.renewal.store');

        Route::get('/vehicle-registration/new', [AdminAddVehicleController::class, 'addVehicleNewRegistration'])->name('admin.vehicle.registration.new');
        Route::post('/vehicle-registration', [AdminAddVehicleController::class, 'storeVehicleNewRegistration'])->name('admin.vehicle.registration.store');

        Route::get('/vehicle-change-of-ownership/add', [AdminAddVehicleController::class, 'addVehicleChangeOfOwnership'])->name('admin.vehicle.changeOfOwnership.add');
        Route::post('/vehicle-change-of-ownership', [AdminAddVehicleController::class, 'storeVehicleChangeOfOwnership'])->name('admin.vehicle.changeOfOwnership.store');

        //Vehicle Type 
        Route::get('/vehicle-types', [AdminVehiclePriceController::class, 'indexVehicleTypes'])->name('admin.vehicle.types');
        Route::get('/vehicle-types/add', [AdminVehiclePriceController::class, 'createVehicleType'])->name('admin.vehicle.type.add');
        Route::post('/vehicle-types/store', [AdminVehiclePriceController::class, 'storeVehicleType'])->name('admin.vehicle.type.store');
        Route::get('/vehicle-types/{id}/edit', [AdminVehiclePriceController::class, 'editVehicleType'])->name('admin.vehicle.type.edit');
        Route::post('/vehicle-types/update', [AdminVehiclePriceController::class, 'updateVehicleType'])->name('admin.vehicle.type.update');
        
        //state
        Route::get('/states', [AdminVehiclePriceController::class, 'indexStates'])->name('admin.states');
        Route::get('/states/create', [AdminVehiclePriceController::class, 'createState'])->name('admin.state.create');
        Route::post('/states/store', [AdminVehiclePriceController::class, 'storeState'])->name('admin.state.store');
        Route::post('/states/update', [AdminVehiclePriceController::class, 'updateState'])->name('admin.state.update');
        Route::get('/states/{id}', [AdminVehiclePriceController::class, 'showStateEdit'])->name('admin.state.details');
        
        //Price Update 
       // Vehicle renewal price management routes for admin
        Route::get('/vehicle-renewal-price', [AdminVehicleRenewalPriceController::class, 'index'])->name('admin.vehicleRenewalPrice.index'); 
        Route::get('/vehicle-renewal-price/create', [AdminVehicleRenewalPriceController::class, 'create'])->name('admin.vehicleRenewalPrice.create'); 
        Route::post('/vehicle-renewal-price', [AdminVehicleRenewalPriceController::class, 'store'])->name('admin.vehicleRenewalPrice.store'); 
        Route::get('/vehicle-renewal-price/{id}/edit', [AdminVehicleRenewalPriceController::class, 'edit'])->name('admin.vehicleRenewalPrice.edit');
        Route::put('/vehicle-renewal-price/{id}', [AdminVehicleRenewalPriceController::class, 'update'])->name('admin.vehicleRenewalPrice.update'); 
        Route::get('/vehicle-renewal-price/{id}', [AdminVehicleRenewalPriceController::class, 'destroy'])->name('admin.vehicleRenewalPrice.destroy'); 

        // Vehicle registration price management routes for admin
        Route::get('/vehicle-registration-price', [AdminVehicleRegistrationPriceController::class, 'index'])->name('admin.vehicleRegistrationPrice.index');
        Route::get('/vehicle-registration-price/create', [AdminVehicleRegistrationPriceController::class, 'create'])->name('admin.vehicleRegistrationPrice.create');
        Route::post('/vehicle-registration-price', [AdminVehicleRegistrationPriceController::class, 'store'])->name('admin.vehicleRegistrationPrice.store');
        Route::get('/vehicle-registration-price/{id}/edit', [AdminVehicleRegistrationPriceController::class, 'edit'])->name('admin.vehicleRegistrationPrice.edit');
        Route::put('/vehicle-registration-price/{id}', [AdminVehicleRegistrationPriceController::class, 'update'])->name('admin.vehicleRegistrationPrice.update');
        Route::get('/vehicle-registration-price/{id}', [AdminVehicleRegistrationPriceController::class, 'destroy'])->name('admin.vehicleRegistrationPrice.destroy');

       // Vehicle change of ownership price management routes for admin
        Route::get('/vehicle-change-of-ownership-price', [VehicleChangeOfOwnershipPriceController::class, 'index'])->name('admin.vehicleChangeofOwnershipPrice.index');
        Route::get('/vehicle-change-of-ownership-price/create', [VehicleChangeOfOwnershipPriceController::class, 'create'])->name('admin.vehicleChangeofOwnershipPrice.create');
        Route::post('/vehicle-change-of-ownership-price', [VehicleChangeOfOwnershipPriceController::class, 'store'])->name('admin.vehicleChangeofOwnershipPrice.store');
        Route::get('/vehicle-change-of-ownership-price/{id}/edit', [VehicleChangeOfOwnershipPriceController::class, 'edit'])->name('admin.vehicleChangeofOwnershipPrice.edit');
        Route::put('/vehicle-change-of-ownership-price/{id}', [VehicleChangeOfOwnershipPriceController::class, 'update'])->name('admin.vehicleChangeofOwnershipPrice.update');
        Route::get('/vehicle-change-of-ownership-price/{id}', [VehicleChangeOfOwnershipPriceController::class, 'destroy'])->name('admin.vehicleChangeofOwnershipPrice.destroy');

       // Driver license price management routes for admin
        Route::get('/new-driver-license', [DriverLicenseController::class, 'index'])->name('admin.newDriverLicense.index');
        Route::get('/new-driver-license/create', [DriverLicenseController::class, 'create'])->name('admin.newDriverLicense.create');
        Route::post('/new-driver-license', [DriverLicenseController::class, 'store'])->name('admin.newDriverLicense.store');
        Route::get('/new-driver-license/{id}/edit', [DriverLicenseController::class, 'edit'])->name('admin.newDriverLicense.edit');
        Route::put('/new-driver-license/{id}', [DriverLicenseController::class, 'update'])->name('admin.newDriverLicense.update');
        Route::get('/new-driver-license/{id}', [DriverLicenseController::class, 'destroy'])->name('admin.newDriverLicense.destroy');

        // Driver license renewal price management routes for admin
        Route::get('/admin/driver-license-renewal', [DriverLicenseRenewalController::class, 'index'])->name('admin.driverLicenseRenewal.index');
        Route::get('/admin/driver-license-renewal/create', [DriverLicenseRenewalController::class, 'create'])->name('admin.driverLicenseRenewal.create');
        Route::post('/admin/driver-license-renewal', [DriverLicenseRenewalController::class, 'store'])->name('admin.driverLicenseRenewal.store');
        Route::get('/admin/driver-license-renewal/{id}/edit', [DriverLicenseRenewalController::class, 'edit'])->name('admin.driverLicenseRenewal.edit');
        Route::put('/admin/driver-license-renewal/{id}', [DriverLicenseRenewalController::class, 'update'])->name('admin.driverLicenseRenewal.update');
        Route::get('/admin/driver-license-renewal/{id}', [DriverLicenseRenewalController::class, 'destroy'])->name('admin.driverLicenseRenewal.destroy');

        //IntDriverlicense
       // International Driver License price management routes for admin
        Route::get('/international-driver-license/price', [InternationalDriverLicensePriceController::class, 'index'])->name('admin.intDriverLicense.index');
        Route::get('/international-driver-license/price/create', [InternationalDriverLicensePriceController::class, 'create'])->name('admin.intDriverLicense.create');
        Route::post('/international-driver-license/price', [InternationalDriverLicensePriceController::class, 'store'])->name('admin.intDriverLicense.store');
        Route::get('/international-driver-license/price/{id}/edit', [InternationalDriverLicensePriceController::class, 'edit'])->name('admin.intDriverLicense.edit');
        Route::put('/international-driver-license/price/{id}', [InternationalDriverLicensePriceController::class, 'update'])->name('admin.intDriverLicense.update');
        Route::get('/international-driver-license/price/{id}', [InternationalDriverLicensePriceController::class, 'destroy'])->name('admin.intDriverLicense.destroy');

        // Dealer Plate Number price management routes for admin
        Route::get('/dealers-plate-number', [DealersPlateNumberPriceController::class, 'index'])->name('admin.dealersPlateNumber.index');
        Route::get('/dealers-plate-number/create', [DealersPlateNumberPriceController::class, 'create'])->name('admin.dealersPlateNumber.create');
        Route::post('/dealers-plate-number', [DealersPlateNumberPriceController::class, 'store'])->name('admin.dealersPlateNumber.store');
        Route::get('/dealers-plate-number/{id}/edit', [DealersPlateNumberPriceController::class, 'edit'])->name('admin.dealersPlateNumber.edit');
        Route::put('/dealers-plate-number/{id}', [DealersPlateNumberPriceController::class, 'update'])->name('admin.dealersPlateNumber.update');
        Route::get('/dealers-plate-number/{id}', [DealersPlateNumberPriceController::class, 'destroy'])->name('admin.dealersPlateNumber.destroy');

        // otherpermit
        Route::get('/other-permit', [OtherPermitPriceController::class, 'index'])->name('admin.otherPermit.index');
        Route::get('/other-permit/create', [OtherPermitPriceController::class, 'create'])->name('admin.otherPermit.create');
        Route::post('/other-permit', [OtherPermitPriceController::class, 'store'])->name('admin.otherPermit.store');
        Route::get('/other-permit/{id}/edit', [OtherPermitPriceController::class, 'edit'])->name('admin.otherPermit.edit');
        Route::put('/other-permit/{id}', [OtherPermitPriceController::class, 'update'])->name('admin.otherPermit.update');
        Route::get('/other-permit/{id}', [OtherPermitPriceController::class, 'destroy'])->name('admin.otherPermit.destroy');
        Route::post('/admin/other-permit-type', [OtherPermitPriceController::class, 'storeType'])->name('admin.otherPermit.storeType');
        // FAQ 
        Route::prefix('faq/questions')->group(function () {
            Route::get('/', [AdminDashboardController::class, 'showFAQ'])
                ->name('admin.faq.index');
            
            Route::get('/create', [AdminDashboardController::class, 'addFaqQuestion'])
                ->name('admin.faq.create');
            
            Route::post('/add', [AdminDashboardController::class, 'addFaqQuestionPost'])
                ->name('admin.faq.add');
            
            Route::get('/{id}/edit', [AdminDashboardController::class, 'editFaqQuestion'])
                ->name('admin.faq.edit');
            Route::put('/{id}', [AdminDashboardController::class, 'updateFaqQuestion'])
                ->name('admin.faq.update');
        });
        //Users
        Route::get('/users', [AdminDashboardController::class, 'getUsers'])->name('admin.users');
        Route::get('/users/{id}/edit', [AdminDashboardController::class, 'editUser'])->name('admin.users.edit');
        Route::put('/users/{id}/status', [AdminDashboardController::class, 'updateUserStatus'])->name('admin.users.updateStatus');
    
        //Agent
        Route::get('/agents', [AdminDashboardController::class, 'getAgent'])->name('admin.agents');
        Route::get('/agents/create', [AdminDashboardController::class, 'createAgent'])->name('admin.agent.create');
        Route::post('/agents', [AdminDashboardController::class, 'postcreateAgent'])->name('admin.agent.store');
        Route::get('/agents/{id}/edit', [AdminDashboardController::class, 'editAgent'])->name('admin.agent.edit');
        Route::put('/agents/{id}', [AdminDashboardController::class, 'updateAgent'])->name('admin.agent.update');

        Route::get('/notificationslist', [NotificationController::class, 'index'])->name('admin.notificationList');
        Route::get('/notifications', [NotificationController::class, 'getNotifications'])->name('admin.getNotifications');
        Route::get('/notifications/{id}', [NotificationController::class, 'markAsRead'])->name('admin.markAsRead');

        Route::get('/withdraw', [AdminDashboardController::class, 'withdraw'])->name('admin.withdraw');
        Route::get('/editWithdraw/{id}', [AdminDashboardController::class, 'editWithdraw'])->name('admin.editWithdraw');
        Route::put('/update/withdraw/{id}', [AdminDashboardController::class, 'updaterWithdrawStatus'])->name('admin.update-withdraw-status');

        Route::get('/transactions', [AdminTransactionController::class, 'index'])->name('admin.transactions');
        Route::get('/transactions/{id}', [AdminTransactionController::class, 'viewTransaction'])->name('admin.transactions.show');
 
        Route::prefix('transaction')->group(function () {
            Route::get('/agent', [AdminTransactionController::class, 'transactionAgentWithdraw'])->name('admin.transactions.agent');
            Route::get('/agent/{id}', [AdminTransactionController::class, 'editTransactionAgentWithdraw'])->name('admin.transactions.editAgentWithdraw');
            Route::put('/agent/{id}', [AdminTransactionController::class, 'updateTransactionAgentWithdraw'])->name('admin.transactions.updateAgentWithdraw');
    
            Route::get('/paper-renewal', [AdminTransactionController::class, 'transactionPaperRenewal'])->name('admin.transaction.paperRenewal');
            Route::get('/paper-renewal/{id}', [AdminTransactionController::class, 'showTransactionPaperRenewal'])->name('admin.transaction.showPaperRenewal');
    
            Route::get('/vehicle-registration', [AdminTransactionController::class, 'transactionVehicleRegistration'])->name('admin.transaction.vehicleRegistration');
            Route::get('/vehicle-registration/{id}', [AdminTransactionController::class, 'showTransactionVehicleRegistration'])->name('admin.transaction.showVehicleRegistration');
    
            Route::get('/change-of-ownership', [AdminTransactionController::class, 'transactionChangeofownership'])->name('admin.transaction.changeOfOwnership');
            Route::get('/change-of-ownership/{id}', [AdminTransactionController::class, 'showTransactionChangeofownership'])->name('admin.transaction.showChangeOfOwnership');
    
            Route::get('/new-driver-license', [AdminTransactionController::class, 'transactionNewDriverlicense'])->name('admin.transactions.newDriverLicense');
            Route::get('/new-driver-license/{id}', [AdminTransactionController::class, 'showTransactionNewDriverlicense'])->name('admin.transactions.showNewDriverLicense');
    
            Route::get('/driver-license-renewal', [AdminTransactionController::class, 'transactionDriverlicenseRenewal'])->name('admin.transactions.driverLicenseRenewal');
            Route::get('/driver-license-renewal/{id}', [AdminTransactionController::class, 'showTransactionDriverlicenseRenewal'])->name('admin.transactions.showDriverLicenseRenewal');
    
            Route::get('/international-driver-license', [AdminTransactionController::class, 'transactionInternationalDriverlicense'])->name('admin.transactions.internationalDriverLicense');
            Route::get('/international-driver-license/{id}', [AdminTransactionController::class, 'showTransactionInternationalDriverlicense'])->name('admin.transactions.showInternationalDriverLicense');
    
            Route::get('/dealer-plate-number', [AdminTransactionController::class, 'transactionDealerPlateNumber'])->name('admin.transactions.dealerPlateNumber');
            Route::get('/dealer-plate-number/{id}', [AdminTransactionController::class, 'showTransactionDealerPlateNumber'])->name('admin.transactions.showDealerPlateNumber');
        
            Route::get('/other-permit', [AdminTransactionController::class, 'transactionOtherPermit'])->name('admin.transactions.otherPermit');
            Route::get('/other-permit/{id}', [AdminTransactionController::class, 'showTransactionOtherPermit'])->name('admin.transactions.showOtherPermit');
        
        });

        
        Route::prefix('settings')->group(function () {
            Route::get('/', [AdminDashboardController::class, 'settings'])
                ->name('admin.settings.index');
            
            Route::post('/', [AdminDashboardController::class, 'postSettings'])
                ->name('admin.settings.update');
        });
        
        Route::prefix('contact-messages')->group(function () {
            Route::get('/', [AdminDashboardController::class, 'contactMessage'])
                ->name('admin.contactMessages.index');
            
            Route::get('/{id}', [AdminDashboardController::class, 'showContactMessage'])
                ->name('admin.contactMessages.show');
        });
        //process/history 
        Route::get('/view/process/history/{id}', [AdminController::class, 'viewprocesshistory'])->name('admin.viewprocesshistory');
        Route::put('/update/process/history/{id}', [AdminController::class, 'updateProcessHistoryStatus'])->name('admin.update-processhistory-status');
        Route::get('/view/ready-for-delivery/paper/{id}', [AdminController::class, 'viewreadyfordeliveryPaper'])->name('admin.viewreadyfordeliveryPaper');
        
        //Document Processes
        Route::get('/pending/paper', [AdminProcessDocument::class, 'pendingPaper'])->name('admin.pendingpaper');
        Route::get('/view/pending/paper/{id}', [AdminProcessDocument::class, 'viewpendingPaper'])->name('admin.viewpendingpaper');
        Route::put('/update/pending/paper/{id}', [AdminProcessDocument::class, 'updatePendingPaperStatus'])->name('admin.update-pendingPaper-status');
        
        Route::get('/process/paper', [AdminProcessDocument::class, 'processedPaper'])->name('admin.processedpaper');
        Route::get('/view/process/paper/{id}', [AdminProcessDocument::class, 'viewProcessPaper'])->name('admin.viewprocesspaper');
        Route::put('/update/process/paper/{id}', [AdminProcessDocument::class, 'updateProcessPaperStatus'])->name('admin.update-processPaper-status');
        
        Route::get('/ready/delivery', [AdminProcessDocument::class, 'readyForDelivery'])->name('admin.readyfordelivery');
        Route::get('/view/viewdeliveryin/porogress/{id}', [AdminProcessDocument::class, 'viewDeliveryinProgress'])->name('admin.viewdeliveryinprogress');
        Route::put('/update/readyfordelivery/paper/{id}', [AdminProcessDocument::class, 'updateReadyforDeliveryPaperStatus'])->name('admin.update-readyfordelivery-status');
    
        Route::get('/delivery/inprogress', [AdminProcessDocument::class, 'deliveryinProgress'])->name('admin.deliveryinprogress'); 
        Route::get('/delivered', [AdminProcessDocument::class, 'delivered'])->name('admin.delivered');
        Route::get('/view/delivered/paper/{id}', [AdminProcessDocument::class, 'viewDeliveredPaper'])->name('admin.viewdeliveredPaper');
        Route::put('/update/delivered/paper/{id}', [AdminProcessDocument::class, 'updateDeliveredPaperStatus'])->name('admin.update-delivered-status');
    
        Route::get('/promocode/index', [PromoCodeController::class, 'index'])->name('admin.promocode.index'); 
        Route::get('/promocode/create', [PromoCodeController::class, 'create'])->name('admin.promocode.create'); 
        Route::post('/promocode/store', [PromoCodeController::class, 'store'])->name('admin.promocode.store'); 
        Route::get('/promocode/edit/{id}', [PromoCodeController::class, 'edit'])->name('admin.promocode.edit'); 
        Route::put('/promocode/update/{id}', [PromoCodeController::class, 'update'])->name('admin.promocode.update'); 

        Route::post('admin/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');

    }); 
});
