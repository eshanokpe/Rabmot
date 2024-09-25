<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class ProfileController extends Controller
{
    public function index(){
        $id = Auth::user()->id;
        $email = Auth::user()->email;
        
        $userdetails = User::where('id', '=', $id)->first();
       return view('user.pages.profile.profile', compact('userdetails'));
    }

    public function editprofile(){
        return view('user.pages.profile.editprofile');
    }

    public function userProfile(){
        $id = Auth::user()->id;
        $email = Auth::user()->email;
        
        $userdetails = User::where('id', '=', $id)->first();

        return response()->json([
            'fullname' => $userdetails->fullname,
            'email' => $userdetails->email,
            'phone' => $userdetails->phone,
            'address' => $userdetails->address,
            'gender' => $userdetails->gender,
            'profileImage' => $userdetails->profile_image,
        ]);
    }

    
    public function updateProfile(Request $request) {
        try {
            // Validate input fields including the profile image
            $validated = Validator::make($request->all(), [
                'fullname' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255'],
                'phone' => ['required', 'string', 'max:255'],
                'address' => ['required', 'string', 'max:255'],
                'gender' => ['required', 'string', 'max:255'],
                // 'profileImage' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:1024'], // Profile image validation
            ]);
    
            // Check if validation fails and return the full list of errors
            if ($validated->fails()) {
                return response()->json([
                    'code' => 400, 
                    'error' => $validated->errors(), // Return all validation errors
                ]);
            }
    
            // Get the authenticated user
            $user = auth()->user();
            $imageName = $user->profile_image; // Keep the old image name
    
            // Check if a new profile image is uploaded
            if ($request->hasFile('profileImage')) {
                // Delete the old profile image if it exists
                if ($imageName && file_exists(public_path('assets/profileimages/') . $imageName)) {
                    unlink(public_path('assets/profileimages/') . $imageName);
                }
    
                // Save the new profile image
                $image = $request->file('profileImage');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('assets/profileimages'), $imageName);
            }
    
            // Update the user's profile details
            $user->update([
                'fullname' => $request->fullname,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'gender' => $request->gender,
                'profile_image' => $imageName,
            ]);
    
            return response()->json([
                'code' => 200,
                'msg' => 'Profile updated successfully.',
            ]);
    
        } catch (\Exception $e) {
            // Return error response in case of an exception
            return response()->json([
                'code' => 500,
                'error' => 'An error occurred during the process. Please try again.',
                'details' => $e->getMessage()
            ]);
        }
    }
    
    
}
