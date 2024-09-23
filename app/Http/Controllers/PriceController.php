<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\State;
use App\Models\VehicleType;
use App\Models\VehicleRegistrationType;
use App\Models\VehicleRenewalPrice;
use App\Models\VehicleRegistrationPrice;
use App\Models\ChangeofOwnershipPrice;
use App\Models\NewDriverLicensePrice;
use App\Models\DriverLicenseRenewalPrice;
use App\Models\OtherPermitType;
use App\Models\OtherPermitPrice;
use App\Models\InternationalDriverLicensePrice;
 
class PriceController extends Controller
{
    // 
    public function pricing(){
      
        $vehicleregistrationTypes = VehicleRegistrationType::all();
        $states =State::all();
        
        return view('frontend.pages.pricing');
    }

    public function getState(){
        $states = State::all();
        $vehicleType =  VehicleType::all();
       
        return response()->json([
            'stateList' => $states,
            'vehicleTypeList' => $vehicleType,
        ]);
    }

    public function getVehicleRenewalPrice(Request $request){
        $stateId = $request->input('stateId');
        $vehicleTypeId = $request->input('vehicleTypeId');

        $vehicleList = VehicleRenewalPrice::where('state_id', $stateId)
                                        ->where('vehicleType_id', $vehicleTypeId)
                                        ->get();

        return response()->json([
            'vehicleLicense' => $vehicleList->first()->vehicle_license ?? 0,
            'roadWorthiness' => $vehicleList->first()->road_worthiness ?? 0,
            'thirdPartyInsurance' => $vehicleList->first()->third_party_insurance ?? 0,
            'proofOwnership' => $vehicleList->first()->proof_of_ownership ?? 0,
            'hackneyPermit' => $vehicleList->first()->hackney_permit ?? 0,
            'vehicleInspectionPickandDrop' => $vehicleList->first()->vehicle_inspection_pickanddrop ?? 0,
            'policeCmris' => $vehicleList->first()->police_cmris ?? 0,
        ]);
    }

    public function getVehicleRegistration(){
        $states = State::all();
        $vehicleType =  VehicleType::all();
        $vehicleRegistrationType =  VehicleRegistrationType::all();
       
        return response()->json([
            'stateList' => $states,
            'vehicleTypeList' => $vehicleType,
            'vehicleRegistrationType' => $vehicleRegistrationType
        ]);
    }

