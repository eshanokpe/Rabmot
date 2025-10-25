<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\State;
use App\Models\VehicleType;
use App\Models\OtherPermitType;
use App\Models\OtherPermitPrice;
use Illuminate\Support\Facades\Validator;


class OtherPermitPriceController extends Controller
{ 
    public function index(){
        $data['data'] = OtherPermitPrice::latest()->get();
        return view('admin.pages.prices.otherPermit.index', $data);
    }

    public function create(){
        $states = State::all(); 
        $VehicleType = VehicleType::all();
        $permitTypes = OtherPermitType::all();
        return view('admin.pages.prices.otherPermit.add', compact('VehicleType','states','permitTypes'));
    } 

    public function store(Request $request){ 
      
        $validatedData = $request->validate([
            'permitTypeId' => 'required|max:255',
            'amount'=> 'required|max:255',
        ]);
        
        try{
            
            $data = new OtherPermitPrice();
            $data->permit_type_id = $validatedData['permitTypeId'];
            $data->amount = $validatedData['amount'];
            $data->save(); 
            
            return redirect()->back()->with('success', 'OtherPermit Price created successfully');
        }catch(\Exception $e){
            
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    public function storeType(Request $request){
     
        $validatedData = $request->validate([
            'permitType' => 'required|max:255',
        ]);
        
        try{
            
            $data = new OtherPermitType();
            $data->name = $validatedData['permitType'];
            $data->save();
            
            return redirect()->back()->with('success', 'Other Permit Type created successfully');
        }catch(\Exception $e){
            
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    public function edit($id){
        $permitTypes = OtherPermitType::all(); 
        $data = OtherPermitPrice::find(decrypt($id));
        return view('admin.pages.prices.otherPermit.edit', compact('permitTypes', 'data'));
    }

       
    public function update(Request $request){
        $validatedData = $request->validate([
            'permitTypeId' => 'required|max:255',
            'amount'=> 'required|max:255',
        ]);
        
        try{
            $data = OtherPermitPrice::find($request->id);
            $data->permit_type_id = $validatedData['permitTypeId'];
            $data->amount = $validatedData['amount'];
            $data->save();
            
            return redirect()->back()->with('success', 'OtherPermit Price updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    public function destroy($id){
        $dataId = decrypt($id);
        $data = DealersPlateNumberPrice::find($dataId);
        if(!$data){
            return redirect()->back()->with('error', 'Dealers Platenumber Price data not found.');
        }
        $data->delete();
        return redirect()->back()->with('success', 'Dealers Platenumber Price  Price deleted successfully');

    }
 
}