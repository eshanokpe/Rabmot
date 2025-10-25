<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\State;
use App\Models\VehicleType;
use App\Models\VehicleRegistrationPrice;
use Illuminate\Support\Facades\Validator;


class AdminVehicleRegistrationPriceController extends Controller
{
    public function index(){
        $data['data'] =  VehicleRegistrationPrice::latest()->get();
        $data['data2'] =  VehicleRegistrationPrice::latest()->get();
        return view('admin.pages.prices.vehicleRegistrationPrice.index', $data);
    }

    public function create(){
        $states = State::all(); 
        $vehcileType = VehicleType::all();
        return view('admin.pages.prices.vehicleRegistrationPrice.add', compact('vehcileType','states'));
    } 

    public function store(Request $request) 
    { 
        
        $validatedData = $request->validate([
            'vehicle_type' => 'required|max:255',
            'stateId' => 'required|max:255',
            'random_private_vehicle_3rd_party_insurance' => 'required|max:255',
            'customized_private_vehicle_3rd_party_insurance' => 'required|max:255',
            'random_plate_private_vehicle_no_insurance' => 'required|max:255',
            'customised_plate_private_vehicle_no_insurance' => 'required|max:255',
            'random_commercial_plate_3rd_party_insurance' => 'required|max:255', 
            'customised_commercial_plate_3rd_party_insurance' => 'required|max:255',
            'random_plate_no_commercial_vehicle_no_insurance' => 'required|max:255',
            'customized_plate_no_commercial_vehicle_no_insurance' => 'required|max:255',
            'random_plate_hackney_permit' => 'required|max:255',
            'customized_plate_hackney_permit' => 'required|max:255',
            'random_plate_police_cmris' => 'required|max:255',
            'customised_plate_police_cmris' => 'required|max:255',
        ]); 
    
       
     try {
            $VehicleRegistrationPrice = new VehicleRegistrationPrice(); 
            $VehicleRegistrationPrice->state_id = $validatedData['stateId']; 
            $VehicleRegistrationPrice->vehicle_type_id = $validatedData['vehicle_type']; 
            $VehicleRegistrationPrice->random_private_vehicle_3rd_party_insurance = $validatedData['random_private_vehicle_3rd_party_insurance']; 
            $VehicleRegistrationPrice->customized_private_vehicle_3rd_party_insurance = $validatedData['customized_private_vehicle_3rd_party_insurance'];
            $VehicleRegistrationPrice->random_plate_private_vehicle_no_insurance = $validatedData['random_plate_private_vehicle_no_insurance']; 
            $VehicleRegistrationPrice->customised_plate_private_vehicle_no_insurance = $validatedData['customised_plate_private_vehicle_no_insurance'];
            $VehicleRegistrationPrice->random_commercial_plate_3rd_party_insurance = $validatedData['random_commercial_plate_3rd_party_insurance'];
            $VehicleRegistrationPrice->customised_commercial_plate_3rd_party_insurance = $validatedData['customised_commercial_plate_3rd_party_insurance']; 
            $VehicleRegistrationPrice->random_plate_no_commercial_vehicle_no_insurance = $validatedData['random_plate_no_commercial_vehicle_no_insurance'];
            $VehicleRegistrationPrice->customized_plate_no_commercial_vehicle_no_insurance = $validatedData['customized_plate_no_commercial_vehicle_no_insurance']; 
            $VehicleRegistrationPrice->random_plate_hackney_permit = $validatedData['random_plate_hackney_permit'];
            $VehicleRegistrationPrice->customized_plate_hackney_permit = $validatedData['customized_plate_hackney_permit'];
            $VehicleRegistrationPrice->random_plate_police_cmris = $validatedData['random_plate_police_cmris'];
            $VehicleRegistrationPrice->customised_plate_police_cmris = $validatedData['customised_plate_police_cmris'];
            $VehicleRegistrationPrice->save();
    
            return redirect()->back()->with('success', 'Vehicle registration price created successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong ' . $e->getMessage());
        }
     }
    
    
    