    public function getVehicleRegistrationPrice(Request $request){
        $stateId = $request->input('stateId');
        $vehicleTypeId = $request->input('vehicleTypeId');
        $vehicleRegistrationTypeId = $request->input('vehicleRegistrationTypeId');
        $numberPlateType = $request->input('numberPlateType');

        $vehiclecategories = VehicleRegistrationType::where('id', $vehicleRegistrationTypeId)->first();


        $vehicleRegPrice = VehicleRegistrationPrice::where('state_id', $stateId)
                                        ->where('vehicle_type_id', $vehicleTypeId)
                                        ->get();
        $vehiclename = VehicleType::where('id', $vehicleTypeId)->first();
        $vehiclename2 = VehicleType::where('id', $vehiclename->id )->first();

        // Initialize default amount
        $amount = 0;
        $HackneyPermit = 0;
        $PoliceCmris = 0;

        if ($vehiclecategories && strpos($vehiclename->name, $vehiclename2->name) !== false) {
            if ($numberPlateType == 'RPN') {
                $RPrivateVehicle3rdPartyInsurance = $vehicleRegPrice->first()->random_private_vehicle_3rd_party_insurance ?? 0;
                $RPrivateVehicle3rdPartyNoInsurance = $vehicleRegPrice->first()->random_plate_private_vehicle_no_insurance ?? 0;
                $RCommercialPlate3rdPartyInsurance = $vehicleRegPrice->first()->random_commercial_plate_3rd_party_insurance ?? 0;
                $RCommercialPlate3rdPartyNoInsurance = $vehicleRegPrice->first()->random_plate_no_commercial_vehicle_no_insurance ?? 0;
                $HackneyPermit =  $vehicleRegPrice->first()->random_plate_hackney_permit ?? 0;
                $PoliceCmris =  $vehicleRegPrice->first()->random_plate_police_cmris ?? 0;
               
                switch ($vehiclecategories->name) {
                    case 'Private Vehicle With 3rd/P insurance':
                        $amount = $RPrivateVehicle3rdPartyInsurance;
                        break;
                    case 'Private Vehicle With No insurance':
                        $amount = $RPrivateVehicle3rdPartyNoInsurance;
                        break;
                    case 'Commercial Vehicle With 3rd/P insurance':
                        $amount = $RCommercialPlate3rdPartyInsurance;
                        break;
                    case 'Commercial Vehicle No insurance':
                        $amount = $RCommercialPlate3rdPartyNoInsurance;
                        break;
                }
            }elseif ($numberPlateType == 'PCN') {
                $CPrivateVehicle3rdPartyInsurance = $vehicleRegPrice->first()->customized_private_vehicle_3rd_party_insurance ?? 0;
                $CPrivateVehicle3rdPartyNoInsurance = $vehicleRegPrice->first()->customised_plate_private_vehicle_no_insurance ?? 0;
                $CCommercialPlate3rdPartyInsurance = $vehicleRegPrice->first()->customised_commercial_plate_3rd_party_insurance ?? 0;
                $CCommercialPlate3rdPartyNoInsurance = $vehicleRegPrice->first()->customized_plate_no_commercial_vehicle_no_insurance ?? 0;
                $HackneyPermit =  $vehicleRegPrice->first()->customized_plate_hackney_permit ?? 0;
                $PoliceCmris =  $vehicleRegPrice->first()->customised_plate_police_cmris ?? 0;
               
                switch ($vehiclecategories->name) {
                    case 'Private Vehicle With 3rd/P insurance':
                        $amount = $CPrivateVehicle3rdPartyInsurance;
                        break;
                    case 'Private Vehicle With No insurance':
                        $amount = $CPrivateVehicle3rdPartyNoInsurance;
                        break;
                    case 'Commercial Vehicle With 3rd/P insurance':
                        $amount = $CCommercialPlate3rdPartyInsurance;
                        break;
                    case 'Commercial Vehicle No insurance':
                        $amount = $CCommercialPlate3rdPartyNoInsurance;
                        break;
                }
            }
        }
        return response()->json([
            'message' => 'Vehicle cost retrieved successfully',
            'hackneyPermitCost' => $HackneyPermit,
            'policeCmrisCost' => $PoliceCmris,
            'totalAmount' => $amount,
        ]);
    }

    public function getChangeofOwnership(){
        $states = State::all();
        $vehicleType =  VehicleType::all();
       
        return response()->json([
            'stateList' => $states,
            'vehicleTypeList' => $vehicleType,
        ]);
    }

