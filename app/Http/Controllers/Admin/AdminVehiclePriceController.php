<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\State;
use App\Models\VehicleType;
use App\Models\AddVehicleRenewal;
use App\Models\AddVehicleOwnership;
use App\Models\AddVehicleRegistration;
use Illuminate\Support\Facades\Validator;


class AdminVehiclePriceController extends Controller
{
    public function indexVehicleTypes(){
        $vehicleTypes = VehicleType::all();
        return view('admin.pages.prices.vehicleType.index', compact('vehicleTypes'));
    }

    public function createVehicleType(){
        return view('admin.pages.prices.vehicleType.add');
    } 

    public function storeVehicleType(Request $request){
          
        $validatedData = $request->validate([
            'vehiclename' => 'required|string|max:255',
        ]);
       
        try {
            VehicleType::create([
                 'name' => $request->input('vehiclename'),
            ]);
    
            return redirect()->back()->with('success', 'Vehicle created successfully');
        } catch (\Exception $e) {
           return redirect()->back()->with('error', 'Something went wrong ' . $e->getMessage());
        }
    }

    public function editVehicleType($id){
        $data = VehicleType::find(decrypt($id));
        
        return view('admin.pages.prices.vehicleType.edit', compact('data'));
    }

    public function updateVehicleType(Request $request){
        $validatedData = $request->validate([
            'vehiclename' => 'required|string|max:255',
        ]);
    
        try {
            $data = VehicleType::find($request->id);
    
            if (!$data) {
                return redirect()->back()->with('error', 'Vehicle type not found.');
            }
    
            $data->name = $request->input('vehiclename');
            $data->save();
     
            return redirect()->route('admin.vehicle.types')->with('success', 'Vehicle updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }
 
    public function indexStates(){
        $states = State::latest()->get();
        return view('admin.pages.prices.state.index', compact('states'));
    }

    public function createState(){
        $states = State::all(); 
        return view('admin.pages.prices.state.add', compact('states')); 
    } 

    public function showStateEdit($id){
        $data = State::find(decrypt($id));

        return view('admin.pages.prices.state.edit', compact('data'));
    }

    public function storeState(Request $request)
    {
       
        $validator = Validator::make($request->all(), [
            'statename' => 'required|string|max:255',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        try {
            State::create([
                 'name' => $request->input('statename'),
            ]);
    
            return redirect()->back()->with('statesuccess', 'State created successfully');
        } catch (\Exception $e) {
           return redirect()->back()->with('stateerror', 'Something went wrong ' . $e->getMessage());
        }
    }

    public function updateState(Request $request){
        $validatedData = $request->validate([
            'statename' => 'required|string|max:255',
        ]);
    
        try {
            $data = State::find($request->id);
    
            if (!$data) {
                return redirect()->back()->with('error', 'State not found.');
            }
    
            $data->name = $request->input('statename');
            $data->save();
     
            return redirect()->route('admin.states')->with('success', 'Vehicle updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

}