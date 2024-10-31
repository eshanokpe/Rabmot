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

   

  

    public function getChangeofOwnershipPrice(Request $request) {
        $stateId = $request->input('stateId');
        $vehicleCategoryId = $request->input('vehicleTypeId');
        $vLExpirydate = $request->input('vehicleLicenseDate');
        $platenumber = $request->input('plateNumber');
        $hackneyPermit = $request->input('hacneyPermitDate');
    
        $vehiclename = VehicleType::where('id', $vehicleCategoryId)->first();
        $changeofownershipPrice = ChangeofOwnershipPrice::where('state_id', $stateId)
                                                        ->where('vehicle_type_id', $vehicleCategoryId)
                                                        ->first();
        
        $vehicleCost = 0;
        $RVLAmount = 0;
        $policeCMRIS = 0;
        $RHPermitAmount = 0;
        $vehiclelicenseAmount = 0;
        $hackneyPermitCost = 0;
        $expiryDateCost = 0;
        $hackneyPermitDateCost = 0;
    
        if (strpos($vehiclename->name, $vehiclename->name) !== false && $platenumber === 'RPN' || $hackneyPermit) {
            if ($changeofownershipPrice) {
                $vehicleCost = $changeofownershipPrice->random_cost;
                $RVLAmount = $changeofownershipPrice->random_vehicleLicense;
                $RHPermitAmount = $changeofownershipPrice->random_hacneyPermit;
                $policeCMRIS = $changeofownershipPrice->random_policeCmris;
                $vehiclelicenseAmount = $this->calculateAmountByDuration($vLExpirydate, $RVLAmount);
                $expiryDateCost += $vehiclelicenseAmount;
                $hackneyPermitCost = $this->calculateAmountByDuration($hackneyPermit, $RHPermitAmount);
                $hackneyPermitDateCost += $hackneyPermitCost;
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'No matching ownership price data found for given criteria.'
                ]);
            }
        } elseif (strpos($vehiclename->name, $vehiclename->name) !== false && $platenumber === 'CPN' || $hackneyPermit) {
            $vehicleCost = $changeofownershipPrice->customised_cost ?? 0;
            $CVLAmount = $changeofownershipPrice->customised_vehicleLicense ?? 0;
            $CHPermitAmount = $changeofownershipPrice->customised_hacneyPermit ?? 0;
            $policeCMRIS = $changeofownershipPrice->customised_policeCmris ?? 0;
            
            $vehiclelicenseAmount = $this->calculateAmountByDuration($vLExpirydate, $CVLAmount);
            $hackneyPermitCost = $this->calculateAmountByDuration($hackneyPermit, $CHPermitAmount);
        }
    
        return response()->json([
            'success' => true,
            'message' => 'Vehicle Ownership Cost',
            'expiryDateCost' => $expiryDateCost,
            'hackneyPermitDateCost' => $hackneyPermitDateCost,
            'changeofownershipPrice' => $changeofownershipPrice,
            'vehicleCost' => $vehicleCost,
            'hackneyPermitCost' => $hackneyPermitCost,
            'platenumber' => $platenumber,
            'policeCmrisCost' => $policeCMRIS,
        ]);
    }
    
    // Helper method to calculate the amount based on duration
    private function calculateAmountByDuration($duration, $amount) {
        switch ($duration) {
            case 'lessthan1month':
                return 0;
            case 'morethan1month':
                return $amount;
            case 'morethan1year':
                return $amount * 2;
            case 'morethan2year':
                return $amount * 3;
            case 'morethan3year':
                return $amount * 4;
            case 'morethan4year':
                return $amount * 5;
            case 'morethan5year':
                return $amount * 6;
            case 'morethan6year':
                return $amount * 7;
            case 'morethan7year':
                return $amount * 8;
            default:
                return 0;
        }
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
