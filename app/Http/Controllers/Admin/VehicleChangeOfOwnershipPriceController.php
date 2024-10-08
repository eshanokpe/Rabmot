<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\State;
use App\Models\VehicleType;
use App\Models\ChangeofOwnershipPrice;
use Illuminate\Support\Facades\Validator;


class VehicleChangeOfOwnershipPriceController extends Controller
{
    public function index(){
        $data['data'] = ChangeofOwnershipPrice::latest()->get();
        return view('admin.pages.prices.changeofOwnership.index', $data);
    }

    public function create(){
        $states = State::all(); 
        $VehicleType = VehicleType::all();
        return view('admin.pages.prices.changeofOwnership.add', compact('VehicleType','states'));
    } 

    public function store(Request $request)
    {
        // Validate the incoming request
        $validatedData = $request->validate([
            'vehicle_type_id' => 'required|max:255',
            'stateId' => 'required|max:255',
            'random_vehicleLicense'=> 'required|max:255',
            'random_hacneyPermit'=> 'required|max:255',
            'random_policeCmris'=> 'required|max:255',
            'random_cost'=> 'required|max:255',
            'customised_vehicleLicense'=> 'required|max:255',
            'customised_hacneyPermit'=> 'required|max:255',
            'customised_policeCmris'=> 'required|max:255',
            'customised_cost'=> 'required|max:255',
        ]);

        try {
            $changeofownershipPrice = new ChangeofOwnershipPrice();
            $changeofownershipPrice->state_id = $validatedData['stateId'];
            $changeofownershipPrice->vehicle_type_id = $validatedData['vehicle_type_id'];
            $changeofownershipPrice->random_vehicleLicense = $validatedData['random_vehicleLicense'];
            $changeofownershipPrice->random_hacneyPermit = $validatedData['random_hacneyPermit'];
            $changeofownershipPrice->random_policeCmris = $validatedData['random_policeCmris'];
            $changeofownershipPrice->random_cost = $validatedData['random_cost'];
            $changeofownershipPrice->customised_vehicleLicense = $validatedData['customised_vehicleLicense'];
            $changeofownershipPrice->customised_hacneyPermit = $validatedData['customised_hacneyPermit'];
            $changeofownershipPrice->customised_policeCmris = $validatedData['customised_policeCmris'];
            $changeofownershipPrice->customised_cost = $validatedData['customised_cost'];
            $changeofownershipPrice->save();

            return redirect()->back()->with('success', 'Vehicle change of ownership price created successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong ' . $e->getMessage());
        }
    }

    public function edit($id){
        $states = State::all(); 
        $vehicleType = VehicleType::all(); 
        $data = ChangeofownershipPrice::find(decrypt($id));
        return view('admin.pages.prices.changeofOwnership.edit', compact('states', 'data', 'vehicleType'));
    }

    public function update(Request $request){
        // Validate the incoming request
       $validatedData = $request->validate([
           'vehicleType' => 'required|max:255',
           'stateId' => 'required|max:255',
           'random_vehicleLicense'=> 'required|max:255',
           'random_hacneyPermit'=> 'required|max:255',
           'random_policeCmris'=> 'required|max:255',
           'random_cost'=> 'required|max:255',
           'customised_vehicleLicense'=> 'required|max:255',
           'customised_hacneyPermit'=> 'required|max:255',
           'customised_policeCmris'=> 'required|max:255',
           'customised_cost'=> 'required|max:255',
       ]);

       try {
           $changeofownershipPrice =  ChangeofownershipPrice::find($request->id);
           $changeofownershipPrice->state_id = $validatedData['stateId'];
           $changeofownershipPrice->vehicle_type_id = $validatedData['vehicleType'];
           $changeofownershipPrice->random_vehicleLicense = $validatedData['random_vehicleLicense'];
           $changeofownershipPrice->random_hacneyPermit = $validatedData['random_hacneyPermit'];
           $changeofownershipPrice->random_policeCmris = $validatedData['random_policeCmris'];
           $changeofownershipPrice->random_cost = $validatedData['random_cost'];
           $changeofownershipPrice->customised_vehicleLicense = $validatedData['customised_vehicleLicense'];
           $changeofownershipPrice->customised_hacneyPermit = $validatedData['customised_hacneyPermit'];
           $changeofownershipPrice->customised_policeCmris = $validatedData['customised_policeCmris'];
           $changeofownershipPrice->customised_cost = $validatedData['customised_cost'];
           $changeofownershipPrice->save();

           return redirect()->back()->with('success', 'Vehicle change of ownership price updated successfully');
       } catch (\Exception $e) {
           return redirect()->back()->with('error', 'Something went wrong ' . $e->getMessage());
       }
   }

    public function destroy($id){
   
        $vehicleRegId = decrypt($id);
        $vehicleReg = ChangeofownershipPrice::find($vehicleRegId);
        if(!$vehicleReg){
            return redirect()->back()->with('error', 'Vehicle Change of ownership price  price not found.');
        }
        $vehicleReg->delete();
        return redirect()->back()->with('success', 'Vehicle Change of ownership price deleted successfully');
    }
 
}