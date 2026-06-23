<?php

namespace App\Http\Controllers;

use Http;
use Illuminate\Http\Request;
use App\Models\FAQs;
use App\Models\Topic;
use App\Models\ContactMessage;
use Illuminate\Support\Facades\Validator;

class ProductsController extends Controller
{
    public function int_drivers_license(){
        return view('frontend.pages.products.int_drivers_license');
    }
    
    public function international_license_store(Request $request){
        $validator = Validator::make($request->all(), [
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone_number' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'country' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'city' => 'required|string|max:100',
            'zip_code' => 'required|string|max:20',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Process the form data and save it to the database or perform any other necessary actions

        return redirect()->back()->with('success', 'Your request has been submitted successfully.');
    }

    public function dealer_plate_number(){
        return view('frontend.pages.products.dealers_plate');
    }

    public function dealer_plate_number_store(Request $request){
        $validator = Validator::make($request->all(), [
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone_number' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'country' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'city' => 'required|string|max:100',
            'zip_code' => 'required|string|max:20',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Process the form data and save it to the database or perform any other necessary actions

        return redirect()->back()->with('success', 'Your request has been submitted successfully.');
    }

    public function vehicle_renewal(){
        return view('frontend.pages.products.vehicle_renewal');
    }

    public function vehicle_renewal_store(Request $request){
        $validator = Validator::make($request->all(), [
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone_number' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'country' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'city' => 'required|string|max:100',
            'zip_code' => 'required|string|max:20',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Process the form data and save it to the database or perform any other necessary actions

        return redirect()->back()->with('success', 'Your request has been submitted successfully.');
    }

}
