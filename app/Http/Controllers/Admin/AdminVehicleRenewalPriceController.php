<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\State;
use App\Models\VehicleType;
use App\Models\VehicleRenewalPrice;
use Illuminate\Support\Facades\Validator;


class AdminVehicleRenewalPriceController extends Controller
{
    public function index(){
        $vehicleRenewal =  VehicleRenewalPrice::latest()->get();
        return view('admin.pages.prices.vehicleRenewalPrice.index', compact('vehicleRenewal') );
    }

    public function create(){
        $states = State::all(); 
        $vehcileType = VehicleType::all();
        return view('admin.pages.prices.vehicleRenewalPrice.add', compact('vehcileType','states'));
    } 

    public function store(Request $request){

        $validatedData = $request->validate([
            'vehicleType' => 'required|max:255',
            'stateId' => 'required|max:255',
            'vehicleLicense' => 'required|max:255',
            'roadWorthiness' => 'required|max:255',
            'thridPartyInsurance' => 'required|max:255',
            'proofOfOwnership' => 'required|max:255',
            'hackneyPermit' => 'required|max:255',
            'policeCmris' => 'required|max:255',
            'vehicleInspection' => 'required|max:255',
        ]);
 
    
        $VehicleRenewalPrice = new VehicleRenewalPrice(); 
        $VehicleRenewalPrice->vehicleType_id = $validatedData['vehicleType']; 
        $VehicleRenewalPrice->state_id = $validatedData['stateId']; 
        $VehicleRenewalPrice->vehicle_license = $validatedData['vehicleLicense'];
        $VehicleRenewalPrice->road_worthiness = $validatedData['roadWorthiness'];
        $VehicleRenewalPrice->third_party_insurance = $validatedData['thridPartyInsurance'];
        $VehicleRenewalPrice->proof_of_ownership = $validatedData['proofOfOwnership'];
        $VehicleRenewalPrice->hackney_permit = $validatedData['hackneyPermit'];
        $VehicleRenewalPrice->police_cmris = $validatedData['policeCmris'];
        $VehicleRenewalPrice->vehicle_inspection_pickanddrop = $validatedData['vehicleInspection'];
        $VehicleRenewalPrice->save();
    
        return redirect()->route('admin.vehicleRenewalPrice.index')->with('success', 'Vehicle Renewal price created successfully');
    }

    public function edit($id){
        $data['vehicleRenewal'] = VehicleRenewalPrice::find(decrypt($id)); 
        $data['states'] = State::all(); 
        $data['vehicleType'] = VehicleType::all();
        return view('admin.pages.prices.vehicleRenewalPrice.edit', $data);
    }

    public function update(Request $request){
        try{
            $validatedData = $request->validate([
                'vehicleType' => 'required|max:255',
                'stateId' => 'required|max:255',
                'vehicleLicense' => 'required|max:255',
                'roadWorthiness' => 'required|max:255',
                'thridPartyInsurance' => 'required|max:255',
                'proofOfOwnership' => 'required|max:255',
                'hackneyPermit' => 'required|max:255',
                'policeCmris' => 'required|max:255',
                'vehicleInspection' => 'required|max:255',
            ]);
            $VehicleRenewalPrice = VehicleRenewalPrice::find($request->id);
            $VehicleRenewalPrice->vehicleType_id = $validatedData['vehicleType']; 
            $VehicleRenewalPrice->state_id = $validatedData['stateId']; 
            $VehicleRenewalPrice->vehicle_license = $validatedData['vehicleLicense'];
            $VehicleRenewalPrice->road_worthiness = $validatedData['roadWorthiness'];
            $VehicleRenewalPrice->third_party_insurance = $validatedData['thridPartyInsurance'];
            $VehicleRenewalPrice->proof_of_ownership = $validatedData['proofOfOwnership'];
            $VehicleRenewalPrice->hackney_permit = $validatedData['hackneyPermit'];
            $VehicleRenewalPrice->police_cmris = $validatedData['policeCmris'];
            $VehicleRenewalPrice->vehicle_inspection_pickanddrop = $validatedData['vehicleInspection'];
            $VehicleRenewalPrice->save();
            
            return redirect()->back()->with('success', 'Vehicle Renewal price updated successfully');
            
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong ' . $e->getMessage());
        }
    }

    public function destroy($id){
   
        $vehicleRenewalId = decrypt($id);
        $vehicleRenewal = VehicleRenewalPrice::find($vehicleRenewalId);
        if(!$vehicleRenewal){
            return redirect()->back()->with('error', 'Vehicle Renewal price not found.');
        }
        $vehicleRenewal->delete();
        return redirect()->back()->with('success', 'Vehicle Renewal price deleted successfully');
    }
 
}