     public function edit($id){ 
      
        $states = State::all(); 
        $vehicleType = VehicleType::all(); 
        $data = VehicleRegistrationPrice::find(decrypt($id));
         
        return view('admin.pages.prices.vehicleRegistrationPrice.edit', compact('states', 'data', 'vehicleType'));
    }


    public function update(Request $request){
        $validatedData = $request->validate([
            'vehicleType' => 'required|max:255',
            'stateId' => 'required|max:255',
            'random_private_vehicle_3rd_party_insurance' => 'required|max:255',
            'customized_private_vehicle_3rd_party_insurance' => 'required|max:255',
            'random_plate_private_vehicle_no_insurance' => 'required|max:255',
            'customised_plate_private_vehicle_no_insurance' => 'required|max:255',
            'random_commercial_plate_3rd_party_insurance' => 'required|max:255', 
            'customised_commercial_plate_3rd_party_insurance' => 'required|max:255',
            'random_plate_no_commercial_vehicle_no_insurance' => 'required|max:255',
            'customized_plate_no_commercial_vehicle_no_insurance' => 'required|max:255',
            'random_plate_hackney_permit' => 'required|max:255',
            'customized_plate_hackney_permit' => 'required|max:255',
            'random_plate_police_cmris' => 'required|max:255',
            'customised_plate_police_cmris' => 'required|max:255',
        ]);  
 
         try {
            $VehicleRegistrationPrice =  VehicleRegistrationPrice::find($request->id); 
            $VehicleRegistrationPrice->state_id = $validatedData['stateId']; 
            $VehicleRegistrationPrice->vehicle_type_id = $validatedData['vehicleType']; 
            $VehicleRegistrationPrice->random_private_vehicle_3rd_party_insurance = $validatedData['random_private_vehicle_3rd_party_insurance']; 
            $VehicleRegistrationPrice->customized_private_vehicle_3rd_party_insurance = $validatedData['customized_private_vehicle_3rd_party_insurance'];
            $VehicleRegistrationPrice->random_plate_private_vehicle_no_insurance = $validatedData['random_plate_private_vehicle_no_insurance']; 
            $VehicleRegistrationPrice->customised_plate_private_vehicle_no_insurance = $validatedData['customised_plate_private_vehicle_no_insurance'];
            $VehicleRegistrationPrice->random_commercial_plate_3rd_party_insurance = $validatedData['random_commercial_plate_3rd_party_insurance'];
            $VehicleRegistrationPrice->customised_commercial_plate_3rd_party_insurance = $validatedData['customised_commercial_plate_3rd_party_insurance']; 
            $VehicleRegistrationPrice->random_plate_no_commercial_vehicle_no_insurance = $validatedData['random_plate_no_commercial_vehicle_no_insurance'];
            $VehicleRegistrationPrice->customized_plate_no_commercial_vehicle_no_insurance = $validatedData['customized_plate_no_commercial_vehicle_no_insurance']; 
            $VehicleRegistrationPrice->random_plate_hackney_permit = $validatedData['random_plate_hackney_permit'];
            $VehicleRegistrationPrice->customized_plate_hackney_permit = $validatedData['customized_plate_hackney_permit'];
            $VehicleRegistrationPrice->random_plate_police_cmris = $validatedData['random_plate_police_cmris'];
            $VehicleRegistrationPrice->customised_plate_police_cmris = $validatedData['customised_plate_police_cmris'];
            $VehicleRegistrationPrice->save();
    
            return redirect()->back()->with('success', 'Vehicle registration price updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong ' . $e->getMessage());
        }
        
        return redirect()->route('admin.price.vehicleRegistration.vehicleRegistration')->with('success', 'Vehicle renewal price deleted successfully');
    }

    public function destroy($id){
   
        $vehicleRegId = decrypt($id);
        $vehicleReg = VehicleRegistrationPrice::find($vehicleRegId);
        if(!$vehicleReg){
            return redirect()->back()->with('error', 'Vehicle renewal price not found.');
        }
        $vehicleReg->delete();
        return redirect()->back()->with('success', 'Vehicle registration price deleted successfully');
    }
 
}