    public function getChangeofOwnershipPriceee(Request $request){
        $stateId = $request->input('stateId');
        $vehicleTypeId = $request->input('vehicleTypeId');
        $vehicleLicenseDate = $request->input('vehicleLicenseDate');
        $plateNumber = $request->input('plateNumber');
        $hacneyPermitDate = $request->input('hacneyPermitDate');

        $vehicleName = VehicleType::where('id', $vehicleTypeId )->first();
        $vehicleName2 = VehicleType::where('id', $vehicleName->id )->first();
        $changeofownershipPrice = ChangeofOwnershipPrice::where('state_id', $stateId)
                                                        ->where('vehicle_type_id', $vehicleTypeId)
                                                        ->get();
        $vehicleCostCO = 0;
        $RVLAmount = 0;
        $policeCMRIS = 0;
        $RHPermitAmount = 0;
        $vehiclelicenseAmount = 0;
        $hackneyPermitCost = 0; 
        
        if($changeofownershipPrice && strpos($vehicleName->name, $vehicleName2) !== false || $hacneyPermitDate){
            if($plateNumber == 'RPN' ){
                
                $vehicleCostCO =  $changeofownershipPrice->first()->random_cost ?? 0;
                $RVLAmount =  $changeofownershipPrice->first()->random_vehicleLicense ?? 0;
                $RHPermitAmount =  $changeofownershipPrice->first()->random_hacneyPermit ?? 0;
                $policeCMRIS =  $changeofownershipPrice->first()->random_policeCmris ?? 0;
                switch($vehiclelicensedate){
                    case 'lessthan1month':
                        $vehiclelicenseAmount = "0";
                        break;
                    case 'morethan1month':
                        $vehiclelicenseAmount = $$changeofownershipPrice->first()->random_vehicleLicense;
                        break;
                    case 'morethan1year':
                        $vehiclelicenseAmount = $changeofownershipPrice->first()->random_vehicleLicense * 2;
                        break;
                    case 'morethan2year':
                        $vehiclelicenseAmount = $changeofownershipPrice->first()->random_vehicleLicense * 3;
                        break;
                    case 'morethan3year':
                        $vehiclelicenseAmount = $changeofownershipPrice->first()->random_vehicleLicense * 4;
                        break;
                    case 'morethan4year':
                        $vehiclelicenseAmount = $changeofownershipPrice->first()->random_vehicleLicense * 5;
                        break;
                    case 'morethan5year':
                        $vehiclelicenseAmount = $changeofownershipPrice->first()->random_vehicleLicense * 6;
                        break;
                    case 'morethan6year':
                        $vehiclelicenseAmount = $changeofownershipPrice->first()->random_vehicleLicense * 7;
                        break;
                    case 'morethan7year':
                        $vehiclelicenseAmount = $changeofownershipPrice->first()->random_vehicleLicense * 8;
                        break;
                    default:
                        $vehiclelicenseAmount = "0";
                }
                switch($hacneypermitdate){
                    case 'lessthan1month':
                        $hacneypermitAmount = "0";
                        break;
                    case 'morethan1month':
                        $hacneypermitAmount = $RHPermitAmount;
                        break;
                    case 'morethan1year':
                        $hacneypermitAmount = $RHPermitAmount * 2;
                        break;
                    case 'morethan2year':
                        $hacneypermitAmount = $RHPermitAmount * 3;
                        break;
                    case 'morethan3year':
                        $hacneypermitAmount = $RHPermitAmount * 4;
                        break;
                    case 'morethan4year':
                        $hacneypermitAmount = $RHPermitAmount * 5;
                        break;
                    case 'morethan5year':
                        $hacneypermitAmount = $RHPermitAmount * 6;
                        break;
                    case 'morethan6year':
                        $hacneypermitAmount = $RHPermitAmount * 7;
                        break;
                    case 'morethan7year':
                        $hacneypermitAmount = $RHPermitAmount * 8;
                        break;
                    default:
                        $hacneypermitAmount = "0";
                }
            }else{
                $plateNumber = 0;
            }
        }
        
        return response()->json([
            'success' => true,
            'stateId' => $stateId,
            'vehicleTypeId' => $vehicleTypeId,
            'vehicleLicenseDate' => $vehicleLicenseDate,
            'plateNumber' => $plateNumber,
            'hacneyPermitDate' => $hacneyPermitDate,
            'changeofownershipPrice' => $changeofownershipPrice,
            'vehicleCostCO' => $changeofownershipPrice->first()->random_cost,
            'vehicleLicenseCost' => $vehiclelicenseAmount,
            'hackneyPermitCost' => $hackneyPermitCost,
            'policeCMRIS' => $policeCMRIS,
        ]);
    }

