<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\AgentRegistrationReceivedMessage;
use App\Models\Agent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AgentRegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.agent.agent-register');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255|unique:agents,username',
            'fullname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:agents,email',
            'phone_no' => 'required|string|max:20',
            'location' => 'nullable|string|max:255',
            'gender' => 'required|in:male,female,other',
            'password' => 'required|string|min:7|confirmed',
            'means_of_identification_type' => 'required|in:national_id,drivers_license,voters_card,international_passport',
            'means_of_identification' => 'required|file|mimes:jpeg,jpg,png,pdf|max:9048',
            'passport_photograph' => 'required|file|mimes:jpeg,jpg,png|max:9048',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors($validator);
        }

        try {
            $idFile = $request->file('means_of_identification');
            $idFilename = time() . '_' . Str::slug($request->input('username')) . '_id.' . $idFile->getClientOriginalExtension();
            $idFile->move(public_path('documents/agentApprovals'), $idFilename);

            $passportFile = $request->file('passport_photograph');
            $passportFilename = time() . '_' . Str::slug($request->input('username')) . '_passport.' . $passportFile->getClientOriginalExtension();
            $passportFile->move(public_path('documents/agentApprovals'), $passportFilename);

            $agent = Agent::create([
                'username' => $request->input('username'),
                'email' => $request->input('email'),
                'fullname' => $request->input('fullname'),
                'phone_no' => $request->input('phone_no'),
                'location' => $request->input('location'),
                'gender' => $request->input('gender'),
                'password' => Hash::make($request->input('password')),
                'userType' => 'agent',
                'status' => 'active',
                'approval_status' => 'pending',
                'means_of_identification_type' => $request->input('means_of_identification_type'),
                'means_of_identification' => $idFilename,
                'passport_photograph' => $passportFilename,
            ]);

            try {
                Mail::to($agent->email)->send(new AgentRegistrationReceivedMessage($agent->email, $agent->fullname, $agent->username));
            } catch (\Exception $e) {
                // Registration still succeeds even if the confirmation email fails.
            }

            return redirect()->route('agent.login')->with('success', 'Your application has been submitted and is pending review. You will be notified by email once it has been approved.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Could not submit your application. Please try again.');
        }
    }
}
