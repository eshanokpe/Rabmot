<?php

namespace App\Http\Controllers\Admin\ProcessDocument;
use App\Http\Controllers\Controller;
use Auth;
use Mail; 
use Illuminate\Http\Request;
use Carbon\Carbon; 
use App\Models\User;
use App\Models\Agent;
use App\Models\ProcessHistory;
use App\Mail\ProcessingMode;
use App\Mail\ReadyforDeliveryMode;
use App\Mail\DeliveryinprogressMode;
use App\Mail\DeliveredMode;

 
class AdminProcessDocument extends Controller
{ 
    // The per-status lists now live on Admin > Documents; keep old links working.
    public function pendingPaper(){
        return redirect()->route('admin.documents.index', ['status' => 'pending']);
    } 

   public function viewpendingPaper($id){ 
      $items = ProcessHistory::find(decrypt($id));
        return view('admin.pages.processHistory.pending.viewpendingPaper', compact('items'));
   }
  
   public function updatePendingPaperStatus(Request $request, $id){
      $request->validate([
         'status' => 'required|in:0,1,2,3,4',
      ]); 
      $user = ProcessHistory::where('id', decrypt($id))->first();
      if($request->input('status') == 1){
     
         $users = User::where('email', $user->user_email)->first();
         if (!$users) {
            $users = Agent::where('email', $user->user_email)->first();
         }
         $email = new ProcessingMode($users); 
         try{
            Mail::to($user->user_email)->send($email);
         } catch(Exception $th){
               return response()->json(['something went Error']);
         }
      }
      if($request->input('status') == 2){
         $users = User::where('email', $user->user_email)->first();
         if (!$users) {
            $users = Agent::where('email', $user->user_email)->first();
         }

         $email = new ReadyforDeliveryMode($users);
         try{
            Mail::to($user->user_email)->send($email);
         } catch(Exception $th){
               return response()->json(['something went Error']);
         }
      }
      if($request->input('status') == 3){
         $users = User::where('email', $user->user_email)->first();
         if (!$users) {
            $users = Agent::where('email', $user->user_email)->first();
         }
         $email = new DeliveryinprogressMode($users);
         try{
            Mail::to($user->user_email)->send($email);
         } catch(Exception $th){
               return response()->json(['something went Error']);
         }
      }
      if($request->input('status') == 4){
         $users = User::where('email', $user->user_email)->first();
         if (!$users) {
            $users = Agent::where('email', $user->user_email)->first();
         }
         $email = new DeliveredMode($users);
         try{
            Mail::to($user->user_email)->send($email);
         } catch(Exception $th){
               return response()->json(['something went Error']);
         }
      }
      $user->status = $request->input('status');
      $user->save();

      return redirect()->back()->with('success', 'Status updated successfully');
   }

   public function processedPaper(){
      return redirect()->route('admin.documents.index', ['status' => 'processing']);
   }

   public function viewProcessPaper($id){
      $items = ProcessHistory::find(decrypt($id));
      return view('admin.pages.processHistory.processed.viewProcessPaper', compact('items'));
   }

   public function updateProcessPaperStatus(Request $request, $id){
      $request->validate([
         'status' => 'required|in:0,1,2,3,4',
      ]);
      $user = ProcessHistory::find(decrypt($id));
      
      if($request->input('status') == 1){
         $users = User::where('email',$user->user_email)->get()->first();
         $email = new ProcessingMode($users);
         try{
            Mail::to($user->user_email)->send($email);
            //Mail::to('eshanokpe@gmail.com')->send($email);
         } catch(Exception $th){
               return response()->json(['something went Error']);
         }
      }
      if($request->input('status') == 2){
         $users = User::where('email',$user->user_email)->get()->first();
         $email = new ReadyforDeliveryMode($users);
         try{
            Mail::to($user->user_email)->send($email);
         } catch(Exception $th){
               return response()->json(['something went Error']);
         }
      }
      if($request->input('status') == 3){
         $users = User::where('email',$user->user_email)->get()->first();
         $email = new DeliveryinprogressMode($users);
         try{
            Mail::to($user->user_email)->send($email);
            //Mail::to('eshanokpe@gmail.com')->send($email);
         } catch(Exception $th){
               return response()->json(['something went Error']);
         }
      }
      if($request->input('status') == 4){
         $users = User::where('email',$user->user_email)->get()->first();
         //dd($users->fullname);
         $email = new DeliveredMode($users);
         try{
            Mail::to($user->user_email)->send($email);
         } catch(Exception $th){
               return response()->json(['something went Error']);
         }
      }
      $user = ProcessHistory::find(decrypt($id));
      //update the status
      $user->status = $request->input('status');
      $user->save();

      return redirect()->back()->with('success', 'Status updated successfully');
   }

