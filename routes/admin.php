<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Admin\ProcessDocument\AdminProcessDocument;
use App\Http\Controllers\Admin\Transaction\AdminTransactionController;
use App\Http\Controllers\Admin\PromoCodeController;
use App\Http\Controllers\Admin\BroadcastController;
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
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\AdminServicePricingController;
use App\Http\Controllers\Admin\AdminStaffController;
use App\Http\Controllers\Admin\AdminSettingsController;

Route::prefix('admin')->group(function () {
    // Public admin routes (no auth)
    Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login/amin', [AdminLoginController::class, 'login'])->name('admin.loginSubmit');
    Route::get('/forgotpassword', [AdminLoginController::class, 'forgotpassword'])->name('admin.forgotpassword');

    // Protected admin routes
    Route::middleware('auth.admin')->group(function () {
        // Super Admin only - manage admins
        Route::middleware('admin.permission:manage_admins')->group(function () {
            Route::resource('/admins', AdminController::class)->names('admin.admins');
        });

        // Dashboard
        Route::get('/', [AdminDashboardController::class, 'index'])->name('admin.index');
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

        // Admin Staff Management (Super Admin only)
        Route::middleware('super.admin')->group(function () {
            Route::get('/staff', [AdminStaffController::class, 'index'])->name('admin.staff.index');
            Route::get('/staff/create', [AdminStaffController::class, 'create'])->name('admin.staff.create');
            Route::post('/staff', [AdminStaffController::class, 'store'])->name('admin.staff.store');
            Route::get('/staff/{id}/edit', [AdminStaffController::class, 'edit'])->name('admin.staff.edit');
            Route::put('/staff/{id}', [AdminStaffController::class, 'update'])->name('admin.staff.update');
            Route::put('/staff/{id}/toggle-status', [AdminStaffController::class, 'toggleStatus'])->name('admin.staff.toggleStatus');
        });

        // ========== PROCESS TYPE ROUTES ==========
        Route::middleware('admin.can:view-orders')->group(function () {
            Route::get('/vehicle/paper-renewal', [AdminProcessTypeController::class, 'processVehiclePaperRenewal'])->name('admin.processVehiclePaperRenewal');
            Route::get('/vehicle/paper-renewal/view/{id}', [AdminProcessTypeController::class, 'viewVehiclePaperRenewal'])->name('admin.viewVehiclePaperRenewal');

            Route::get('/vehicle/registration', [AdminProcessTypeController::class, 'processNewVehicleRegistration'])->name('admin.processNewVehicleRegistration');
            Route::get('/vehicle/registration/view/{id}', [AdminProcessTypeController::class, 'viewNewVehicleRegistration'])->name('admin.viewNewVehicleRegistration');

            Route::get('/ownership/change', [AdminProcessTypeController::class, 'processChangeOfOwnership'])->name('admin.processChangeOfOwnership');
            Route::get('/ownership/change/view/{id}', [AdminProcessTypeController::class, 'viewChangeOfOwnership'])->name('admin.viewChangeOfOwnership');

            Route::get('/new/driver/license', [AdminProcessTypeController::class, 'processNewDriverLicense'])->name('admin.processNewDriverlicense');
            Route::get('/newdriver/license/view/{id}', [AdminProcessTypeController::class, 'viewNewDriverLicense'])->name('admin.viewNewDriverLicense');

            Route::get('/newdriver/license-renewal', [AdminProcessTypeController::class, 'processnewDriverlicenseRenewal'])->name('admin.processNewDriverLicenseRenewal');
            Route::get('/newdriver/license-renewal/view/{id}', [AdminProcessTypeController::class, 'viewnewdriverlicenseRenewal'])->name('admin.viewNewDriverLicenseRenewal');

            Route::get('/international-driver-license', [AdminProcessTypeController::class, 'processInternationalDriverLicense'])->name('admin.processInternationalDriverLicense');
            Route::get('/international-driver-license/view/{id}', [AdminProcessTypeController::class, 'viewInternationalDriverLicense'])->name('admin.viewInternationalDriverlicense');

            Route::get('/dealer/plateNumber', [AdminProcessTypeController::class, 'processDealerPlateNumber'])->name('admin.processDealerPlateNumber');
            Route::get('/viewplateNumber/{id}', [AdminProcessTypeController::class, 'viewDealerPlateNumber'])->name('admin.viewplateNumber');

            Route::get('/otherPermit', [AdminProcessTypeController::class, 'processOtherPermit'])->name('admin.processOtherPermit');
            Route::get('/viewotherPermit/{id}', [AdminProcessTypeController::class, 'viewOtherPermit'])->name('admin.viewOtherPermit');
        });

        // Download routes (with manage permission)
        Route::middleware('admin.can:manage-orders')->group(function () {
            Route::get('/ownership/license-paper/download/{id}', [AdminProcessTypeController::class, 'downloadChangeOfOwnershipLicensePaper'])->name('changeOfOwnershipLicensePaper.download');
            Route::get('/ownership/proof/download/{id}', [AdminProcessTypeController::class, 'downloadChangeOfOwnershipProof'])->name('changeOfOwnershipProof.download');
            Route::get('/ownership/agreement/download/{id}', [AdminProcessTypeController::class, 'downloadChangeOfOwnershipAgreement'])->name('changeOfOwnershipAgreement.download');
            Route::get('/ownership/means-of-id/download/{id}', [AdminProcessTypeController::class, 'downloadChangeOfOwnershipMeansOfId'])->name('changeOfOwnershipMeansOfId.download');
            
            Route::get('/newdriver-licenseRenewal/download/{id}', [AdminProcessTypeController::class, 'downloadnewDriverLicensedocument'])->name('newDriverlicensedocument.download');
            Route::get('/driver/license-renewal/download/{id}', [AdminProcessTypeController::class, 'downloadnewDriverlicenseRenewaldocument'])->name('newDriverlicenseRenewaldocument.download');
            Route::get('/international-driver-license-passport/download/{id}', [AdminProcessTypeController::class, 'downloadInternationalDriverLicensePassPort'])->name('internationalDriverlicensepassport.download');
            
            Route::get('/download/plateNumberpassportpassport/{id}', [AdminProcessTypeController::class, 'downloadPlateNumberPassPort'])->name('plateNumberpassport.download');
            Route::get('/download/plateNumbercertificate/{id}', [AdminProcessTypeController::class, 'downloadPlateNumberCertificate'])->name('plateNumbercertificate.download');
            Route::get('/download/plateNumbercompanyLetterhead/{id}', [AdminProcessTypeController::class, 'downloadPlateNumberCompanyLetterhead'])->name('plateNumbercompanyLetterhead.download');
            
            Route::get('/download/otherpermitpassport/{id}', [AdminProcessTypeController::class, 'downloadotherpermitpassport'])->name('otherpermitpassport.download');
            Route::get('/download/otherpermitmeansofID/{id}', [AdminProcessTypeController::class, 'downloadotherpermitmeansofID'])->name('otherpermitmeansofID.download');
            Route::get('/download/otherpermitpictureoftheVehicleLicense/{id}', [AdminProcessTypeController::class, 'downloadotherpermitpictureoftheVehicleLicense'])->name('otherpermitpictureoftheVehicleLicense.download');
            Route::get('/download/otherpermitaffidavit/{id}', [AdminProcessTypeController::class, 'downloadotherpermitaffidavit'])->name('otherpermitaffidavit.download');
            Route::get('/download/otherpermitpolicereport/{id}', [AdminProcessTypeController::class, 'downloadotherpermitpolicereport'])->name('otherpermitpolicereport.download');
        });

        Route::put('/update/deliveryinprogress/paper/{id}', [AdminDashboardController::class, 'updatedeliveryinprogressStatus'])->name('admin.update-deliveryinprogress-status')->middleware('admin.can:manage-orders');

        // ========== VEHICLE ROUTES ==========
        Route::middleware('admin.can:view-vehicles')->group(function () {
            // Vehicle Renewals
            Route::get('/vehicle-renewals', [AdminAddedVehicleController::class, 'showAddVehicleRenewal'])->name('admin.vehicle.renewals');
            Route::get('/vehicle-renewals/{id}', [AdminAddedVehicleController::class, 'showVehicleRenewalDetails'])->name('admin.vehicle.renewals.view');
            Route::get('/vehicle-renewals/delete/{id}', [AdminAddedVehicleController::class, 'showVehicleRenewalDelete'])->name('admin.vehicle.renewals.delete');
            Route::put('/vehicle-renewals/{id}', [AdminAddedVehicleController::class, 'updateVehicleRenewal'])->name('admin.vehicle.renewals.update');

            // Vehicle Registrations
            Route::get('/vehicle-registrations/new', [AdminAddedVehicleController::class, 'showAddNewVehicleRegistration'])->name('admin.vehicle.registrations.new');
            Route::get('/vehicle-registrations/{id}', [AdminAddedVehicleController::class, 'showAddNewVehicleRegistrationDetails'])->name('admin.vehicle.registrations.view');
            Route::put('/vehicle-registrations/{id}', [AdminAddedVehicleController::class, 'updateVehicleRegistration'])->name('admin.vehicle.registration.update');

            // Change of Ownership
            Route::get('/change-of-ownership', [AdminAddedVehicleController::class, 'showAddChangeOfOwnership'])->name('admin.changeOfOwnership');
            Route::get('/change-of-ownership/{id}', [AdminAddedVehicleController::class, 'viewAddChangeOfOwnership'])->name('admin.changeOfOwnership.view');
            Route::put('/change-of-ownership/{id}', [AdminAddedVehicleController::class, 'updateChangeOfOwnership'])->name('admin.vehicle.changeOfOwnership.update');

            // Add Vehicle Forms
            Route::get('/vehicle-renewal/add', [AdminAddVehicleController::class, 'addVehicleRenewal'])->name('admin.vehicle.renewal.add');
            Route::post('/vehicle-renewal', [AdminAddVehicleController::class, 'storeVehicleRenewal'])->name('admin.vehicle.renewal.store');

            Route::get('/vehicle-registration/new', [AdminAddVehicleController::class, 'addVehicleNewRegistration'])->name('admin.vehicle.registration.new');
            Route::post('/vehicle-registration', [AdminAddVehicleController::class, 'storeVehicleNewRegistration'])->name('admin.vehicle.registration.store');

            Route::get('/vehicle-change-of-ownership/add', [AdminAddVehicleController::class, 'addVehicleChangeOfOwnership'])->name('admin.vehicle.changeOfOwnership.add');
            Route::post('/vehicle-change-of-ownership', [AdminAddVehicleController::class, 'storeVehicleChangeOfOwnership'])->name('admin.vehicle.changeOfOwnership.store');
        });

        // Vehicle download routes
        Route::middleware('admin.can:manage-vehicles')->group(function () {
            // Renewal downloads
            Route::get('/vehicle-license-papers/download/{id}', [AdminAddedVehicleController::class, 'downloadVehicleLicensePapers'])->name('vehicle.license.papers.download');
            Route::get('/vehicle-insurance-papers/download/{id}', [AdminAddedVehicleController::class, 'downloadVehicleInsurancePapers'])->name('vehicle.insurance.papers.download');
            Route::get('/vehicle-roadworthiness/download/{id}', [AdminAddedVehicleController::class, 'downloadVehicleRoadworthiness'])->name('vehicle.roadworthiness.download');
            Route::get('/vehicle-hackney-permit/download/{id}', [AdminAddedVehicleController::class, 'downloadVehicleHackneyPermit'])->name('vehicle.hackney.permit.download');
            Route::get('/vehicle-state-carriage-permit/download/{id}', [AdminAddedVehicleController::class, 'downloadVehicleStateCarriagePermit'])->name('vehicle.state.carriage.permit.download');
            Route::get('/vehicle-local-government-permit/download/{id}', [AdminAddedVehicleController::class, 'downloadVehicleLocalGovernmentPermit'])->name('vehicle.local.government.permit.download');
            Route::get('/vehicle-midyear-permit/download/{id}', [AdminAddedVehicleController::class, 'downloadVehicleMidyearPermit'])->name('vehicle.midyear.permit.download');
            Route::get('/vehicle-means-of-id/download/{id}', [AdminAddedVehicleController::class, 'downloadVehicleMeansOfId'])->name('vehicle.means.of.id.download');

            // Registration downloads
            Route::get('/vehicle-registrations/download/custom-paper/{id}', [AdminAddedVehicleController::class, 'downloadVehicleRegistrationCustomPaper'])->name('vehicle.registration.custom.paper.download');
            Route::get('/vehicle-registrations/download/means-of-id/{id}', [AdminAddedVehicleController::class, 'downloadVehicleRegistrationMeansOfId'])->name('vehicle.registration.means.of.id.download');

            // Change of ownership downloads
            Route::get('/change-of-ownership/download/vehicle-license/{id}', [AdminAddedVehicleController::class, 'downloadChangeOfOwnershipVehicleLicense'])->name('changeOfOwnership.vehicle.license.download');
            Route::get('/change-of-ownership/download/proof-of-ownership/{id}', [AdminAddedVehicleController::class, 'downloadChangeOfOwnershipProofOfOwnership'])->name('changeOfOwnership.proof.download');
            Route::get('/change-of-ownership/download/agreements/{id}', [AdminAddedVehicleController::class, 'downloadChangeOfOwnershipAgreements'])->name('changeOfOwnership.agreements.download');
            Route::get('/change-of-ownership/download/means-of-id/{id}', [AdminAddedVehicleController::class, 'downloadChangeOfOwnershipMeansOfID'])->name('changeOfOwnership.means.of.id.download');
        });

        // ========== PRICING ROUTES (Super Admin only) ==========
        Route::middleware('admin.permission:set_service_pricing')->group(function () {
            // Vehicle Types
            Route::get('/vehicle-types', [AdminVehiclePriceController::class, 'indexVehicleTypes'])->name('admin.vehicle.types');
            Route::get('/vehicle-types/add', [AdminVehiclePriceController::class, 'createVehicleType'])->name('admin.vehicle.type.add');
            Route::post('/vehicle-types/store', [AdminVehiclePriceController::class, 'storeVehicleType'])->name('admin.vehicle.type.store');
            Route::get('/vehicle-types/{id}/edit', [AdminVehiclePriceController::class, 'editVehicleType'])->name('admin.vehicle.type.edit');
            Route::post('/vehicle-types/update', [AdminVehiclePriceController::class, 'updateVehicleType'])->name('admin.vehicle.type.update');
            
            // States
            Route::get('/states', [AdminVehiclePriceController::class, 'indexStates'])->name('admin.states');
            Route::get('/states/create', [AdminVehiclePriceController::class, 'createState'])->name('admin.state.create');
            Route::post('/states/store', [AdminVehiclePriceController::class, 'storeState'])->name('admin.state.store');
            Route::post('/states/update', [AdminVehiclePriceController::class, 'updateState'])->name('admin.state.update');
            Route::get('/states/{id}', [AdminVehiclePriceController::class, 'showStateEdit'])->name('admin.state.details');
            
            // Vehicle Renewal Price
            Route::get('/vehicle-renewal-price', [AdminVehicleRenewalPriceController::class, 'index'])->name('admin.vehicleRenewalPrice.index');
            Route::get('/vehicle-renewal-price/create', [AdminVehicleRenewalPriceController::class, 'create'])->name('admin.vehicleRenewalPrice.create');
            Route::post('/vehicle-renewal-price', [AdminVehicleRenewalPriceController::class, 'store'])->name('admin.vehicleRenewalPrice.store');
            Route::get('/vehicle-renewal-price/{id}/edit', [AdminVehicleRenewalPriceController::class, 'edit'])->name('admin.vehicleRenewalPrice.edit');
            Route::put('/vehicle-renewal-price/{id}', [AdminVehicleRenewalPriceController::class, 'update'])->name('admin.vehicleRenewalPrice.update');
            Route::get('/vehicle-renewal-price/{id}', [AdminVehicleRenewalPriceController::class, 'destroy'])->name('admin.vehicleRenewalPrice.destroy');

            // Vehicle Registration Price
            Route::get('/vehicle-registration-price', [AdminVehicleRegistrationPriceController::class, 'index'])->name('admin.vehicleRegistrationPrice.index');
            Route::get('/vehicle-registration-price/create', [AdminVehicleRegistrationPriceController::class, 'create'])->name('admin.vehicleRegistrationPrice.create');
            Route::post('/vehicle-registration-price', [AdminVehicleRegistrationPriceController::class, 'store'])->name('admin.vehicleRegistrationPrice.store');
            Route::get('/vehicle-registration-price/{id}/edit', [AdminVehicleRegistrationPriceController::class, 'edit'])->name('admin.vehicleRegistrationPrice.edit');
            Route::put('/vehicle-registration-price/{id}', [AdminVehicleRegistrationPriceController::class, 'update'])->name('admin.vehicleRegistrationPrice.update');
            Route::get('/vehicle-registration-price/{id}', [AdminVehicleRegistrationPriceController::class, 'destroy'])->name('admin.vehicleRegistrationPrice.destroy');

            // Vehicle Change of Ownership Price
            Route::get('/vehicle-change-of-ownership-price', [VehicleChangeOfOwnershipPriceController::class, 'index'])->name('admin.vehicleChangeofOwnershipPrice.index');
            Route::get('/vehicle-change-of-ownership-price/create', [VehicleChangeOfOwnershipPriceController::class, 'create'])->name('admin.vehicleChangeofOwnershipPrice.create');
            Route::post('/vehicle-change-of-ownership-price', [VehicleChangeOfOwnershipPriceController::class, 'store'])->name('admin.vehicleChangeofOwnershipPrice.store');
            Route::get('/vehicle-change-of-ownership-price/{id}/edit', [VehicleChangeOfOwnershipPriceController::class, 'edit'])->name('admin.vehicleChangeofOwnershipPrice.edit');
            Route::put('/vehicle-change-of-ownership-price/{id}', [VehicleChangeOfOwnershipPriceController::class, 'update'])->name('admin.vehicleChangeofOwnershipPrice.update');
            Route::get('/vehicle-change-of-ownership-price/{id}', [VehicleChangeOfOwnershipPriceController::class, 'destroy'])->name('admin.vehicleChangeofOwnershipPrice.destroy');

            // Driver License Price
            Route::get('/new-driver-license', [DriverLicenseController::class, 'index'])->name('admin.newDriverLicense.index');
            Route::get('/new-driver-license/create', [DriverLicenseController::class, 'create'])->name('admin.newDriverLicense.create');
            Route::post('/new-driver-license', [DriverLicenseController::class, 'store'])->name('admin.newDriverLicense.store');
            Route::get('/new-driver-license/{id}/edit', [DriverLicenseController::class, 'edit'])->name('admin.newDriverLicense.edit');
            Route::put('/new-driver-license/{id}', [DriverLicenseController::class, 'update'])->name('admin.newDriverLicense.update');
            Route::get('/new-driver-license/{id}', [DriverLicenseController::class, 'destroy'])->name('admin.newDriverLicense.destroy');

            // Driver License Renewal Price
            Route::get('/admin/driver-license-renewal', [DriverLicenseRenewalController::class, 'index'])->name('admin.driverLicenseRenewal.index');
            Route::get('/admin/driver-license-renewal/create', [DriverLicenseRenewalController::class, 'create'])->name('admin.driverLicenseRenewal.create');
            Route::post('/admin/driver-license-renewal', [DriverLicenseRenewalController::class, 'store'])->name('admin.driverLicenseRenewal.store');
            Route::get('/admin/driver-license-renewal/{id}/edit', [DriverLicenseRenewalController::class, 'edit'])->name('admin.driverLicenseRenewal.edit');
            Route::put('/admin/driver-license-renewal/{id}', [DriverLicenseRenewalController::class, 'update'])->name('admin.driverLicenseRenewal.update');
            Route::get('/admin/driver-license-renewal/{id}', [DriverLicenseRenewalController::class, 'destroy'])->name('admin.driverLicenseRenewal.destroy');

            // International Driver License Price
            Route::get('/international-driver-license/price', [InternationalDriverLicensePriceController::class, 'index'])->name('admin.intDriverLicense.index');
            Route::get('/international-driver-license/price/create', [InternationalDriverLicensePriceController::class, 'create'])->name('admin.intDriverLicense.create');
            Route::post('/international-driver-license/price', [InternationalDriverLicensePriceController::class, 'store'])->name('admin.intDriverLicense.store');
            Route::get('/international-driver-license/price/{id}/edit', [InternationalDriverLicensePriceController::class, 'edit'])->name('admin.intDriverLicense.edit');
            Route::put('/international-driver-license/price/{id}', [InternationalDriverLicensePriceController::class, 'update'])->name('admin.intDriverLicense.update');
            Route::get('/international-driver-license/price/{id}', [InternationalDriverLicensePriceController::class, 'destroy'])->name('admin.intDriverLicense.destroy');

            // Dealer Plate Number Price
            Route::get('/dealers-plate-number', [DealersPlateNumberPriceController::class, 'index'])->name('admin.dealersPlateNumber.index');
            Route::get('/dealers-plate-number/create', [DealersPlateNumberPriceController::class, 'create'])->name('admin.dealersPlateNumber.create');
            Route::post('/dealers-plate-number', [DealersPlateNumberPriceController::class, 'store'])->name('admin.dealersPlateNumber.store');
            Route::get('/dealers-plate-number/{id}/edit', [DealersPlateNumberPriceController::class, 'edit'])->name('admin.dealersPlateNumber.edit');
            Route::put('/dealers-plate-number/{id}', [DealersPlateNumberPriceController::class, 'update'])->name('admin.dealersPlateNumber.update');
            Route::get('/dealers-plate-number/{id}', [DealersPlateNumberPriceController::class, 'destroy'])->name('admin.dealersPlateNumber.destroy');

            // Other Permit Price
            Route::get('/other-permit', [OtherPermitPriceController::class, 'index'])->name('admin.otherPermit.index');
            Route::get('/other-permit/create', [OtherPermitPriceController::class, 'create'])->name('admin.otherPermit.create');
            Route::post('/other-permit', [OtherPermitPriceController::class, 'store'])->name('admin.otherPermit.store');
            Route::get('/other-permit/{id}/edit', [OtherPermitPriceController::class, 'edit'])->name('admin.otherPermit.edit');
            Route::put('/other-permit/{id}', [OtherPermitPriceController::class, 'update'])->name('admin.otherPermit.update');
            Route::get('/other-permit/{id}', [OtherPermitPriceController::class, 'destroy'])->name('admin.otherPermit.destroy');
            Route::post('/admin/other-permit-type', [OtherPermitPriceController::class, 'storeType'])->name('admin.otherPermit.storeType');
        });

        // ========== FAQ ROUTES ==========
        Route::prefix('faq/questions')->group(function () {
            Route::get('/', [AdminDashboardController::class, 'showFAQ'])->name('admin.faq.index')->middleware('admin.can:view-faq');
            Route::get('/create', [AdminDashboardController::class, 'addFaqQuestion'])->name('admin.faq.create')->middleware('admin.can:view-faq');
            Route::post('/add', [AdminDashboardController::class, 'addFaqQuestionPost'])->name('admin.faq.add')->middleware('admin.can:manage-faq');
            Route::get('/{id}/edit', [AdminDashboardController::class, 'editFaqQuestion'])->name('admin.faq.edit')->middleware('admin.can:view-faq');
            Route::put('/{id}', [AdminDashboardController::class, 'updateFaqQuestion'])->name('admin.faq.update')->middleware('admin.can:manage-faq');
        });

        // ========== USERS ROUTES ==========
        Route::get('/users', [AdminDashboardController::class, 'getUsers'])->name('admin.users')->middleware('admin.can:view-users');
        Route::get('/users/{id}/edit', [AdminDashboardController::class, 'editUser'])->name('admin.users.edit')->middleware('admin.can:view-users');
        Route::put('/users/{id}/status', [AdminDashboardController::class, 'updateUserStatus'])->name('admin.users.updateStatus')->middleware('admin.can:manage-users');

        // ========== AGENT ROUTES ==========
        Route::middleware('admin.can:view-agents')->group(function () {
            Route::get('/agents', [AdminAgentManagementController::class, 'index'])->name('admin.agents');
            Route::get('/agents/create', [AdminAgentManagementController::class, 'create'])->name('admin.agent.create');
            Route::get('/agents/{id}/edit', [AdminAgentManagementController::class, 'edit'])->name('admin.agent.edit');
            Route::get('/agents/{id}', [AdminAgentManagementController::class, 'show'])->name('admin.agent.show');
        });

        Route::middleware('admin.can:manage-agents')->group(function () {
            Route::post('/agents', [AdminAgentManagementController::class, 'store'])->name('admin.agent.store');
            Route::put('/agents/{id}', [AdminAgentManagementController::class, 'update'])->name('admin.agent.update');
            Route::put('/agents/{id}/commission-override', [AdminAgentManagementController::class, 'setOverride'])->name('admin.agent.setOverride');
            Route::delete('/agents/{id}/commission-override', [AdminAgentManagementController::class, 'clearOverride'])->name('admin.agent.clearOverride');
            Route::put('/agents/{id}/activate', [AdminAgentManagementController::class, 'activate'])->name('admin.agent.activate');
            Route::put('/agents/{id}/suspend', [AdminAgentManagementController::class, 'suspend'])->name('admin.agent.suspend');
            Route::put('/agents/{id}/reset-credentials', [AdminAgentManagementController::class, 'resetCredentials'])->name('admin.agent.resetCredentials');
        });

        // Agent Approvals
        Route::middleware('admin.can:view-agents')->group(function () {
            Route::get('/agent-approvals', [AdminAgentApprovalController::class, 'index'])->name('admin.agentApprovals.index');
            Route::get('/agent-approvals/{id}', [AdminAgentApprovalController::class, 'show'])->name('admin.agentApprovals.show');
        });

        Route::middleware('admin.can:manage-agents')->group(function () {
            Route::put('/agent-approvals/{id}/approve', [AdminAgentApprovalController::class, 'approve'])->name('admin.agentApprovals.approve');
            Route::put('/agent-approvals/{id}/reject', [AdminAgentApprovalController::class, 'reject'])->name('admin.agentApprovals.reject');
            Route::get('/agent-approvals/{id}/download/means-of-id', [AdminAgentApprovalController::class, 'downloadMeansOfIdentification'])->name('admin.agentApprovals.download.meansOfId');
            Route::get('/agent-approvals/{id}/download/passport', [AdminAgentApprovalController::class, 'downloadPassportPhotograph'])->name('admin.agentApprovals.download.passport');
        });

        // ========== COMMISSION ROUTES ==========
        Route::get('/commission', [AdminAgentCommissionController::class, 'index'])->name('admin.commission.index')->middleware('admin.can:view-commissions');
        Route::middleware('admin.can:manage-commissions')->group(function () {
            Route::put('/commission/base-rate', [AdminAgentCommissionController::class, 'updateBaseRate'])->name('admin.commission.updateBaseRate');
            Route::post('/commission/preview', [AdminAgentCommissionController::class, 'previewCommission'])->name('admin.commission.preview');
            Route::post('/commission/tiers', [AdminAgentCommissionController::class, 'storeTier'])->name('admin.commission.tiers.store');
            Route::put('/commission/tiers/{id}', [AdminAgentCommissionController::class, 'updateTier'])->name('admin.commission.tiers.update');
            Route::delete('/commission/tiers/{id}', [AdminAgentCommissionController::class, 'destroyTier'])->name('admin.commission.tiers.destroy');
        });

        // ========== NOTIFICATIONS ==========
        Route::get('/notificationslist', [NotificationController::class, 'index'])->name('admin.notificationList');
        Route::get('/notifications', [NotificationController::class, 'getNotifications'])->name('admin.getNotifications');
        Route::get('/notifications/{id}', [NotificationController::class, 'markAsRead'])->name('admin.markAsRead');

        // ========== FINANCIAL ROUTES (Super Admin only) ==========
        Route::middleware('admin.permission:view_financial_reports')->group(function () {
            Route::get('/withdraw', [AdminDashboardController::class, 'withdraw'])->name('admin.withdraw');
            Route::get('/editWithdraw/{id}', [AdminDashboardController::class, 'editWithdraw'])->name('admin.editWithdraw');
            Route::put('/update/withdraw/{id}', [AdminDashboardController::class, 'updaterWithdrawStatus'])->name('admin.update-withdraw-status');

            Route::get('/transactions', [AdminTransactionController::class, 'index'])->name('admin.transactions')->middleware('admin.can:view-orders');
            Route::get('/transactions/{id}', [AdminTransactionController::class, 'viewTransaction'])->name('admin.transactions.show')->middleware('admin.can:view-orders');

            // Agent Withdrawal Queue
            Route::get('/withdrawals/agent', [AdminAgentWithdrawalController::class, 'index'])->name('admin.withdrawalQueue.index')->middleware('admin.can:view-withdrawals');
            Route::get('/withdrawals/agent/{id}', [AdminAgentWithdrawalController::class, 'show'])->name('admin.withdrawalQueue.show')->middleware('admin.can:view-withdrawals');
            Route::put('/withdrawals/agent/{id}/approve', [AdminAgentWithdrawalController::class, 'approve'])->name('admin.withdrawalQueue.approve')->middleware('admin.can:manage-withdrawals');
            Route::put('/withdrawals/agent/{id}/reject', [AdminAgentWithdrawalController::class, 'reject'])->name('admin.withdrawalQueue.reject')->middleware('admin.can:manage-withdrawals');
            Route::put('/withdrawals/agent/{id}/mark-paid', [AdminAgentWithdrawalController::class, 'markPaid'])->name('admin.withdrawalQueue.markPaid')->middleware('admin.can:manage-withdrawals');
            Route::get('/withdrawals/agent/{id}/proof', [AdminAgentWithdrawalController::class, 'downloadProof'])->name('admin.withdrawalQueue.downloadProof')->middleware('admin.can:manage-withdrawals');
        });

        // ========== TRANSACTION ROUTES ==========
        Route::prefix('transaction')->middleware('admin.can:view-orders')->group(function () {
            Route::get('/agent', [AdminTransactionController::class, 'transactionAgentWithdraw'])->name('admin.transactions.agent');
           
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

        // ========== ACCOUNT ROUTES ==========
        Route::prefix('account')->group(function () {
            Route::get('/password', [AdminDashboardController::class, 'settings'])->name('admin.account.password');
            Route::post('/password', [AdminDashboardController::class, 'postSettings'])->name('admin.account.password.update');
        });

        // ========== SETTINGS ROUTES ==========
        Route::prefix('settings')->middleware('admin.can:view-settings')->group(function () {
            Route::get('/', [AdminSettingsController::class, 'index'])->name('admin.settings.index');

            Route::middleware('admin.can:manage-settings')->group(function () {
                Route::post('/general', [AdminSettingsController::class, 'updateGeneral'])->name('admin.settings.updateGeneral');
                Route::post('/email', [AdminSettingsController::class, 'updateEmail'])->name('admin.settings.updateEmail');
                Route::post('/sms', [AdminSettingsController::class, 'updateSms'])->name('admin.settings.updateSms');
                Route::post('/whatsapp', [AdminSettingsController::class, 'updateWhatsapp'])->name('admin.settings.updateWhatsapp');
                Route::post('/currency', [AdminSettingsController::class, 'updateCurrency'])->name('admin.settings.updateCurrency');
                Route::post('/timezone', [AdminSettingsController::class, 'updateTimezone'])->name('admin.settings.updateTimezone');
                Route::post('/maintenance/enable', [AdminSettingsController::class, 'enableMaintenance'])->name('admin.settings.maintenance.enable');
                Route::post('/maintenance/disable', [AdminSettingsController::class, 'disableMaintenance'])->name('admin.settings.maintenance.disable');
            });
        });

        // ========== CONTACT MESSAGES ==========
        Route::prefix('contact-messages')->middleware('admin.can:view-messaging')->group(function () {
            Route::get('/', [AdminDashboardController::class, 'contactMessage'])->name('admin.contactMessages.index');
            Route::get('/{id}', [AdminDashboardController::class, 'showContactMessage'])->name('admin.contactMessages.show');
        });

        // ========== PROCESS/HISTORY ROUTES ==========
        Route::get('/view/process/history/{id}', [AdminController::class, 'viewprocesshistory'])->name('admin.viewprocesshistory');
        Route::put('/update/process/history/{id}', [AdminController::class, 'updateProcessHistoryStatus'])->name('admin.update-processhistory-status');
        Route::get('/view/ready-for-delivery/paper/{id}', [AdminController::class, 'viewreadyfordeliveryPaper'])->name('admin.viewreadyfordeliveryPaper');

        // ========== DOCUMENT PROCESS ROUTES ==========
        Route::middleware('admin.can:view-orders')->group(function () {
            Route::get('/pending/paper', [AdminProcessDocument::class, 'pendingPaper'])->name('admin.pendingpaper');
            Route::get('/view/pending/paper/{id}', [AdminProcessDocument::class, 'viewpendingPaper'])->name('admin.viewpendingpaper');

            Route::get('/process/paper', [AdminProcessDocument::class, 'processedPaper'])->name('admin.processedpaper');
            Route::get('/view/process/paper/{id}', [AdminProcessDocument::class, 'viewProcessPaper'])->name('admin.viewprocesspaper');

            Route::get('/ready/delivery', [AdminProcessDocument::class, 'readyForDelivery'])->name('admin.readyfordelivery');
            Route::get('/view/viewdeliveryin/porogress/{id}', [AdminProcessDocument::class, 'viewDeliveryinProgress'])->name('admin.viewdeliveryinprogress');

            Route::get('/delivery/inprogress', [AdminProcessDocument::class, 'deliveryinProgress'])->name('admin.deliveryinprogress');
            Route::get('/delivered', [AdminProcessDocument::class, 'delivered'])->name('admin.delivered');
            Route::get('/view/delivered/paper/{id}', [AdminProcessDocument::class, 'viewDeliveredPaper'])->name('admin.viewdeliveredPaper');
        });

        Route::middleware('admin.can:manage-orders')->group(function () {
            Route::put('/update/pending/paper/{id}', [AdminProcessDocument::class, 'updatePendingPaperStatus'])->name('admin.update-pendingPaper-status');
            Route::put('/update/process/paper/{id}', [AdminProcessDocument::class, 'updateProcessPaperStatus'])->name('admin.update-processPaper-status');
            Route::put('/update/readyfordelivery/paper/{id}', [AdminProcessDocument::class, 'updateReadyforDeliveryPaperStatus'])->name('admin.update-readyfordelivery-status');
            Route::put('/update/delivered/paper/{id}', [AdminProcessDocument::class, 'updateDeliveredPaperStatus'])->name('admin.update-delivered-status');
        });

        // ========== PROMO CODE ROUTES ==========
        Route::middleware('admin.can:view-promocode')->group(function () {
            Route::get('/promocode/index', [PromoCodeController::class, 'index'])->name('admin.promocode.index');
            Route::get('/promocode/create', [PromoCodeController::class, 'create'])->name('admin.promocode.create');
            Route::get('/promocode/edit/{id}', [PromoCodeController::class, 'edit'])->name('admin.promocode.edit');
        });

        Route::middleware('admin.can:manage-promocode')->group(function () {
            Route::post('/promocode/store', [PromoCodeController::class, 'store'])->name('admin.promocode.store');
            Route::put('/promocode/update/{id}', [PromoCodeController::class, 'update'])->name('admin.promocode.update');
        });

        // ========== ORDER ROUTES (Fixed - NO nested admin prefix) ==========
        Route::middleware('auth:admin')->group(function () {
            Route::get('/orders', [OrderController::class, 'index'])->name('admin.orders.index');
            Route::get('/orders/status/{status}', [OrderController::class, 'byStatus'])->name('admin.orders.status');
            Route::get('/orders/assigned', [OrderController::class, 'assigned'])->name('admin.orders.assigned');
            Route::get('/orders/{id}', [OrderController::class, 'show'])->name('admin.orders.show');
            Route::put('/orders/{id}/status', [OrderController::class, 'updateStatus'])->name('admin.orders.update-status');
            Route::put('/orders/{id}/eta', [OrderController::class, 'setEta'])->name('admin.orders.set-eta');
            Route::put('/orders/{id}/notes', [OrderController::class, 'addNotes'])->name('admin.orders.add-notes');
            Route::put('/orders/{id}/assign', [OrderController::class, 'assignAdmin'])->name('admin.orders.assign');
        });

        // ========== BROADCAST ROUTES (Fixed - NO nested admin prefix) ==========
        Route::middleware('auth:admin')->group(function () {
            Route::get('/broadcasts/compose', [BroadcastController::class, 'compose'])->name('admin.broadcasts.compose');
            Route::post('/broadcasts', [BroadcastController::class, 'store'])->name('admin.broadcasts.store');
            Route::get('/broadcasts/history', [BroadcastController::class, 'history'])->name('admin.broadcasts.history');
            Route::get('/broadcasts/{broadcast}', [BroadcastController::class, 'show'])->name('admin.broadcasts.show');
        });

        // ========== LOGOUT ==========
        Route::post('admin/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');
    });
});