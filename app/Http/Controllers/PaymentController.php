<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use PHPUnit\TextUI\Exception;
use Redirect;
use SeerbitLaravel\Facades\Seerbit; 
use App\Models\PaymentModel;
use App\Models\ProcessHistory;
use Auth;
use Cart;
use App\Models\User;
use App\Mail\PendingMode;
use Mail;
use App\Mail\InvoiceMail;
use Carbon\Carbon;

class PaymentController extends Controller{
    
    
    
    public function initiatePayment(Request $request){
     
     
        $item = Order::whereOrderNumber($request->orderNo)->get();
        $amount = Order::whereOrderNumber($request->orderNo)->sum('total');
        $total = $request->total;
        $fullname = $request->fullname;
        $email = $request->email;
        $process_id = $request->process_id;
        $process_type = $request->process_type;
        $numberStringWithoutComma = str_replace(',', '', $total);
        $floatNumber = (float) $numberStringWithoutComma;
        $uuid = bin2hex(random_bytes(6));  
        $transaction_ref = strtoupper(trim($uuid));
    
        $payload = [
            "amount" =>  $floatNumber,
            "callbackUrl" => "https://rabmotlicensing.com/home/payment_callbackSeerbit", 
            "country" => "NG",
            "currency" => "NGN",
            "email" => $email,
            'full_name' => $fullname,
            "paymentReference" => $transaction_ref,
            "productType" => $process_type,
            "productId" => $process_id,
        ];
  
        // Initiate the payment request
        $paymentUrl = SeerBit::Standard()->Initialize($payload);
        $redirectLink = $paymentUrl['data']['payments']['redirectLink'];
        $redirectLink_msg = $paymentUrl['data']['message'];
        
        if("Successful" == $redirectLink_msg){
           
            $payment = new PaymentModel();
            $payment->process_id = $process_id;
            $payment->process_type = $process_type;
            $payment->paymentReference = $transaction_ref;
            $payment->full_name = $fullname;
            $payment->email = $email;
            $payment->amount = $floatNumber;
            $payment->trans_id = null;
            $payment->status = "0";
            $phone = Auth::user()->phone;
           
            if($payment->save()){
                // Send the invoice email
                $cartItems = Cart::content();
                // dd($cartItems); 
                // dd($item);
                $totalAmount = collect($item)->sum('total');
                $saleDate = Carbon::now()->format('M d, Y');
                
                $invoiceDate = Carbon::now()->format('d') . Carbon::now()->format('m');
                $lastInvoice = PaymentModel::where('created_at', '>=', Carbon::now()->format('Y-m-d 00:00:00'))
                                           ->where('created_at', '<=', Carbon::now()->format('Y-m-d 23:59:59'))
                                           ->orderBy('id', 'desc')
                                           ->first();
                // dd($lastInvoice);
                if ($lastInvoice) {
                    $increment = intval(substr(0, -3)) + 1; // Extract the last three digits and increment
                } else {
                    $increment = 1;
                }
                $incrementFormatted = str_pad($increment, 3, '0', STR_PAD_LEFT);
                $invoiceNumber = $invoiceDate . $incrementFormatted; 

                try{
                    Mail::to($email)->send(new InvoiceMail(
                        $request->orderNo, 
                        $fullname, 
                        $email, 
                        $phone,
                        $item,
                        $cartItems,
                        $totalAmount,
                        $invoiceNumber,
                        $saleDate
                    ));
                } catch (Exception $e) {
                    Session::flash('error', 'Payment initiation failed! ' . $e->getMessage());
                    return redirect()->route('home.cart');
                }
                return redirect($redirectLink);
            }else{
                //   echo "Failed Transaction!";
                Session::flash('error', 'Failed to save payment details!');
                return redirect()->route('home.cart'); 
            }
        }else {
            Session::flash('error', 'Payment initiation failed!');
            return redirect()->route('home.cart'); // Redirect to cart or another appropriate page
        }
       
    }
   
    public function handleGatewayCallbackSeerbit(Request $request){
       
        $data = $request->all();
        
        $id = Auth::user()->id;
        $email = Auth::user()->email;
        $cartItems = Cart::content();
       
        if("Successful" == $data['message']){
            //   dd($data);
            $ref_id = $data['reference'];
            $trans_id = $data['linkingreference'];
            $status = $data['message'];
            $payment = PaymentModel::where('paymentReference', $ref_id)->firstOrFail();
            $payment->trans_id = $trans_id;
            $payment->status = $status;
            foreach ($cartItems as $item ){
                //  dd($item);
                ProcessHistory::create([ 
                    'user_id' => $id ?? null,
                    'user_email' => $email ?? null,
                    'process_number'=> $orderNumber ?? null,
                    'process_id' =>  $item->model->process_id ?? null,
                    'process_type' => $item->model->process_type ?? null,
                    'process_DLR_lengthofyears' =>  $item->model->lengthofyears ?? null,
                    'process_NDL_lengthofyear' => $item->model->lengthofyear ?? null,
                    'process_CO_vc' => $item->model->vehicle_category ?? null,
                    'process_CO_vl' => $item->model->vehiclelicenseexpiry_date ?? null,
                    'process_VR_name' =>  $item->model->categoryInfo->name ?? null,
                    'process_VR_vehicleregistrationType' =>  $item->model->vehicleregistrationType->name ?? null,
                    'process_VR_numberplate' =>  $item->model->numberplate ?? null, 
                    'process_VR_preferrednumber' =>  $item->model->preferrednumber ?? null, 
                    'process_VPR_vehicleType' =>  $item->model->vehicleType ?? null, 
                    'process_VPR_vehicleLicense' =>  $item->model->vehicleLicense ?? null, 
                    'process_VPR_roadWorthiness' =>  $item->model->roadWorthiness ?? null, 
                    'process_VPR_thirdPartyInsurance' =>  $item->model->thirdPartyInsurance ?? null, 
                    'process_VPR_vehicleInspectionPickanddrop' =>  $item->model->vehicleInspectionPickanddrop ?? null, 
                    'process_VPR_hackneyPermit' =>  $item->model->hackneyPermit ?? null, 
                    'process_DPN_processtype' =>  $item->model->process_type ?? null, 
                    'process_DPN_fullname' =>  $item->model->fullname ?? null, 
                    'totalamount' => $item->price * $item->qty ?? null,
                    'status' => 0,
                ]);
            }
            
            
           
            if($payment->save()){
                
                $user = User::where('email',$email)->get()->first();
                
                $user_email = new PendingMode($user); 
               
                Mail::to($user->email)->send($user_email);
               
                Cart::destroy();
                return  redirect()->route('home');
            }else{
                Session::flash('error', 'Payment initiation failed!');
                // echo "Failed Transaction!";
                return redirect()->route('home.cart'); 
            }
        }
    }
    
