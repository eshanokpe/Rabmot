<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\State;
use App\Models\VehicleType;
use App\Models\DriverLicenseRenewalPrice;
use Illuminate\Support\Facades\Validator;


class DriverLicenseRenewalController extends Controller
{
    public function index(){
        $data['data'] = DriverLicenseRenewalPrice::latest()->get();
        return view('admin.pages.prices.driverLicenseRenewal.index', $data);
    }

    public function create(){
        $states = State::all(); 
        $VehicleType = VehicleType::all();
        return view('admin.pages.prices.driverLicenseRenewal.add', compact('VehicleType','states'));
    } 

    public function store(Request $request){
        $validatedData = $request->validate([
            'stateId' => 'required|max:255',
            'yearType'=> 'required|max:255',
            'amount'=> 'required|max:255',
        ]);
        
        try{
            $data = new DriverLicenseRenewalPrice();
            $data->state_id = $validatedData['stateId'];
            $data->years_type = $validatedData['yearType'];
            $data->amount = $validatedData['amount'];
            $data->save();
            
            return redirect()->back()->with('success', 'Vehicle Driver License Renewal created successfully');
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    public function edit($id){
        $states = State::all(); 
        $vehicleType = VehicleType::all(); 
        $data = DriverLicenseRenewalPrice::find(decrypt($id));
        return view('admin.pages.prices.driverLicenseRenewal.edit', compact('states', 'data', 'vehicleType'));
    }

       
    public function update(Request $request){
        $validatedData = $request->validate([
                'stateId' => 'required|max:255',
                'yearType'=> 'required|max:255',
                'amount'=> 'required|max:255',
            ]);
            
            try{
                $data = DriverLicenseRenewalPrice::find($request->id);
                $data->state_id = $validatedData['stateId'];
                $data->years_type = $validatedData['yearType'];
                $data->amount = $validatedData['amount'];
                $data->save();
                
                return redirect()->back()->with('success', 'Vehicle Driver License Renewal updated successfully');
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
            }
        }

    
     public function destroy($id){
   
        $vehicleRegId = decrypt($id);
        $vehicleReg = DriverLicenseRenewalPrice::find($vehicleRegId);
        if(!$vehicleReg){
            return redirect()->back()->with('error', 'Vehicle Driver License Renewal Price  price not found.');
        }
        $vehicleReg->delete();
        return redirect()->back()->with('success', 'Vehicle Driver License Renewal Price deleted successfully');
    }
 
}