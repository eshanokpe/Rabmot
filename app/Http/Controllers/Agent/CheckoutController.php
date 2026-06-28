<?php

namespace App\Http\Controllers\Agent;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\VehiclePaperRenewal;
use App\Models\DriverLicenseRenewal;
use App\Models\NewDriverLicense;
use App\Models\InternationalDriverLicense;
use App\Models\Order;
use Auth;
use Cart;

class CheckoutController extends Controller
{
    public function index(){
        
        $cartItems = Cart::content();
        if( $cartItems->isEmpty() ){
         return redirect()->route('agent.cart')->with('error', 'Your cart is Empty. Add Items to process to checkout.');
        }
       
        $orderNumber = str_pad(mt_rand(1,999999), 6, '0', STR_PAD_LEFT);
        $user = Auth::guard('agent')->user();
        $id = $user->id;
        $email = $user->email;
        $fullname = $user->fullname;

        $newdriverlicense = null;
        $license = '';
        $driverlicenserenewal = null;
        $changeofownership = '';
        $dealerplatenumber = '';
        $vehiclerenewal = '';
        $vehicleregistration = '';
        $internationalDL = null;
        try{
            foreach ($cartItems as $items ){
                Order::create([
                    'user_id' => $id,
                    'user_email' => $email,
                    'owner_id' => $items->model->owner_id,
                    'userType' => 'agent',
                    'order_number' => $orderNumber,
                    'process_id' => $items->model->process_id,
                    'product_name' => $items->model->process_type,
                    'product_amount' => $items->price,
                    'product_qty' => $items->qty,
                    'total' => $items->price * $items->qty,
                ]);
            }
            if ($items->model->process_type == 'Vehicle Paper Renewal') {
                $vehiclerenewal = VehiclePaperRenewal::where('process_id', $items->model->process_id)->first();
            }
            if ($items->model->process_type == 'Driver License Renewal') {
                $driverlicenserenewal = DriverLicenseRenewal::where('process_id', $items->model->process_id)->first();
            }
            
            if ($items->model->process_type == 'New Driver License') {
                $newdriverlicense = NewDriverLicense::where('process_id', $items->model->process_id)->first();
            }
            
            if ($items->model->process_type == 'International Driver License') {
                $internationalDL = InternationalDriverLicense::where('process_id', $items->model->process_id)->first();
            }
            
            return view('agent.pages.checkout', compact(
                'user',
                'fullname', 'email', 
                'cartItems', 'orderNumber', 
                'newdriverlicense', 'driverlicenserenewal', 
                'changeofownership', 'dealerplatenumber',
                'vehiclerenewal', 'vehicleregistration', 'internationalDL'
            ));
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error', $e], 500);
        }
     }
 
     public function store(Request $request){
        $item = Order::whereOrderNumber($request->orderNo)->get();
 
        $amount = Order::whereOrderNumber($request->orderNo)->sum('total');
 
     }
}
