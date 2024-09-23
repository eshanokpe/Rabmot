<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use App\Models\ProcessHistory;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function processHistory()
    {
        $id = Auth::user()->id;
        $email = Auth::user()->email;
        $processhistory = ProcessHistory::where('user_id', $id)
                                        ->latest()
                                        ->get();

        return view('user.processhistory', compact('id', 'email', 'processhistory'));
    }

    public function deleteprocesshistory(Request $request){
        $id =  $request->itemId;
        $history = ProcessHistory::findOrFail($id);
        $history->delete();
        return response()->json([
            'message' => 'Process History deleted successfully', 
        ]);
    }

    public function transactionHistory()
    {
        $id = Auth::user()->id;
        $email = Auth::user()->email;
        $transactionhistory = ProcessHistory::where('user_id', $id)
                                       // ->where('status',0)
                                        ->get();

        return view('user.transactionhistory', compact('id', 'email', 'transactionhistory'));
    }

    public function deletetransactionhistory(Request $request){
        $id =  $request->itemId;
        $history = ProcessHistory::findOrFail($id);
        $history->delete();
        return response()->json([
            'message' => 'Transaction History deleted successfully', 
        ]);
    }

    public function updateProfile(Request $request){
        $validated = Validator::make($request->all(), [
            'fullname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'gender' => ['required', 'string', 'max:255'],
        ]); 
 
        # check if user profile image is null, then validate
        if (auth()->user()->profile_image == null) {
             $validate_image = Validator::make($request->all(), [
                'profile_image' => ['required', 'image', 'max:1000']
            ]);
             # check if their is any error in image validation
            if ($validate_image->fails()) {
                return response()->json(['code' => 400, 'msg' => $validate_image->errors()->first()]);
            }
        }
 
        # check if their is any error
        if ($validated->fails()) {
            return response()->json(['code' => 400, 'msg' => $validated->errors()->first()]);
        }
        $imageName = auth()->user()->profile_image ;
 
        # check if the request has profile image
        if ($request->hasFile('profile_image')) {
             // Delete old image if it exists
            if (auth()->user()->profile_image) {
                // Delete the old image from the public directory
                $oldImagePath = public_path('assets/profileimages/') . auth()->user()->profile_image;
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            $image = $request->file('profile_image');
            $profile_image = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('assets/profileimages'), $profile_image);
            $imageName = $profile_image;
        }
        
 
        # update the user info
        auth()->user()->update([
            'fullname' => $request->fullname,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'gender' => $request->gender,
            'profile_image' => $imageName
        ]);
        return response()->json(['code' => 200, 'msg' => 'Profile updated successfully.']);
    }
}
