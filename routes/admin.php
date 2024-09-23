<?php 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Admin\AdminDashboardController;


Route::get('admin/forgotpassword',  [AdminLoginController::class, 'forgotpassword'])->name('admin-forgotpassword');
// Route::get('/login/admin',  [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
Route::get('/admin',  [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('/login/amin',  [AdminLoginController::class, 'login'])->name('admin.login');
Route::get('/forgotpassword/admin',  [AdminLoginController::class, 'forgotpassword'])->name('admin.forgotpassword');

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    //Processe Type
    Route::get('/vechicle/paperRenewal', [AdminDashboardController::class, 'processvechiclePaperRenewal'])->name('admin.processvechiclePaperRenewal');
    Route::get('/viewvehiclepaperRenewal/{id}', [AdminDashboardController::class, 'viewvehiclepaperRenewal'])->name('admin.viewvehiclepaperRenewal');

    Route::get('/vechicle/Registration', [AdminDashboardController::class, 'processnewvehicleRegistration'])->name('admin.processnewvehicleRegistration');
    Route::get('/viewNewvehicleRegistration/{id}', [AdminDashboardController::class, 'viewNewvehicleRegistration'])->name('admin.viewNewvehicleRegistration');

    Route::get('/processchangeofownership', [AdminDashboardController::class, 'processchangeofownership'])->name('admin.processchangeofownership');
    Route::get('/vviewchangeofownership/{id}', [AdminDashboardController::class, 'vviewchangeofownership'])->name('admin.vviewchangeofownership');
    Route::get('/download/changeofownershiplicensepaper/{id}', [AdminDashboardController::class, 'downloadchangeofownershiplicensepaper'])->name('changeofownershiplicensepaper.download');
    Route::get('/download/changeofownershipproof/{id}', [AdminDashboardController::class, 'downloadchangeofownershipproof'])->name('changeofownershipproof.download');
    Route::get('/download/changeofownershipagreement/{id}', [AdminDashboardController::class, 'downloadchangeofownershipagreement'])->name('changeofownershipagreement.download');
    Route::get('/download/changeofownershipmeansofid/{id}', [AdminDashboardController::class, 'downloadchangeofownershipmeansofid'])->name('changeofownershipmeansofid.download');
   
    Route::get('/newdriver/license', [AdminDashboardController::class, 'processnewDriverlicense'])->name('admin.processnewDriverlicense');
    Route::get('/viewnewdriver/license/{id}', [AdminDashboardController::class, 'viewnewdriverlicense'])->name('admin.viewnewdriverlicense');
    Route::get('/download/newDriverlicenseRenewaldocument/{id}', [AdminDashboardController::class, 'downloadnewDriverlicenseRenewaldocument'])->name('newDriverlicenseRenewaldocument.download');

    Route::get('/newdriverlicenseRenewal', [AdminDashboardController::class, 'processnewDriverlicenseRenewal'])->name('admin.processnewDriverlicenseRenewal');
    Route::get('/viewnewdriverlicenseRenewal/{id}', [AdminDashboardController::class, 'viewnewdriverlicenseRenewal'])->name('admin.viewnewdriverlicenseRenewal');
    Route::get('/download/newDriverlicenseRenewaldocument/{id}', [AdminDashboardController::class, 'downloadnewDriverlicenseRenewaldocument'])->name('newDriverlicenseRenewaldocument.download');

    Route::get('/dealer/plateNumber', [AdminDashboardController::class, 'processdealerplateNumber'])->name('admin.processdealerplateNumber');
    Route::get('/viewplateNumber/{id}', [AdminDashboardController::class, 'viewplateNumber'])->name('admin.viewplateNumber');
    Route::get('/download/plateNumberpassportpassport/{id}', [AdminDashboardController::class, 'downloadplateNumberpassport'])->name('plateNumberpassport.download');
    Route::get('/download/plateNumbercertificate/{id}', [AdminDashboardController::class, 'downloadplateNumbercertificate'])->name('plateNumbercertificate.download');
    Route::get('/download/plateNumbercompanyLetterhead/{id}', [AdminDashboardController::class, 'downloadplateNumbercompanyLetterhead'])->name('plateNumbercompanyLetterhead.download');
    
    Route::get('/otherPermit', [AdminDashboardController::class, 'processotherPermit'])->name('admin.processotherPermit');
    Route::get('/viewotherPermit/{id}', [AdminDashboardController::class, 'viewotherPermit'])->name('admin.viewotherPermit');
    Route::get('/download/otherpermitpassport/{id}', [AdminDashboardController::class, 'downloadotherpermitpassport'])->name('otherpermitpassport.download');
    Route::get('/download/otherpermitmeansofID/{id}', [AdminDashboardController::class, 'downloadotherpermitmeansofID'])->name('otherpermitmeansofID.download');
    Route::get('/download/otherpermitpictureoftheVehicleLicense/{id}', [AdminDashboardController::class, 'downloadotherpermitpictureoftheVehicleLicense'])->name('otherpermitpictureoftheVehicleLicense.download');
    Route::get('/download/otherpermitaffidavit/{id}', [AdminDashboardController::class, 'downloadotherpermitaffidavit'])->name('otherpermitaffidavit.download');
    Route::get('/download/otherpermitpolicereport/{id}', [AdminDashboardController::class, 'downloadotherpermitpolicereport'])->name('otherpermitpolicereport.download');

    Route::get('/internationalDriverlicense', [AdminDashboardController::class, 'processinternationalDriverlicense'])->name('admin.processinternationalDriverlicense');
    Route::get('/viewinternationalDriverlicense/{id}', [AdminDashboardController::class, 'viewinternationalDriverlicense'])->name('admin.viewinternationalDriverlicense');
    Route::get('/download/internationalDriverlicensepassport/{id}', [AdminDashboardController::class, 'downloadinternationalDriverlicensepassport'])->name('internationalDriverlicensepassport.download');

    Route::get('/view/viewdeliveryin/porogress/{id}', [AdminDashboardController::class, 'viewdeliveryinprogress'])->name('admin.viewdeliveryinprogress');
    Route::put('/update/deliveryinprogress/paper/{id}', [AdminDashboardController::class, 'updatedeliveryinprogressStatus'])->name('admin.update-deliveryinprogress-status');

    Route::get('/delivered', [AdminDashboardController::class, 'delivered'])->name('admin.delivered');
     
    Route::get('/process/paper', [AdminDashboardController::class, 'processedpaper'])->name('admin.processedpaper');
    Route::get('/pending/paper', [AdminDashboardController::class, 'pendingpaper'])->name('admin.pendingpaper');
    Route::get('/ready/delivery', [AdminDashboardController::class, 'readyfordelivery'])->name('admin.readyfordelivery');
    Route::get('/delivery/inprogress', [AdminDashboardController::class, 'deliveryinprogress'])->name('admin.deliveryinprogress'); 
    
    //Getaddvehiclerenewal
    Route::get('/getaddvehiclerenewal', [AdminDashboardController::class, 'getaddvehiclerenewal'])->name('admin.getaddvehiclerenewal');
    Route::get('/viewaddvehiclerenewal/{id}', [AdminDashboardController::class, 'viewaddvehiclerenewal'])->name('admin.viewaddvehiclerenewal');
    Route::put('/updateAddvehiclerenewal/{id}', [AdminDashboardController::class, 'updateAddvehiclerenewal'])->name('admin.addvehiclerenewal.update');
    
    Route::get('/download/addvehiclelicensepapers/{id}', [AdminDashboardController::class, 'downloadaddvehiclelicensepapers'])->name('addvehiclelicensepapers.download');
    Route::get('/download/addvehicleinsurancepapers/{id}', [AdminDashboardController::class, 'downloadaddvehicleinsurancepapers'])->name('addvehicleinsurancepapers.download');
    Route::get('/download/addvehicleroadWorthiness/{id}', [AdminDashboardController::class, 'downloadaddvehicleroadWorthiness'])->name('addvehicleroadWorthiness.download');
    Route::get('/download/addvehiclehackneypermitpaper/{id}', [AdminDashboardController::class, 'downloadaddvehiclehackneypermitpaper'])->name('addvehiclehackneypermitpaper.download');
    Route::get('/download/addvehiclestatecarriagepermit/{id}', [AdminDashboardController::class, 'downloadaddvehiclestatecarriagepermit'])->name('addvehiclestatecarriagepermit.download');
    Route::get('/download/addvehiclelocalgovernmentpermit/{id}', [AdminDashboardController::class, 'downloadaddvehiclelocalgovernmentpermit'])->name('addvehiclelocalgovernmentpermit.download');
    Route::get('/download/addvehiclemidyearpermit/{id}', [AdminDashboardController::class, 'downloadaddvehiclemidyearpermit'])->name('addvehiclemidyearpermit.download');
    Route::get('/download/addvehiclemeansofid/{id}', [AdminDashboardController::class, 'downloadaddvehiclemeansofid'])->name('addvehiclemeansofid.download');
    //Getaddvehiclerenewal
    Route::get('/getaddnewvehicleregistration', [AdminDashboardController::class, 'getaddnewvehicleregistration'])->name('admin.getaddnewvehicleregistration');
    Route::get('/viewaddvehicleregistration/{id}', [AdminDashboardController::class, 'viewaddvehicleregistration'])->name('admin.viewaddvehicleregistration');
    Route::get('/download/downloadaddaddvehicleregistrationcustomepaper/{id}', [AdminDashboardController::class, 'downloadaddaddvehicleregistrationcustomepaper'])->name('addvehicleregistrationcustomepaper.download');
    Route::get('/download/downloadaddaddvehicleregistrationcustomepaper/{id}', [AdminDashboardController::class, 'downloadaddaddvehicleregistrationcustomepaper'])->name('addvehicleregistrationcustomepaper.download');
    
    //GetaddchangeOfownership
    Route::get('/getaddchangeOfownership', [AdminDashboardController::class, 'getaddchangeOfownership'])->name('admin.getaddchangeOfownership');
    Route::get('/viewchangeofownership/{id}', [AdminDashboardController::class, 'viewchangeofownership'])->name('admin.viewchangeofownership');
    Route::get('/download/addchangeofownershipvehiclelicense/{id}', [AdminDashboardController::class, 'downloadaddchangeofownershipvehiclelicense'])->name('addchangeofownershipvehiclelicense.download');
    Route::get('/download/addchangeofownershipproofownership/{id}', [AdminDashboardController::class, 'downloadaddchangeofownershipproofownership'])->name('addchangeofownershipproofownership.download');
    Route::get('/download/addchangeofownershipagreements/{id}', [AdminDashboardController::class, 'downloadaddchangeofownershipagreements'])->name('addchangeofownershipagreements.download');
    Route::get('/download/addvehiclemeansID/{id}', [AdminDashboardController::class, 'downloadaddaddvehiclemeansID'])->name('addvehiclemeansID.download');
    //Add Vehicle Renewal
    Route::get('/addvehiclerenewal', [AdminDashboardController::class, 'addvehiclerenewal'])->name('admin.addvehiclerenewal');
    Route::get('/addvehiclenewregistration', [AdminDashboardController::class, 'addvehiclenewregistration'])->name('admin.addvehiclenewregistration');
    Route::get('/addvehiclechangeofownership', [AdminDashboardController::class, 'addvehiclechangeofownership'])->name('admin.addvehiclechangeofownership');

    //Add Vehiclre
    Route::post('/postaddvehiclerenewal', [AdminDashboardController::class, 'postaddvehiclerenewal'])->name('admin.postaddvehiclerenewal');
    Route::get('/addnewvehicleregistration', [AdminDashboardController::class, 'addnewvehicleregistration'])->name('admin.addnewvehicleregistration');
    Route::post('/postaddnewvehicleregistration', [AdminDashboardController::class, 'postaddnewvehicleregistration'])->name('admin.postaddnewvehicleregistration');
    Route::get('/addchangeOfownership', [AdminDashboardController::class, 'addchangeOfownership'])->name('admin.addchangeOfownership');
    Route::post('/postaddchangeownership', [AdminDashboardController::class, 'postaddchangeownership'])->name('admin.postaddchangeownership');
    
    //Vehicle Type
    Route::get('/vehicle/type', [AdminDashboardController::class, 'vehicleType'])->name('admin.vehicleType');
    Route::get('/add/vehicleType', [AdminDashboardController::class, 'addVehicleType'])->name('admin.addVehicleType');
    Route::post('/store/vehicleType', [AdminDashboardController::class, 'storeVehicleType'])->name('admin.storeVehicleType');   
    Route::get('/view/vehicleType/edit/{id}', [AdminDashboardController::class, 'vehiclTypeEdit'])->name('admin.vehiclTypeEdit');
    Route::post('/update/vehicleType', [AdminDashboardController::class, 'updateVehicleType'])->name('admin.updateVehicleType');  
    //state
    Route::get('/state', [AdminDashboardController::class, 'state'])->name('admin.state');
    Route::get('/create/state', [AdminDashboardController::class, 'createState'])->name('admin.createState');
    Route::post('/store/state', [AdminDashboardController::class, 'storeState'])->name('admin.storeState'); 
    Route::get('/view/state/details/{id}', [AdminDashboardController::class, 'stateDetails'])->name('admin.stateDetails');
   
    //Price Update 
    Route::get('/vehicle/renewal/price', [AdminDashboardController::class, 'vehicleRenewalPrice'])->name('admin.vehicleRenewalPrice'); 
    Route::get('/edit/vehicle/renewal/price/{id}', [AdminDashboardController::class, 'editVehicleRenewalPrice'])->name('admin.editVehicleRenewalPrice');
    Route::get('/add/vehicle/renewal/price', [AdminDashboardController::class, 'addVehicleRenewalPrice'])->name('admin.addVehicleRenewalPrice');
    Route::post('/post/vehicle/renewal/price', [AdminDashboardController::class, 'postVehicleRenewalPrice'])->name('admin.postVehicleRenewalPrice');
    Route::post('/update/vehicle/renewal/price', [AdminDashboardController::class, 'updateVehicleRenewalPrice'])->name('admin.updateVehicleRenewalPrice');
    Route::get('/delete/vehicle/renewal/price/{id}', [AdminDashboardController::class, 'deleteVehicleRenewalPrice'])->name('admin.deleteVehicleRenewalPrice');
    //Vehicle Reg
    Route::get('/vehicle/registration/price', [AdminDashboardController::class, 'vehicleRegistrationPrice'])->name('admin.vehicleRegistrationPrice');
    Route::get('/add/vehicle/registration/price', [AdminDashboardController::class, 'addVehicleRegistrationPrice'])->name('admin.addVehicleRegistrationPrice');
    Route::post('/post/vehicle/registration/price', [AdminDashboardController::class, 'postVehicleRegistrationPrice'])->name('admin.postVehicleRegistrationPrice');
    Route::get('/edit/vehicle/registration/price/{id}', [AdminDashboardController::class, 'editVehicleRegistrationPrice'])->name('admin.editVehicleRegistrationPrice');
    Route::post('/update/vehicle/registration/price', [AdminDashboardController::class, 'updateVehicleRegistrationPrice'])->name('admin.updateVehicleRegistrationPrice');
    Route::get('/delete/vehicle/registration/price/{id}', [AdminDashboardController::class, 'deleteVehicleRegistrationPrice'])->name('admin.deleteVehicleRegistrationPrice');
    //Vehicle Change of changeofOwnership
    Route::get('/vehicle/changeofOwnership/price', [AdminDashboardController::class, 'vehicleChangeofOwnershipPrice'])->name('admin.vehicleChangeofOwnershipPrice');
    Route::get('add/vehicle/changeofOwnership/price', [AdminDashboardController::class, 'addVehicleChangeofOwnershipPrice'])->name('admin.addVehicleChangeofOwnershipPrice');
    Route::post('/post/vehicle/changeofOwnership/price', [AdminDashboardController::class, 'postVehicleChangeofOwnershipPrice'])->name('admin.postVehicleChangeofOwnershipPrice');
    Route::get('edit/vehicle/changeofOwnership/price/{id}', [AdminDashboardController::class, 'editVehicleChangeofOwnershipPrice'])->name('admin.editVehicleChangeofOwnershipPrice');
    Route::post('/update/vehicle/changeofOwnership/price', [AdminDashboardController::class, 'updateVehicleChangeofOwnershipPrice'])->name('admin.updateVehicleChangeofOwnershipPrice');
    //Vehicle newdriverlicense
    Route::get('/newdriver/license/price', [AdminDashboardController::class, 'newDriverLicense'])->name('admin.newDriverLicense'); 
    Route::get('/add/newdriver/license/price', [AdminDashboardController::class, 'addNewDriverLicense'])->name('admin.addNewDriverLicense');
    Route::post('/post/newdriver/license/price', [AdminDashboardController::class, 'postNewDriverLicense'])->name('admin.postNewDriverLicense');
    Route::get('/edit/newdriver/license/price/{id}', [AdminDashboardController::class, 'editNewDriverLicense'])->name('admin.editNewDriverLicense');
    Route::get('/delete/newdriver/license/price/{id}', [AdminDashboardController::class, 'deleteNewDriverLicense'])->name('admin.deleteNewDriverLicense');
    Route::post('/update/newdriver/license/price/', [AdminDashboardController::class, 'updateNewDriverLicense'])->name('admin.updateNewDriverLicense');
    //Vehicle newdriverlicenseRenewal 
    Route::get('/driver/license/renewal/price', [AdminDashboardController::class, 'driverLicenseRenewal'])->name('admin.driverLicenseRenewal');
    Route::get('/add/newdriver/license/renewal/price', [AdminDashboardController::class, 'addDriverLicenseRenewal'])->name('admin.addDriverLicenseRenewal');
    Route::post('/post/newdriver/license/renewal/price', [AdminDashboardController::class, 'postDriverLicenseRenewal'])->name('admin.postDriverLicenseRenewal');
    Route::get('/edit/newdriver/license/renewal/price/{id}', [AdminDashboardController::class, 'editDriverLicenseRenewal'])->name('admin.editDriverLicenseRenewal');
    Route::post('/update/newdriver/license/renewal/price/', [AdminDashboardController::class, 'updateDriverLicenseRenewal'])->name('admin.updateDriverLicenseRenewal');
    Route::get('/delete/newdriver/license/renewal/price/{id}', [AdminDashboardController::class, 'deleteDriverLicenseRenewal'])->name('admin.deleteDriverLicenseRenewal');
    //IntDriverlicense
    Route::get('/intdriverlicense/price', [AdminDashboardController::class, 'intDriverlicense'])->name('admin.intDriverlicense');
    Route::get('/add/intdriverlicense/price', [AdminDashboardController::class, 'addIntDriverlicense'])->name('admin.addIntDriverlicense');
    Route::post('/post/intdriverlicense/price', [AdminDashboardController::class, 'postIntDriverlicense'])->name('admin.postIntDriverlicense');
    Route::get('/edit/intdriverlicense/price/{id}', [AdminDashboardController::class, 'editPriceIntDriverlicense'])->name('admin.editPriceIntDriverlicense'); 
    Route::post('/update/intdriverlicense/price', [AdminDashboardController::class, 'updatePriceIntDriverlicense'])->name('admin.updatePriceIntDriverlicense'); 
    Route::get('/delete/intdriverlicense/price/{id}', [AdminDashboardController::class, 'deletePriceIntDriverlicense'])->name('admin.deletePriceIntDriverlicense');
    // dealersplatenumber
    Route::get('/dealersplatenumber/price', [AdminDashboardController::class, 'dealersPlatenumber'])->name('admin.dealersPlatenumber');
    Route::get('/add/dealersplatenumber/price', [AdminDashboardController::class, 'addDealersPlatenumber'])->name('admin.addDealersPlatenumber');
    Route::post('/post/dealersplatenumber/price', [AdminDashboardController::class, 'postDealersPlatenumber'])->name('admin.postDealersPlatenumber');   
    Route::get('/edit/dealersplatenumber/price/{id}', [AdminDashboardController::class, 'editDealersPlatenumber'])->name('admin.editDealersPlatenumber'); 
    Route::post('/update/dealersplatenumber/price', [AdminDashboardController::class, 'updateDealersPlatenumber'])->name('admin.updateDealersPlatenumber'); 
    Route::get('/delete/dealersplatenumber/price/{id}', [AdminDashboardController::class, 'deleteDealersPlatenumber'])->name('admin.deleteDealersPlatenumber');
    // otherpermit
    Route::get('/otherpermit/price', [AdminDashboardController::class, 'otherPermitPrice'])->name('admin.otherPermit');
    Route::post('/add/otherpermitType', [AdminDashboardController::class, 'addOtherPermitType'])->name('admin.addOtherPermitType');
    Route::post('/add/otherpermitType/price', [AdminDashboardController::class, 'addOtherPermitTypePrice'])->name('admin.addOtherPermitTypePrice');
    Route::get('/add/otherpermit/price', [AdminDashboardController::class, 'addOtherPermit'])->name('admin.addOtherPermit');
    Route::get('/edit/OtherPermit/price/{id}', [AdminDashboardController::class, 'editOtherPermit'])->name('admin.editOtherPermit'); 
    Route::post('/update/OtherPermit/price', [AdminDashboardController::class, 'updateOtherPermit'])->name('admin.updateOtherPermit');
     
    // FAQ 
    Route::get('/question', [AdminDashboardController::class, 'question'])->name('admin.question'); 
    Route::get('/add/question', [AdminDashboardController::class, 'addQuestion'])->name('admin.addQuestion');
    Route::get('/edit/question/{id}', [AdminDashboardController::class, 'editQuestion'])->name('admin.editQuestion');
    //Users
    Route::get('/getusers', [AdminDashboardController::class, 'getusers'])->name('admin.users');
    Route::get('/viewusers/{id}', [AdminDashboardController::class, 'editgetusers'])->name('admin.editgetusers');
    Route::post('/updateUserStatus/{id}', [AdminDashboardController::class, 'updateUserStatus'])->name('admin.updateUserStatus');

    //Agent
    Route::get('/getAgent', [AdminDashboardController::class, 'getAgent'])->name('admin.getAgent');
    Route::get('/editAgent/{id}', [AdminDashboardController::class, 'editAgent'])->name('admin.editAgent');
    Route::post('/updateAgent/{id}', [AdminDashboardController::class, 'updateAgent'])->name('admin.updateAgent');
    Route::get('/createAgent', [AdminDashboardController::class, 'createAgent'])->name('admin.createAgent');
    Route::post('/postcreateAgent', [AdminDashboardController::class, 'postcreateAgent'])->name('admin.postcreateAgent');

    Route::get('/notificationslist', [NotificationController::class, 'index'])->name('admin.notificationList');
    Route::get('/notifications', [NotificationController::class, 'getNotifications'])->name('admin.getNotifications');
    Route::get('/notifications/{id}', [NotificationController::class, 'markAsRead'])->name('admin.markAsRead');
    

    Route::get('/withdraw', [AdminDashboardController::class, 'withdraw'])->name('admin.withdraw');
    Route::get('/editWithdraw/{id}', [AdminDashboardController::class, 'editWithdraw'])->name('admin.editWithdraw');
    Route::put('/update/withdraw/{id}', [AdminDashboardController::class, 'updaterWithdrawStatus'])->name('admin.update-withdraw-status');

    Route::get('/transaction', [AdminDashboardController::class, 'transaction'])->name('admin.transaction');
    Route::get('/view/transaction/{id}', [AdminDashboardController::class, 'viewtransaction'])->name('admin.viewtransaction');

    Route::get('/transactionPaperRenewal', [AdminDashboardController::class, 'transactionPaperRenewal'])->name('admin.transactionPaperRenewal');
    Route::get('/view/transactionPaperRenewal/{id}', [AdminDashboardController::class, 'viewtransactionPaperRenewal'])->name('admin.viewtransactionPaperRenewal');
    
    Route::get('/transactionVehicleRegistration', [AdminDashboardController::class, 'transactionVehicleRegistration'])->name('admin.transactionVehicleRegistration');
    Route::get('/view/transactionVehicleRegistration/{id}', [AdminDashboardController::class, 'viewtransactionVehicleRegistration'])->name('admin.viewtransactionVehicleRegistration');

    Route::get('/transactionChangeofownership', [AdminDashboardController::class, 'transactionChangeofownership'])->name('admin.transactionChangeofownership');
    Route::get('/view/transactionChangeofownership/{id}', [AdminDashboardController::class, 'viewtransactionChangeofownership'])->name('admin.viewtransactionChangeofownership');
    
    Route::get('/transactionNewDriverlicense', [AdminDashboardController::class, 'transactionNewDriverlicense'])->name('admin.transactionNewDriverlicense');
    Route::get('/view/transactionNewDriverlicense/{id}', [AdminDashboardController::class, 'viewtransactionNewDriverlicense'])->name('admin.viewtransactionNewDriverlicense');
    
    Route::get('/transactionNewDriverlicense', [AdminDashboardController::class, 'transactionNewDriverlicense'])->name('admin.transactionNewDriverlicense');
    Route::get('/view/transactionNewDriverlicense/{id}', [AdminDashboardController::class, 'viewtransactionNewDriverlicense'])->name('admin.viewtransactionNewDriverlicense');
    
    Route::get('/transactionDriverlicenseRenewal', [AdminDashboardController::class, 'transactionDriverlicenseRenewal'])->name('admin.transactionDriverlicenseRenewal');
    Route::get('/view/transactionDriverlicenseRenewal/{id}', [AdminDashboardController::class, 'viewtransactionDriverlicenseRenewal'])->name('admin.viewtransactionDriverlicenseRenewal');
    
    Route::get('/transactionInternationalDriverlicense', [AdminDashboardController::class, 'transactionInternationalDriverlicense'])->name('admin.transactionInternationalDriverlicense');
    Route::get('/view/transactionInternationalDriverlicense/{id}', [AdminDashboardController::class, 'viewtransactionInternationalDriverlicense'])->name('admin.viewtransactionInternationalDriverlicense');
    
    Route::get('/transactionDealerplateNumber', [AdminDashboardController::class, 'transactionDealerplateNumber'])->name('admin.transactionDealerplateNumber');
    Route::get('/view/transactionDealerplateNumber/{id}', [AdminDashboardController::class, 'viewtransactionDealerplateNumber'])->name('admin.viewtransactionDealerplateNumber');
    
    Route::get('/transactionOtherPermit', [AdminDashboardController::class, 'transactionOtherPermit'])->name('admin.transactionOtherPermit');
    Route::get('/view/transactionOtherPermit/{id}', [AdminDashboardController::class, 'viewtransactionOtherPermit'])->name('admin.viewtransactionOtherPermit');      

    Route::get('/',[AdminDashboardController::class, 'index'])->name('admin.index');
    Route::get('/settings',[AdminDashboardController::class, 'settings'])->name('admin.settings');
    Route::post('/settings',[AdminDashboardController::class, 'postSettings'])->name('admin.postSettings');
    Route::get('/contactmessage',[AdminDashboardController::class, 'contactMessage'])->name('admin.contactMessage');
    Route::get('/viewcontactmessage/{id}',[AdminDashboardController::class, 'viewcontactMessage'])->name('admin.viewcontactMessage');
        
    Route::post('admin/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');

}); 
