<?php

namespace App\Http\Controllers\Admin\Transaction;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\PaymentModel;
use App\Models\Wallet;


class AdminTransactionController extends Controller
{
    public function index(){
        $data['totalAmount'] = PaymentModel::sum('amount');
        $data['totalAmountVPR'] = PaymentModel::where('process_type','Vehicle Paper Renewal')->sum('amount');
        $data['totalAmountVNR'] = PaymentModel::where('process_type','Vehicle Registration')->sum('amount');
        $data['totalAmountCO'] = PaymentModel::where('process_type','Change of Ownership')->sum('amount');
        $data['totalAmountNDL'] = PaymentModel::where('process_type','New Driver License')->sum('amount');
        $data['totalAmountDLR'] = PaymentModel::where('process_type','Driver License Renewal')->sum('amount');
        $data['totalAmountIDL'] = PaymentModel::where('process_type','International Driver License')->sum('amount');
        $data['totalAmountDPN']= PaymentModel::where('process_type','Dealers Plate Number')->sum('amount');
        $data['totalAmountOP'] = PaymentModel::where('process_type','Other Permit')->sum('amount');
        $data['totalAmountwithdraw'] = Wallet::latest()->sum('amount');
  
        $data['items'] = PaymentModel::latest()->get();
  
        
        return view('admin.pages.transactions.index', $data);
    }

    public function viewTransaction($id){
        $data['items'] = PaymentModel::find(decrypt($id));
        return view('admin.pages.transactions.viewtransaction', $data);
    }

    public function transactionPaperRenewal(){
        $data['totalAmountVPR'] = PaymentModel::where('process_type','Vehicle Paper Renewal')->sum('amount');
        $data['items'] = PaymentModel::where('process_type','Vehicle Paper Renewal')->latest()->get();
        
        return view('admin.pages.transactions.paperRenewal.index', $data);  
    }

    public function showTransactionPaperRenewal($id){
        $items = PaymentModel::find(decrypt($id));
        return view('admin.pages.transactions.paperRenewal.show', compact('items'));
    }

    public function transactionVehicleRegistration(){
        $data['totalAmountVNR'] = PaymentModel::where('process_type','Vehicle Registration')->sum('amount');
        $data['items'] = PaymentModel::where('process_type','Vehicle Registration')->latest()->get();
        return view('admin.pages.transactions.vehicleRegistration.index', $data);
    }

    public function showTransactionVehicleRegistration($id){
        $data['items'] = PaymentModel::find(decrypt($id));
        return view('admin.pages.transactions.vehicleRegistration.show', $data);
    }

    public function transactionChangeofownership(){
        $data['totalAmountCO'] = PaymentModel::where('process_type','Change of Ownership')->sum('amount');
        $data['items'] = PaymentModel::where('process_type','Change of Ownership')->latest()->get();
        return view('admin.pages.transactions.changeofOwnership.index', $data);
    }

    public function showTransactionChangeofownership($id){
        $items = PaymentModel::find(decrypt($id));
        return view('admin.pages.transactions.changeofOwnership.show', compact('items'));
    }

    public function transactionNewDriverlicense(){ 
        $data['totalAmountNDL'] = PaymentModel::where('process_type','New Driver License')->sum('amount');
        $data['items'] = PaymentModel::where('process_type','New Driver License')->latest()->get();
        return view('admin.pages.transactions.newDriverlicense.index', $data);
    }

    public function showTransactionNewDriverlicense($id){
        $items = PaymentModel::find(decrypt($id));
        return view('admin.pages.transactions.newDriverlicense.show', compact('items'));
    }

    public function transactionDriverlicenseRenewal(){ 
        $data['totalAmountDLR'] = PaymentModel::where('process_type','Driver License Renewal')->sum('amount');
        $data['items'] = PaymentModel::where('process_type','Driver License Renewal')->latest()->get();
        return view('admin.pages.transactions.driverlicenseRenewal.index', $data);
    }
  
    public function showTransactionDriverlicenseRenewal($id){
        $items = PaymentModel::find(decrypt($id));
        return view('admin.pages.transactions.driverlicenseRenewal.show', compact('items'));
    }

    public function transactionInternationalDriverlicense(){
        $data['totalAmountIDL'] = PaymentModel::where('process_type','International Driver License')->sum('amount');
        $data['items'] = PaymentModel::where('process_type','International Driver License')->latest()->get();
        return view('admin.pages.transactions.intDriverlicense.index', $data);
    }

    public function showTransactionInternationalDriverlicense($id){
        $items = PaymentModel::find(decrypt($id));
        return view('admin.pages.transactions.intDriverlicense.show', compact('items'));
    }

    public function transactionDealerPlateNumber(){
        $data['totalAmountDPN'] = PaymentModel::where('process_type','Dealers Plate Number')->sum('amount');
        $data['items'] = PaymentModel::where('process_type','Dealers Plate Number')->latest()->get();
        return view('admin.pages.transactions.dealerPlateNumber.index', $data);
    }
  
    public function showTransactionDealerPlateNumber($id){
        $items = PaymentModel::find(decrypt($id));
        return view('admin.pages.transactions.dealerPlateNumber.show', compact('items'));
    }

    public function transactionOtherPermit(){
        $data['totalAmountOP'] = PaymentModel::where('process_type','Other Permit')->sum('amount');
        $data['items'] = PaymentModel::where('process_type','Other Permit')->latest()->get();
        return view('admin.pages.transactions.otherPermit.index', $data);
    }
  
    public function showTransactionOtherPermit($id){
        $items = PaymentModel::find(decrypt($id));
        return view('admin.pages.transactions.otherPermit.show', compact('items'));
    }
}