    public function getChangeofOwnershipPrice(Request $request){
        
        $stateId = $request->input('stateId');
        $vehicleCategoryId = $request->input('vehicleTypeId');
        $vLExpirydate = $request->input('vehicleLicenseDate');
        $platenumber = $request->input('plateNumber');
        $hackneyPermit = $request->input('hacneyPermitDate');
        
        $vehiclename = VehicleType::where('id', $vehicleCategoryId )->first();
        
        $changeofownershipPrice = ChangeofOwnershipPrice::where('state_id', $stateId)
                                                        ->where('vehicle_type_id', $vehicleCategoryId)->get();
        $vehicleCost = 0;
        $RVLAmount = 0;
        $policeCMRIS = 0;
        $RHPermitAmount = 0;
        $vehiclelicenseAmount = 0;
        $hackneyPermitCost = 0;
        
        if(strpos($vehiclename->name, $vehiclename->name) !== false && $platenumber == 'RPN'  || $hackneyPermit){
         
            $vehicleCost =  $changeofownershipPrice->first()->random_cost;
            $RVLAmount =  $changeofownershipPrice->first()->random_vehicleLicense;
            $RHPermitAmount =  $changeofownershipPrice->first()->random_hacneyPermit;
            $policeCMRIS =  $changeofownershipPrice->first()->random_policeCmris;
            
            switch($vLExpirydate){
                case 'lessthan1month':
                    $vehiclelicenseAmount = 0;
                    break;
                case 'morethan1month':
                    $vehiclelicenseAmount = $RVLAmount;
                    break;
                case 'morethan1year':
                    $vehiclelicenseAmount = $RVLAmount * 2;
                    break;
                case 'morethan2year':
                    $vehiclelicenseAmount = $RVLAmount * 3;
                    break;
                case 'morethan3year':
                    $vehiclelicenseAmount = $RVLAmount * 4;
                    break;
                case 'morethan4year':
                    $vehiclelicenseAmount = $RVLAmount * 5;
                    break;
                case 'morethan5year':
                    $vehiclelicenseAmount = $RVLAmount * 6;
                    break;
                case 'morethan6year':
                    $vehiclelicenseAmount = $RVLAmount * 7;
                    break;
                case 'morethan7year':
                    $vehiclelicenseAmount = $RVLAmount * 8;
                    break;
                default:
                    $vehiclelicenseAmount = 0;
            }
            switch($hackneyPermit){
                case 'lessthan1month':
                    $hackneyPermitCost = 0;
                    break;
                case 'morethan1month':
                    $hackneyPermitCost = $RHPermitAmount;
                    break;
                case 'morethan1year':
                    $hackneyPermitCost = $RHPermitAmount * 2;
                    break;
                case 'morethan2year':
                    $hackneyPermitCost = $RHPermitAmount * 3;
                    break;
                case 'morethan3year':
                    $hackneyPermitCost = $RHPermitAmount * 4;
                    break;
                case 'morethan4year':
                    $hackneyPermitCost = $RHPermitAmount * 5;
                    break;
                case 'morethan5year':
                    $hackneyPermitCost = $RHPermitAmount * 6;
                    break;
                case 'morethan6year':
                    $hackneyPermitCost = $RHPermitAmount * 7;
                    break;
                case 'morethan7year':
                    $hackneyPermitCost = $RHPermitAmount * 8;
                    break;
                default:
                    $hackneyPermitCost = 0;
            }
         
            
        } elseif(strpos($vehiclename->name, $vehiclename->name) !== false && $platenumber == 'CPN' || $hackneyPermit){
            $vehicleCost =  $changeofownershipPrice->first()->customised_cost;
            $CVLAmount =  $changeofownershipPrice->first()->customised_vehicleLicense;
            $CHPermitAmount =  $changeofownershipPrice->first()->customised_hacneyPermit;
            $policeCMRIS =  $changeofownershipPrice->first()->customised_policeCmris;
            switch($vLExpirydate){
                case 'lessthan1month':
                    $vehiclelicenseAmount = 0;
                    break;
                case 'morethan1month':
                    $vehiclelicenseAmount = $CVLAmount;
                    break;
                case 'morethan1year':
                    $vehiclelicenseAmount = $CVLAmount * 2;
                    break;
                case 'morethan2year':
                    $vehiclelicenseAmount = $CVLAmount * 3;
                    break;
                case 'morethan3year':
                    $vehiclelicenseAmount = $CVLAmount * 4;
                    break;
                case 'morethan4year':
                    $vehiclelicenseAmount = $CVLAmount * 5;
                    break;
                case 'morethan5year':
                    $vehiclelicenseAmount = $CVLAmount * 6;
                    break;
                case 'morethan6year':
                    $vehiclelicenseAmount = $CVLAmount * 7;
                    break;
                case 'morethan7year':
                    $vehiclelicenseAmount = $CVLAmount * 8;
                    break;
                default:
                    $vehiclelicenseAmount = 0;
            }
            switch($hackneyPermit){
                case 'lessthan1month':
                    $hackneyPermitCost = "0";
                    break;
                case 'morethan1month':
                    $hackneyPermitCost = $CHPermitAmount;
                    break;
                case 'morethan1year':
                    $hackneyPermitCost = $CHPermitAmount * 2;
                    break;
                case 'morethan2year':
                    $hackneyPermitCost = $CHPermitAmount * 3;
                    break;
                case 'morethan3year':
                    $hackneyPermitCost = $CHPermitAmount * 4;
                    break;
                case 'morethan4year':
                    $hackneyPermitCost = $CHPermitAmount * 5;
                    break;
                case 'morethan5year':
                    $hackneyPermitCost = $CHPermitAmount * 6;
                    break;
                case 'morethan6year':
                    $hackneyPermitCost = $CHPermitAmount * 7;
                    break;
                case 'morethan7year':
                    $hackneyPermitCost = $CHPermitAmount * 8;
                    break;
                default:
                    $hackneyPermitCost = "0";
            }
        }else{
            $vehiclelicenseAmount = 0;
            $hackneyPermitCost = 0;
            $vehicleCost = 0;
        }
         
        return response()->json([
            'success' => true,
            'message' => 'Vehicle Ownershipt Cost',
            'vehicleCost' => $vehicleCost,
            'hackneyPermitCost' => $hackneyPermitCost,
            'vehicleLicenseCost' => $vehiclelicenseAmount,
            'changeofownershipPrice' => $changeofownershipPrice,
            'platenumber' => $platenumber,
            'policeCmrisCost' => $policeCMRIS,
        ]);
    }

