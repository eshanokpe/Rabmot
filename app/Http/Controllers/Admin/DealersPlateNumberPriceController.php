<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\State;
use App\Models\VehicleType;
use App\Models\DealersPlateNumberPrice;
use Illuminate\Support\Facades\Validator;


class DealersPlateNumberPriceController extends Controller
{ 
    public function index(){
        $data['data'] = DealersPlateNumberPrice::latest()->get();
        return view('admin.pages.prices.dealersPlatenumber.index', $data);
    }

    public function create(){
        $states = State::all(); 
        $VehicleType = VehicleType::all();
        return view('admin.pages.prices.dealersPlatenumber.add', compact('VehicleType','states'));
    } 

    public function store(Request $request){ 
      
        $validatedData = $request->validate([
            'stateId' => 'required|max:255',
            'amount'=> 'required|max:255',
        ]);
        
        try{
            
            $data = new DealersPlateNumberPrice();
            $data->state_id = $validatedData['stateId'];
            $data->amount = $validatedData['amount'];
            $data->save();
            
            return redirect()->back()->with('success', 'Dealers Platenumber Price created successfully');
        }catch(\Exception $e){
            
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    public function edit($id){
        $states = State::all(); 
        $vehicleType = VehicleType::all(); 
        $data = DealersPlateNumberPrice::find(decrypt($id));
        return view('admin.pages.prices.dealersPlatenumber.edit', compact('states', 'data', 'vehicleType'));
    }

       
    public function update(Request $request){
      
        $validatedData = $request->validate([
            'stateId' => 'required|max:255',
            'amount'=> 'required|max:255',
        ]);
        
        try{
            $data = DealersPlateNumberPrice::find($request->id);
            $data->state_id = $validatedData['stateId'];
            $data->amount = $validatedData['amount'];
            $data->save();
            
            return redirect()->back()->with('success', 'Dealers Platenumber Price updated successfully');
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