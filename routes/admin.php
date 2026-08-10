<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Admin\ProcessDocument\AdminProcessDocument;
use App\Http\Controllers\Admin\Transaction\AdminTransactionController;
use App\Http\Controllers\Admin\PromoCodeController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminAgentApprovalController;
use App\Http\Controllers\Admin\AdminAgentManagementController;
use App\Http\Controllers\Admin\AdminAgentCommissionController;
use App\Http\Controllers\Admin\AdminAgentWithdrawalController;
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
use App\Http\Controllers\Admin\AdminServicePricingController;
use App\Http\Controllers\Admin\AdminStaffController;
use App\Http\Controllers\Admin\AdminSettingsController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\BroadcastController;





Route::prefix('admin')->group(function () {
    Route::get('/login',  [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login/amin',  [AdminLoginController::class, 'login'])->name('admin.loginSubmit');
    Route::get('/forgotpassword',  [AdminLoginController::class, 'forgotpassword'])->name('admin-forgotpassword');
    Route::get('/forgotpassword',  [AdminLoginController::class, 'forgotpassword'])->name('admin.forgotpassword');

    Route::middleware('auth.admin')->group(function () {
        Route::get('/',[AdminDashboardController::class, 'index'])->name('admin.index');

        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

        //Admin Staff Management
        Route::middleware('super.admin')->group(function () {
            Route::get('/staff', [AdminStaffController::class, 'index'])->name('admin.staff.index');
            Route::get('/staff/create', [AdminStaffController::class, 'create'])->name('admin.staff.create');
            Route::post('/staff', [AdminStaffController::class, 'store'])->name('admin.staff.store');
            Route::get('/staff/{id}/edit', [AdminStaffController::class, 'edit'])->name('admin.staff.edit');
            Route::put('/staff/{id}', [AdminStaffController::class, 'update'])->name('admin.staff.update');
            Route::put('/staff/{id}/toggle-status', [AdminStaffController::class, 'toggleStatus'])->name('admin.staff.toggleStatus');
        });

        //Processe Type
        Route::get('/vehicle/paper-renewal', [AdminProcessTypeController::class, 'processVehiclePaperRenewal'])->name('admin.processVehiclePaperRenewal')->middleware('admin.can:view-orders');
        Route::get('/vehicle/paper-renewal/view/{id}', [AdminProcessTypeController::class, 'viewVehiclePaperRenewal'])->name('admin.viewVehiclePaperRenewal')->middleware('admin.can:view-orders');

        Route::get('/vehicle/registration', [AdminProcessTypeController::class, 'processNewVehicleRegistration'])->name('admin.processNewVehicleRegistration')->middleware('admin.can:view-orders');
        Route::get('/vehicle/registration/view/{id}', [AdminProcessTypeController::class, 'viewNewVehicleRegistration'])->name('admin.viewNewVehicleRegistration')->middleware('admin.can:view-orders');

        Route::get('/ownership/change', [AdminProcessTypeController::class, 'processChangeOfOwnership'])->name('admin.processChangeOfOwnership')->middleware('admin.can:view-orders');
        Route::get('/ownership/change/view/{id}', [AdminProcessTypeController::class, 'viewChangeOfOwnership'])->name('admin.viewChangeOfOwnership')->middleware('admin.can:view-orders');

        Route::get('/ownership/license-paper/download/{id}', [AdminProcessTypeController::class, 'downloadChangeOfOwnershipLicensePaper'])->name('changeOfOwnershipLicensePaper.download')->middleware('admin.can:manage-orders');
        Route::get('/ownership/proof/download/{id}', [AdminProcessTypeController::class, 'downloadChangeOfOwnershipProof'])->name('changeOfOwnershipProof.download')->middleware('admin.can:manage-orders');
        Route::get('/ownership/agreement/download/{id}', [AdminProcessTypeController::class, 'downloadChangeOfOwnershipAgreement'])->name('changeOfOwnershipAgreement.download')->middleware('admin.can:manage-orders');
        Route::get('/ownership/means-of-id/download/{id}', [AdminProcessTypeController::class, 'downloadChangeOfOwnershipMeansOfId'])->name('changeOfOwnershipMeansOfId.download')->middleware('admin.can:manage-orders');

        Route::get('/new/driver/license', [AdminProcessTypeController::class, 'processNewDriverLicense'])->name('admin.processNewDriverlicense')->middleware('admin.can:view-orders');
        Route::get('/newdriver/license/view/{id}', [AdminProcessTypeController::class, 'viewNewDriverLicense'])->name('admin.viewNewDriverLicense')->middleware('admin.can:view-orders');
        Route::get('/newdriver-licenseRenewal/download/{id}', [AdminProcessTypeController::class, 'downloadnewDriverLicensedocument'])->name('newDriverlicensedocument.download')->middleware('admin.can:manage-orders');

        Route::get('/newdriver/license-renewal', [AdminProcessTypeController::class, 'processnewDriverlicenseRenewal'])->name('admin.processNewDriverLicenseRenewal')->middleware('admin.can:view-orders');
        Route::get('/newdriver/license-renewal/view/{id}', [AdminProcessTypeController::class, 'viewnewdriverlicenseRenewal'])->name('admin.viewNewDriverLicenseRenewal')->middleware('admin.can:view-orders');
        Route::get('/driver/license-renewal/download/{id}', [AdminProcessTypeController::class, 'downloadnewDriverlicenseRenewaldocument'])->name('newDriverlicenseRenewaldocument.download')->middleware('admin.can:manage-orders');

        Route::get('/international-driver-license', [AdminProcessTypeController::class, 'processInternationalDriverLicense'])->name('admin.processInternationalDriverLicense')->middleware('admin.can:view-orders');
        Route::get('/international-driver-license/view/{id}', [AdminProcessTypeController::class, 'viewInternationalDriverLicense'])->name('admin.viewInternationalDriverlicense')->middleware('admin.can:view-orders');
        Route::get('/international-driver-license-passport/download/{id}', [AdminProcessTypeController::class, 'downloadInternationalDriverLicensePassPort'])->name('internationalDriverlicensepassport.download')->middleware('admin.can:manage-orders');

        Route::get('/dealer/plateNumber', [AdminProcessTypeController::class, 'processDealerPlateNumber'])->name('admin.processDealerPlateNumber')->middleware('admin.can:view-orders');
        Route::get('/viewplateNumber/{id}', [AdminProcessTypeController::class, 'viewDealerPlateNumber'])->name('admin.viewplateNumber')->middleware('admin.can:view-orders');
        Route::get('/download/plateNumberpassportpassport/{id}', [AdminProcessTypeController::class, 'downloadPlateNumberPassPort'])->name('plateNumberpassport.download')->middleware('admin.can:manage-orders');
        Route::get('/download/plateNumbercertificate/{id}', [AdminProcessTypeController::class, 'downloadPlateNumberCertificate'])->name('plateNumbercertificate.download')->middleware('admin.can:manage-orders');
        Route::get('/download/plateNumbercompanyLetterhead/{id}', [AdminProcessTypeController::class, 'downloadPlateNumberCompanyLetterhead'])->name('plateNumbercompanyLetterhead.download')->middleware('admin.can:manage-orders');

        Route::get('/otherPermit', [AdminProcessTypeController::class, 'processOtherPermit'])->name('admin.processOtherPermit')->middleware('admin.can:view-orders');
        Route::get('/viewotherPermit/{id}', [AdminProcessTypeController::class, 'viewOtherPermit'])->name('admin.viewOtherPermit')->middleware('admin.can:view-orders');
        Route::get('/download/otherpermitpassport/{id}', [AdminProcessTypeController::class, 'downloadotherpermitpassport'])->name('otherpermitpassport.download')->middleware('admin.can:manage-orders');
        Route::get('/download/otherpermitmeansofID/{id}', [AdminProcessTypeController::class, 'downloadotherpermitmeansofID'])->name('otherpermitmeansofID.download')->middleware('admin.can:manage-orders');
        Route::get('/download/otherpermitpictureoftheVehicleLicense/{id}', [AdminProcessTypeController::class, 'downloadotherpermitpictureoftheVehicleLicense'])->name('otherpermitpictureoftheVehicleLicense.download')->middleware('admin.can:manage-orders');
        Route::get('/download/otherpermitaffidavit/{id}', [AdminProcessTypeController::class, 'downloadotherpermitaffidavit'])->name('otherpermitaffidavit.download')->middleware('admin.can:manage-orders');
        Route::get('/download/otherpermitpolicereport/{id}', [AdminProcessTypeController::class, 'downloadotherpermitpolicereport'])->name('otherpermitpolicereport.download')->middleware('admin.can:manage-orders');
        Route::put('/update/deliveryinprogress/paper/{id}', [AdminDashboardController::class, 'updatedeliveryinprogressStatus'])->name('admin.update-deliveryinprogress-status')->middleware('admin.can:manage-orders');

        //Getaddvehiclerenewal
        Route::get('/vehicle-renewals', [AdminAddedVehicleController::class, 'showAddVehicleRenewal'])->name('admin.vehicle.renewals')->middleware('admin.can:view-vehicles');
        Route::get('/vehicle-renewals/{id}', [AdminAddedVehicleController::class, 'showVehicleRenewalDetails'])->name('admin.vehicle.renewals.view')->middleware('admin.can:view-vehicles');
        Route::get('/vehicle-renewals/delete/{id}', [AdminAddedVehicleController::class, 'showVehicleRenewalDelete'])->name('admin.vehicle.renewals.delete')->middleware('admin.can:manage-vehicles');
        Route::put('/vehicle-renewals/{id}', [AdminAddedVehicleController::class, 'updateVehicleRenewal'])->name('admin.vehicle.renewals.update')->middleware('admin.can:manage-vehicles');

        Route::get('/vehicle-license-papers/download/{id}', [AdminAddedVehicleController::class, 'downloadVehicleLicensePapers'])->name('vehicle.license.papers.download')->middleware('admin.can:manage-vehicles');
        Route::get('/vehicle-insurance-papers/download/{id}', [AdminAddedVehicleController::class, 'downloadVehicleInsurancePapers'])->name('vehicle.insurance.papers.download')->middleware('admin.can:manage-vehicles');
        Route::get('/vehicle-roadworthiness/download/{id}', [AdminAddedVehicleController::class, 'downloadVehicleRoadworthiness'])->name('vehicle.roadworthiness.download')->middleware('admin.can:manage-vehicles');
        Route::get('/vehicle-hackney-permit/download/{id}', [AdminAddedVehicleController::class, 'downloadVehicleHackneyPermit'])->name('vehicle.hackney.permit.download')->middleware('admin.can:manage-vehicles');
        Route::get('/vehicle-state-carriage-permit/download/{id}', [AdminAddedVehicleController::class, 'downloadVehicleStateCarriagePermit'])->name('vehicle.state.carriage.permit.download')->middleware('admin.can:manage-vehicles');
        Route::get('/vehicle-local-government-permit/download/{id}', [AdminAddedVehicleController::class, 'downloadVehicleLocalGovernmentPermit'])->name('vehicle.local.government.permit.download')->middleware('admin.can:manage-vehicles');
        Route::get('/vehicle-midyear-permit/download/{id}', [AdminAddedVehicleController::class, 'downloadVehicleMidyearPermit'])->name('vehicle.midyear.permit.download')->middleware('admin.can:manage-vehicles');
        Route::get('/vehicle-means-of-id/download/{id}', [AdminAddedVehicleController::class, 'downloadVehicleMeansOfId'])->name('vehicle.means.of.id.download')->middleware('admin.can:manage-vehicles');

        //Getnewvehicleregistration
        Route::get('/vehicle-registrations/new', [AdminAddedVehicleController::class, 'showAddNewVehicleRegistration'])->name('admin.vehicle.registrations.new')->middleware('admin.can:view-vehicles');
        Route::get('/vehicle-registrations/{id}', [AdminAddedVehicleController::class, 'showAddNewVehicleRegistrationDetails'])->name('admin.vehicle.registrations.view')->middleware('admin.can:view-vehicles');
        Route::put('/vehicle-registrations/{id}', [AdminAddedVehicleController::class, 'updateVehicleRegistration'])->name('admin.vehicle.registration.update')->middleware('admin.can:manage-vehicles');
        Route::get('/vehicle-registrations/download/custom-paper/{id}', [AdminAddedVehicleController::class, 'downloadVehicleRegistrationCustomPaper'])->name('vehicle.registration.custom.paper.download')->middleware('admin.can:manage-vehicles');
        Route::get('/vehicle-registrations/download/means-of-id/{id}', [AdminAddedVehicleController::class, 'downloadVehicleRegistrationMeansOfId'])->name('vehicle.registration.means.of.id.download')->middleware('admin.can:manage-vehicles');

        //GetaddchangeOfownership
        Route::get('/change-of-ownership', [AdminAddedVehicleController::class, 'showAddChangeOfOwnership'])->name('admin.changeOfOwnership')->middleware('admin.can:view-vehicles');
        Route::get('/change-of-ownership/{id}', [AdminAddedVehicleController::class, 'viewAddChangeOfOwnership'])->name('admin.changeOfOwnership.view')->middleware('admin.can:view-vehicles');
        Route::put('/change-of-ownership/{id}', [AdminAddedVehicleController::class, 'updateChangeOfOwnership'])->name('admin.vehicle.changeOfOwnership.update')->middleware('admin.can:manage-vehicles');

        Route::get('/change-of-ownership/download/vehicle-license/{id}', [AdminAddedVehicleController::class, 'downloadChangeOfOwnershipVehicleLicense'])->name('changeOfOwnership.vehicle.license.download')->middleware('admin.can:manage-vehicles');
        Route::get('/change-of-ownership/download/proof-of-ownership/{id}', [AdminAddedVehicleController::class, 'downloadChangeOfOwnershipProofOfOwnership'])->name('changeOfOwnership.proof.download')->middleware('admin.can:manage-vehicles');
        Route::get('/change-of-ownership/download/agreements/{id}', [AdminAddedVehicleController::class, 'downloadChangeOfOwnershipAgreements'])->name('changeOfOwnership.agreements.download')->middleware('admin.can:manage-vehicles');
        Route::get('/change-of-ownership/download/means-of-id/{id}', [AdminAddedVehicleController::class, 'downloadChangeOfOwnershipMeansOfID'])->name('changeOfOwnership.means.of.id.download')->middleware('admin.can:manage-vehicles');

        //Add Vehicle Renewal
        Route::get('/vehicle-renewal/add', [AdminAddVehicleController::class, 'addVehicleRenewal'])->name('admin.vehicle.renewal.add')->middleware('admin.can:view-vehicles');
        Route::post('/vehicle-renewal', [AdminAddVehicleController::class, 'storeVehicleRenewal'])->name('admin.vehicle.renewal.store')->middleware('admin.can:manage-vehicles');

        Route::get('/vehicle-registration/new', [AdminAddVehicleController::class, 'addVehicleNewRegistration'])->name('admin.vehicle.registration.new')->middleware('admin.can:view-vehicles');
        Route::post('/vehicle-registration', [AdminAddVehicleController::class, 'storeVehicleNewRegistration'])->name('admin.vehicle.registration.store')->middleware('admin.can:manage-vehicles');

        Route::get('/vehicle-change-of-ownership/add', [AdminAddVehicleController::class, 'addVehicleChangeOfOwnership'])->name('admin.vehicle.changeOfOwnership.add')->middleware('admin.can:view-vehicles');
        Route::post('/vehicle-change-of-ownership', [AdminAddVehicleController::class, 'storeVehicleChangeOfOwnership'])->name('admin.vehicle.changeOfOwnership.store')->middleware('admin.can:manage-vehicles');

        //Vehicle Type
        Route::get('/vehicle-types', [AdminVehiclePriceController::class, 'indexVehicleTypes'])->name('admin.vehicle.types')->middleware('admin.can:view-vehicles');
        Route::get('/vehicle-types/add', [AdminVehiclePriceController::class, 'createVehicleType'])->name('admin.vehicle.type.add')->middleware('admin.can:view-vehicles');
        Route::post('/vehicle-types/store', [AdminVehiclePriceController::class, 'storeVehicleType'])->name('admin.vehicle.type.store')->middleware('admin.can:manage-vehicles');
        Route::get('/vehicle-types/{id}/edit', [AdminVehiclePriceController::class, 'editVehicleType'])->name('admin.vehicle.type.edit')->middleware('admin.can:view-vehicles');
        Route::post('/vehicle-types/update', [AdminVehiclePriceController::class, 'updateVehicleType'])->name('admin.vehicle.type.update')->middleware('admin.can:manage-vehicles');

        //state
        Route::get('/states', [AdminVehiclePriceController::class, 'indexStates'])->name('admin.states')->middleware('admin.can:view-vehicles');
        Route::get('/states/create', [AdminVehiclePriceController::class, 'createState'])->name('admin.state.create')->middleware('admin.can:view-vehicles');
        Route::post('/states/store', [AdminVehiclePriceController::class, 'storeState'])->name('admin.state.store')->middleware('admin.can:manage-vehicles');
        Route::post('/states/update', [AdminVehiclePriceController::class, 'updateState'])->name('admin.state.update')->middleware('admin.can:manage-vehicles');
        Route::get('/states/{id}', [AdminVehiclePriceController::class, 'showStateEdit'])->name('admin.state.details')->middleware('admin.can:view-vehicles');

        //Service Pricing
        Route::get('/services', [AdminServicePricingController::class, 'index'])->name('admin.services.index')->middleware('admin.can:view-pricing');
        Route::get('/services/create', [AdminServicePricingController::class, 'create'])->name('admin.services.create')->middleware('admin.can:view-pricing');
        Route::post('/services', [AdminServicePricingController::class, 'store'])->name('admin.services.store')->middleware('admin.can:manage-pricing');
        Route::get('/services/{id}/edit', [AdminServicePricingController::class, 'edit'])->name('admin.services.edit')->middleware('admin.can:view-pricing');
        Route::put('/services/{id}', [AdminServicePricingController::class, 'update'])->name('admin.services.update')->middleware('admin.can:manage-pricing');
        Route::put('/services/{id}/toggle-status', [AdminServicePricingController::class, 'toggleStatus'])->name('admin.services.toggleStatus')->middleware('admin.can:manage-pricing');

        //Price Update
       // Vehicle renewal price management routes for admin
        Route::get('/vehicle-renewal-price', [AdminVehicleRenewalPriceController::class, 'index'])->name('admin.vehicleRenewalPrice.index')->middleware('admin.can:view-pricing');
        Route::get('/vehicle-renewal-price/create', [AdminVehicleRenewalPriceController::class, 'create'])->name('admin.vehicleRenewalPrice.create')->middleware('admin.can:view-pricing');
        Route::post('/vehicle-renewal-price', [AdminVehicleRenewalPriceController::class, 'store'])->name('admin.vehicleRenewalPrice.store')->middleware('admin.can:manage-pricing');
        Route::get('/vehicle-renewal-price/{id}/edit', [AdminVehicleRenewalPriceController::class, 'edit'])->name('admin.vehicleRenewalPrice.edit')->middleware('admin.can:view-pricing');
        Route::put('/vehicle-renewal-price/{id}', [AdminVehicleRenewalPriceController::class, 'update'])->name('admin.vehicleRenewalPrice.update')->middleware('admin.can:manage-pricing');
        Route::get('/vehicle-renewal-price/{id}', [AdminVehicleRenewalPriceController::class, 'destroy'])->name('admin.vehicleRenewalPrice.destroy')->middleware('admin.can:manage-pricing');

        // Vehicle registration price management routes for admin
        Route::get('/vehicle-registration-price', [AdminVehicleRegistrationPriceController::class, 'index'])->name('admin.vehicleRegistrationPrice.index')->middleware('admin.can:view-pricing');
        Route::get('/vehicle-registration-price/create', [AdminVehicleRegistrationPriceController::class, 'create'])->name('admin.vehicleRegistrationPrice.create')->middleware('admin.can:view-pricing');
        Route::post('/vehicle-registration-price', [AdminVehicleRegistrationPriceController::class, 'store'])->name('admin.vehicleRegistrationPrice.store')->middleware('admin.can:manage-pricing');
        Route::get('/vehicle-registration-price/{id}/edit', [AdminVehicleRegistrationPriceController::class, 'edit'])->name('admin.vehicleRegistrationPrice.edit')->middleware('admin.can:view-pricing');
        Route::put('/vehicle-registration-price/{id}', [AdminVehicleRegistrationPriceController::class, 'update'])->name('admin.vehicleRegistrationPrice.update')->middleware('admin.can:manage-pricing');
        Route::get('/vehicle-registration-price/{id}', [AdminVehicleRegistrationPriceController::class, 'destroy'])->name('admin.vehicleRegistrationPrice.destroy')->middleware('admin.can:manage-pricing');

       // Vehicle change of ownership price management routes for admin
        Route::get('/vehicle-change-of-ownership-price', [VehicleChangeOfOwnershipPriceController::class, 'index'])->name('admin.vehicleChangeofOwnershipPrice.index')->middleware('admin.can:view-pricing');
        Route::get('/vehicle-change-of-ownership-price/create', [VehicleChangeOfOwnershipPriceController::class, 'create'])->name('admin.vehicleChangeofOwnershipPrice.create')->middleware('admin.can:view-pricing');
        Route::post('/vehicle-change-of-ownership-price', [VehicleChangeOfOwnershipPriceController::class, 'store'])->name('admin.vehicleChangeofOwnershipPrice.store')->middleware('admin.can:manage-pricing');
        Route::get('/vehicle-change-of-ownership-price/{id}/edit', [VehicleChangeOfOwnershipPriceController::class, 'edit'])->name('admin.vehicleChangeofOwnershipPrice.edit')->middleware('admin.can:view-pricing');
        Route::put('/vehicle-change-of-ownership-price/{id}', [VehicleChangeOfOwnershipPriceController::class, 'update'])->name('admin.vehicleChangeofOwnershipPrice.update')->middleware('admin.can:manage-pricing');
        Route::get('/vehicle-change-of-ownership-price/{id}', [VehicleChangeOfOwnershipPriceController::class, 'destroy'])->name('admin.vehicleChangeofOwnershipPrice.destroy')->middleware('admin.can:manage-pricing');

       // Driver license price management routes for admin
        Route::get('/new-driver-license', [DriverLicenseController::class, 'index'])->name('admin.newDriverLicense.index')->middleware('admin.can:view-pricing');
        Route::get('/new-driver-license/create', [DriverLicenseController::class, 'create'])->name('admin.newDriverLicense.create')->middleware('admin.can:view-pricing');
        Route::post('/new-driver-license', [DriverLicenseController::class, 'store'])->name('admin.newDriverLicense.store')->middleware('admin.can:manage-pricing');
        Route::get('/new-driver-license/{id}/edit', [DriverLicenseController::class, 'edit'])->name('admin.newDriverLicense.edit')->middleware('admin.can:view-pricing');
        Route::put('/new-driver-license/{id}', [DriverLicenseController::class, 'update'])->name('admin.newDriverLicense.update')->middleware('admin.can:manage-pricing');
        Route::get('/new-driver-license/{id}', [DriverLicenseController::class, 'destroy'])->name('admin.newDriverLicense.destroy')->middleware('admin.can:manage-pricing');

        // Driver license renewal price management routes for admin
        Route::get('/admin/driver-license-renewal', [DriverLicenseRenewalController::class, 'index'])->name('admin.driverLicenseRenewal.index')->middleware('admin.can:view-pricing');
        Route::get('/admin/driver-license-renewal/create', [DriverLicenseRenewalController::class, 'create'])->name('admin.driverLicenseRenewal.create')->middleware('admin.can:view-pricing');
        Route::post('/admin/driver-license-renewal', [DriverLicenseRenewalController::class, 'store'])->name('admin.driverLicenseRenewal.store')->middleware('admin.can:manage-pricing');
        Route::get('/admin/driver-license-renewal/{id}/edit', [DriverLicenseRenewalController::class, 'edit'])->name('admin.driverLicenseRenewal.edit')->middleware('admin.can:view-pricing');
        Route::put('/admin/driver-license-renewal/{id}', [DriverLicenseRenewalController::class, 'update'])->name('admin.driverLicenseRenewal.update')->middleware('admin.can:manage-pricing');
        Route::get('/admin/driver-license-renewal/{id}', [DriverLicenseRenewalController::class, 'destroy'])->name('admin.driverLicenseRenewal.destroy')->middleware('admin.can:manage-pricing');

        //IntDriverlicense
       // International Driver License price management routes for admin
        Route::get('/international-driver-license/price', [InternationalDriverLicensePriceController::class, 'index'])->name('admin.intDriverLicense.index')->middleware('admin.can:view-pricing');
        Route::get('/international-driver-license/price/create', [InternationalDriverLicensePriceController::class, 'create'])->name('admin.intDriverLicense.create')->middleware('admin.can:view-pricing');
        Route::post('/international-driver-license/price', [InternationalDriverLicensePriceController::class, 'store'])->name('admin.intDriverLicense.store')->middleware('admin.can:manage-pricing');
        Route::get('/international-driver-license/price/{id}/edit', [InternationalDriverLicensePriceController::class, 'edit'])->name('admin.intDriverLicense.edit')->middleware('admin.can:view-pricing');
        Route::put('/international-driver-license/price/{id}', [InternationalDriverLicensePriceController::class, 'update'])->name('admin.intDriverLicense.update')->middleware('admin.can:manage-pricing');
        Route::get('/international-driver-license/price/{id}', [InternationalDriverLicensePriceController::class, 'destroy'])->name('admin.intDriverLicense.destroy')->middleware('admin.can:manage-pricing');

        // Dealer Plate Number price management routes for admin
        Route::get('/dealers-plate-number', [DealersPlateNumberPriceController::class, 'index'])->name('admin.dealersPlateNumber.index')->middleware('admin.can:view-pricing');
        Route::get('/dealers-plate-number/create', [DealersPlateNumberPriceController::class, 'create'])->name('admin.dealersPlateNumber.create')->middleware('admin.can:view-pricing');
        Route::post('/dealers-plate-number', [DealersPlateNumberPriceController::class, 'store'])->name('admin.dealersPlateNumber.store')->middleware('admin.can:manage-pricing');
        Route::get('/dealers-plate-number/{id}/edit', [DealersPlateNumberPriceController::class, 'edit'])->name('admin.dealersPlateNumber.edit')->middleware('admin.can:view-pricing');
        Route::put('/dealers-plate-number/{id}', [DealersPlateNumberPriceController::class, 'update'])->name('admin.dealersPlateNumber.update')->middleware('admin.can:manage-pricing');
        Route::get('/dealers-plate-number/{id}', [DealersPlateNumberPriceController::class, 'destroy'])->name('admin.dealersPlateNumber.destroy')->middleware('admin.can:manage-pricing');

        // otherpermit
        Route::get('/other-permit', [OtherPermitPriceController::class, 'index'])->name('admin.otherPermit.index')->middleware('admin.can:view-pricing');
        Route::get('/other-permit/create', [OtherPermitPriceController::class, 'create'])->name('admin.otherPermit.create')->middleware('admin.can:view-pricing');
        Route::post('/other-permit', [OtherPermitPriceController::class, 'store'])->name('admin.otherPermit.store')->middleware('admin.can:manage-pricing');
        Route::get('/other-permit/{id}/edit', [OtherPermitPriceController::class, 'edit'])->name('admin.otherPermit.edit')->middleware('admin.can:view-pricing');
        Route::put('/other-permit/{id}', [OtherPermitPriceController::class, 'update'])->name('admin.otherPermit.update')->middleware('admin.can:manage-pricing');
        Route::get('/other-permit/{id}', [OtherPermitPriceController::class, 'destroy'])->name('admin.otherPermit.destroy')->middleware('admin.can:manage-pricing');
        Route::post('/admin/other-permit-type', [OtherPermitPriceController::class, 'storeType'])->name('admin.otherPermit.storeType')->middleware('admin.can:manage-pricing');
        // FAQ
        Route::prefix('faq/questions')->group(function () {
            Route::get('/', [AdminDashboardController::class, 'showFAQ'])
                ->name('admin.faq.index')->middleware('admin.can:view-faq');

            Route::get('/create', [AdminDashboardController::class, 'addFaqQuestion'])
                ->name('admin.faq.create')->middleware('admin.can:view-faq');

            Route::post('/add', [AdminDashboardController::class, 'addFaqQuestionPost'])
                ->name('admin.faq.add')->middleware('admin.can:manage-faq');

            Route::get('/{id}/edit', [AdminDashboardController::class, 'editFaqQuestion'])
                ->name('admin.faq.edit')->middleware('admin.can:view-faq');
            Route::put('/{id}', [AdminDashboardController::class, 'updateFaqQuestion'])
                ->name('admin.faq.update')->middleware('admin.can:manage-faq');
        });
        //Users
        Route::get('/users', [AdminDashboardController::class, 'getUsers'])->name('admin.users')->middleware('admin.can:view-users');
        Route::get('/users/{id}/edit', [AdminDashboardController::class, 'editUser'])->name('admin.users.edit')->middleware('admin.can:view-users');
        Route::put('/users/{id}/status', [AdminDashboardController::class, 'updateUserStatus'])->name('admin.users.updateStatus')->middleware('admin.can:manage-users');

        //Agent
        Route::get('/agents', [AdminAgentManagementController::class, 'index'])->name('admin.agents')->middleware('admin.can:view-agents');
        Route::get('/agents/create', [AdminAgentManagementController::class, 'create'])->name('admin.agent.create')->middleware('admin.can:view-agents');
        Route::post('/agents', [AdminAgentManagementController::class, 'store'])->name('admin.agent.store')->middleware('admin.can:manage-agents');
        Route::get('/agents/{id}/edit', [AdminAgentManagementController::class, 'edit'])->name('admin.agent.edit')->middleware('admin.can:view-agents');
        Route::put('/agents/{id}', [AdminAgentManagementController::class, 'update'])->name('admin.agent.update')->middleware('admin.can:manage-agents');
        Route::put('/agents/{id}/commission-override', [AdminAgentManagementController::class, 'setOverride'])->name('admin.agent.setOverride')->middleware('admin.can:manage-agents');
        Route::delete('/agents/{id}/commission-override', [AdminAgentManagementController::class, 'clearOverride'])->name('admin.agent.clearOverride')->middleware('admin.can:manage-agents');
        Route::get('/agents/{id}', [AdminAgentManagementController::class, 'show'])->name('admin.agent.show')->middleware('admin.can:view-agents');
        Route::put('/agents/{id}/activate', [AdminAgentManagementController::class, 'activate'])->name('admin.agent.activate')->middleware('admin.can:manage-agents');
        Route::put('/agents/{id}/suspend', [AdminAgentManagementController::class, 'suspend'])->name('admin.agent.suspend')->middleware('admin.can:manage-agents');
        Route::put('/agents/{id}/reset-credentials', [AdminAgentManagementController::class, 'resetCredentials'])->name('admin.agent.resetCredentials')->middleware('admin.can:manage-agents');

        //Agent Commission Management
        Route::get('/commission', [AdminAgentCommissionController::class, 'index'])->name('admin.commission.index')->middleware('admin.can:view-commissions');
        Route::put('/commission/base-rate', [AdminAgentCommissionController::class, 'updateBaseRate'])->name('admin.commission.updateBaseRate')->middleware('admin.can:manage-commissions');
        Route::post('/commission/preview', [AdminAgentCommissionController::class, 'previewCommission'])->name('admin.commission.preview')->middleware('admin.can:view-commissions');
        Route::post('/commission/tiers', [AdminAgentCommissionController::class, 'storeTier'])->name('admin.commission.tiers.store')->middleware('admin.can:manage-commissions');
        Route::put('/commission/tiers/{id}', [AdminAgentCommissionController::class, 'updateTier'])->name('admin.commission.tiers.update')->middleware('admin.can:manage-commissions');
        Route::delete('/commission/tiers/{id}', [AdminAgentCommissionController::class, 'destroyTier'])->name('admin.commission.tiers.destroy')->middleware('admin.can:manage-commissions');

        //Agent Approvals
        Route::get('/agent-approvals', [AdminAgentApprovalController::class, 'index'])->name('admin.agentApprovals.index')->middleware('admin.can:view-agents');
        Route::get('/agent-approvals/{id}', [AdminAgentApprovalController::class, 'show'])->name('admin.agentApprovals.show')->middleware('admin.can:view-agents');
        Route::put('/agent-approvals/{id}/approve', [AdminAgentApprovalController::class, 'approve'])->name('admin.agentApprovals.approve')->middleware('admin.can:manage-agents');
        Route::put('/agent-approvals/{id}/reject', [AdminAgentApprovalController::class, 'reject'])->name('admin.agentApprovals.reject')->middleware('admin.can:manage-agents');
        Route::get('/agent-approvals/{id}/download/means-of-id', [AdminAgentApprovalController::class, 'downloadMeansOfIdentification'])->name('admin.agentApprovals.download.meansOfId')->middleware('admin.can:manage-agents');
        Route::get('/agent-approvals/{id}/download/passport', [AdminAgentApprovalController::class, 'downloadPassportPhotograph'])->name('admin.agentApprovals.download.passport')->middleware('admin.can:manage-agents');

        Route::get('/notificationslist', [NotificationController::class, 'index'])->name('admin.notificationList');
        Route::get('/notifications', [NotificationController::class, 'getNotifications'])->name('admin.getNotifications');
        Route::get('/notifications/{id}', [NotificationController::class, 'markAsRead'])->name('admin.markAsRead');

        Route::get('/withdraw', [AdminDashboardController::class, 'withdraw'])->name('admin.withdraw');
        Route::get('/editWithdraw/{id}', [AdminDashboardController::class, 'editWithdraw'])->name('admin.editWithdraw');
        Route::put('/update/withdraw/{id}', [AdminDashboardController::class, 'updaterWithdrawStatus'])->name('admin.update-withdraw-status');

        Route::get('/transactions', [AdminTransactionController::class, 'index'])->name('admin.transactions')->middleware('admin.can:view-orders');
        Route::get('/transactions/{id}', [AdminTransactionController::class, 'viewTransaction'])->name('admin.transactions.show')->middleware('admin.can:view-orders');

        //Agent Withdrawal Queue
        Route::get('/withdrawals/agent', [AdminAgentWithdrawalController::class, 'index'])->name('admin.withdrawalQueue.index')->middleware('admin.can:view-withdrawals');
        Route::get('/withdrawals/agent/{id}', [AdminAgentWithdrawalController::class, 'show'])->name('admin.withdrawalQueue.show')->middleware('admin.can:view-withdrawals');
        Route::put('/withdrawals/agent/{id}/approve', [AdminAgentWithdrawalController::class, 'approve'])->name('admin.withdrawalQueue.approve')->middleware('admin.can:manage-withdrawals');
        Route::put('/withdrawals/agent/{id}/reject', [AdminAgentWithdrawalController::class, 'reject'])->name('admin.withdrawalQueue.reject')->middleware('admin.can:manage-withdrawals');
        Route::put('/withdrawals/agent/{id}/mark-paid', [AdminAgentWithdrawalController::class, 'markPaid'])->name('admin.withdrawalQueue.markPaid')->middleware('admin.can:manage-withdrawals');
        Route::get('/withdrawals/agent/{id}/proof', [AdminAgentWithdrawalController::class, 'downloadProof'])->name('admin.withdrawalQueue.downloadProof')->middleware('admin.can:manage-withdrawals');

        Route::prefix('transaction')->group(function () {
            Route::get('/paper-renewal', [AdminTransactionController::class, 'transactionPaperRenewal'])->name('admin.transaction.paperRenewal')->middleware('admin.can:view-orders');
            Route::get('/paper-renewal/{id}', [AdminTransactionController::class, 'showTransactionPaperRenewal'])->name('admin.transaction.showPaperRenewal')->middleware('admin.can:view-orders');

            Route::get('/vehicle-registration', [AdminTransactionController::class, 'transactionVehicleRegistration'])->name('admin.transaction.vehicleRegistration')->middleware('admin.can:view-orders');
            Route::get('/vehicle-registration/{id}', [AdminTransactionController::class, 'showTransactionVehicleRegistration'])->name('admin.transaction.showVehicleRegistration')->middleware('admin.can:view-orders');

            Route::get('/change-of-ownership', [AdminTransactionController::class, 'transactionChangeofownership'])->name('admin.transaction.changeOfOwnership')->middleware('admin.can:view-orders');
            Route::get('/change-of-ownership/{id}', [AdminTransactionController::class, 'showTransactionChangeofownership'])->name('admin.transaction.showChangeOfOwnership')->middleware('admin.can:view-orders');

            Route::get('/new-driver-license', [AdminTransactionController::class, 'transactionNewDriverlicense'])->name('admin.transactions.newDriverLicense')->middleware('admin.can:view-orders');
            Route::get('/new-driver-license/{id}', [AdminTransactionController::class, 'showTransactionNewDriverlicense'])->name('admin.transactions.showNewDriverLicense')->middleware('admin.can:view-orders');

            Route::get('/driver-license-renewal', [AdminTransactionController::class, 'transactionDriverlicenseRenewal'])->name('admin.transactions.driverLicenseRenewal')->middleware('admin.can:view-orders');
            Route::get('/driver-license-renewal/{id}', [AdminTransactionController::class, 'showTransactionDriverlicenseRenewal'])->name('admin.transactions.showDriverLicenseRenewal')->middleware('admin.can:view-orders');

            Route::get('/international-driver-license', [AdminTransactionController::class, 'transactionInternationalDriverlicense'])->name('admin.transactions.internationalDriverLicense')->middleware('admin.can:view-orders');
            Route::get('/international-driver-license/{id}', [AdminTransactionController::class, 'showTransactionInternationalDriverlicense'])->name('admin.transactions.showInternationalDriverLicense')->middleware('admin.can:view-orders');

            Route::get('/dealer-plate-number', [AdminTransactionController::class, 'transactionDealerPlateNumber'])->name('admin.transactions.dealerPlateNumber')->middleware('admin.can:view-orders');
            Route::get('/dealer-plate-number/{id}', [AdminTransactionController::class, 'showTransactionDealerPlateNumber'])->name('admin.transactions.showDealerPlateNumber')->middleware('admin.can:view-orders');

            Route::get('/other-permit', [AdminTransactionController::class, 'transactionOtherPermit'])->name('admin.transactions.otherPermit')->middleware('admin.can:view-orders');
            Route::get('/other-permit/{id}', [AdminTransactionController::class, 'showTransactionOtherPermit'])->name('admin.transactions.showOtherPermit')->middleware('admin.can:view-orders');

        });


        Route::prefix('account')->group(function () {
            Route::get('/password', [AdminDashboardController::class, 'settings'])
                ->name('admin.account.password');

            Route::post('/password', [AdminDashboardController::class, 'postSettings'])
                ->name('admin.account.password.update');
        });

        Route::prefix('settings')->group(function () {
            Route::get('/', [AdminSettingsController::class, 'index'])
                ->name('admin.settings.index')->middleware('admin.can:view-settings');

            Route::post('/general', [AdminSettingsController::class, 'updateGeneral'])
                ->name('admin.settings.updateGeneral')->middleware('admin.can:manage-settings');

            Route::post('/email', [AdminSettingsController::class, 'updateEmail'])
                ->name('admin.settings.updateEmail')->middleware('admin.can:manage-settings');

            Route::post('/sms', [AdminSettingsController::class, 'updateSms'])
                ->name('admin.settings.updateSms')->middleware('admin.can:manage-settings');

            Route::post('/whatsapp', [AdminSettingsController::class, 'updateWhatsapp'])
                ->name('admin.settings.updateWhatsapp')->middleware('admin.can:manage-settings');

            Route::post('/currency', [AdminSettingsController::class, 'updateCurrency'])
                ->name('admin.settings.updateCurrency')->middleware('admin.can:manage-settings');

            Route::post('/timezone', [AdminSettingsController::class, 'updateTimezone'])
                ->name('admin.settings.updateTimezone')->middleware('admin.can:manage-settings');

            Route::post('/maintenance/enable', [AdminSettingsController::class, 'enableMaintenance'])
                ->name('admin.settings.maintenance.enable')->middleware('admin.can:manage-settings');

            Route::post('/maintenance/disable', [AdminSettingsController::class, 'disableMaintenance'])
                ->name('admin.settings.maintenance.disable')->middleware('admin.can:manage-settings');
        });

        Route::prefix('contact-messages')->group(function () {
            Route::get('/', [AdminDashboardController::class, 'contactMessage'])
                ->name('admin.contactMessages.index')->middleware('admin.can:view-messaging');

            Route::get('/{id}', [AdminDashboardController::class, 'showContactMessage'])
                ->name('admin.contactMessages.show')->middleware('admin.can:view-messaging');
        });
        //process/history
        Route::get('/view/process/history/{id}', [AdminController::class, 'viewprocesshistory'])->name('admin.viewprocesshistory');
        Route::put('/update/process/history/{id}', [AdminController::class, 'updateProcessHistoryStatus'])->name('admin.update-processhistory-status');
        Route::get('/view/ready-for-delivery/paper/{id}', [AdminController::class, 'viewreadyfordeliveryPaper'])->name('admin.viewreadyfordeliveryPaper');

        //Document Processes
        Route::get('/pending/paper', [AdminProcessDocument::class, 'pendingPaper'])->name('admin.pendingpaper')->middleware('admin.can:view-orders');
        Route::get('/view/pending/paper/{id}', [AdminProcessDocument::class, 'viewpendingPaper'])->name('admin.viewpendingpaper')->middleware('admin.can:view-orders');
        Route::put('/update/pending/paper/{id}', [AdminProcessDocument::class, 'updatePendingPaperStatus'])->name('admin.update-pendingPaper-status')->middleware('admin.can:manage-orders');

        Route::get('/process/paper', [AdminProcessDocument::class, 'processedPaper'])->name('admin.processedpaper')->middleware('admin.can:view-orders');
        Route::get('/view/process/paper/{id}', [AdminProcessDocument::class, 'viewProcessPaper'])->name('admin.viewprocesspaper')->middleware('admin.can:view-orders');
        Route::put('/update/process/paper/{id}', [AdminProcessDocument::class, 'updateProcessPaperStatus'])->name('admin.update-processPaper-status')->middleware('admin.can:manage-orders');

        Route::get('/ready/delivery', [AdminProcessDocument::class, 'readyForDelivery'])->name('admin.readyfordelivery')->middleware('admin.can:view-orders');
        Route::get('/view/viewdeliveryin/porogress/{id}', [AdminProcessDocument::class, 'viewDeliveryinProgress'])->name('admin.viewdeliveryinprogress')->middleware('admin.can:view-orders');
        Route::put('/update/readyfordelivery/paper/{id}', [AdminProcessDocument::class, 'updateReadyforDeliveryPaperStatus'])->name('admin.update-readyfordelivery-status')->middleware('admin.can:manage-orders');

        Route::get('/delivery/inprogress', [AdminProcessDocument::class, 'deliveryinProgress'])->name('admin.deliveryinprogress')->middleware('admin.can:view-orders');
        Route::get('/delivered', [AdminProcessDocument::class, 'delivered'])->name('admin.delivered')->middleware('admin.can:view-orders');
        Route::get('/view/delivered/paper/{id}', [AdminProcessDocument::class, 'viewDeliveredPaper'])->name('admin.viewdeliveredPaper')->middleware('admin.can:view-orders');
        Route::put('/update/delivered/paper/{id}', [AdminProcessDocument::class, 'updateDeliveredPaperStatus'])->name('admin.update-delivered-status')->middleware('admin.can:manage-orders');

        Route::get('/promocode/index', [PromoCodeController::class, 'index'])->name('admin.promocode.index')->middleware('admin.can:view-promocode');
        Route::get('/promocode/create', [PromoCodeController::class, 'create'])->name('admin.promocode.create')->middleware('admin.can:view-promocode');
        Route::post('/promocode/store', [PromoCodeController::class, 'store'])->name('admin.promocode.store')->middleware('admin.can:manage-promocode');
        Route::get('/promocode/edit/{id}', [PromoCodeController::class, 'edit'])->name('admin.promocode.edit')->middleware('admin.can:view-promocode');
        Route::put('/promocode/update/{id}', [PromoCodeController::class, 'update'])->name('admin.promocode.update')->middleware('admin.can:manage-promocode');

        // ========== ORDER MANAGEMENT ==========
        Route::get('/orders', [OrderController::class, 'index'])->name('admin.orders.index')->middleware('admin.can:view-orders');
        Route::get('/orders/status/{status}', [OrderController::class, 'byStatus'])->name('admin.orders.status')->middleware('admin.can:view-orders');
        Route::get('/orders/assigned', [OrderController::class, 'assigned'])->name('admin.orders.assigned')->middleware('admin.can:view-orders');
        Route::get('/orders/{id}', [OrderController::class, 'show'])->name('admin.orders.show')->middleware('admin.can:view-orders');
        Route::put('/orders/{id}/status', [OrderController::class, 'updateStatus'])->name('admin.orders.update-status')->middleware('admin.can:manage-orders');
        Route::put('/orders/{id}/eta', [OrderController::class, 'setEta'])->name('admin.orders.set-eta')->middleware('admin.can:manage-orders');
        Route::put('/orders/{id}/notes', [OrderController::class, 'addNotes'])->name('admin.orders.add-notes')->middleware('admin.can:manage-orders');
        Route::put('/orders/{id}/assign', [OrderController::class, 'assignAdmin'])->name('admin.orders.assign')->middleware('admin.can:manage-orders');

        // ========== BROADCASTS ==========
        Route::get('/broadcasts/compose', [BroadcastController::class, 'compose'])->name('admin.broadcasts.compose')->middleware('admin.can:view-messaging');
        Route::post('/broadcasts', [BroadcastController::class, 'store'])->name('admin.broadcasts.store')->middleware('admin.can:manage-messaging');
        Route::get('/broadcasts/history', [BroadcastController::class, 'history'])->name('admin.broadcasts.history')->middleware('admin.can:view-messaging');
        Route::get('/broadcasts/{broadcast}', [BroadcastController::class, 'show'])->name('admin.broadcasts.show')->middleware('admin.can:view-messaging');

        Route::post('admin/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');

    });
});