    public function getNewdriverLicensesLength(Request $request){

        $stateId = $request->input('stateIdNDL');
        $lengthYears = NewDriverLicensePrice::where('state_id', $stateId)
                                            ->get();
        return response()->json([
            'lengthYear' => $lengthYears,
            'amount' => $lengthYears->first()->amount,
        ]);
    }

    public function getNewdriverLicensesPrice(Request $request){
        $stateId = $request->input('stateIdNDL');
        $selectedLength = $request->input('selectedLengthNDL');
        $lengthYears = NewDriverLicensePrice::where('state_id', $stateId)
                                            ->where('years_type', $selectedLength)
                                            ->get();
        return response()->json([
            'amount' => $lengthYears->first()->amount ?? 0,
            'lengthYears' => $lengthYears ?? 0,
        ]);
    }

    public function getDriverLicenseRenewalLength(Request $request){
        $stateId = $request->input('statesDLR');
        $lengthYears = DriverLicenseRenewalPrice::where('state_id', $stateId)
                                            ->get();

        return response()->json([
            'lengthYear' => $lengthYears,
            'amount' => $lengthYears->first()->amount,
        ]);
    }

    public function getDriverLicenseRenewalPrice(Request $request){
        $stateId = $request->input('stateIdDLR');
        $selectedLength = $request->input('selectedLengthDLR');
        $lengthYears = DriverLicenseRenewalPrice::where('state_id', $stateId)
                                            ->where('years_type', $selectedLength)
                                            ->get();
        return response()->json([
            'amount' => $lengthYears->first()->amount ?? 0,
        ]);
    }

    public function getOtherPermit(){
        $permitType = OtherPermitType::all();

        return response()->json([
            'permitType' => $permitType,
        ]);
    }

    public function getOtherPermitPrice(Request $request){
        
        $permitTypeId = $request->input('otherPermits');
        $otherPermit = OtherPermitPrice::where('permit_type_id', $permitTypeId)
                                                ->get();

        return response()->json([
            'amount' => $otherPermit->first()->amount,
        ]);
    }

    public function getInternationaDriverLicenseLength(Request $request){
        $stateId = $request->input('stateIdIDL');
        $lengthYears = InternationalDriverLicensePrice::where('state_id', $stateId)
                                                        ->get();

        return response()->json([
            'lengthYear' => $lengthYears,
        ]);
    }

    public function getInternationaDriverLicensePrice(Request $request){
        $stateId = $request->input('stateIdIDL');
        $lengthYear = $request->input('lengthOfYearsIDL');

        $lengthYears = InternationalDriverLicensePrice::where('years_type', $lengthYear)
                                                ->where('state_id', $stateId)
                                                ->get();

        return response()->json([
            'amount' => $lengthYears->first()->amount ?? 0,
        ]);
    }
}
