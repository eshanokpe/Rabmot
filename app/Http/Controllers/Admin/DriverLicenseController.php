<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\State;
use App\Models\VehicleType;
use App\Models\NewDriverLicensePrice;
use Illuminate\Support\Facades\Validator;


class DriverLicenseController extends Controller
{
    public function index(){
        $data['data'] = NewDriverLicensePrice::latest()->get();
        return view('admin.pages.prices.driverLicense.index', $data);
    }

    public function create(){
        $states = State::all(); 
        $VehicleType = VehicleType::all();
        return view('admin.pages.prices.driverLicense.add', compact('VehicleType','states'));
    } 

    public function store(Request $request){
          
        $validatedData = $request->validate([
            'stateId' => 'required|max:255',
            'yearsType'=> 'required|max:255',
            'amount'=> 'required|max:255',
        ]);
        
        try{
            $data = new NewDriverLicensePrice();
            $data->state_id = $validatedData['stateId'];
            $data->years_type = $validatedData['yearsType'];
            $data->amount = $validatedData['amount'];
            $data->save();
            
            return redirect()->back()->with('success', 'Vehicle Driver License created successfully');
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    public function edit($id){
        $states = State::all(); 
        $vehicleType = VehicleType::all(); 
        $data = NewDriverLicensePrice::find(decrypt($id));
        return view('admin.pages.prices.driverLicense.edit', compact('states', 'data', 'vehicleType'));
    }

       
    public function update(Request $request){
        
        $validatedData = $request->validate([
             'stateId' => 'required|max:255',
             'yearsType'=> 'required|max:255',
             'amount'=> 'required|max:255',
         ]);
        
         try{
             $data = NewDriverLicensePrice::find($request->id);
             $data->state_id = $validatedData['stateId'];
             $data->years_type = $validatedData['yearsType'];
             $data->amount = $validatedData['amount'];
             $data->save();
             
             return redirect()->back()->with('success', 'Vehicle Driver License updated successfully');
         } catch (\Exception $e) {
             return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
         }
     }

    public function destroy($id){
   
        $vehicleRegId = decrypt($id);
        $vehicleReg = NewDriverLicensePrice::find($vehicleRegId);
        if(!$vehicleReg){
            return redirect()->back()->with('error', 'Vehicle Driver License  price  price not found.');
        }
        $vehicleReg->delete();
        return redirect()->back()->with('success', 'Vehicle Driver License  price deleted successfully');
    }
 
}