     public function AgentInitiatePayment(Request $request){
        $item = Order::whereOrderNumber($request->orderNo)->get();
        $amount = Order::whereOrderNumber($request->orderNo)->sum('total');
        $total = $request->total;
        $fullname = $request->fullname;
        $email = $request->email;
        $process_id = $request->process_id;
        $process_type = $request->process_type;
    
        // Remove the comma from the number string
        $numberStringWithoutComma = str_replace(',', '', $total);
    
        // Convert the string to a float
        $floatNumber = (float) $numberStringWithoutComma;
       
        $uuid = bin2hex(random_bytes(6));  
        $transaction_ref = strtoupper(trim($uuid));
    
        $payload = [
            "amount" =>  $floatNumber,
            "callbackUrl" => "https://rabmotlicensing.com/home/payment_callbackSeerbit", 
            //  "callbackUrl" => route('home.payment'), 
            "country" => "NG",
            "currency" => "NGN",
            "email" => $email,
            'full_name' => $fullname,
            "paymentReference" => $transaction_ref,
            "productType" => $process_type,
            "productId" => $process_id,
        ];
    
        // Initiate the payment request
        $paymentUrl = SeerBit::Standard()->Initialize($payload);
        $redirectLink = $paymentUrl['data']['payments']['redirectLink'];
        $redirectLink_msg = $paymentUrl['data']['message'];
        if("Successful" == $redirectLink_msg){
            
            $payment = new PaymentModel();
            $payment->process_id = $process_id;
            $payment->process_type = $process_type;
            $payment->paymentReference = $transaction_ref;
            $payment->full_name = $fullname;
            $payment->email = $email;
            $payment->amount = $floatNumber;
            $payment->trans_id = null;
            $payment->status = "0";
            
            if($payment->save()){
                //echo "Transaction Successful";
                return redirect($redirectLink);
            }else{
                echo "Failed Transaction!";
                    
            }
        }
    }

    public function AgentHandleGatewayCallbackSeerbit(Request $request){
        //$paymentDetails = SeerBit::getPaymentData();
        $data = $request->all();
        $agent = auth('agent')->user();
        $id = $agent->id;
        $fullname = $agent->fullname;
        $email = $agent->email;
        $cartItems = Cart::content();
       
        if("Successful" == $data['message']){
            $ref_id = $data['reference'];
            $trans_id = $data['linkingreference'];
            $status = $data['message'];
            
            $payment = PaymentModel::where('paymentReference', $ref_id)->firstOrFail();
            $payment->trans_id = $trans_id;
            $payment->status = $status;
            foreach ($cartItems as $item ){
                ProcessHistory::create([
                    'user_id' => $id ?? null,
                    'user_email' => $email ?? null,
                    'process_number'=> $orderNumber ?? null,
                    'process_id' =>  $item->model->process_id ?? null,
                    'process_type' => $item->model->process_type ?? null,
                    'process_DLR_lengthofyears' =>  $item->model->lengthofyears ?? null,
                    'process_NDL_lengthofyear' => $item->model->lengthofyear ?? null,
                    'process_CO_vc' => $item->model->vehicle_category ?? null,
                    'process_CO_vl' => $item->model->vehiclelicenseexpiry_date ?? null,
                    'process_VR_name' =>  $item->model->categoryInfo->name ?? null,
                    'process_VR_vehicleregistrationType' =>  $item->model->vehicleregistrationType->name ?? null,
                    'process_VR_numberplate' =>  $item->model->numberplate ?? null, 
                    'process_VR_preferrednumber' =>  $item->model->preferrednumber ?? null, 
                    'process_VPR_vehicleType' =>  $item->model->vehicleType ?? null, 
                    'process_VPR_vehicleLicense' =>  $item->model->vehicleLicense ?? null, 
                    'process_VPR_roadWorthiness' =>  $item->model->roadWorthiness ?? null, 
                    'process_VPR_thirdPartyInsurance' =>  $item->model->thirdPartyInsurance ?? null, 
                    'process_VPR_vehicleInspectionPickanddrop' =>  $item->model->vehicleInspectionPickanddrop ?? null, 
                    'process_VPR_hackneyPermit' =>  $item->model->hackneyPermit ?? null, 
                    'process_DPN_processtype' =>  $item->model->process_type ?? null, 
                    'process_DPN_fullname' =>  $item->model->fullname ?? null, 
                    'totalamount' => $item->price * $item->qty ?? null,
                    'status' => 0,
                ]);
            }

            if($payment->save()){
                Cart::destroy();
                return  redirect()->route('agent.index');
            }else{
                 echo "Failed Transaction!";
                    
            }
        }
    }
}
