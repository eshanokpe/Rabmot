<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\State;
use App\Models\VehicleType;
use App\Models\InternationalDriverLicensePrice;
use Illuminate\Support\Facades\Validator;


class InternationalDriverLicensePriceController extends Controller
{ 
    public function index(){
        $data['data'] = InternationalDriverLicensePrice::latest()->get();
        return view('admin.pages.prices.intDriverLicense.index', $data);
    }

    public function create(){
        $states = State::all(); 
        $VehicleType = VehicleType::all();
        return view('admin.pages.prices.intDriverLicense.add', compact('VehicleType','states'));
    } 

    public function store(Request $request){
    
        $validatedData = $request->validate([
            'stateId' => 'required|max:255',
            'yearType'=> 'required|max:255',
            'amount'=> 'required|max:255',
        ]);
      
        try{
            $data = new InternationalDriverLicensePrice();
            $data->state_id = $validatedData['stateId'];
            $data->years_type = $validatedData['yearType'];
            $data->amount = $validatedData['amount'];
            $data->save();
            
            return redirect()->back()->with('success', 'International Driver License created successfully');
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    public function edit($id){
        $states = State::all(); 
        $vehicleType = VehicleType::all(); 
        $data = InternationalDriverLicensePrice::find(decrypt($id));
        return view('admin.pages.prices.intDriverLicense.edit', compact('states', 'data', 'vehicleType'));
    }

       
    public function update(Request $request){
        $validatedData = $request->validate([
           'stateId' => 'required|max:255',
           'yearType'=> 'required|max:255',
           'amount'=> 'required|max:255',
       ]);
       
       try{
           $data = InternationalDriverLicensePrice::find($request->id);
           $data->state_id = $validatedData['stateId'];
           $data->years_type = $validatedData['yearType'];
           $data->amount = $validatedData['amount'];
           $data->save();
           
           return redirect()->back()->with('success', 'Vehicle International Driver License updated successfully');
       } catch (\Exception $e) {
           return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
       }
   }

   public function destroy($id){
        $dataId = decrypt($id);
        $data = InternationalDriverLicensePrice::find($dataId);
        if(!$data){
            return redirect()->back()->with('error', 'Vehicle International Driver License  data not found.');
        }
        $data->delete();
        return redirect()->back()->with('success', 'Vehicle International Driver License  Price deleted successfully');

    }
 
}