   public function readyForDelivery(){
      return redirect()->route('admin.documents.index', ['status' => 'ready']);
   }

   public function viewDeliveryinProgress($id){
      $items = ProcessHistory::find(decrypt($id));
      return view('admin.pages.processHistory.delivery.viewReadyforDeliveryPaper', compact('items'));
   }

   public function updatereadyfordeliveryPaperStatus(Request $request, $id){
       //Validate the request
       $request->validate([
          'status' => 'required|in:0,1,2,3,4',
       ]);
 
       $user = ProcessHistory::find(decrypt($id));
      
       if($request->input('status') == 1){
          $users = User::where('email',$user->user_email)->get()->first();
          $email = new ProcessingMode($users);
          try{
            Mail::to($user->user_email)->send($email);
          } catch(Exception $th){
            return response()->json(['something went Error']);
          }
       }
       if($request->input('status') == 2){
          $users = User::where('email',$user->user_email)->get()->first();
          $email = new ReadyforDeliveryMode($users);
          try{
            Mail::to($user->user_email)->send($email);
          } catch(Exception $th){
            return response()->json(['something went Error']);
          }
       }
       if($request->input('status') == 3){
          $users = User::where('email',$user->user_email)->get()->first();
          $email = new DeliveryinprogressMode($users);
          try{
            Mail::to($user->user_email)->send($email);
          } catch(Exception $th){
                return response()->json(['something went Error']);
          }
       }
       if($request->input('status') == 4){
          $users = User::where('email',$user->user_email)->get()->first();
          $email = new DeliveredMode($users);
          try{
            Mail::to($user->user_email)->send($email);
          } catch(Exception $th){
            return response()->json(['something went Error']);
          }
       }
       //update the status
       $user->status = $request->input('status');
       $user->save();
 
       return redirect()->back()->with('success', 'Status updated successfully');
   }

   public function deliveryinProgress(){
      return redirect()->route('admin.documents.index', ['status' => 'in_progress']);
   }

   public function delivered(){
      return redirect()->route('admin.documents.index', ['status' => 'delivered']);
   }

   public function viewDeliveredPaper($id){
      $items = Processhistory::find(decrypt($id));
      return view('admin.pages.processHistory.delivered.viewDeliveredPaper', compact('items'));
   }

   public function updatedeliveredPaperStatus(Request $request, $id){
      //Validate the request
      $request->validate([
         'status' => 'required|in:0,1,2,3,4',
      ]);

      $user = ProcessHistory::find(decrypt($id));
     
      if($request->input('status') == 1){
         $users = User::where('email',$user->user_email)->get()->first();
         $email = new ProcessingMode($users);
         try{
            Mail::to($user->user_email)->send($email);
         } catch(Exception $th){
               return response()->json(['something went Error']);
         }
      }
      if($request->input('status') == 2){
         $users = User::where('email',$user->user_email)->get()->first();
         $email = new ReadyforDeliveryMode($users);
         try{
            Mail::to($user->user_email)->send($email);
         } catch(Exception $th){
               return response()->json(['something went Error']);
         }
      }
      if($request->input('status') == 3){
         $users = User::where('email',$user->user_email)->get()->first();
         $email = new DeliveryinprogressMode($users);
         try{
            Mail::to($user->user_email)->send($email);
         } catch(Exception $th){
               return response()->json(['something went Error']);
         }
      }
      if($request->input('status') == 4){
         $users = User::where('email',$user->user_email)->get()->first();
         $email = new DeliveredMode($users);
         try{
            Mail::to($user->user_email)->send($email);
         } catch(Exception $th){
               return response()->json(['something went Error']);
         }
      }
      //update the status
      $user->status = $request->input('status');
      $user->save();

      return redirect()->back()->with('success', 'Status updated successfully');
   }

   
   

}


