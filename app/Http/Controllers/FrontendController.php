<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactMessage;

class FrontendController extends Controller
{
    public function index()
    {
        return view('frontend.home'); 
    }

    public function processpapers(){
        return view('frontend.pages.processpapers');
    }
    public function contactus()
    {
        return view('frontend.pages.contactus');
    }
    public function community()
    {
        return view('frontend.pages.community');
    }
    public function aboutus(){
        return view('frontend.pages.aboutus');
    }

    public function policy (){
        return view('frontend.pages.policy');
    } 

    public function terms (){
        return view('frontend.pages.terms');
    } 

    public function howitwork (){
        return view('frontend.pages.howitwork');
    } 
    public function signup(){
        return view('frontend.pages.signup');
    }

    public function discusion()
    {
        return view('frontend.pages.discusion');
    } 

    public function submitForm(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'fullname' => 'required|string|max:30',
            'email' => 'required|string|email|max:30',
            'phone' => 'required|string|max:11',
            'subject' => 'required|max:30',
            'message' => 'required|max:50',
            'g-recaptcha-response'=> 'required',
        ]);
       
        $recaptcha = $request->input('g-recaptcha-response');
        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => config('services.recaptcha.secretKey'),
            'response' => $recaptcha,
            'remoteip' => \request()->ip()
        ]);
        $recaptcha_success = $response['success'];
         // Checking if validation fails
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        if (!$recaptcha_success) {
            return redirect()->back()->with(['recaptcha_error' => 'Please verify that you are not a robot.']);
        }
        // $mailmessage = $request->all();
        $contactMessage = new ContactMessage([
            'fullname' => $request->input('fullname'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'subject' => $request->input('subject'),
            'message' => $request->input('message'),
        ]);
        $contactMessage->save();

        // Redirect back with a success message
        return redirect()->route('contactus')->with('success', 'Message sent successfully');

        
    }
    

   
}
